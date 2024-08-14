    <!DOCTYPE html>
    <!-- saved from url=(0024) -->
    <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>BBMS</title>

      <!-- Custom fonts for this theme -->
      <link href="./asset/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

      <!-- Theme CSS -->
      <link href="./asset/freelancer.min.css" rel="stylesheet">
      <style type="text/css">
        h2{color: #000000;}
        .mySlides {display:none}

    /* Slideshow container */
    .slideshow-container {
      max-width: 1000px;
      position: relative;
      margin: auto;
    }

    /* Caption text */
    .text {
      color: #f2f2f2;
      font-size: 15px;
      padding: 8px 12px;
      position: absolute;
      bottom: 8px;
      width: 100%;
      text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
      height: 13px;
      width: 13px;
      margin: 0 2px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }

    .active {
      background-color: #717171;
    }

    /* Fading animation */
    .fade {
      -webkit-animation-name: fade;
      -webkit-animation-duration: 1.5s;
      animation-name: fade;
      animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }

    @keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
      .text {font-size: 11px}
    }

      </style>
    </head>

    <body id="page-top">

      <!-- Navigation -->
      <?php require 'nav.php'; ?>

  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center" style="padding-top: 11%;padding-bottom: 0%;">

      <!-- Masthead Avatar Image -->
      <!-- Image Header -->
      <div class="slideshow-container">

      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="asset/1.jpg" src="asset/3.jpg" class="masthead-avatar mb-5" style="width: 60%;height: 60%">
        <div class="text">Mansion</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="asset/2.jpg" src="asset/3.jpg" class="masthead-avatar mb-5" style="width: 60%;height: 60%">
        <div class="text">Duplex</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="asset/3.jpg" class="masthead-avatar mb-5" style="width: 60%;height: 60%">
        <div class="text">Bungalow</div>
      </div>
	 



      </div>
      <br>

      <div style="text-align:center">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
      </div>

  </header>

  <!-- Portfolio Section -->
  <section class="page-section portfolio" id="portfolio">
    <div class="container">

      <!-- Portfolio Section Heading -->
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">INSTRUCTIONS</h2>
      <hr>    
      <br>

      <!-- Portfolio Grid Items -->
      <div class="row">
        <div class="col-lg-6">
          <h4><u>The Special Services offer in the Company: </u></h4>
          <ul type="*">

            <li>Estimate the total cost or budget a specific building can be spend on.</li>
            <li>Give the best fit of the client building choice.</li>
            <li>keeps all the outstanding data for constructor to get value information as an ideas to their building.</li>
            
          </ul>
        </div>
        <div class="col-lg-6">
          <h4><u>STEPS TO FOLLOW TO BE REGISTERED AS A CLIENT</u></h4>
          <ol>
            <li>Click the Client Button.</li>
            <li>Fill the available form to registered the client.</li>
            <li>click the material button.</li>
            <li>Input all the necessary material to be used in the contracts.</li>
            <li>Estimate the number of blocks, tiles and roofing sheets.</li>
            <li>Make the calculations based on the client choice.</li>
            <li>Finally print the client paper.</li>
          </ol>
        </div>
        
      </div>

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
  <script src="./asset/jquery.min.js.download"></script>
  <script src="./asset/bootstrap.bundle.min.js.download"></script>

</body></html>