<?php
include("session.php");
	session_destroy();
	echo "<script>window.location ='".$login_page."'</script>";
?>




