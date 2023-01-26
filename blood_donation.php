<?php
include_once "session.php";
$pagename = "blood_donation.php";
$pagename_1 = "blood_donation_list.php";
$page_module = 'Donar';

$status = $head_quarter_id = 0;
$tabel_name = "blood_donation";
$module_name = "Blood Donation";
$current_date_time = date('Y-m-d H:i:s');
// $display_form_section = "display:none";
?>

<?php
$donation_id = 0;
$blood_group = "";
$donar_id = "";
$mobile_number = "";
$email = "";
$unit = "";
?>
<!-- Insering and update -->
<?php
if (isset($_POST['submit'])) {
  // print_r($_POST);
  $donation_id = $_POST['donation_id'];
  $donar_id = $_POST['donar_id'];
  $unit = $_POST['unit'];
  $status = 0;

  if ($donation_id > 0) {
    // update data
    $update_query = "UPDATE $tabel_name SET `donar_id`='$donar_id',`unit`= '$unit', update_date = '$current_date_time' WHERE id = '$donation_id' ";
    $run1 = mysqli_query($con, $update_query);
    if ($run1) {
      $msg_show = "Updated";
      $msg = 1;
    } else {
      $msg_show = "somthing went wrong!!!";
    }
  } else {
    // insert data
    $query = "INSERT INTO $tabel_name SET donar_id = '$donar_id' , unit = '$unit', create_date = '$current_date_time' , update_date = '$current_date_time'";
    $run = mysqli_query($con, $query);
    if ($run) {
      $msg_show = "Inserted";
      $msg = 2;
    } else {
      $msg_show = "somthing went wrong!!!";
    }
  }
}
?>
<script>
  alert('<?php echo $msg_show; ?>')
  var msg = "<?php echo $msg; ?>"
  if (msg < 3) {
    window.location = '<?php echo $pagename_1 ?>';
  }
</script>


<!-- geting data -->
<?php
if (isset($_REQUEST['tbl_id'])) {
  $donation_id = base64_decode($_REQUEST['tbl_id']);
  $sql1 = " SELECT * From $tabel_name WHERE id = '$donation_id' ";
  $run1 = mysqli_query($con, $sql1);
  $row1 = mysqli_fetch_assoc($run1);
  $donation_id = $row1['id'];
  $donar_id = $row1['donar_id'];
  $blood_group = $row1['blood_group'];
  $unit = $row1['unit'];
}

if (isset($_REQUEST['donar_id'])) {

  $donar_id = base64_decode($_REQUEST['donar_id']);
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

                <!-- form start -->
                <form action="" method="POST">
                  <div class="row card-body">
                    <input type="hidden" name="donation_id" value="<?php echo $donation_id; ?>">
                    <?php
                    $schema = "SELECT id , donar_name, blood_group FROM donar_registration ";
                    $run = mysqli_query($con, $schema);
                    ?>

                    <div class="col-md-6 form-group">
                      <label for="donar_id">Donar</label>
                      <select class="custom-select form-control" name="donar_id" id="donar_id">
                        <option value="">Select Donar</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($run)) {
                          $abc = "";
                          if ($donar_id == $row['id']) {
                            $abc = "selected";
                          }
                        ?>
                          <option <?php echo $abc; ?> value="<?php echo $row['id'] ?>"><?php echo $row['donar_name'] . " (" . $row['blood_group'] . ")"; ?></option>
                        <?php  } ?>
                      </select>
                      <!-- <input type="text" class="form-control" value="<?php echo $blood_group; ?>" id="blood_group" name="blood_group" placeholder="Enter Blood Group" required> -->
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="unit">Unit</label>
                      <input type="text" class="form-control" value="<?php echo $unit; ?>" id="unit" name="unit" placeholder="Enter unit" required>
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