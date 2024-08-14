<?php 
    session_start();
    $id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : '';
    if (empty($id)) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<!-- saved from url=(0024) -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BBS | Dashboard</title>
    <script src="../asset/vue.js"></script>

    <!-- Custom fonts for this theme -->
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

<body>

    <!-- Navigation -->
    <?php 
    require 'head.php';
    ?>

    <!-- Portfolio Section -->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <div class="row" id="profile">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h1>BUILDING BILLING MANAGEMENT SYSTEM</h1>
                <br>
                <u><h1><span class="badge badge-danger">Calculations print out</span></h1></u>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <!-- <b><u>Engineer information</u></b> -->
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info">Client information</li>
                        <li class="list-group-item"><b> <i class="fa fa-male" aria-hidden="true"></i> Name:</b> 
                            <?php echo getCalculations($id)[0]['name']; ?>
                        </li>
                        <li class="list-group-item"><b> <i class="fa fa-phone" aria-hidden="true"></i> Phone:</b> 
                            <?php echo getCalculations($id)[0]['phone']; ?>
                        </li>
                        <li class="list-group-item"><b> <i class="fa fa-envelope" aria-hidden="true"></i> Email:</b> 
                            <?php echo getCalculations($id)[0]['email']; ?>
                        </li>
                        <li class="list-group-item"><b> <i class="fa fa-calendar" aria-hidden="true"></i> Date registered:</b> 
                            <?php echo getCalculations($id)[0]['date_registered']; ?>
                        </li>
                    </ul>
                    <!-- <button class="btn btn-primary" title="Edit">Edit<i class="fa fa-pencil"></i></button> -->
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <!-- <b><u>Engineer information</u></b> -->
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info">Proposed building information</li>
                        <li class="list-group-item">
                            <b>
                                <i class="fa fa-building-o" aria-hidden="true"></i> Building type:
                            </b> 
                            <?php echo getCalculations($id)[0]['building_type']; ?>
                        </li>
                        <li class="list-group-item">
                            <b>
                                <i class="fa fa-calculator" aria-hidden="true"></i> Number of flats:
                            </b> 
                            <?php echo getCalculations($id)[0]['calculations']->others->flats; ?> bedroom flat(s)
                        </li>
                        <li class="list-group-item">
                            <b>
                                <i class="fa fa-hashtag" aria-hidden="true"></i> Total amount to be spent on each flat:
                            </b> 
                            #<?php echo getCalculations($id)[0]['total']; ?>
                        </li>
                        <li class="list-group-item">
                            <b>
                                <i class="fa fa-calendar" aria-hidden="true"></i> Last edited:
                            </b> 
                            <?php echo getCalculations($id)[0]['last_edited']; ?>
                        </li>
                    </ul>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th colspan='6' class='text-center list-group-item-info'>Materials to be used <i class="fa fa-truck" aria-hidden="true"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>S/N</th>
                                    <th>Category of material</th>
                                    <th>Material name</th>
                                    <th>Unit cost</th>
                                    <th>Quantity</th>
                                    <th>Total cost</th>
                                </tr>
                                <?php for ($i=0; $i < count(getCalculations($id)[0]['calculations']->calculations); $i++) { 
                                    $materials = getCalculations($id)[0]['calculations']->calculations; 
                                ?>
                                  <tr>
                                    <td><?php echo ($i + 1); ?></td>
                                    <td><?php echo $materials[$i]->category; ?></td>
                                    <td><?php echo $materials[$i]->name; ?></td>
                                    <td>#<?php echo $materials[$i]->unitCost; ?></td>
                                    <td><?php echo $materials[$i]->qty; ?></td>
                                    <td>#<?php echo $materials[$i]->total; ?></td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="5"><b> Total cost:</b></td>
                                    <td><i class="fa fa-hashtag" aria-hidden="true"></i><?php echo getCalculations($id)[0]['total']; ?></td>
                                </tr>                                <tr>
                                    <td colspan="6">
                                        <i class="fa fa-comment" aria-hidden="true"></i> <b>Comment:</b> 
                                        <?php echo getCalculations($id)[0]['calculations']->comments; ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="list-group">
                        <li class="list-group-item">
                            This document was prepared by <b><?php echo $admin['name']; ?></b>. For any complains or need for further explanations, recall out via:
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-sticky-note" aria-hidden="true"></i>Extra note:
                            <br><br><br><br><br><br>
                        </li>
                    </ul>
                    <p  class="d text-center">
                        <a href="index.php" ><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go back</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="javascript:void(0)" onclick="window.print()"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                    </p>
                </div>
            </div>
    </section>
    
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
</body>

</html>