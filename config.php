<?php


$host_name = "localhost";
$db_name = "blood_bank";
$db_user = "root";
$db_pwd = "";

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$con = mysqli_connect("$host_name", "$db_user", "$db_pwd") or die('Error Connectiong to mysql: ' . mysqli_error($con));
mysqli_select_db($con, "$db_name") or die("Select Error: " . mysqli_error($con));

date_default_timezone_set('Asia/Calcutta');

Include "vendors/lib/getval.php";
$cmn = new Comman();

?>
