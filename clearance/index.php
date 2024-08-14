<?php 
require_once 'head.php'; 

if ($user['status'] == 2) {
  header("Location: clearance.php");
}

  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : promptMsg('name empty', 'index.php');
      $Email = isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : promptMsg('Email empty', 'index.php');
      $Phone = isset($_POST['Phone']) ? htmlspecialchars($_POST['Phone']) : promptMsg('Phone empty', 'index.php');
      $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : promptMsg('gender empty', 'index.php');
      $programme = isset($_POST['programme']) ? htmlspecialchars($_POST['programme']) : promptMsg('programme empty', 'index.php');
      $Department = isset($_POST['Department']) ? htmlspecialchars($_POST['Department']) : promptMsg('Department empty', 'index.php');

        //pic to send as passport
      $target_dir = "../passports/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      if ($_FILES["file"]["size"] > 500000) {
        promptMsg('Error updating biodata: Image size too large', 'index.php');
      } 

     // Select file type
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

     // Valid file extensions
     $extensions_arr = array("jpg","jpeg","png","gif");

     // Check extension
     if( in_array($imageFileType,$extensions_arr) ){
     
      // Convert to base64 
      $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
      $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
     }
     //passport validation stops here

    $query = "UPDATE `students` SET `lastname`='$name',`email`='$Email',`phone`='$Phone',`gender`='$gender',`status`='2',`passport`='$image',`level`='$programme',`department`='$Department' WHERE reg_ref = '$reg_ref'";
    
    $result = $db->query($query);

    if ($db->affected_rows <= 0) {
      promptMsg("Error processing clearance", 'index.php');
    }else{
      promptMsg("Clearance form submitted successfully", 'index.php');
    }

}
?>

  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center" style="padding-top: 11%;padding-bottom: 0%;">
     <div class="container">
         <center><h2>Receipts, result and complains </h2></center>
         <p style="color: red;background-color:#ffffff ">If any receipt is empty, any complain filed against you or you have a pending result, the clearance will not be processed</p>
      <div class="row">
            <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">School fees receipts</label>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">1st Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['fees_first_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">2nd Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['fees_second_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">3rd Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['fees_third_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">4th Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['fees_forth_sem']);?>" readonly>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="name">Departmental receipts</label>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">1st Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['dept_first_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">2nd Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['dept_second_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">3rd Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['dept_third_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">4th Semeseter</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['dept_forth_sem']);?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Alumni receipt</label>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Semeseter">Alumni receipt</label>
                           <input type="text" class="form-control" minlength="2" required value="<?php echo userData($user['alumi']);?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Semeseter">Result:</label>
                           <p style="background-color:#ffffff;color: #000000">
                            <?php echo (empty($user['year'])) ? "<span style='color:red'>Not ready</span>" : 'Set of '.userData($user['year']);?>
                          </p>
                        </div>
                        <div class="form-group col-md-2">
                        </div>
                        <div class="form-group col-md-2">
                        </div>  
                        <div class="form-group col-md-4">
                            <label for="Semeseter">Complain:</label>
                          <p style="background-color:#ffffff;color: #000000">
                            <?php echo (empty($user['complain'])) ? "<span style='color:green'>".userData("No Complain against you")."</span>" : "<span style='color:red'>".$user['complain']."</span>";?>
                          </p>
                        </div>


                    </div>
            </div>
      </div>
      </div>
  </header>
  <!-- Portfolio Section -->
  <section class="page-section portfolio" id="portfolio">
      
    <form  class="container" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
      <center><h2>Biodata</h2></center>
          <div class="row">
            <div class="col-lg-8">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="name">Full name</label>
                            <input type="text" class="form-control" minlength="2" title="Full name" required name="name" placeholder="Full name" value="<?php echo filterData($user['lastname'])?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" minlength="6" title="email address" required name="Email" placeholder="Email" value="<?php echo filterData($user['email'])?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Phone">Phone</label>
                            <input type="Phone" class="form-control" title="phone number" required name="Phone" pattern="[0-9]{11}" minlength="11" maxlength="11" placeholder="e.g: 080xxxx" value="<?php echo filterData($user['phone'])?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select  class="form-control" required name="gender">
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4">
                <img src="<?php echo $user['passport'];?>" id="output" width="200px" height="200px" alt="Passport here">
                <input type="file" name="file" id="fileToUpload" accept="image/*" onchange="loadFile(event)" required="">
                      <script>
                        var loadFile = function(event) {
                          var output = document.getElementById('output');
                          output.src = URL.createObjectURL(event.target.files[0]);
                        };
                      </script>
              </div>
          </div>
      <center><h2>Student data</h2></center>
          <div class="row">
            <div class="col-lg-8">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="name">Registeration number</label>
                            <br><h3><?php echo filterData($user['reg_no'])?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Programme">Programme</label>
                            <select  class="form-control" required name="programme">
                              <option>ND</option>
                              <option>HND</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Department">Department</label>
                            <select  class="form-control" required name="Department">
                              <option value="">--Seelct department--</option>
                              <option>Computer Science</option>
                              <option>Mathematics</option>
                              <option>Science Laboratory Technology</option>
                              <option>Urban Regional Planning</option>
                              <option>Architecture</option>
                              <option>Electrical Electronics engineering</option>
                              <option>Mechanical Engineering</option>
                              <option>Civil Engineering</option>
                              <option>Social Development</option>
                              <option>Business Administration</option>
                              <option>Public administration</option>
                              <option>Local Government</option>
                              <option>Mass Communication</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>
          <center>
          <?php echo (userData("counter") == 12)? '<button class="btn btn-primary" type="submit">Submit form</button>':'<h1>'.floor(((100*(userData("counter")-1))/12)).'% complete</h1>'?>
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
          <!-- <h4 class="text-uppercase mb-4"><a href="mailto:tasiukwaplong@gmail.com"> Nasarawa State Polytechnic Lafia</a></h4> -->
          <!-- <p class="lead mb-0">Student Clearance system</p> -->
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