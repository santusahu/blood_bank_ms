<?php
include_once "session.php";
$pagename = "blood_donation_AR.php";
$pagename_1 = "blood_groop_list.php";
$page_module = 'Donar';

$status = $head_quarter_id = 0;
$tabel_name = "blood_donation";
$module_name = "Blood Donation Approval/Rejection";
// $display_form_section = "display:none";
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
              <h1><?php echo $module_name; ?></h1>
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
                  <h3 class="card-title h3_font_size"><?php echo $module_name; ?> Form</h3>
                </div>
                <!-- Insering and update -->
                <?php
                if (isset($_POST['submit'])) {
                  // print_r($_POST); die;
                  $donation_id = $_POST['donation_id'];
                  $unit = $_POST['unit'];
                  $status = $_POST['status'];
                  $blood_group = $_POST['blood_group'];

                  $update_query = "UPDATE $tabel_name SET `blood_group` = '$blood_group' ,`status`='$status',`unit`='$unit' WHERE id = '$donation_id' ";
                  $run1 = mysqli_query($con, $update_query);
                  if ($run1) {
                    echo "Updated";
                  } else {
                    echo "somthing went wrong!!!";
                  }
                }


                $donation_id = 0;
                $blood_group = "";
                $donar_id = "";
                $mobile_number = "";
                $email = "";
                $unit = "";
                ?>

                <!-- geting data -->
                <?php
                if (isset($_REQUEST['tbl_id'])) {
                  $donation_id = base64_decode($_REQUEST['tbl_id']);
                  $sql1 = " SELECT $tabel_name.* , donar_registration.donar_name , donar_registration.blood_group From $tabel_name LEFT JOIN donar_registration on 
                       $tabel_name.donar_id = donar_registration.id
                       WHERE $tabel_name.id = '$donation_id' ";
                  // $sql1 = " SELECT * From $tabel_name WHERE id = '$donation_id' ";
                  $run1 = mysqli_query($con, $sql1);
                  $row1 = mysqli_fetch_assoc($run1);
                  $donation_id = $row1['id'];
                  $donar_id = $row1['donar_id'];
                  $donar_name = $row1['donar_name'];
                  $blood_group = $row1['blood_group'];
                  $unit = $row1['unit'];
                }
                ?>
                <!-- update  -->
                <?php

                ?>
                <!-- form start -->
                <form action="" method="POST">
                  <div class="row card-body">
                    <input type="hidden" name="donation_id" value="<?php echo $donation_id; ?>">
                    <input type="hidden" name="donation_id" value="<?php echo $donation_id; ?>">

                    <div class="col-md-6 form-group">
                      <label for="donar_name">donar_name</label>
                      <input readonly type="text" class="form-control" value="<?php echo $donar_name; ?>" id="donar_name" name="donar_name" placeholder="Enter address" required>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="blood_group">blood_group</label>
                      <input readonly type="text" class="form-control" value="<?php echo $blood_group; ?>" id="blood_group" name="blood_group" placeholder="Enter address" required>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="unit">Unit</label>
                      <input type="text" class="form-control" value="<?php echo $unit; ?>" id="unit" name="unit" placeholder="Enter address" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="status">status</label>

                      <select class="custom-select form-control" name="status" id="status">
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                      </select>
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