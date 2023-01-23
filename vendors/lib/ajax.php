<?php
//Include database configuration file
include "dbinfo.php";

if(isset($_POST["id"])){
    //Get all state data
	$id= $_POST['id'];
    $query = "SELECT * FROM vehicles WHERE id = '".$id."' 
	ORDER BY vehicle_name ASC";
	$run_query = mysqli_query($con, $query);
    
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display states list
    if($count > 0){
        echo '<option value="">Select vehicle</option>';
        while($row = mysqli_fetch_array($run_query)){
		$id=$row['id'];
		$vehicle_name=$row['vehicle_name'];
        echo "<option value='$id'>$vehicle_name</option>";
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"])){
	$state_id= $_POST['state_id'];
    //Get all city data
    echo $query = "SELECT * FROM cities WHERE state_id = '".$state_id."' 
	ORDER BY city_name ASC";
    $run_query = mysqli_query($con, $query);
    //Count total number of rows 
    echo $count = mysqli_num_rows($run_query);
    
    //Display cities list
    if($count > 0){
        echo '<option value="">Select city</option>';
        while($row = mysqli_fetch_array($run_query)){
		$city_id=$row['city_id'];
		$city_name=$row['city_name']; 
        echo "<option value='$city_id'>$city_name</option>";
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}


if(isset($_POST["product_type"])){
    //Get all state data
    $product_type= $_POST['product_type'];

    $query = "SELECT * FROM product_group WHERE product_type = '".$product_type."' 
    ORDER BY product_group_name ASC";
   
    $run_query = mysqli_query($con, $query);
   
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display states list
    if($count > 0){
        echo '<option value="">Select Product Group Name</option>';
        while($row = mysqli_fetch_array($run_query)){
        $product_group_id=$row['product_group_id'];
        $product_group_name=$row['product_group_name'];
        echo "<option value='$product_group_id' >$product_group_name</option>";
        }
    }else{
        echo '<option value="">No Product Group Available</option>';
    }
}

// if(isset($_GET["changestatus"])){
//     $pid= $_GET['pid'];
//     $tablename= $_GET['tablename'];
  
//     $query = "UPDATE $tablename SET status='Accepted' WHERE pid = $pid ";

//     $run_query = mysqli_query($con, $query);
//     if($run_query){echo 'Sucessfull'; }else{echo $query;}
// }
if(isset($_POST["status_change"])){
    $unique_id= $_POST['unique_id'];
    $table_name= $_POST['table_name'];
    $status= $_POST['status'];
    $tblpkey= $_POST['tblpkey'];
    if($status=='Pending'){$status='Approved';$dybtn= 'success';}else{$status='Pending';$dybtn='danger';}
  
    $query = "UPDATE $table_name SET status='$status' WHERE $tblpkey = $unique_id ";

    $run_query = mysqli_query($con, $query);
    
    if($run_query){echo '<input type="button" value="'.$status.'" onclick="changestatus("'.$unique_id.'","'.$status.'")" name="status" id="status" class="btn-wide mb-2 mr-2 mt-2 btn btn-'.$dybtn.'">'; }else{}
}


?>