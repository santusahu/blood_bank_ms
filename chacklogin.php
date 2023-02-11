<?php 
session_start();
include_once "config.php";

if (isset($_POST['chacklogin'])) {


	$myusername = $myusername1 = $_POST['user_id'];
	$mypassword = $mypassword1 = $_POST['password'];
	
	// $myusername = md5(addslashes($myusername1));
	// $mypassword = md5(addslashes($mypassword1));

	$sql = "SELECT * from users where user_type = 1 AND  mobile ='$myusername' AND `password`='$mypassword'";
	$result = mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);
	if($count == 1)
	{	
		$row1 = mysqli_fetch_assoc($result);
		$_SESSION['bb_user_id'] = $row1['user_id'];
		$_SESSION['bb_username'] = "Admin";
		$_SESSION['user_type'] = 1;
		header("location:index.php");
	}else{
		echo "<script>alert('Wrong user id password')</script>";
		header("location:login.php?msg=wrong");
	}
}
