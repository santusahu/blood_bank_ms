<?php
include_once "session.php";
// include_once "config.php";

$pagename = "index.php";
$sql_head = "SELECT * From blood_group_master WHERE 1";
$run_head = mysqli_query($con, $sql_head);
$tot_blood_group = mysqli_num_rows($run_head);

// $sql_doctor = "SELECT * From doctor_registration WHERE delete_status = 0 $crit_dr_area ";
// $run_doctor = mysqli_query($con, $sql_doctor);
// $total_doctor = mysqli_num_rows($run_doctor);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <!-- Top Navbar -->
    <?php include_once $top_navbar; ?>

    <!-- Main Sidebar Container -->
    <?php include_once $left_navbar; ?>

    <style>
      .info-box>a {
        color: #fff;
      }

      .info-box>a:hover {
        color: #fff !important;
      }
    </style>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <?php
            $sql_medicine = "SELECT * From blood_group_master WHERE 1 ";
            $run_medicine = mysqli_query($con, $sql_medicine);
            $no = 1;
            while ($row = mysqli_fetch_assoc($run_medicine)) {
              $blood_group = $row['blood_group'];
              $stock = $row['stock'];

              $class_color = "danger";
              if ($no % 4 == 1) {
                $class_color = "danger";
              } else if ($no % 4 == 2) {
                $class_color = "success";
              } else if ($no % 4 == 3) {
                $class_color = "primary";
              } else if ($no % 4 == 0) {
                $class_color = "warning";
              }
              $no++;
            ?>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-<?= $class_color; ?> elevation-1" style="max-height:65px"><img src="Images/logo/pngtree1.png" style="width: auto; height:50%; " alt="" sizes="" srcset=""></span>
                  <a href="blood_group_list.php">
                    <div class="info-box-content">
                      <span class="info-box-text"><?php echo $blood_group ?></span>
                      <span class="info-box-number"><?php echo $stock ?></span>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?>

            <div class="clearfix hidden-md-up"></div>
            <?php
            $sql_1 = "SELECT * From donar_registration WHERE 1 ";
            $run_1 = mysqli_query($con, $sql_1);
            $total_1 = mysqli_num_rows($run_1);
            ?>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                <a href="donar_list.php">
                  <div class="info-box-content">
                    <span class="info-box-text">Total Donor</span>
                    <span class="info-box-number"><?php echo $total_1 ?></span>
                  </div>
                </a>
              </div>
            </div>

            <?php
            $sql_1 = "SELECT * From blood_donation WHERE 1  AND DATE_FORMAT(create_date , '%Y-%m-%d') = '$today' AND status = 1  ";
            $run_1 = mysqli_query($con, $sql_1);
            $total_1 = mysqli_num_rows($run_1);
            ?>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-question-circle"></i></span>
                <a href="blood_donation_list.php">
                  <div class="info-box-content">
                    <span class="info-box-text">Today's Donation</span>
                    <span class="info-box-number"><?php echo $total_1 ?></span>
                  </div>
                </a>
              </div>
            </div>

            <?php
            $sql_1 = "SELECT * From patient_registration WHERE 1 ";
            $run_1 = mysqli_query($con, $sql_1);
            $total_1 = mysqli_num_rows($run_1);
            ?>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                <a href="patient_list.php">
                  <div class="info-box-content">
                    <span class="info-box-text">Total Patient</span>
                    <span class="info-box-number"><?php echo $total_1 ?></span>
                  </div>
                </a>
              </div>
            </div>

            <?php
            $sql_1 = "SELECT * From blood_enquiry WHERE 1 AND DATE_FORMAT(create_date , '%Y-%m-%d') = '$today' ";
            $run_1 = mysqli_query($con, $sql_1);
            $total_1 = mysqli_num_rows($run_1);
            ?>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-question-circle"></i></span>
                <a href="blood_enquiry_list.php">
                  <div class="info-box-content">
                    <span class="info-box-text">Today's Blood Enquiry</span>
                    <span class="info-box-number"><?php echo $total_1 ?></span>
                  </div>
                </a>
              </div>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
          </div><!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include_once "footer_copy_rights.php" ?>
  </div><!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- <script src="dist/js/pages/dashboard2.js"></script> -->
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>