<?php 
// session_start();

if(!isset($_SESSION['login_admin'])){
	echo '<script type="text/javascript">
		  window.location = "login.php"
	</script>';
	// header("location: login.php");
}

$uname = $_SESSION['login_admin'];

  require_once '../connection/connection.php';
  $query1 = "SELECT * FROM `login` WHERE id='$uname'";
  $result=$db->query($query1);
  if ($result->num_rows != 1) {header("location: logout.php"); }
  $admin = $result->fetch_assoc();

  function getClients(){
    # get all clients registered by user
    global $db, $admin;
    $uname = $admin['username'];
    $query1 = "SELECT * FROM `client` WHERE reg_by='$uname'";
    $result=$db->query($query1);
    $data = [];
    while ($d= $result->fetch_assoc()) {
      array_push($data, $d);
    }
    
    return $data;
  }

  function getMaterials(){
    # get all clients registered by user
    global $db, $admin;
    $uname = $admin['id'];
    $query1 = "SELECT * FROM materials WHERE owner =$uname";
    $result=$db->query($query1);
    $data = [];
    while ($d= $result->fetch_assoc()) {
      $variety = unserialize($d['variety']);
      $variety->id = $d['id'];
      array_push($data, $variety);
    }      
    return (count($data) >= 1) ? $data : []; 
  }

  function getBuildingTypes(){
    # get all clients registered by user
    global $db, $admin;
    $uname = $admin['id'];
    $query1 = "SELECT DISTINCT building_type FROM calculations WHERE owner_id =$uname";
    // echo $query1;
    $result=$db->query($query1);
    $data = [];
    while ($d= $result->fetch_assoc()) {
      array_push($data, $d);
    }      
    return (count($data) >= 1) ? $data : []; 
  }

  function getClient($email_or_id){
    # get all clients registered by user
    global $db, $admin;
    $uname = $admin['username'];
    $query1 = "SELECT * FROM client WHERE reg_by ='$uname' AND (email='$email_or_id' OR id=$email_or_id)";
    // echo $query1;
    $result=$db->query($query1);
    $data = $result->fetch_assoc();
    return (count($data) >= 1) ? $data : []; 
  }

  function getMaterialsForCalculation(){
    $materials = getMaterials();
    $data = [];
    for ($i=0; $i < count($materials) ; $i++) { 
      // $materials[$materials[$i]->materialName] = $materials[$i]->vData;
      $data[$materials[$i]->other][] =  [
        $materials[$i]->materialName => $materials[$i]->vData
      ];
    }

    return $data;
  }

  function getCalculations($id = null){
    //get all calculations
    global $db, $admin;
    $adminID = $admin['id'];
    $query1 = (isset($id)) ? 
      "SELECT * FROM client, calculations WHERE calculations.id = $id AND client.id = calculations.client_id AND owner_id = $adminID"
      : "SELECT * FROM client, calculations WHERE client.id = calculations.client_id AND owner_id = $adminID";
    $result=$db->query($query1);
    $data = [];
    if ($result->num_rows >= 1) {
      while ($d= $result->fetch_assoc()) {
        $d['calculations'] = unserialize($d['calculations']);
        array_push($data, $d);
      }    
    }

    return $data;
  }
?>
