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

<body id="page-top">

    <!-- Navigation -->
    <?php 
    require 'nav.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password1'])) {
        // die();
        $password1 = htmlspecialchars($_POST['password1']);
        $password2 = htmlspecialchars($_POST['password2']);

        if ($password1 !== $password2) {
            $msg = 'Passwords do not match';
            //promptMsg($msg, 'index.php');
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/index.php');
            die();
        } else {
            $query1 = "UPDATE login SET password = '$password1'
            WHERE id = ".$admin['id'];
            $result = $db->query($query1);
            if ($result) {
                $msg = "Password changed successfully..!!";
               // promptMsg($msg, 'index.php');
               $_SESSION["error"] = $msg;
               header('Location: http://localhost/bbms/admin/index.php');
               die();
            } else {
                $msg = "Unable to change password. INTERNAL_ERROR";
                $db->close(); // Closing Connection
               // promptMsg($msg, 'index.php');
               $_SESSION["error"] = $msg;
               header('Location: http://localhost/bbms/admin/index.php');
               die();
            }
        }
    }else if (isset($_GET['deleteid']) && !empty($_GET['deleteid'])) {
        $id = htmlspecialchars($_GET['deleteid']);
        $query1 = "DELETE FROM calculations WHERE id = $id";
        $result=$db->query($query1);
        
        if ($result) {
            $msg = "Calculation deleted successful..!!";
            //promptMsg($msg, 'index.php'); 
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/index.php');
            die(); 
        } else {
          $msg = "Unable to delete calcultaion.";
          $db->close();   // Closing Connection
         // promptMsg($msg, 'index.php');
         $_SESSION["error"] = $msg;
         header('Location: http://localhost/bbms/admin/index.php');
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
            <div class="row" id="profile">

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <!-- <b><u>Engineer information</u></b> -->
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info">Engineer information</li>
                        <li class="list-group-item"><b>Username:</b><br><?php echo $admin['username'];?></li>
                        <li class="list-group-item"><b>Name:</b><br><?php echo $admin['name'];?></li>
                        <li class="list-group-item"><b>Account type:</b><br><?php echo $admin['type'];?></li>
                    </ul>
                    <!-- <button class="btn btn-primary" title="Edit">Edit<i class="fa fa-pencil"></i></button> -->
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 list-group" id="password">
                <p class="list-group-item list-group-item-warning">Change password <i class="fa fa-key" aria-hidden="true"></i> </p>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="variety" class="list-group-item">                       
                        <div class="alert alert-danger" v-if="password1 !== password2">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Password do not match
                        </div>
                        
                        <!-- <legend>Change password</legend> -->
                        <div class="form-group">
                            <label for="">New password</label>
                            <input type="password" minlength="4" v-model="password1" name="password1" class="form-control" placeholder="*******" required>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm password</label>
                            <input type="password" minlength="4" v-model="password2" name="password2" class="form-control" id="" placeholder="*******" required type="password2">
                        </div>

                        <button v-show="password1 === password2" type="submit" class="btn btn-warning">Change password <i class="fa fa-key" aria-hidden="true"></i></button>
                    </form>

                </div>
            </div>
            <div class="row" id="history">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan='8' class='text-center'>History <i class="fa fa-history" aria-hidden="true"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> S/N</th>
                                    <th> <i class="fa fa-male" aria-hidden="true"></i> Name</th>
                                    <th> <i class="fa fa-envelope" aria-hidden="true"></i> Email</th>
                                    <th> <i class="fa fa-building-o" aria-hidden="true"></i> Building type</th>
                                    <th> <i class="fa fa-hashtag" aria-hidden="true"></i> Total cost</th>
                                    <th> <i class="fa fa-calculator" aria-hidden="true"></i> Flats</th>
                                    <th> <i class="fa fa-calendar" aria-hidden="true"></i> Last edited</th>
                                    <th></th>
                                </tr>
                                <?php for ($i=0; $i < count(getCalculations()); $i++) { ?>
                                <tr>
                                    <td><?php echo ($i + 1); ?></td>
                                    <td><?php echo getCalculations()[$i]['name']; ?></td>
                                    <td><?php echo getCalculations()[$i]['email']; ?></td>
                                    <td><?php echo getCalculations()[$i]['building_type']; ?></td>                                    
                                    <td><?php echo getCalculations()[$i]['total']; ?></td>                                    
                                    <td><?php echo getCalculations()[$i]['calculations']->others->flats; ?></td>                                    
                                    <td><?php echo getCalculations()[$i]['last_edited']; ?></td>                                    
                                    <td>
                                        <a href="print.php?id=<?php echo getCalculations()[$i]['id']; ?>" class="btn btn-success">
                                            View <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" onclick="deleteMaterial(<?php echo getCalculations()[$i]['id']; ?>)" class="btn btn-danger" data-toggle="modal" data-target="#modelId">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
    </section>

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
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Delete client</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        You are about to delete this calculation. Deleting a calculation will delete all information relating to the calculation. Sure to proceed?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteMaterial('yes')">Yes<i class="fa fa-trash-o" ></i> </button>
                </div>
            </div>
        </div>
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
      let deleteID = ''
      function deleteMaterial(val){
          if (val === 'yes') {
              window.location = 'index.php?deleteid='+deleteID
          } else {
            deleteID = val;              
          }
      }
    </script>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
        });
        let password = new Vue({
        el: '#password',
        data: {
            password1: '',
            password2: ''
        }});       
    </script>
  
</body>

</html>