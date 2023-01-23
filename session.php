<?php
// session_start();
include_once "config.php";

// pages in variable
$home = "index.php";
$top_navbar = "top_navbar.php";
$left_navbar = "left_navbar.php";
$head_links = "head_links.php";
$footer_js_links = "footer_js_links.php";
$login_page = "login.php";
$product_sales_enter = "dr_pro_sales_entery.php";
// pages in variable end

$create_date = $update_date = date('Y-m-d H:i:s');

$crit_area_head = "";
$crit_dr_area = "";

// *************************************\\

// if ($_SESSION['abms_username'] == '') {
//   echo "<script>window.location ='".$login_page."'</script>";
// }

?>