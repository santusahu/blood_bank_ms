<?php
include "../../lib/dbinfo.php";
$id  =$_GET['id'];
 $tablename  =$_GET['table_name'];
 $lowertable  =$_GET['lowertable'];
 $tblpkey  =$_GET['tblpkey'];
 $module_name = $_GET['module_name'];
 $pagename = $_GET['pagename'];
 $crit="where 1";
if($tablename == "employee_master")
{
	$sql_doc="select file1,file2,file3   from  $tablename $crit  and  $tblpkey='$id' ";
	$res_doc=mysqli_query($con,
$sql_doc);
	$row_doc=mysqli_fetch_array($res_doc);
	$file1 = $row_doc['file1'];
	$file2 = $row_doc['file2'];
	$file3 = $row_doc['file3'];
	$uploadfolder = "upload_emp_document";
	$myFile1 = $uploadfolder .'/'. $file1;
	if($file1!="") 
	{
	 if(file_exists($myFile1))
	 unlink($myFile1);
	}
	$myFile2 = $uploadfolder .'/'. $file2;
	
	if($file2!="")
	{
	 if(file_exists($myFile2))
	 unlink($myFile2);
	}
	
	$myFile3 = $uploadfolder .'/'. $file3; 
	if($file3!="")
	{
	 if(file_exists($myFile3))
	 unlink($myFile3);
	}
	//die;
	$data = $cmn->delete_data($con,"delete from $tablename $crit and  $tblpkey = '$id'");
}

else
if($tablename == "our_partners")
{

	$sql_doc="select logo from  $tablename $crit  and  $tblpkey='$id' ";
	$res_doc=mysqli_query($con,$sql_doc);
	$row_doc=mysqli_fetch_array($res_doc);
	$logo = $row_doc['logo'];

	$myFile1 = $uploadfolder .'/'. $logo;
	if($file1!="")
	{
	 if(file_exists($myFile1))
	 unlink($myFile1);
	}
	
	$data = $cmn->delete_data($con,"delete from $tablename $crit and  $tblpkey = '$id'");
	
}
else
if($tablename == "product_checklist")
{
	$sql_doc="select doc_name,upload_id   from  product_checklist_details $crit  and  $tblpkey='$id' ";
	$res_doc=mysqli_query($con,
$sql_doc);
	while($row_doc=mysqli_fetch_array($res_doc))
	{
	  $upload_doc=$row_doc['doc_name'];
	  $upload_id=$row_doc['upload_id'];
	  $upload_doc1 = "checklist_doc/" . $upload_doc;
	  if(file_exists($upload_doc1))
	  unlink($upload_doc1);
	  $cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,"upload_product_doc",$upload_id,$client_id,$user_type,$client_id);

	}
	$data = $cmn->delete_data($con,"delete from product_checklist_details $crit and  $tblpkey = '$id'");
}

else
if($tablename == "property_type_master")
{
	
	 $data = $cmn->delete_data($con,"delete from property_type_master Where 1 and  $tblpkey = '$id'");
}

else
if($tablename == "broker_master")
{
	
	echo  $data = $cmn->delete_data($con,"delete from broker_master Where 1 and  $tblpkey = '$id'");
}

else
if($tablename == "recharge_master")
{
	
	echo $data = $cmn->delete_data($con,"delete from recharge_master Where 1 and  $tblpkey = '$id	'");
}
else
if($tablename == "wallet_recharge")
{
	
	 $data = $cmn->delete_data($con,"delete from wallet_recharge Where 1 and  $tblpkey = '$id'");
}

else
if($tablename == "product_name_master")
{

	$sql_doc="select  upload_id,doc_name   from  upload_product_doc	 $crit  and  product_name_id='$id' ";
	$res_doc=mysqli_query($con,
$sql_doc);
	while($row_doc=mysqli_fetch_array($res_doc))
	{
	  $upload_doc=$row_doc['doc_name'];
	  $upload_id=$row_doc['upload_id'];
	  $upload_doc1 = "upload_doc/" . $upload_doc;
	  if(file_exists($upload_doc1))
	  unlink($upload_doc1);
	  $cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,"upload_product_doc",$upload_id,$client_id,$user_type,$client_id);
	}
     $data = $cmn->delete_data($con,"delete from upload_product_doc $crit and  product_name_id = '$id'");

} else
if($tablename == "proposal_master")
{

	$sql_doc="select upload_id,doc_name  from upload_proposal_doc	 $crit  and  proposal_id='$id' ";
	$res_doc=mysqli_query($con,
$sql_doc);
	while($row_doc=mysqli_fetch_array($res_doc))
	{
	  $upload_doc=$row_doc['doc_name'];
	  $upload_id=$row_doc['upload_id'];
	  $upload_doc1 = "proposal_doc/" . $upload_doc;
	  if(file_exists($upload_doc1))
	  unlink($upload_doc1);
	  $cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,"upload_proposal_doc",$upload_id,$client_id,$user_type,$client_id);

	}
	$data = $cmn->delete_data($con,"delete from upload_proposal_doc $crit and  proposal_id = '$id'");
		
} else
if($tablename == "template_master")
{
     $sel = "update template_master set del=1 where template_id = '$id'";
	 mysqli_query($con,
$sel);
	 echo "1";
	 exit();
	/*$sql_doc="select upload_id,doc_name  from upload_template_doc $crit  and  template_id='$id' ";
	$res_doc=mysqli_query($con,
$sql_doc);
	while($row_doc=mysqli_fetch_array($res_doc))
	{
	  $upload_doc=$row_doc['doc_name'];
	  $upload_id=$row_doc['upload_id'];
	  $upload_doc1 = "tempatedoc/" . $upload_doc;
	  if(file_exists($upload_doc1))
	  unlink($upload_doc1);
	  $cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,"upload_template_doc",$upload_id,$client_id,$user_type,$client_id);

	}
	$data = $cmn->delete_data($con,"delete from upload_template_doc $crit and  template_id = '$id'");*/
		
} if(isset($lowertable))
{  
	/*------- First delete data from team_member page--------*/
	$sql_low="select team_member_id  from $lowertable $crit  and  $tblpkey='$id' ";
	$res_low=mysqli_query($con,
$sql_low);
	while($row_low=mysqli_fetch_array($res_low))
	{
	  $team_member_id=$row_low['team_member_id'];
	  $cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,$lowertable,$team_member_id,$client_id,$user_type,$client_id);
	}
	$data = $cmn->delete_data($con,"delete from $lowertable $crit and $tblpkey = '$id'");
	/*---------Then delete create_team table--------------*/
	echo $data = $cmn->delete_data($con,"delete from $tablename $crit and $tblpkey = '$id'");
	if($data==1)
	$cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,"create_team",$id,$client_id,$user_type,$client_id);
} 
else
{
   echo $data = $cmn->delete_data($con,"delete from $tablename $crit and $tblpkey = '$id'");
   if($data==1)
    $cmn->useractivity_logs($con,"Deleted",$pagename,$module_name,$tablename,$id,$client_id,$user_type,$client_id);
}


?>