<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once '../connection/connection.php';

  $uname = htmlspecialchars ($_POST['uname']);
  $pword = htmlspecialchars($_POST['password']);

   if (!isset($uname) || empty($pword)){
      $msg = 'Username empty. Pls provide accurate admin username and password';
      promptMsg($msg, 'login.php');

   }else{
    $query1 = "SELECT id FROM `login` WHERE username='$uname' AND password = '$pword' LIMIT 1";
    $result=$db->query($query1);
    
    if ($result->num_rows == 1) {
      $_SESSION['login_admin']=$result->fetch_assoc()['id']; // Initializing Session
      header("location: index.php"); // Redirecting To Other Page
    } else {
      $msg = "Username or Password is not correct";
      promptMsg($msg, 'index.php');
      $db->close();   // Closing Connection
  }
}
}
?>

  <!DOCTYPE html>
    <!-- saved from url=(0024) -->
    <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>BBMS | Admin Login</title>

      <!-- Custom fonts for this theme -->
      <link href="../asset/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

      <!-- Theme CSS -->
      <link href="../asset/freelancer.min.css" rel="stylesheet">
      <style type="text/css">
        h2{color: #000000;}

      </style>
    </head>

    <body id="page-top">

      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../asset/logo.png" style="height: 50px" >BBMS | Building Billing Management System</a>
          <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../about.html">About</a>
              </li>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../contact.html">Contact</a>
              </li>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Admin</a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
  
  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center" style="padding-top: 11%;padding-bottom: 0%;">
  </header>

  <!-- Portfolio Section -->
  <section class="page-section portfolio" id="portfolio">
    <div class="container">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
          <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Username">Username</label>
                            <input type="text" title="Admin Username" minlength="2" class="form-control" required name="uname" placeholder="Admin Username">
                        </div>
                        <div class="form-group col-md-6">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Password">Password</label>
                            <input type="Password" class="form-control" minlength="4" title="Password address" required name="password" placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                        </div>

                      </div>
                    </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Login
                        </button>
                    <br><br>
                </div>

                <!-- End Grid/Pricing tables -->
            </div>
      </form>
    </div>
  </section>
  
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
  <!-- Footer -->
  <?php require 'footer.php'; ?>
  <!-- Copyright Section -->
  <section class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright © <?php echo date('Y'); ?></small>
    </div>
  </section>

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="../asset/jquery.min.js.download"></script>
  <script src="../asset/bootstrap.bundle.min.js.download"></script>

</body>
</html>