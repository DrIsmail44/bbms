<?php
function getRandRef(){
  $ALPHABETS = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
  $indx1 = rand(0,25);
  $indx2 = rand(0,25);
  return rand(1111,999999).$ALPHABETS[$indx1].$ALPHABETS[$indx2];

}

require_once 'connection/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = isset($_POST['fName']) ? htmlspecialchars($_POST['fName']) : promptMsg('first name empty', 'invoice.php');
    $lName = isset($_POST['lName']) ? htmlspecialchars($_POST['lName']) : promptMsg('last name empty', 'invoice.php');
    $Email = isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : promptMsg('Email empty', 'invoice.php');
    $Phone = isset($_POST['Phone']) ? htmlspecialchars($_POST['Phone']) : promptMsg('Phone empty', 'invoice.php');
    $regNo = isset($_POST['regNo']) ? htmlspecialchars($_POST['regNo']) : promptMsg('regNo empty', 'invoice.php');
    $ref = getRandRef();
    $date = date('Y-M-D');
    $name = $fName.' '.$lName;
    $query = "INSERT INTO `pending`(`name`, `email`, `phone`, `reg_no`, `ref`, `date`, `password`) VALUES ('$name','$Email','$Phone','$regNo','$ref','$date','$ref')";
    
    $ressult = $db->query($query);
    if(!$ressult){
      promptMsg('Error generating invoice', 'invoice.php');
    }else{
      promptMsg("Invoice created successfully. Payment reference is: $ref", "paystack.php?ref=$ref");
    }

}
?>
    <!DOCTYPE html>
    <!-- saved from url=(0024) -->
    <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Billing System | BBMS</title>

      <!-- Custom fonts for this theme -->
      <link href="./asset/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

      <!-- Theme CSS -->
      <link href="./asset/freelancer.min.css" rel="stylesheet">
      <style type="text/css">
        h2{color: #000000;}

      </style>
    </head>

    <body id="page-top">

      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="asset/logo.png" style="height: 50px" > Clearance | NasPoly</a>
          <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="invoice.php">Pay Invoice</a>
              </li>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">Login</a>
              </li>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#">Contact</a>
              </li>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="admin/">Admin</a>
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
      <center>
        <h3>Create invoice</h3>
        <p>Fill this form to generate invoice for clearance</p>
      </center>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
          <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <div class="w3-panel  w3-leftbar w3-border-red w3-pale-red" id="errorMsg">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <b><label for="fName">First Name</label></b>
                            <input type="text" title="first name" minlength="2" class="form-control" required name="fName" placeholder="First name">
                        </div>
                        <div class="form-group col-md-6">
                            <b><label for="lName">Last Name</label></b>
                            <input type="text" class="form-control" minlength="2" title="last name" required name="lName" placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <b><label for="Email">Email</label></b>
                            <input type="email" class="form-control" minlength="6" title="email address" required name="Email" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <b><label for="Phone">Phone</label></b>
                            <input type="Phone" class="form-control" title="phone number" required name="Phone" pattern="[0-9]{11}" minlength="11" maxlength="11" placeholder="e.g: 080xxxx">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <b><label for="regNo">Registeration Number</label></b>
                            <input type="text" placeholder="e.g: 19/xxx" minlength="3" title="Registeration Number" class="form-control" required name="regNo">
                        </div>
                        <div class="form-group col-md-4">

                        </div>

                    </div>
                    <button class="btn btn-primary" type="submit">Continue to payment
                        </button><br>
                        Made payment already? Click <a href="login.php">here to login</a>
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
  <footer class="footer text-center">
    <div class="container">
      <div class="row">

        <!-- Footer Location -->
        <div class="col-lg-4 mb-5 mb-lg-0">
          <img src="asset/logo.png">
        </div>

        <!-- Footer Social Icons -->
        <div class="col-lg-8 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4"><a href="mailto:tasiukwaplong@gmail.com"> Building Billing Management System</a></h4>
          <p class="lead mb-0">Client Billing System | BBMS</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Copyright Section -->
  <section class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright © 2021</small>
    </div>
  </section>

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="./asset/jquery.min.js.download"></script>
  <script src="./asset/bootstrap.bundle.min.js.download"></script>

</body>
</html>