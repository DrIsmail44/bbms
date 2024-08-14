<?php 
session_start();
?>

<!DOCTYPE html>
<!-- saved from url=(0024) -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BBMS | Clients</title>

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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // require_once '../connection/connection.php';
        $name = htmlspecialchars ($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $option = htmlspecialchars($_POST['option']);
    
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = 'Invalid email entered..!!';
            // promptMsg($msg, 'clients.php');
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/clients.php');
            die();
       }else if(strlen(trim($name)) <= 3 || strlen(trim($phone)) <= 3){
           $msg = 'All client info must exceed 4 characters. Click OK to try again';
           $_SESSION["error"] = $msg;
           header('Location: http://localhost/bbms/admin/clients.php');
           die();
        //    promptMsg($msg, 'clients.php');
       }else{
        $query1 = "INSERT INTO client(name, phone, email, reg_by) 
            VALUES 
            ('$name','$phone','$email','".$admin['username']."')
            ON DUPLICATE KEY UPDATE
            name = '$name', phone = '$phone'";
            
            $result=$db->query($query1);
        if ($result) {
            $msg = "$name $option successfully..!!";
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/clients.php');
            die();
            // promptMsg($msg, 'clients.php');  
        } else {
          $msg = "Unable to add/edit client. Make sure client doesnt exist and Try again";
          $db->close();   // Closing Connection
          $_SESSION["error"] = $msg;
          header('Location: http://localhost/bbms/admin/clients.php');
          die();
        //   promptMsg($msg, 'clients.php');
      }
    }
    }else if (isset($_GET['action']) && !empty($_GET['email'])) {
        $email = htmlspecialchars($_GET['email']);
        $query1 = "DELETE FROM client WHERE email = '$email'";
        $result=$db->query($query1);
        
        if ($result) {
            $msg = "Deleting client successful..!!";
            $_SESSION["error"] = $msg;
            header('Location: http://localhost/bbms/admin/clients.php');
            die();
            // promptMsg($msg, 'clients.php');  
        } else {
          $msg = "Unable to delete client.";
          $db->close();   // Closing Connection
          $_SESSION["error"] = $msg;
          header('Location: http://localhost/bbms/admin/clients.php');
          die();
        //   promptMsg($msg, 'clients.php');
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
                                <th colspan='6' class='text-center'>Clients <i class="fa fa-male" aria-hidden="true"></i></th>
                              </tr>
                              <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date registered</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php for ($i=0; $i < count(getClients()) ; $i++) { ?>
                                <tr>
                                    <td><?php echo ($i + 1); ?></td>
                                    <td><?php echo getClients()[$i]['name']; ?></td>
                                    <td><?php echo getClients()[$i]['email']; ?></td>
                                    <td><?php echo getClients()[$i]['phone']; ?></td>
                                    <td><?php echo getClients()[$i]['date_registered']; ?></td>
                                    <td>
                                    <a href="javascript:void(0)" onclick='edit(this.parentNode.parentNode)'>Edit<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><br>
                                    <a href="javascript:void(0)" onclick='deleteClient(this.parentNode.parentNode)' 
                                      data-toggle="modal" data-target="#modelId" style="color:red">Delete
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                                      </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div> 
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <legend>Add/Edit Client</legend>
                    
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" minlength='4' maxlength='30' placeholder="Name" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" class="form-control" placeholder="Phone" minlength='11' maxlength='15' name="phone" id="phone" required>
                            <input type="hidden"  name="option" id='option' value='added' required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        </div>                    
                        <button type="submit" class="btn btn-primary" id='optionBtn' title='Add/Edit'>Add</button>
                    </form>
                    
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
    <!-- Button trigger modal -->    
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
                <div class="modal-body" id="modalMsg">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" onclick="deleteYes()">Yes <i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../asset/jquery.min.js.download"></script>
    <script src="../asset/bootstrap.bundle.min.js.download"></script>

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
    let deleteEmail = '';
    function edit(data){
        document.getElementById('name').value = data.getElementsByTagName('td')[1].innerHTML || '';
        document.getElementById('email').value = data.getElementsByTagName('td')[2].innerHTML || '';
        document.getElementById('phone').value = data.getElementsByTagName('td')[3].innerHTML || '';

        document.getElementById('option').value = 'editted'; 
        document.getElementById('optionBtn').innerHTML = 'Edit'; 
    }

    function deleteClient(data){
        let msg = 'You are about to delete '
          + data.getElementsByTagName('td')[1].innerHTML
          + ' with email: '+ data.getElementsByTagName('td')[2].innerHTML
          + '. <br> Deleting client will also delete all calculations under the client. Sure to continue?'
        document.getElementById('modalMsg').innerHTML = msg;
        deleteEmail = data.getElementsByTagName('td')[2].innerHTML; 
    }

    function deleteYes(){
        window.location = 'clients.php?action=delete&email='+deleteEmail;
    }

    </script>
</body>

</html>
