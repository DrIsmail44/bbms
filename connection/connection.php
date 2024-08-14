<?php 
//connection file
$db_hostname = 'localhost';
$db_database = 'bbms';
$db_username = 'root';
$db_password = '';

function promptMsg($value, $location){
    echo "<script>
            alert('".$value."');
            window.location='$location'
          </script>";
}

$db = new mysqli($db_hostname,$db_username,$db_password,$db_database);

/*$db_hostname = 'localhost';//id9401657_awep_db
$db_database = 'id9401657_awep_db';
$db_username = 'id9401657_root_';
$db_password = '7277Pass';*/
?>