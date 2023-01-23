<?php
include_once "session.php";
$pagename = "donar_registration.php";
$pagename_1 = "donar_list.php";
$page_module = 'Patient';

$status = $head_quarter_id = 0;
$tabel_name = "donar_registration";
$module_name = "Donar Registration";
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
                  // print_r($_POST);  
                  $donar_id = $_POST['donar_id'];
                  $donar_name = $_POST['donar_name'];
                  $blood_group = $_POST['blood_group'];
                  $mobile_number = $_POST['mobile_number'];
                  $email = $_POST['email'];
                  $address = $_POST['address'];

                  if ($donar_id > 0) {
                    // update data
                    $update_query = "UPDATE $tabel_name SET `donar_name`='$donar_name',`blood_group`='$blood_group',`mobile_number`='$mobile_number',`email`='$email',`address`='$address' WHERE id = '$donar_id' ";
                    $run1 = mysqli_query($con, $update_query);
                    if ($run1) {
                      $msg_show = "Updated";
                      $msg = 1;
                    } else {
                      $msg_show = "somthing went wrong!!!";
                    }
                  } else {
                    // insert data
                    $query = "INSERT INTO $tabel_name SET donar_name = '$donar_name' , blood_group = '$blood_group' , mobile_number = '$mobile_number' , email = '$email' , `address` = '$address' ";
                    $run = mysqli_query($con, $query);
                    if ($run) {
                      $msg_show = "Inserted";
                      $msg = 2;
                    } else {
                      $msg_show = "somthing went wrong!!!";
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

                <?php

                }


                $donar_id = 0;
                $blood_group = "";
                $donar_name = "";
                $mobile_number = "";
                $email = "";
                $address = "";
                ?>

                <!-- geting data -->
                <?php
                if (isset($_REQUEST['tbl_id'])) {
                  $donar_id = base64_decode($_REQUEST['tbl_id']);
                  $sql1 = " SELECT * From $tabel_name WHERE id = '$donar_id' ";
                  $run1 = mysqli_query($con, $sql1);
                  $row1 = mysqli_fetch_assoc($run1);
                  $donar_id = $row1['id'];
                  $donar_name = $row1['donar_name'];
                  $blood_group = $row1['blood_group'];
                  $mobile_number = $row1['mobile_number'];
                  $email = $row1['email'];
                  $address = $row1['address'];
                }
                ?>
                <!-- update  -->
                <?php

                ?>
                <!-- form start -->
                <form action="" method="POST">
                  <div class="row card-body">
                    <div class="col-md-6 form-group">
                      <label for="donar_name ">name</label>
                      <input type="hidden" name="donar_id" value="<?php echo $donar_id; ?>">
                      <input type="text" class="form-control" value="<?php echo $donar_name; ?>" id="donar_name" name="donar_name" placeholder="Enter Name" required>
                    </div>


                    <div class="col-md-6 form-group">
                      <label for="blood_group ">Blood Group</label>
                      <?php
                        $schema = "SELECT id , blood_groop FROM blood_groop_master";
                        $run = mysqli_query($con, $schema);
                      ?>
                      <select class="custom-select form-control" name="blood_group" id="blood_group">
                        <option value="">Select Blood Group</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($run)) {
                          $abc = "";
                          if ($blood_group == $row['blood_groop']) {
                            $abc = "selected";
                          }
                        ?>
                          <option <?php echo $abc; ?> value="<?php echo $row['blood_groop'] ?>"><?php echo $row['blood_groop']; ?></option>
                        <?php  } ?>
                      </select>
                      <!-- <input type="text" class="form-control" value="<?php echo $blood_group; ?>" id="blood_group" name="blood_group" placeholder="Enter Blood Group" required> -->
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="mobile_number ">mobile_number</label>
                      <input type="text" class="form-control" value="<?php echo $mobile_number; ?>" id="mobile_number" name="mobile_number" placeholder="Enter mobile_number" required>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="email ">email</label>
                      <input type="text" class="form-control" value="<?php echo $email; ?>" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="address ">Address</label>
                      <input type="text" class="form-control" value="<?php echo $address; ?>" id="address" name="address" placeholder="Enter address" required>
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