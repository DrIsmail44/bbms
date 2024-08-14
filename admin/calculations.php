<?php session_start(); ?>
<!DOCTYPE html>
<!-- saved from url=(0024) -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="../asset/vue.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BBMS | Dashboard</title>

    <!-- Custom fonts for this theme -->
    <link rel="stylesheet" href="estimate.css">
    <link href="../asset/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <!-- Theme CSS -->
    <link href="../asset/freelancer.min.css" rel="stylesheet">
    <style type="text/css">
        h2 {
            color: #000000;
        }
    </style>
</head>

<body id="page-top">
<script>
        let allMaterials = '';
    </script>
     <div>   
    <!-- Navigation -->
    <?php 
    require 'nav.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $formData = json_decode($_POST['calculations']);
      // print_r($_POST['calculations']);

      if (isset($formData->calculations) && isset($formData->others->client_id) && isset($formData->totalCost)) {
        $client_id = $formData->others->client_id;
        $buildingType = $formData->others->building_type;
        $total = $formData->totalCost;
        $calculation = serialize($formData);
    
        $query1 = "INSERT INTO calculations(client_id, owner_id, building_type, calculations, total) 
          VALUES ('$client_id', '".$admin['id']."', '$buildingType', '$calculation', '$total')";
    
        $result = $db->query($query1);
        if ($result) {
            $msg = "Calculation saved successfully..!!";
            //promptMsg($msg, 'print.php?id='.$db->insert_id);
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/print.php?id='.$db->insert_id);
            die();
        } else {
            $msg = "Unable to save calculation. Try again later";
            $db->close(); // Closing Connection
            //promptMsg($msg, 'calculations.php');
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/calculations.php');
            die();
        }
    } else {
        $msg = 'One or more inputs are invalid. Try again';
        //promptMsg($msg, 'calculations.php');
        $_SESSION["error"] = $msg;
        header('Location: http://localhost/bbms/admin/calculations.php');
        die();
    }
    // die();
    }
    ?>
    <!-- Masthead -->
    <header class="masthead bg-primary text-white text-center" style="padding-top: 11%;padding-bottom: 0%;">
    </header>

    <?php if(!empty($_GET['client']) && isset($_GET['client'])  && isset($_GET['buildingType']) && isset($_GET['flat']) ) { ?>    
    <!-- get list of materials -->
    <!-- Portfolio Section -->
    <script>
      let others = {};
      others['client_id'] = "<?php echo @getClient(htmlspecialchars($_GET['client']))['id'];?>" || 0
      others['building_type'] = "<?php echo @htmlspecialchars($_GET['buildingType']);?>" || 0
      others['flats'] = "<?php echo @htmlspecialchars($_GET['flat']);?>" || 0
    </script>
    <section class="page-section portfolio" id="calculations">
        <div class="container">
            <div class="row" >
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="list-group">
                    <p class="list-group-item active">Client information</p>
                    <p class="list-group-item">
                      <strong> <i class="fa fa-male" aria-hidden="true"></i> Name: </strong>
                      <?php echo getClient(htmlspecialchars($_GET['client']))['name'];?>
                    </p>
                    <p class="list-group-item">
                      <strong><i class="fa fa-envelope" aria-hidden="true"></i> Email: </strong>
                      <?php echo getClient(htmlspecialchars($_GET['client']))['email'];?>
                    </p>
                    <p class="list-group-item">
                      <strong> <i class="fa fa-phone" aria-hidden="true"></i> Phone: </strong>
                      <?php echo getClient(htmlspecialchars($_GET['client']))['phone'];?>
                    </p>
                    <p class="list-group-item">
                      <strong> <i class="fa fa-calendar" aria-hidden="true"></i> Date registered: </strong>
                      <?php echo getClient(htmlspecialchars($_GET['client']))['date_registered'];?>
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="list-group">
                    <p class="list-group-item list-group-item-danger">Building Information</p>
                    <p class="list-group-item">
                      <strong> <i class="fa fa-home" aria-hidden="true"></i> Building type: </strong>
                      <?php echo htmlspecialchars($_GET['buildingType']);?>
                    </p>
                    <p class="list-group-item">
                      <strong> <i class="fa fa-hashtag" aria-hidden="true"></i> No. of flat(s): </strong>
                      <?php echo htmlspecialchars($_GET['flat']);?> Bedroom flat
                    </p>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 active">
            <p></p>
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                  <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th colspan='6' class='text-center'>Calculations <i class="fa fa-calculator" aria-hidden="true"></i></th>
                              </tr>
                              <tr>
                                <th>S/N</th>
                                <th>Material</th>
                                <th>Varieties</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                <tr v-for="(selectedMaterial, counter) in materialsToDisplay">
                                    <td>{{((counter+1))}}</td>
                                    <td>{{Object.keys(selectedMaterial)[0]}}</td>
                                    <td>
                                        <select class="form-control" @change="updateSelection(counter, 'costAndName',[$event, selectedMaterial])" required="required">
                                          <option value="">--Select a variety--</option>
                                          <option v-for="(smt, indx) in Object.values(selectedMaterial)[0]" :value="indx">{{smt.name}}</option>
                                        </select>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control" @input="updateSelection(counter, 'qty',$event)"  placeholder="" min="0" value="0" required="required">
                                    </td>
                                    <td><i class="fa fa-hashtag" aria-hidden="true"></i>{{selections.calculations[counter].total}}</td>
                                    <td>
                                      <button type="button" @click="remove(counter)" class="btn btn-danger">
                                        <i title="remove from list" class="fa fa-trash" aria-hidden="true"></i>
                                      </button>
                                    </td>
                                </tr>
                                <tr>
                                  <td colspan="6"> 
                                    <strong>Total: <i class="fa fa-hashtag" aria-hidden="true"></i> {{total}}</strong>
                                    <textarea style="visibility: hidden" name="calculations">{{selections}}</textarea>
                                  </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-center">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                                        <div class="col-sm-6">
                                        <!-- {{selections}} -->
                                          <label for="">Select category</label>
                                          <select v-model="category" class="form-control">
                                            <option v-for="(category, key) in allMaterials">{{key}}</option>
                                          </select>
                                        </div>
                                        <div class="col-sm-6">
                                          <label for="">Select Material</label>
                                          <select class="form-control" v-model="selectedMaterials">
                                            <option v-for="material in allMaterials[category]" :value="material">{{Object.keys(material)[0]}}</option>
                                          </select>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                  <td colspan="6">
                                    <textarea v-show="showCommentBox" v-model="selections.comments" class="form-control" placeholder="Comments goes here...." cols="30" rows="10"></textarea>
                                    <input type="checkbox" :value="showCommentBox" @change="showCommentBox = !showCommentBox">
                                    Show comment box
                                    <br>
                                    <button v-show="selections.totalCost > 0" type="submit" class="btn btn-primary">
                                      Save <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                  </button></td>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                    </div> 
                </div>
        <div style="padding: 20px 12px; display: flex; alignItems: center; justifyContent: space-between; width: 100%">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#blockId">
        Blocks Estimate
        </button>
        <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#tilesId">
        TIles Estimate
        </button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#roofingId">
        Roofing Sheets Estimate
        </button>
        </div>
            </div>
    </section>

    <?php } else{ ?>
    <script>
      let others = {}
    </script>
    <div id="calculations">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Note:</strong> A client must be selected before you can make any calculation. If you have not done that, kidnly click on start now button
        <!-- </div> -->
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
        Start now
        </button>
    </div>    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 
                        class="modal-title" 
                        style="
                            width: 100%;
                            font-size: 1.6rem;
                        "
                    >Calculate building cost</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <!-- <span aria-hidden="true">&times;</span> -->
                        </button>
                </div>
                <div class="modal-body" style="padding-top: 1rem" >
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
                        <div class="form-group">
                          <label for="">Choose client</label>
                          <select class="form-control" name="client" required="required">
                            <option value="">--Select a client to make his calculations--</option>
                            <?php for ($i=0; $i < count(getClients()) ; $i++) { ?>
                                <?php 
                                echo '<option value = "'.getClients()[$i]['id'].'">'
                                 .getClients()[$i]['name']
                                  .' ('.getClients()[$i]['email'].')'
                                  .'</option>'; 
                                  ?>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="" title="Choose other if building type is not listed">Building type</label>
                          <select title="Choose other if building type is not listed" class="form-control" name="buildingType" v-model.trim="otherSelect" id="otherSelect" required="required">
                            <option value="">--Select building type--</option>
                            <?php for ($i=0; $i < count(getBuildingTypes()) ; $i++) { ?>
                                <option>
                                    <?php 
                                      echo getBuildingTypes()[$i]['building_type']; 
                                    ?>
                                </option>
                            <?php } ?>
                            <option>Other</option>
                          </select>
                          <input type="text" v-model.trim="otherInput" class="form-control" name="buildingType" style="display:none" id="otherInput" placeholder="Enter a new building type">
                          <span style="display:none" id="selectionBtn"><a href="javaScript:void(0)" @click="displayOptions()">Change to selection <i class="fa fa-refresh"></i></span></a> 
                        </div>
                        <label for="">No. of Bedroom flats</label>
                        <input type="number" name="flat" id="inputflat" class="form-control" value="1" min="1"  step="1" required="required">
                        <br>
                        <button type="submit" class="btn btn-primary pull-right margin-top-sm">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php } ?>
    <div class="modal fade" id="blockId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog blocks" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="box num-of-blocks">
                        <h2>Calculate Number of Blocks required</h2>
                        <form>
                            <div class="input-cont">
                                <label>Length of Room</label>
                                <input class="l-of-room" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Height of Room</label>
                                <input class="h-of-room" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Width of Room</label>
                                <input class="w-of-room" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Length of Door</label>
                                <input class="l-of-door" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Height of Door</label>
                                <input class="h-of-door" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Length of Window</label>
                                <input class="l-of-window" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Height of Window</label>
                                <input class="h-of-window" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Number of Doors Per Room</label>
                                <input class="num-of-doors" placeholder="in whole number" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Number of Windows Per Room</label>
                                <input class="num-of-windows" placeholder="in whole number" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Block Length</label>
                                <input class="block-length" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Block Height</label>
                                <input class="block-height" placeholder="in metres" type="number">
                            </div>
                            <div class="input-cont">
                                <label>Number of rooms</label>
                                <input class="num-of-rooms" placeholder="in whole number" type="number">
                            </div>
                        
                            <button id="calculate-blocks">Calculate Number of Blocks</button>
                        </form>
        
                        <div class="result">
                            <h1 id="result"></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tilesId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog tiles" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <div class="box num-of-blocks">
            <h2>Calculate Number of Tiles required</h2>
            <form>
                <div class="input-cont">
                    <label>Length of Room</label>
                    <input class="tl-of-room" placeholder="Length of Room" type="number">
                </div>
                <div class="input-cont">
                    <label>Width of Room</label>
                    <input class="tw-of-room" placeholder="Width of Room" type="number">
                </div>
                <div class="input-cont">
                    <label>Length of Tile</label>
                    <input class="tl-of-tile" placeholder="Length of Tile" type="number">
                </div>
                <div class="input-cont">
                    <label>Width of Tile</label>
                    <input class="tw-of-tile" placeholder="Width of Tile" type="number">
                </div>
                <div class="input-cont">
                    <label>Number of Rooms</label>
                    <input class="tnum-of-rooms" placeholder="Number of Rooms" type="number">
                </div>
    
                <button id="calculate-tiles">Calculate Number of Tiles</button>
            </form>
            <div class="result">
                <h1 id="tile-result"></h1>
            </div>
        </div>
        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roofingId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg roof" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <div class="box num-of-blocks">
                <div class="box roof-content">
        <h2>Choose Your Respective Roof</h2>
        <div class="roof-cont">
            <div id="roof1" class="roof">
                <svg width="410" height="168" viewBox="0 0 410 168" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Roof1">
                        <g id="Roof">
                            <g id="Vector">
                                <path d="M1 1H409.5V166.188H408.448H2.05216L1 1Z"/>
                                <path d="M1 1H409.5M1 1L84.1204 84.12M1 1L2.05216 166.188M409.5 1V166.188H2.05216M409.5 1L326.38 84.12M84.1204 84.12L2.05216 166.188M84.1204 84.12H326.38M326.38 84.12L409.5 167.24" stroke="black"/>
                            </g>
                            </g>
                            <g class="indicator1" id="Two">
                                <circle id="Ellipse 1" cx="29" cy="88" r="20" fill="#A4A4A4"/>
                                <path id="2" d="M33.3945 95H25.0098V93.8311L29.4395 88.9092C30.0957 88.165 30.5469 87.5615 30.793 87.0986C31.0449 86.6299 31.1709 86.1465 31.1709 85.6484C31.1709 84.9805 30.9688 84.4326 30.5645 84.0049C30.1602 83.5771 29.6211 83.3633 28.9473 83.3633C28.1387 83.3633 27.5088 83.5947 27.0576 84.0576C26.6123 84.5146 26.3896 85.1533 26.3896 85.9736H24.7637C24.7637 84.7959 25.1416 83.8438 25.8975 83.1172C26.6592 82.3906 27.6758 82.0273 28.9473 82.0273C30.1367 82.0273 31.0771 82.3408 31.7686 82.9678C32.46 83.5889 32.8057 84.418 32.8057 85.4551C32.8057 86.7148 32.0029 88.2148 30.3975 89.9551L26.9697 93.6729H33.3945V95Z" fill="black"/>
                            </g>
                            <g class="indicator1" id="Two_2">
                                <circle id="Ellipse 1_2" cx="378" cy="88" r="20" fill="#A4A4A4"/>
                                <path id="2_2" d="M382.395 95H374.01V93.8311L378.439 88.9092C379.096 88.165 379.547 87.5615 379.793 87.0986C380.045 86.6299 380.171 86.1465 380.171 85.6484C380.171 84.9805 379.969 84.4326 379.564 84.0049C379.16 83.5771 378.621 83.3633 377.947 83.3633C377.139 83.3633 376.509 83.5947 376.058 84.0576C375.612 84.5146 375.39 85.1533 375.39 85.9736H373.764C373.764 84.7959 374.142 83.8438 374.897 83.1172C375.659 82.3906 376.676 82.0273 377.947 82.0273C379.137 82.0273 380.077 82.3408 380.769 82.9678C381.46 83.5889 381.806 84.418 381.806 85.4551C381.806 86.7148 381.003 88.2148 379.397 89.9551L375.97 93.6729H382.395V95Z" fill="black"/>
                            </g>
                            <g class="indicator1" id="One">
                                <circle id="Ellipse 1_3" cx="208" cy="38" r="20" fill="#A4A4A4"/>
                                <path id="1" d="M209.354 45H207.719V34.1631L204.44 35.3672V33.8906L209.099 32.1416H209.354V45Z" fill="black"/>
                            </g>
                            <g class="indicator1" id="One_2">
                            <circle id="Ellipse 1_4" cx="208" cy="128" r="20" fill="#A4A4A4"/>
                            <path id="1_2" d="M209.354 135H207.719V124.163L204.44 125.367V123.891L209.099 122.142H209.354V135Z" fill="black"/>
                        </g>
                    </g>
                </svg>
            </div>
            <div id="roof2" class="roof">
                <svg width="410" height="280" viewBox="0 0 410 280" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Roof2">
                        <g id="Roof2_2">
                            <g id="Vector 7">
                                <path id="Vector" d="M0.5 1H409V166.189H407.948H1.55216H0.5V1Z"/>
                                <g id="Vector_2">
                                    <path d="M325.88 84.1204L409 167.241Z" fill="#C4C4C4"/>
                                    <path d="M0.5 1H409M0.5 1V166.189M0.5 1L83.6204 84.1204M409 1V166.189H0.5M409 1L325.88 84.1204M0.5 166.189L83.6204 84.1204M83.6204 84.1204H325.88M325.88 84.1204L409 167.241" stroke="black"/>
                                </g>
                            </g>
                            <g id="Vector 8">
                                <g id="Vector_3">
                                    <path d="M278.007 279.296H197.254H111.24V166.189L197.254 85.4355L278.007 166.189V279.296Z" fill="#C4C4C4"/>
                                    <path d="M197.254 85.4355V279.296H278.007M197.254 85.4355L111.24 166.189V279.296H278.007M197.254 85.4355L278.007 166.189V279.296" stroke="black"/>
                                </g>
                            </g>
                        </g>
                        <g id="Num Indicators">
                            <g class="indicator2" id="Two">
                                <circle id="Ellipse 1" cx="35" cy="84" r="20" fill="#A4A4A4"/>
                                <path id="2" d="M39.3945 91H31.0098V89.8311L35.4395 84.9092C36.0957 84.165 36.5469 83.5615 36.793 83.0986C37.0449 82.6299 37.1709 82.1465 37.1709 81.6484C37.1709 80.9805 36.9688 80.4326 36.5645 80.0049C36.1602 79.5771 35.6211 79.3633 34.9473 79.3633C34.1387 79.3633 33.5088 79.5947 33.0576 80.0576C32.6123 80.5146 32.3896 81.1533 32.3896 81.9736H30.7637C30.7637 80.7959 31.1416 79.8438 31.8975 79.1172C32.6592 78.3906 33.6758 78.0273 34.9473 78.0273C36.1367 78.0273 37.0771 78.3408 37.7686 78.9678C38.46 79.5889 38.8057 80.418 38.8057 81.4551C38.8057 82.7148 38.0029 84.2148 36.3975 85.9551L32.9697 89.6729H39.3945V91Z" fill="black"/>
                            </g>
                            <g class="indicator2" id="Two_2">
                                <circle id="Ellipse 1_2" cx="375" cy="84" r="20" fill="#A4A4A4"/>
                                <path id="2_2" d="M379.395 91H371.01V89.8311L375.439 84.9092C376.096 84.165 376.547 83.5615 376.793 83.0986C377.045 82.6299 377.171 82.1465 377.171 81.6484C377.171 80.9805 376.969 80.4326 376.564 80.0049C376.16 79.5771 375.621 79.3633 374.947 79.3633C374.139 79.3633 373.509 79.5947 373.058 80.0576C372.612 80.5146 372.39 81.1533 372.39 81.9736H370.764C370.764 80.7959 371.142 79.8438 371.897 79.1172C372.659 78.3906 373.676 78.0273 374.947 78.0273C376.137 78.0273 377.077 78.3408 377.769 78.9678C378.46 79.5889 378.806 80.418 378.806 81.4551C378.806 82.7148 378.003 84.2148 376.397 85.9551L372.97 89.6729H379.395V91Z" fill="black"/>
                            </g>
                            <g class="indicator2" id="Three">
                                <circle id="Ellipse 1_3" cx="255" cy="34" r="20" fill="#A4A4A4"/>
                                <path id="3" d="M253.374 33.8105H254.596C255.363 33.7988 255.967 33.5967 256.406 33.2041C256.846 32.8115 257.065 32.2812 257.065 31.6133C257.065 30.1133 256.318 29.3633 254.824 29.3633C254.121 29.3633 253.559 29.5654 253.137 29.9697C252.721 30.3682 252.513 30.8984 252.513 31.5605H250.887C250.887 30.5469 251.256 29.7061 251.994 29.0381C252.738 28.3643 253.682 28.0273 254.824 28.0273C256.031 28.0273 256.978 28.3467 257.663 28.9854C258.349 29.624 258.691 30.5117 258.691 31.6484C258.691 32.2051 258.51 32.7441 258.146 33.2656C257.789 33.7871 257.3 34.1768 256.679 34.4346C257.382 34.6572 257.924 35.0264 258.305 35.542C258.691 36.0576 258.885 36.6875 258.885 37.4316C258.885 38.5801 258.51 39.4912 257.76 40.165C257.01 40.8389 256.034 41.1758 254.833 41.1758C253.632 41.1758 252.653 40.8506 251.897 40.2002C251.147 39.5498 250.772 38.6914 250.772 37.625H252.407C252.407 38.2988 252.627 38.8379 253.066 39.2422C253.506 39.6465 254.095 39.8486 254.833 39.8486C255.618 39.8486 256.219 39.6436 256.635 39.2334C257.051 38.8232 257.259 38.2344 257.259 37.4668C257.259 36.7227 257.03 36.1514 256.573 35.7529C256.116 35.3545 255.457 35.1494 254.596 35.1377H253.374V33.8105Z" fill="black"/>
                            </g>
                            <g class="indicator2" id="Three_2">
                                <circle id="Ellipse 1_4" cx="105" cy="124" r="20" fill="#A4A4A4"/>
                                <path id="3_2" d="M103.374 123.811H104.596C105.363 123.799 105.967 123.597 106.406 123.204C106.846 122.812 107.065 122.281 107.065 121.613C107.065 120.113 106.318 119.363 104.824 119.363C104.121 119.363 103.559 119.565 103.137 119.97C102.721 120.368 102.513 120.898 102.513 121.561H100.887C100.887 120.547 101.256 119.706 101.994 119.038C102.738 118.364 103.682 118.027 104.824 118.027C106.031 118.027 106.978 118.347 107.663 118.985C108.349 119.624 108.691 120.512 108.691 121.648C108.691 122.205 108.51 122.744 108.146 123.266C107.789 123.787 107.3 124.177 106.679 124.435C107.382 124.657 107.924 125.026 108.305 125.542C108.691 126.058 108.885 126.688 108.885 127.432C108.885 128.58 108.51 129.491 107.76 130.165C107.01 130.839 106.034 131.176 104.833 131.176C103.632 131.176 102.653 130.851 101.897 130.2C101.147 129.55 100.772 128.691 100.772 127.625H102.407C102.407 128.299 102.627 128.838 103.066 129.242C103.506 129.646 104.095 129.849 104.833 129.849C105.618 129.849 106.219 129.644 106.635 129.233C107.051 128.823 107.259 128.234 107.259 127.467C107.259 126.723 107.03 126.151 106.573 125.753C106.116 125.354 105.457 125.149 104.596 125.138H103.374V123.811Z" fill="black"/>
                            </g>
                            <g class="indicator2" id="Four">
                                <circle id="Ellipse 1_5" cx="155" cy="224" r="20" fill="#A4A4A4"/>
                                <path id="4" d="M157.874 226.702H159.649V228.029H157.874V231H156.239V228.029H150.412V227.071L156.143 218.203H157.874V226.702ZM152.258 226.702H156.239V220.427L156.046 220.778L152.258 226.702Z" fill="black"/>
                            </g>
                            <g class="indicator2" id="Four_2">
                                <circle id="Ellipse 1_6" cx="235" cy="224" r="20" fill="#A4A4A4"/>
                                <path id="4_2" d="M237.874 226.702H239.649V228.029H237.874V231H236.239V228.029H230.412V227.071L236.143 218.203H237.874V226.702ZM232.258 226.702H236.239V220.427L236.046 220.778L232.258 226.702Z" fill="black"/>
                            </g>
                        </g>
                    </g>
                </svg>
                <svg id="r2front" width="410" height="280" viewBox="0 0 410 280" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.8804 188.988L90.3035 57.5H319.224L398.117 188.988H11.8804Z" stroke="black"/>
                    <path d="M197.902 99.5854L108.473 189.015H128.346L197.902 119.459L267.459 189.015H287.332L197.902 99.5854Z" stroke="black"/>
                    <circle class="indicator2" cx="195.537" cy="159.205" r="18.9268" fill="#A4A4A4"/>
                    <path class="indicator2" d="M196.89 166.741H195.255V155.905L191.977 157.109V155.632L196.635 153.883H196.89V166.741Z" fill="black"/>
                    <line x1="90.0464" y1="57" x2="90.0464" y2="63.7082" stroke="black"/>
                    <line x1="90.0464" y1="65.3855" x2="90.0464" y2="72.0937" stroke="black"/>
                    <line x1="90.0464" y1="73.7705" x2="90.0464" y2="80.4788" stroke="black"/>
                    <line x1="90.0464" y1="82.156" x2="90.0464" y2="88.8643" stroke="black"/>
                    <line x1="90.0464" y1="90.5413" x2="90.0464" y2="97.2495" stroke="black"/>
                    <line x1="90.0464" y1="98.9265" x2="90.0464" y2="105.635" stroke="black"/>
                    <line x1="90.0464" y1="107.312" x2="90.0464" y2="114.02" stroke="black"/>
                    <line x1="90.0464" y1="115.697" x2="90.0464" y2="122.406" stroke="black"/>
                    <line x1="90.0464" y1="124.082" x2="90.0464" y2="130.791" stroke="black"/>
                    <line x1="90.0464" y1="132.468" x2="90.0464" y2="139.176" stroke="black"/>
                    <line x1="90.0464" y1="140.853" x2="90.0464" y2="147.561" stroke="black"/>
                    <line x1="90.0464" y1="149.238" x2="90.0464" y2="155.947" stroke="black"/>
                    <line x1="90.0464" y1="157.624" x2="90.0464" y2="164.332" stroke="black"/>
                    <line x1="90.0464" y1="166.009" x2="90.0464" y2="172.717" stroke="black"/>
                    <line x1="90.0464" y1="174.394" x2="90.0464" y2="181.102" stroke="black"/>
                    <line x1="90.0464" y1="182.78" x2="90.0464" y2="189.488" stroke="black"/>
                    <line x1="319.061" y1="57" x2="319.061" y2="63.7082" stroke="black"/>
                    <line x1="319.061" y1="65.3855" x2="319.061" y2="72.0937" stroke="black"/>
                    <line x1="319.061" y1="73.7705" x2="319.061" y2="80.4788" stroke="black"/>
                    <line x1="319.061" y1="82.156" x2="319.061" y2="88.8643" stroke="black"/>
                    <line x1="319.061" y1="90.5413" x2="319.061" y2="97.2495" stroke="black"/>
                    <line x1="319.061" y1="98.9265" x2="319.061" y2="105.635" stroke="black"/>
                    <line x1="319.061" y1="107.312" x2="319.061" y2="114.02" stroke="black"/>
                    <line x1="319.061" y1="115.697" x2="319.061" y2="122.406" stroke="black"/>
                    <line x1="319.061" y1="124.082" x2="319.061" y2="130.791" stroke="black"/>
                    <line x1="319.061" y1="132.468" x2="319.061" y2="139.176" stroke="black"/>
                    <line x1="319.061" y1="140.853" x2="319.061" y2="147.561" stroke="black"/>
                    <line x1="319.061" y1="149.238" x2="319.061" y2="155.947" stroke="black"/>
                    <line x1="319.061" y1="157.624" x2="319.061" y2="164.332" stroke="black"/>
                    <line x1="319.061" y1="166.009" x2="319.061" y2="172.717" stroke="black"/>
                    <line x1="319.061" y1="174.394" x2="319.061" y2="181.102" stroke="black"/>
                    <line x1="319.061" y1="182.78" x2="319.061" y2="189.488" stroke="black"/>
                </svg>
            </div>
        </div>
        <div class="roof-deets">
            <div class="roof1">
                <h1>Fill Fields Below</h1>
                <form class="roof-form">
                    <div class="info-cont">
                        <label>Lengths of Triangle 1(in metres)</label>
                        <input type="number" placeholder="A" id="l-of-t1" >
                        <input type="number" placeholder="B" id="b-of-t1">
                        <input type="number" placeholder="C" id="h-of-t1">
                    </div>
                    <div class="info-cont">
                        <label>Lengths of Triangle 2(in metres)</label>
                        <input type="number" placeholder="A" id="l-of-t2">
                        <input type="number" placeholder="B" id="b-of-t2">
                        <input type="number" placeholder="C" id="h-of-t2">
                    </div>
                    <div class="info-cont">
                        <label>Lengths of Trapezium 1(in metres)</label>
                        <input type="number" placeholder="A" id="l-of-tr1">
                        <input type="number" placeholder="B" id="b-of-tr1">
                        <input type="number" placeholder="C" id="h-of-tr1">
                    </div>
                    <div class="info-cont">
                        <label>Lengths of Trapezium 2(in metres)</label>
                        <input type="number" placeholder="A" id="l-of-tr2">
                        <input type="number" placeholder="B" id="b-of-tr2">
                        <input type="number" placeholder="C" id="h-of-tr2">
                    </div>
                    <div class="info-cont">
                        <label>Length of Sheet(in metres)</label>
                        <input type="number" class="sheet" id="l-of-sheet" >
                    </div>
                    <div class="info-cont">
                        <label>Width of Sheet(in metres)</label>
                        <input type="number" class="sheet" id="w-of-sheet">
                    </div>
                    <button id="calculate-sheets">Calculate Number of Sheets</button>
                </form>
                <div class="result" >
                    <h1 id="result-of-sheet"></h1>
                </div>
            </div>
        </div>
    </div>
    
        </div>
        
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
   <?php require 'footer.php'; ?>
    <!-- Copyright Section -->
    <section class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright © <?php echo date('Y');?></small>
        </div>
    </section>
    </div>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
             <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    
    <?php 
        if (isset($_SESSION['error'])) {
            echo 'error';
            echo '<script>setTimeout(function() {';
            echo 'alert("'.$_SESSION['error'].'")';
            echo '}, 100)</script>';
            unset($_SESSION['error']);
        }
    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="../asset/jquery.min.js.download"></script>
    <script src="../asset/bootstrap.bundle.min.js.download"></script>
    <script>
        $(window).on('load', function(){
            $('#modelId').modal('show');
        })
    </script>
    <script>
        allMaterials = <?php print_r(json_encode(getMaterialsForCalculation())); ?>;
        // console.log(allMaterials)
    </script>
    <script src="calculations.js"></script>
    <script src="estimate.js"></script>
</body>

</html>