<?php
include_once "session.php";
$pagename = "blood_enquiry.php";
$pagename1 = "blood_enquiry_list.php";
$status = $head_quarter_id = 0;
$tabel_name = "blood_enquiry";
$module_name = "Blood Enquiry";
$page_module = "Patient";
$current_date_time = date('Y-m-d H:i:s');
// $display_form_section = "display:none";
?>
<!-- Insering and update -->
<?php
$enquiry_id = 0;
$patient_name = "";
$blood_group = "";
$unit = "";
if (isset($_POST['submit'])) {
    // print_r($_POST);die;

    // SELECT `id`, `patient_id`, `blood_group`, `unit`, `create_date`, `update_date` FROM `blood_enquiry` WHERE 1
    $enquiry_id = $_POST['id'];
    $patient_id = $_POST['patient_id'];
    $blood_group = $_POST['blood_group'];
    $unit = $_POST['unit'];


    if($enquiry_id == 0){
        $query = "INSERT INTO $tabel_name set  `patient_id` = '$patient_id' ,`blood_group` = '$blood_group' ,`unit` = '$unit' ,`create_date` = '$create_date' ,`update_date` = '$update_date' ";
        $run = mysqli_query($con,$query);
    
        if($run){
            $msg = 1;
            $message = "Enquiry generated!!!";
        }else{
            $msg = 3;
            $message = "Somthing Went Wrong";
        }
    }else{

        $query = "UPDATE $tabel_name SET `patient_id` = '$patient_id' ,`blood_group` = '$blood_group' ,`unit` = '$unit'  ,`update_date` = '$update_date' WHERE id = $enquiry_id ";
        $run = mysqli_query($con, $query);

        if ($run) {
            $msg = 2;
            $message = "Enquiry Updated!!!";
        } else {
            $msg = 3;
            $message = "Somthing Went Wrong";
        }
    }

    // $head_quarter_id = $_POST['head_quarter_id'];
    // $patient_name = ucfirst($_POST['patient_name']);
    // $status = $_POST['status'];

     ?>
    <script>
        alert('<?php echo $message; ?>')
        var msg = "<?php echo $msg; ?>"
        if (msg < 3) {
            window.location = '<?php echo $pagename1 ?>';
        }
    </script>
<?php }
?>


<?php 
if(isset($_REQUEST['tbl_id'])){
    $enquiry_id = base64_decode($_REQUEST['tbl_id']);
    $query = "SELECT * from $tabel_name WHERE id = $enquiry_id ";
    $run = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($run);

    $patient_id = $row['patient_id'];
    $blood_group = $row['blood_group'];
    $unit = $row['unit'];

}

if(isset($_REQUEST['patient_id'])){
    $patient_id = base64_decode($_REQUEST['patient_id']);

}


?>
<!DOCTYPE html>
<html lang="en">
<?php include_once $head_links; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Top Navbar -->
        <?php include_once $top_navbar; ?>
        <!-- Main Sidebar Container -->
        <?php include_once $left_navbar ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Blood Enquiry </h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content" id="form_section">
                <div class="container-fluid">
                    <div class="row">
                        <!-- card form -->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title h3_font_size">Blood Enquiry Form</h3>

                                </div>
                                <!-- form start -->
                                <form action="" method="POST">
                                    <div class="row card-body">
                                        <?php
                                        $schema = "SELECT id , patient_name, mobile_number FROM patient_registration ";
                                        $run = mysqli_query($con, $schema);
                                        ?>

                                        <div class="col-md-6 form-group">
                                            <label for="patient_id">Patient</label>
                                            <input type="hidden" name="id" value="<?php echo $enquiry_id;?>">
                                            <select class="custom-select form-control" name="patient_id" id="patient_id">
                                                <option value="">Select Patient</option>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($run)) {
                                                    $abc = "";
                                                    if ($patient_id == $row['id']) {
                                                        $abc = "selected";
                                                    }
                                                ?>
                                                    <option <?php echo $abc; ?> value="<?php echo $row['id'] ?>"><?php echo $row['patient_name'] . " (" . $row['mobile_number'] . ")"; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="blood_group ">Blood Group</label>
                                            <?php
                                            $schema = "SELECT id , blood_group FROM blood_group_master";
                                            $run = mysqli_query($con, $schema);
                                            ?>
                                            <select class="custom-select form-control" name="blood_group" id="blood_group">
                                                <option value="">Select Blood Group</option>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($run)) {
                                                    $abc = "";
                                                    if ($blood_group == $row['blood_group']) {
                                                        $abc = "selected";
                                                    }
                                                ?>
                                                    <option <?php echo $abc; ?> value="<?php echo $row['blood_group'] ?>"><?php echo $row['blood_group']; ?></option>
                                                <?php  } ?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="unit">Blood Unit</label>
                                            <input type="text" class="form-control" value="<?php echo $unit; ?>" id="unit" name="unit" placeholder="Enter blood_unit" required>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <?php include_once "footer_copy_rights.php" ?>

        <aside class="control-sidebar control-sidebar-dark">
        </aside> <!-- /.control-sidebar -->
    </div><!-- ./wrapper -->

    <?php include_once "footer_js_links.php" ?>

    <?php include_once "footer_js.php" ?>

</body>

</html>