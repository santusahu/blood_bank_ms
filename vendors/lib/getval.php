<?php
class Comman {

// get value if you know the primary key value //
function getval($con,$table,$field,$value,$primarykey)
{
	$sql = "select $field from $table where $primarykey = $value";
	//echo $sql;
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_fetch_row($getvalue);

	return $getval[0];
}

function genNDigitCode($joinchar, $id, $num)
{
	$digit = strlen($id);
	$zeronum = "";
	for($i=$digit; $i<$num;  $i++)
	$zeronum .= "0";
	return $joinchar . $zeronum . $id;
}

// get value from any condition //
function getvalfield($con,$table,$field,$where)
{
	$sql = "SELECT $field from $table where $where";
	// echo $sql;
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_fetch_row($getvalue);
	return "".$getval[0];
}

function getvalMultiple($con,$table,$field,$where,$space)
{
	if($where != "")
	$sql = "select $field from $table where $where";
	else
	$sql = "select $field from $table";
	//echo $sql."<br>";
	$getvalue = mysqli_query($con,$sql);
	$getval="";
	while($row = mysqli_fetch_row($getvalue))
	{
		if($getval == "")
		$getval = $row[0];
		else
		{
			if($space==true)
			$getval .= ", ". $row[0];
			else
			$getval .= ",". $row[0];
		}
	}
	return $getval;
}
// To encrypt data based on key //
function encrypt($string, $key)
{
	$result = '';
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	return base64_encode($result);
}

// To decrypt data based on key //
function decrypt($string, $key)
{
	$result = '';
	$string = base64_decode($string);
	
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}

// for get mixed no. like password etc. //
function getmixedno($totalchar)
{
	$abc= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$mixedno = "";
	for($i=1; $i<=$totalchar; $i++)
	{
		$mixedno .= $abc[rand(0,33)];
	}
	return $mixedno;
}


// get date format (01 march 2012) from 2012-03-01 //
function dateformat($date)
{
	if($date != "0000-00-00")
	{
	$ndate = explode("-",$date);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = intval($ndate[1])-1;
	$montharr = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$month1 = $montharr[$month];
	
	
	return $day . " " . $month1 . " " . $year;
	}
	else
	return "";
}

// get date format (01-03-2012) from (2012-03-01) //
function dateformatindia($date)
{
	$ndate = explode("-",$date);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = $ndate[1];
	
	if($date == "0000-00-00" || $date =="")
	return "";
	else
	return $day . "-" . $month . "-" . $year;
	
}
 function finalPageName()
 {
 $urlname = $_SERVER["REQUEST_URI"]; //to get complete url //
 $urlurl = explode("/",$urlname); // to explode based on '/' to get array of folders //
 $cnturl = count($urlurl); // count all folders in array //
 $finalpagename_q = $urlurl[$cnturl-1]; // to get last page of url //
 $arr_of_qs = explode("?",$finalpagename_q); // to remove query string from last page //
 $finalpagename = $arr_of_qs[0]; // to get final page name //
 return $finalpagename;
 }
 function sendOTPdynamic($link,$msg, $mobile, $schedule="", $sentid="", $action=1,$lang=0,$smstempid='')
{
		
	
	$smsuname    = "taurus"; //$rowSms['smsuname'];   // sms user name 
	$smspass     = "81636ca70eXX";//$rowSms['smspass'];    // sms password 
	$smssender   = "COMPAS"; //$rowSms['smssender'];  // sms sender id
	$veruname    = "user"; //$rowSms['veruname'];   // variable name of user name
	$verpass     = "password";//$rowSms['verpass'];    // variable name of password
	$versender   = "senderid";//$rowSms['versender'];  // variable name of sender id
	$vermessage  = "sms";//$rowSms['vermessage']; // variable name of message
	$vermob      = "mobiles";//$rowSms['vermob'];     // variable name of to (mobile no)
	
	$verdate     = "dt";//$rowSms['verdate'];    // variable of date field for schedule sms
	$verpatter   = "yyyy-mm-dd hh:mm:ss";//$rowSms['verpatter'];  // pattern of date field e.g. ddmmyyyy
	$working_key = ""; //$rowSms['working_key'];// working key
	$verkey      = "workingkey";// $rowSms['verkey'];     // variable name of working key
	
	$api_url     = "dndsms.reliableindya.info";//$rowSms['api_url'];    // API URL
	$send_api    = "/sendsms.jsp";//$rowSms['send_api'];   // sending page name 
	
	$chk_bal_api = "/getbalance.jsp";//$rowSms['chk_bal_api'];// balance check api
	$sch_api     = "/sendsms.jsp";// $rowSms['sch_api'];    // schedule api
	$status_api  = "/getDLR.jsp";//$rowSms['status_api']; // status api
	
	
	//echo "Called";
	$request = ""; //initialize the request variable
	if($api_url=="smsjust.com" )
	{
		$api_url='smsjust.com';
		$host='smsjust.com';
		$ch = curl_init();
	}
	
	if($working_key == "")
	{
		if(($action==2 && ($api_url == "smsjust.com" )))
		{
		}
		else
		{
			$param[$veruname] = $smsuname; //this is the username of our TM4B account
			$param[$verpass]  = $smspass; //this is the password of our TM4B account
			
			if($action==1)
			$param[$vermob]   = $mobile; //these are the recipients of the message
		}
	}
	else
	{
		if(($action==2 && ($api_url == "smsjust.com")))
		{
		}
		else
		{
			$param[$verkey] = $working_key; //this is the key of our TM4B account
			
			if($action==1)
			$param[$vermob] = "91".$mobile; //these are the recipients of the message
		}
	}

	if($action==1)
	{
		$param[$versender]  = $smssender;//this is our sender 
		$param[$vermessage] = $msg; //this is the message that we want to send
		if($api_url=="dndsms.reliableindya.info" || $api_url=="dndsms.ajitsms.in" || $api_url=="dndsms.reliableservices.org")
        {
           $param["tempid"]  = $smstempid;
        }
	}
	else if($action==2)
	{
		if($api_url == "smsjust.com" )
		{
			$param['Scheduleid']  =$sentid;

		}
		else
		{
		$param['messageid']  = $sentid;//this is our sender 
		}
	}
	if(( $api_url=="smsjust.com") && $action!=2)
	{
		$param['response'] = 'Y';// variable name of responce  for websms
	}
	// for schedule //
	if($schedule!="")
	{
		$timearr = explode(" ",$schedule);
		
		$dateoftime = $timearr[0];
		$timeoftime = $timearr[1];
		
		$datearr = explode("-",$dateoftime); // explode Date //
		$yyyy = $datearr[0]; // year
		$mm   = $datearr[1]; // month
		$dd   = $datearr[2]; // day
		
		$datearr = explode(":",$timeoftime);
		$hh  = $datearr[0];
		$mmt = $datearr[1];
		$ss  = $datearr[2];
		
		$scdltime = strtolower($verpatter);
		$scdltime = str_replace("yyyy",$yyyy,$scdltime);
		$scdltime = str_replace("dd",$dd,$scdltime);
		$scdltime = str_replace("hh",$hh,$scdltime);
		$scdltime = str_replace("ss",$ss,$scdltime);
		$scdltime = preg_replace('/mm/i', $mm, $scdltime, 1);
		$scdltime = str_replace("mm",$mmt,$scdltime);
		if(($api_url=="smsjust.com"))
		{
			$param['dt'] = "$yyyy-$mm-$dd";
			$param['tm'] = "$hh-$mmt-$ss";
		}
		else
		{
			$param[$verdate] = $scdltime; //this is the schedule datetime //
		}
		
		
		
	}
	//print_r($param);	
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	if($lang!=0 && $api_url!="smsjust.com")
	{
		$request.="unicode=1&";
	}
	elseif($lang!=0 && ($api_url=="smsjust.com"))
	{
		$request.="msgtype=UNI&";
	}
	
	
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	//echo $request;

	if($action=="1") // 1 for send sms //
	$process_api = trim($send_api,"/");
	else if($action=="2") // 2 for Delivery report //
	$process_api = trim($status_api,"/");
	else if($action=="3") // 3 for check balance //
	$process_api = trim($chk_bal_api,"/");
	
	
	//First prepare the info that relates to the connection
	$host = $api_url;
	$script = "/$process_api";
	$request_length = strlen($request);
	$method = "GET"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
	if($api_url == "smsjust.com" )
	{
		 $url="http://$host$script?$request";
		 curl_setopt($ch,CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output= curl_exec($ch);
		
		curl_close($ch);
		
		//if($action == 1)die;
	}
	else
	{
	    //echo $host.$script;
		//Now comes the header which we are going to post. 
		$header = "$method $script HTTP/1.1\r\n";
		$header .= "Host: $host\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: $request_length\r\n";
		$header .= "Connection: close\r\n\r\n";
		$header .= "$request\r\n";
		
		//echo $header;
		//Now we open up the connection
		$socket = @fsockopen($host, 80, $errno, $errstr); 
		if ($socket) //if its open, then...
		{ 
		  fputs($socket, $header); // send the details over
		  while(!feof($socket))
		  {
			 $output[] = fgets($socket); //get the results 
					
		  }
		  fclose($socket); 
		}
	}
		
	if($action==1) // sent sms //
	{
		if($api_url=="alerts.reliableindya.info")
		{
			$cntOutput = count($output);
			$lastValue = $output[$cntOutput-1];
			
			$expLastValue = explode("=",$lastValue);
			$cntLastValue = count($expLastValue);
			$messageid = $expLastValue[$cntLastValue-1];
			
			return  $messageid;
		}
		else if($api_url=="dndsms.reliableindya.info" || $api_url=="bulk.reliableindya.info"  || $api_url=="dndsms.reliableservices.org")
		{
			//$messageid = trim($output[22])."||".trim($output[21]);
			$messageid = trim($output[22]);
			return $messageid; //substr($lastBal,4);
		}
		if($api_url=="smsjust.com")
		{
			return $output;
		}
		
	}
	else if($action==2) // delivery report //
	{
		return  $output;
	}
	else if($action==3) // check balance //
	{
		if($api_url=="alerts.reliableindya.info")
		{
			$balamount = "";
			//print_r($output);
			foreach($output as $op)
			{
				if(strpos($op,'credits')!==false)
				$balamount = $op;
			}
			//return preg_replace("/[^0-9]/","",$output[9]);
			return preg_replace("/[^0-9.]/","",$balamount);
		}
		else if($api_url=="smsjust.com")
		{
			$outArr = explode(":",$output);
			$output = trim($outArr[1]);
			return $output;
		}
	}
	
}
function showOutput($data) 
{
  $data = stripslashes($data);
  $data = htmlspecialchars_decode($data);
  return $data;
}
// T
// // check privileges of any user //
// function checkPrivileges($con,$roleid, $finalpagename)
// {
// //$finalpagename = $this->finalPageName();
// //echo "select * from setprivilege where login_id='$roleid'";
// $roleid= 1;
//  $getprivs = mysqli_query($con,"select * from setprivilege where login_id='$roleid'");
//  $rowprivs = mysqli_fetch_array($getprivs);

//  $privilegesids = $rowprivs['privilegesids']; // all privileges id means all pages id in concat //
//  $setvalues = $rowprivs['setvalues']; // all privilege's values //


// $explode_privilegesids = explode(",",$privilegesids);
//  $explode_setvalues = explode(",",$setvalues);


// $return_priv = "";
// //print_r($explode_privilegesids);
// $sttpagename = "select * from privileges where pageurl='$finalpagename'";
// //echo $sttpagename;
// $getpagename = mysqli_query($con,$sttpagename);
// $rowpagename = mysqli_fetch_array($getpagename);

// if($rowpagename['privilegesid'] != "")
// {
// //echo $rowpagename['privilegesid'];
// $key = array_search($rowpagename['privilegesid'], $explode_privilegesids);
// //echo "..".$key;
// $val = $explode_setvalues[$key];


// if($val == 1 || $val == 3 || $val == 5 || $val == 7 || $val == 9 || $val == 11 || $val == 13 || $val == 15 || $val == 17 || $val == 19 || $val == 21 || $val == 23 || $val == 25 || $val == 27 || $val == 29 || $val == 31)
// $return_priv .= "T";
// else
// $return_priv .= "F";

// if($val == 2 || $val == 3 || $val == 6 || $val == 7 || $val == 10 || $val == 11 || $val == 14 || $val == 15 || $val == 18 || $val == 19 || $val == 22 || $val == 23 || $val == 26 || $val == 27 || $val == 30 || $val == 31)
// $return_priv .= "T";
// else
// $return_priv .= "F";

// if($val == 4 || $val == 5 || $val == 6 || $val == 7 || $val == 12 || $val == 13 || $val == 14 || $val == 15 || $val == 20 || $val == 21 || $val == 22 || $val == 23 || $val == 28 || $val == 29 || $val == 30 || $val == 31)
// $return_priv .= "T";
// else
// $return_priv .= "F";

// if($val == 8 || $val == 9 || $val == 10 || $val == 11 || $val == 12 || $val == 13 || $val == 14 || $val == 15 || $val == 24 || $val == 25 || $val == 26 || $val == 27 || $val == 28 || $val == 29 || $val == 30 || $val == 31)
// $return_priv .= "T";
// else
// $return_priv .= "F";

// if($val == 16 || $val == 17 || $val == 18 || $val == 19 || $val == 20 || $val == 21 || $val == 22 || $val == 23 || $val == 24 || $val == 25 || $val == 26 || $val == 27 || $val == 28 || $val == 29 || $val == 30 || $val == 31)
// $return_priv .= "T";
// else
// $return_priv .= "F";

// return $return_priv;
// }
// }

// // to get privileg true or false //
// function explodePriv($return_priv,$type)
// {
// $view = substr($return_priv,0,1);
// $add = substr($return_priv,1,1);
// $edit = substr($return_priv,2,1);
// $delete = substr($return_priv,3,1);
// $print = substr($return_priv,4,1);

// if($type == "V")
// return $view;
// else if($type == "A")
// return $add;
// else if($type == "E")
// return $edit;
// else if($type == "D")
// return $delete;
// else if($type == "P")
// return $print;
// }
// get date format (01-03-2012) from (2012-03-01 23:12:04) //
function dateFullToIndia($date,$full)
{
	$fdate = explode(" ",$date);
	
	$ndate = explode("-",$fdate[0]);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = $ndate[1];
	
	if($full == "full")
	return $day . "-" . $month . "-" . $year . " " . $fdate[1];
	else
	return $day . "-" . $month . "-" . $year;
}

// get date format (2012-03-01) from (01-03-2012) //
function dateformatusa($date)
{
	$ndate = explode("-",$date);
	$year = $ndate[2];
	$day = $ndate[0];
	$month = $ndate[1];
	
	return $year . "-" . $month . "-" . $day;
}


// get posting hour and minutes from (2012-03-01 23:12:04) //
function getpostinghour($date)
{
	$todate = date("Y-m-d H:i:s");
	
	$tdate = explode(" ",$todate);
	$xdate = explode(" ",$date);
	
	if($tdate[0] == $xdate[0])
	{
		$hourt = explode(":",$tdate[1]);
		$hourx = explode(":",$xdate[1]);
		if($hourt[0] == $hourx[0])
		{
			$howmanyhour = $hourt[1] - $hourx[1];
			return $howmanyhour . " min ago";
		}
		else if($hourt[0] == $hourx[0] + 1)
		{
			$howmanyhour = (60 - $hourx[1]) + $hourt[1];
			if($howmanyhour > 60)
			return "1 hours ago";
			else
			return $howmanyhour . " min ago";
			//$howmanyhour = $hourt[1] - $hourx[1];
			//return $howmanyhour . " min ago";
		}
		else
		{
			$howmanyhour = $hourt[0] - $hourx[0];
			return $howmanyhour . " hours ago";
		}
	}
	else
	{
		$ndate = explode("-",$xdate[0]);
		$year = $ndate[0];
		$day = $ndate[2];
		$month = $ndate[1];
		return $day . "-" . $month . "-" . $year;
	}
}

// get posting hour and minutes from (2012-03-01 23:12:04) //
function getpostinghourfull($date)
{
	$todate = date("Y-m-d H:i:s");
	
	$tdate = explode(" ",$todate);
	$xdate = explode(" ",$date);
	
	if($tdate[0] == $xdate[0])
	{
		$hourt = explode(":",$tdate[1]);
		$hourx = explode(":",$xdate[1]);
		if($hourt[0] == $hourx[0])
		{
			$howmanyhour = $hourt[1] - $hourx[1];
			return $howmanyhour . " min ago";
		}
		else
		{
			$howmanyhour = $hourt[0] - $hourx[0];
			return $howmanyhour . " hours ago";
		}
	}
	else
	{
		$ndate = explode("-",$xdate[0]);
		$year = $ndate[0];
		$day = $ndate[2];
		$month = $ndate[1];
		return $day . "-" . $month . "-" . $year . " " . $xdate[1];
	}
}

// change number into word format //
function numtowords($num, $format=1) // by default Indian Format //
{
	$ones = array(
	1 => "one",
	2 => "two",
	3 => "three",
	4 => "four",
	5 => "five",
	6 => "six",
	7 => "seven",
	8 => "eight",
	9 => "nine",
	10 => "ten",
	11 => "eleven",
	12 => "twelve",
	13 => "thirteen",
	14 => "fourteen",
	15 => "fifteen",
	16 => "sixteen",
	17 => "seventeen",
	18 => "eighteen",
	19 => "nineteen"
	);
	
	$tens = array(
	2 => "twenty",
	3 => "thirty",
	4 => "fourty",
	5 => "fifty",
	6 => "sixty",
	7 => "seventy",
	8 => "eighty",
	9 => "ninety"
	);
	
	if($format==0) // for english //
	{
		$hundreds = array(
		"hundred",
		"thousand",
		"million",
		"billion",
		"trillion",
		"quadrillion"
		); //limit t quadrillion
		
		$num = number_format($num,2,".",",");
		$num_arr = explode(".",$num);
		$wholenum = $num_arr[0];
		$decnum = $num_arr[1];
	}
	else if($format==1) // for hindi //
	{
		$hundreds = array(
		"hundred",
		"thousand",
		"lacs",
		"crore",
		"arab",
		"kharab"
		); //limit t quadrillion
		
		
		$num_arr = explode(".",$num);
		$wholenum = $num_arr[0];
		$decnum = $num_arr[1];
		
		// check and insert comma //
		$cnt = strlen($wholenum);
		$arrNum = array();
		if($cnt > 3)
		{
			if($cnt % 2 == 0) // for even
			{
				array_push($arrNum,substr($wholenum,0,1));
				$loopStart = 1;
			}
			else // for odd
			{
				array_push($arrNum,substr($wholenum,0,2));
				$loopStart = 2;
			}
			
			for($i=$loopStart; $i<$cnt-3; $i=$i+2)
			{
				array_push($arrNum,substr($wholenum,$i,2));
			}
			
			array_push($arrNum,substr($wholenum,$i));
			$wholenum = implode(",",$arrNum);
		}
	}
	
	$whole_arr = array_reverse(explode(",",$wholenum));
	krsort($whole_arr);
	$rettxt = "";
		
	foreach($whole_arr as $key => $i)
	{
		$i = intval($i);
		if($i < 20)
		{
			$rettxt .= $ones[$i];
		}
		elseif($i < 100)
		{
			$rettxt .= $tens[substr($i,0,1)];
			$rettxt .= " ".$ones[substr($i,1,1)];
		}
		else
		{
			$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
			$rettxt .= " ".$tens[substr($i,1,1)];
			
			if(substr($i,1,1) == 1)
			$rettxt .= " ".$ones[substr($i,1,2)];
			else
			$rettxt .= " ".$ones[substr($i,2,1)];
		}
		
		if($key > 0 && $i != 0)
		{
			$rettxt .= " ".$hundreds[$key]." ";
		}
	}
	
	if($format==0 && $decnum > 0) // for english //
	{
		$rettxt .= " and ";
		if($decnum < 20)
		{
			$rettxt .= $ones[$decnum];
		}
		elseif($decnum < 100)
		{
			$rettxt .= $tens[substr($decnum,0,1)];
			$rettxt .= " ".$ones[substr($decnum,1,1)];
		}
	}
	else if($format==1 && $decnum > 0) // for hindi //
	{
		$rettxt .= " and ";
		
		$cntdec = strlen($decnum);
		
		for($i=0; $i<$cntdec; $i++)
		{
			$rettxt .= $ones[substr($decnum,$i,1)]." ";
		}
	}
	
	return trim($rettxt);
}

// get image in particular size. if you writ only width then it returns in ratio of height. and you can set width and height //
function convert_image($fname,$path,$wid,$hei)
{
	$wid = intval($wid); 
	$hei = intval($hei); 
	//$fname = $sname;
	$sname = "$path$fname";
	//echo $sname;
	//header('Content-type: image/jpeg,image/gif,image/png');
	//image size
	list($width, $height) = getimagesize($sname);
	
	if($hei == "")
	{
		if($width < $wid)
		{
			$wid = $width;
			$hei = $height;
		}
		else
		{
			$percent = $wid/$width;  
			$wid = $wid;
			$hei = round ($height * $percent);
		}
	}
	
	//$wid=469;
	//$hei=290;
	$thumb = imagecreatetruecolor($wid,$hei);
	//image type
	$type=exif_imagetype($sname);
	//check image type
	switch($type)
	{
	case 2:
	$source = imagecreatefromjpeg($sname);
	break;
	case 3:
	$source = imagecreatefrompng($sname);
	break;
	case 1:
	$source = imagecreatefromgif($sname);
	break;
	}
	// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0,$wid,$hei, $width, $height);
	//echo "converted";
	//else
	//echo "not converted";
	// source filename
	$file = basename($sname);
	//destiantion file path
	//$path="upload/flashgallery/";
	$dname=$path.$fname;
	//display on browser
	//imagejpeg($thumb);
	//store into file path
	imagejpeg($thumb,$dname);
}
// To upload a file with selected extentions only //
function fileupload($controlname, $extention, $convert=false, $width, $height, $uploadfolder)
{
	$uploadfolder = trim($uploadfolder,"/");
	if(isset($_FILES[$controlname]['tmp_name']))
	{
		if($_FILES[$controlname]['error']!=4)
		{
			$fname=$_FILES[$controlname]['name'];
			$tm="p";
			$tm.=microtime(true)*10000;
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$fname=$tm.".".$ext;
			
			$arrext = explode(",",$extention);
			if(in_array($ext,$arrext))
			{
				if(move_uploaded_file($_FILES[$controlname]['tmp_name'],"$uploadfolder/$fname"))
				{
					if($convert==true)
					{
						if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'png')
						$this->convert_image($fname,"$uploadfolder/","$width","$height");
					}
					return $fname;
				}
				else
				return 0;
			}
			else
			return 0;
		}
	}
	else
	return 0;
}
function get_tiny_url($url)  {  
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
  
  // instead of above code below can also be used.
  // return file_get_contents('http://tinyurl.com/api-create.php?url='.$url);
}
}
?>