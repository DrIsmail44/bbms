<?php
session_start();
session_unset();
session_destroy();
echo "Redirecting.....";
echo "<script>window.location='login.php';</script>";