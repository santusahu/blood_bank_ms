<?php
include_once "session.php";
$pagename = "blood_groop_master.php";
$pagename_1 = "blood_groop_list.php";

$status = $head_quarter_id = 0;
$tabel_name = "blood_groop_master";
$module_name = "Blood Group";
// $display_form_section = "display:none";
?>


<!-- Insering and update -->
<?php

$blood_group_id = 0;
$blood_groop = "";
if (isset($_POST['submit'])) {

  // print_r($_POST);
  // die;
  $blood_group_id = $_POST['blood_group_id'];
  $blood_groop = ucfirst($_POST['blood_groop']);
  $current_date_time = date('Y-m-d H:i:s');
  if ($blood_group_id == 0) { // insert 
    $query = " INSERT INTO $tabel_name( `blood_groop`, `create_date`, `update_date`) VALUES ('$blood_groop', '$current_date_time', '$current_date_time') ";
    $run = mysqli_query($con, $query);
    if ($run) {
      $msg = 1; // inserted 
      $message = $blood_groop . " Added Successfull  "; // inserted 
    } else {
      $msg = 3; // not added
      $message = "Error Unable to Add " . $blood_groop . " Try again"; // inserted 
    }
  } else { // update
    $update_sql = "UPDATE $tabel_name SET blood_groop = '$blood_groop' , update_date = '$current_date_time' WHERE id = '$blood_group_id' ";
    $run = mysqli_query($con, $update_sql);
    if ($run) {
      $msg = 2; // updated 
      $message = $blood_groop . " Successfull Updated "; // inserted 

    } else {
      $msg = 4; // not updated 
      $message = "Error Unable to Update " . $blood_groop; // inserted 
    }
  } 
  ?>
  <script>
    alert('<?php echo $message; ?>')
    var msg = "<?php echo $msg; ?>"
    if (msg < 3) {
      window.location = '<?php echo $pagename_1 ?>';
    }
  </script>
<?php }
?>

<!-- geting data -->
<?php
if (isset($_REQUEST['tbl_id'])) {
  $display_form_section = "display:block";

  $blood_group_id = base64_decode($_REQUEST['tbl_id']);
  $sql1 = " SELECT * From $tabel_name WHERE id = '$blood_group_id' ";
  $run1 = mysqli_query($con, $sql1);
  $row1 = mysqli_fetch_assoc($run1);
  $blood_groop = $row1['blood_groop'];
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
              <h1><?php echo $module_name; ?> Master</h1>
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
                  <h3 class="card-title h3_font_size"><?php echo $module_name; ?> Master Form</h3>
                </div>
                <!-- form start -->
                <form action="" method="POST">
                  <div class="row card-body">
                    <div class="col-md-6 form-group">
                      <label for="blood_groop ">Blood Group</label>
                      <input type="hidden" name="blood_group_id" value="<?php echo $blood_group_id; ?>">
                      <input type="text" class="form-control" value="<?php echo $blood_groop; ?>" id="blood_groop" name="blood_groop" placeholder="Enter Blood Group" required>
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