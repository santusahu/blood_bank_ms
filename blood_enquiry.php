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
<?php 
$patient_name="";
?>
<!-- geting data -->
<?php
if (isset($_REQUEST['head_quarter_id'])) {
    $display_form_section = "display:block";

    $head_quarter_id = base64_decode($_REQUEST['head_quarter_id']);
    $sql1 = " SELECT * From head_quarter_master WHERE delete_status = 0 AND head_quarter_id = '$head_quarter_id' ";
    $run1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($run1);
    $patient_name = $row1['patient_name'];
    $status = $row1['status'];
}
?>

<!-- Insering and update -->
<?php
$patient_name = "";
$blood_group = "";
$unit = "";
if (isset($_POST['submit'])) {
    // $patient_name = $_POST['patient_name'];
    // $blood_group = $_POST['blood_group'];
    // $unit = $_POST['unit'];
    // $head_quarter_id = $_POST['head_quarter_id'];
    // $patient_name = ucfirst($_POST['patient_name']);
    // $status = $_POST['status'];

    if ($head_quarter_id == 0) { // insert 
        $insert_sql = "INSERT INTO $tabel_name SET patient_name = '$patient_name' , blood_group = `$blood_group`, unit= `$unit`, create_date = '$current_date_time' , update_date = '$current_date_time' ";
        $run = mysqli_query($con, $insert_sql);
        if ($run) {
            $msg = 1; // inserted 
            $message = $patient_name . " Added Successfull  "; // inserted 
        } else {
            $msg = 3; // not added
            $message = "Error Unable to Add " . $patient_name . " Try again"; // inserted 
        }
    } else { // update
        $update_sql = "UPDATE head_quarter_master SET patient_name = '$patient_name' , status = '$status', update_date = '$update_date' WHERE head_quarter_id = '$head_quarter_id' ";
        $run = mysqli_query($con, $update_sql);
        if ($run) {
            $msg = 2; // updated 
            $message = $patient_name . " Successfull Updated "; // inserted 

        } else {
            $msg = 4; // not updated 
            $message = "Error Unable to Update " . $patient_name; // inserted 
        }
    } ?>
    <script>
        alert('<?php echo $message; ?>')
        var msg = "<?php echo $msg; ?>"
        if (msg < 3) {
            window.location = '<?php echo $pagename ?>';
        }
    </script>
<?php }
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
                        <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $home; ?>">Home</a></li>
              <li class="breadcrumb-item active">Head Quarter Master</li>
            </ol>
          </div> -->
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
                                        <div class="col-md-6 form-group">
                                            <label for="dr_code ">Patient</label>
                                            <input type="hidden" name="dr_id" value="<?php echo $dr_id; ?>">
                                            <input type="text" class="form-control" value="<?php echo $patient_name; ?>" id="dr_code" name="dr_code" placeholder="Enter User Name" required>
                                        </div>
                                        <!-- dr_name  -->
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
                                            <!-- <input type="text" class="form-control" value="<?php echo $blood_group; ?>" id="blood_group" name="blood_group" placeholder="Enter Blood Group" required> -->
                                        </div>
                                        <!--  -->
                                        <div class="col-md-6 form-group">
                                            <label for="dr_name">Blood Unit</label>
                                            <input type="text" class="form-control" value="<?php echo $unit; ?>" id="dr_name" name="dr_name" placeholder="Enter blood_unit" required>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- card form end -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section> <!-- /.content -->
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