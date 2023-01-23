<?php
session_start();
include "../config.php";

if(isset($_POST['username']))
{
    $username = $_POST['username'];
      $sql = "select * from customers where (cust_number ='".$username."' or cust_email = '".$username."')  ";
      $result = mysqli_query($con,$sql);

        $count = mysqli_num_rows($result);
    	if($count == 1)
    	{  
            $row123 = mysqli_fetch_assoc($result);            
            $cust_number = $row123['cust_number'];

    	    $gen_otp=rand(1000,9999);
            $_SESSION["otpp"] = $gen_otp;
            $_SESSION["username"] = $username;
            $sms=" Your verification OTP is $gen_otp  \nRegards  Sponge Enterprise Limited  \nRELIABLE SERVICES";
        	$smstempid = "1707160957183999947";
        
            $mobile = $cmn->getvalfield($con,"users","mobile","1");
            
        	if($mobile > 0 || $mobile != "")
        	// $cmn->sendOTPdynamic($con,$sms,$mobile,"","",1,0,$smstempid);
        	//$email = $cmn->getvalfield($con,"users","email","1");

             // $subject = "OTP For Login ";
             // $header = "From: opencompas1@gmail.com \r\n";
             // $header .= "MIME-Version: 1.0\r\n";
             // $header .= "Content-type: text/html\r\n";
             // $retval = mail($email,$subject,$sms,$header);
                
    	    echo $result= "1|||".$cust_number."|||".$gen_otp;
    	}
    	else
    	{
    	    echo $result= "0";
    	}
            
}

if(isset($_POST['resend_otp']))
{
    $gen_otp=rand(1000,9999);
    $_SESSION["otpp"] = $gen_otp;
    
    if(isset($_SESSION["otpp"]))
    {
        $sms=" Your verification OTP is $gen_otp  \nRegards  \nHimnad Qua \nRELIABLE SERVICES";
	$smstempid = "1707160957183999947";

    $mobile = $cmn->getvalfield($con,"users","mobile","1");
    
	if($mobile > 0 || $mobile != "")
	// $cmn->sendOTPdynamic($con,$sms,$mobile,"","",1,0,$smstempid);
	
	$email = $cmn->getvalfield($con,"users","email","1");
   
     $subject = "OTP For Login ";
     $header = "From: opencompas1@gmail.com \r\n";
     $header .= "MIME-Version: 1.0\r\n";
     $header .= "Content-type: text/html\r\n";
     $retval = mail($email,$subject,$sms,$header);
     
     $result = "1";
    }
    else
    {
        $result = "0";
    }
    
    	    
    echo $result;
}

?>