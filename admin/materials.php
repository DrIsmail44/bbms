<?php session_start(); ?>
<!DOCTYPE html>
<!-- saved from url=(0024) -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BBMS | Dashboard</title>

    <!-- Custom fonts for this theme -->
    <link href="../asset/all.min.css" rel="stylesheet" type="text/css">
    <script src="../asset/vue.js"></script>
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

    <!-- Navigation -->
    <?php 
    require 'nav.php'; 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $formData = json_decode($_POST['formData']);
        $name = $formData->materialName;
        $category = $formData->other;
        $formData = serialize($formData);
            
        if (!$formData) {
            $msg = 'One or more of your input is invalid';
           // promptMsg($msg, 'materials.php');
           $_SESSION["error"] = $msg;
           header('Location: http://localhost/bbms/admin/materials.php');
           die();
       }else{
        $query1 = "INSERT INTO materials(name, category, variety, owner) 
            VALUES 
            ('$name','$category','$formData','".$admin['id']."')";
            
            $result=$db->query($query1);
        if ($result) {
            $msg = "$name added to materials successfully..!!";
            //promptMsg($msg, 'materials.php');  
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/materials.php');
            die();
        } else {
          $msg = "Unable to add material. Make sure you enter all values correctly";
          $db->close();   // Closing Connection
          //promptMsg($msg, 'materials.php');
          $_SESSION["error"] = $msg;
          header('Location: http://localhost/bbms/admin/materials.php');
          die();
      }
    }
    }else if (isset($_GET['deleteid']) && !empty($_GET['deleteid'])) {
        $id = htmlspecialchars($_GET['deleteid']);
        $query1 = "DELETE FROM materials WHERE id = $id";
        $result=$db->query($query1);
        
        if ($result) {
            $msg = "Material deleted successful..!!";
           // promptMsg($msg, 'materials.php');  
           $_SESSION["error"] = $msg;
           header('Location: http://localhost/bbms/admin/materials.php');
           die();
        } else {
          $msg = "Unable to delete material.";
          $db->close();   // Closing Connection
          //promptMsg($msg, 'materials.php');
          $_SESSION["error"] = $msg;
          header('Location: http://localhost/bbms/admin/materials.php');
          die();
      }
}
    
    ?>
    <!-- Masthead -->
    <header class="masthead bg-primary text-white text-center" style="padding-top: 11%;padding-bottom: 0%;">
    </header>

    <!-- Portfolio Section -->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <div class="row" >
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th colspan='6' class='text-center'>Materials <i class="fa fa-truck" ></i></th>
                              </tr>
                              <tr>
                                <th>S/N</th>
                                <th>Material</th>
                                <th>Category</th>
                                <th>Variety & Cost</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php for ($i=0; $i < count(getMaterials()) ; $i++) { ?>
                                <tr>
                                    <td><?php echo ($i + 1); ?></td>
                                    <td><?php echo getMaterials()[$i]->materialName; ?></td>
                                    <td><?php echo getMaterials()[$i]->other; ?></td>
                                      <td>
                                        <?php 
                                            for ($j=0; $j < count(getMaterials()[$i]->vData); $j++) { 
                                                echo "(".($j+1).") "
                                                     .getMaterials()[$i]->vData[$j]->name
                                                     ." = #"
                                                     .getMaterials()[$i]->vData[$j]->cost."<hr>"; 
                                            }
                                        ?>
                                      </td>
                                    <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-lg" onclick="deleteMaterial(<?php echo getMaterials()[$i]->id;?>)" data-toggle="modal" data-target="#modelId">
                                    Delete <i class="fa fa-trash"></i>
                                    </button>
                                        </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div> 
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="variety">
                        <legend>Add Material</legend>
                    
                        <div class="form-group">
                            <label for="">Material name</label>
                            <input type="text" v-model.trim="materialName" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control" v-model.trim="otherSelect" name="other" required id="otherSelect">
                              <option value="">--Select a category of the material--</option>
                              <?php 
                                $category = [];
                                for ($k=0; $k < count(getMaterials()) ; $k++) {
                                    if(!in_array(getMaterials()[$k]->other, $category)) {
                                        echo "<option>".getMaterials()[$k]->other."</option>";
                                    }
                                    array_push($category, getMaterials()[$k]->other);
                                }
                              ?>
                              <option >Other</option>
                            </select>
                            
                            <input type="text" v-model.trim="otherInput" class="form-control" name="other" style="display:none" id="otherInput" placeholder="Enter a new category">
                            <span style="display:none" id="selectionBtn"><a href="javaScript:void(0)" @click="displayOptions()">Change to selection <i class="fa fa-refresh"></i></span></a> 
                        </div>
                        <div class="form-group row">
                        <label for="">Number of material varieties</label>
                        <div class="col-sm-12">
                              <input v-model.number="varietyTotal" type="number" name="VarietyNumber" id="inputVarietyNumber" class="form-control" min="1"  max="10" step="1" required="required">
                        </div>
                        </div>
                        <div class="form-group row" v-for="vt in parseInt(varietyTotal)">
                            <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                            <div class="col-sm-6">
                            <label for="">Variety {{vt}}</label>
                              <input type="text" @change="updateVarietyName(vt, $event)" class="form-control" placeholder="variety name" required="required">
                            </div>
                            <div class="col-sm-6">
                            <label for="">Unit cost</label>
                            <input type="number" @change="updateVarietyCost(vt, $event)" class="form-control" min="1" step="1" required="required" placeholder="Unit cost">
                            </div>
                        </div>         
                        <textarea name="formData" style="visibility:hidden">{{formData}}</textarea>                              
                        <button type="submit" class="btn btn-primary">Add <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                    </form>
                    
                </div>
            </div>
    </section>

    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Material</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span >&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                  You are about to delete a material
                  <br>
                  <em>Note:</em> Deleting a material will also delete all information related to it. Still wish to continue?                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" onclick="deleteMaterial('yes')">Yes<i class="fa fa-trash-o" ></i> </button>
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

    <script>
      let deleteID = ''
      function deleteMaterial(val){
          if (val === 'yes') {
              window.location = 'materials.php?deleteid='+deleteID
          } else {
            deleteID = val;              
          }
      }
    </script>
    <script type="text/javascript" src="materials.js"></script>    <!-- Bootstrap core JavaScript -->
    <script src="../asset/jquery.min.js.download"></script>
    <script src="../asset/bootstrap.bundle.min.js.download"></script>

</body>

</html>