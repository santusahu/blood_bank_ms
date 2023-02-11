<?php 
if(isset($_REQUEST['msg'])){
  echo "<script>alert('Wrong user id password')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center" style="position: relative;">
      <h3>Blood Bank Management System</h3>
    <img src="Images/logo/blood_bank.jpeg" alt="Blood Bank" class="brand-image elevation-3" style="opacity: .8;width: 30%;">
      <!-- <a href="index.php" class="h1"><b>Admin</b>LTE</a> -->
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login with your Mobile No. and Password</p>
      <form action="chacklogin.php" method="post" autocomplete="off">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_id" placeholder="Mobile" minlength="10" maxlength="10" onkeypress="return isNumber(event);" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <!-- <input type="sub" name=""> -->
            <button type="submit" name="chacklogin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <!-- <p class="mb-1"><a href="forgot-password.php">I forgot my password</a></p> -->
    </div>    <!-- /.card-body -->
  </div>  <!-- /.card -->
</div><!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    // alert("Please enter only Numbers.");
    return false;
    }
    return true;
  }
</script>
</body>
</html>
