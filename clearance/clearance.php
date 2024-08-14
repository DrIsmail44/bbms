<?php 
require_once 'head.php'; 

if ($user['status'] != 2) {
  header("Location: index.php");
}

  

?>

  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center" style="padding-top: 9%;padding-bottom: 0%;">  
  </header>
  <!-- Portfolio Section -->
  <section class="page-section portfolio" id="portfolio">
      
    <form  class="container" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
      <center><h2>Biodata</h2></center>
          <div class="row">
            <div class="col-lg-8">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="name">Full name:</label>
                            <h3><?php echo filterData($user['lastname'])?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Email">Email:</label>
                            <h3><?php echo filterData($user['email'])?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Phone">Phone:</label>
                            <h3><?php echo filterData($user['phone'])?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender:</label>
                            <h3><?php echo filterData($user['gender'])?></h3>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4">
                <img src="<?php echo $user['passport'];?>" id="output" width="200px" height="200px" alt="Passport here" style="float:right">
              </div>
          </div>
      <center><h2>Student data</h2></center>
          <div class="row">
            <div class="col-lg-8">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="name">Registeration number:</label>
                            <br><h3><?php echo filterData($user['reg_no'])?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Programme">Programme:</label>
                            <h3><?php echo filterData($user['level'])?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Department">Department:</label>
                            <h3><?php echo filterData($user['department'])?></h3>
                        </div>
                    </div>
            </div>
          </div>
          <center>
            <button class="btn btn-primary" type="button" onclick="window.print()">Print form</button>
            <hr>
            <em style="color: red">Kindly note that this form only shows that you have successfully completed your clearance. This is NOT your certificate neither does it mean your certificate is ready. You will be contacted once it is ready</em>
        </center>
      </form>
    </section>

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <div class="row">

        <!-- Footer Location -->
        <div class="col-lg-4 mb-5 mb-lg-0">
          <img src="../asset/logo.png">
        </div>

        <!-- Footer Social Icons -->
        <div class="col-lg-8 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4"><a href="mailto:drismailnice44@gmail.com">Building Building Management System</a></h4>
          <p class="lead mb-0">Client Clearance</p>
        </div>

      </div>
    </div>
  </footer>

  <!-- Copyright Section -->
  <section class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright © 2020</small>
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