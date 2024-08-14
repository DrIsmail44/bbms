<?php 
session_start();
require_once '../connection/connection.php';

if(!isset($_SESSION['login_user'])){
  header("location: ../login.php");
}
$reg_ref = $_SESSION['login_user'];
$userQuery = $db->query("SELECT * FROM students WHERE reg_ref = '$reg_ref'");
$user =  $userQuery->fetch_assoc();

  
function userData($value){
  global $counter;
  if (isset($value) && !empty($value)) {
    $counter++;
    return ($value == 'counter') ? $counter : htmlspecialchars($value) ;
  }else{
    return "";
  }
}

function filterData($value){
  global $counter;
  if (isset($value) && !empty($value)) {
    return htmlspecialchars($value) ;
  }else{
    return "";
  }
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

      <title>Clearance system | NasPoly</title>

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
          <a class="navbar-brand js-scroll-trigger" href="../"><img src="../asset/logo.png" style="height: 50px">Clearance form</a>
          <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>