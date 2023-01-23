<?php 
include_once "session.php";
  $pagename = "head_quarter_master.php";
  $status = $head_quarter_id = 0;
  $tabel_name = "head_quarter_master";
  $module_name = "head Quarter Master";
  $display_form_section = "display:none";
?>
<!-- geting data -->
<?php 
  if (isset($_REQUEST['head_quarter_id'])) {
    $display_form_section = "display:block";  

    $head_quarter_id = base64_decode($_REQUEST['head_quarter_id']);
    $sql1 = " SELECT * From head_quarter_master WHERE delete_status = 0 AND head_quarter_id = '$head_quarter_id' ";
    $run1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($run1);
    $head_quarter_name = $row1['head_quarter_name'];
    $status = $row1['status'];   
  }
?>

<!-- Insering and update -->
<?php 
  if (isset($_POST['submit'])) {
    $head_quarter_id = $_POST['head_quarter_id'];
    $head_quarter_name = ucfirst($_POST['head_quarter_name']);
    $status = $_POST['status'];

    if($head_quarter_id == 0){ // insert 
      $insert_sql = "INSERT INTO head_quarter_master SET head_quarter_name = '$head_quarter_name' , status = '$status', create_date = '$create_date' ";
      $run = mysqli_query($con,$insert_sql);
      if ($run) {
        $msg = 1; // inserted 
        $message = $head_quarter_name." Added Successfull  "; // inserted 
      }else{
        $msg = 3; // not added
        $message = "Error Unable to Add ".$head_quarter_name." Try again" ; // inserted 
      }

    }else{ // update
      $update_sql = "UPDATE head_quarter_master SET head_quarter_name = '$head_quarter_name' , status = '$status', update_date = '$update_date' WHERE head_quarter_id = '$head_quarter_id' ";
      $run = mysqli_query($con,$update_sql);
      if ($run) {
        $msg = 2; // updated 
        $message = $head_quarter_name." Successfull Updated "; // inserted 

      }else{
        $msg = 4; // not updated 
        $message = "Error Unable to Update ".$head_quarter_name; // inserted 
      }
    } ?>
   <script>
      alert('<?php echo $message;?>')
      var msg = "<?php echo $msg;?>"
      if (msg < 3) {
       window.location = '<?php echo $pagename?>';
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
  <?php  include_once $top_navbar; ?>  
  <!-- Main Sidebar Container -->
  <?php include_once $left_navbar ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Head Quarter Master</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $home;?>">Home</a></li>
              <li class="breadcrumb-item active">Head Quarter Master</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content"  id="form_section" style="<?php echo $display_form_section?>">
      <div class="container-fluid">
        <div class="row">
          <!-- card form -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title h3_font_size">Head Quarter Master Form</h3>
                <button class="btn btn-danger show_list_section" style="float: right;" id="show_list_section">Head Quarter List</button>

              </div>
              <!-- form start -->
              <form action="" method="POST">
                <div class="row card-body">
                  <div class="col-md-4 form-group">
                    <label for="head_quarter_name">Head Quarter Name</label>
                    <input type="hidden" name="head_quarter_id" value="<?php echo $head_quarter_id;?>" >
                    <input type="text" class="form-control" value="<?php echo $head_quarter_name;?>" id="head_quarter_name" name="head_quarter_name" placeholder="Enter Head Quarter Name" required>
                  </div>
                  <div class="col-md-4 form-group">
                    <label for="status">Status</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input custom-control-input-danger" value="0" type="radio" id="customRadio4" name="status" <?php if($status == 0){echo 'checked';} ?> >
                      <label for="customRadio4" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" id="customRadio5" value="1" name="status" <?php if($status == 1){echo 'checked';} ?>>
                      <label for="customRadio5" class="custom-control-label">Inactive</label>
                    </div>
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
    </section>    <!-- /.content -->

        <section class="content list_section" id="list_section">
          <div class="container-fluid">
            <div class="row">
              <!-- Head Quarter List -->
          <div class="col-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Head Quarter List</h3>
                <button class="btn btn-primary show_form_section" style="float: right;" id="show_form_section" value="Add Doctor">Add Head Quarter</button>

              </div><!-- /.card-header -->

              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <!-- <table> -->
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Head Quarter Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql33 = " SELECT * From head_quarter_master WHERE delete_status = 0  ";
                      $run33 = mysqli_query($con,$sql33);
                      $count_rows = mysqli_num_rows($run33);
                      $sno = 1;
                      if ($count_rows == 0) { ?>
                        <tr>
                          <td colspan="4" style="text-align: center;">No Head Quarter</td>
                        </tr>
                      <?php  
                      }else{
                        while ($row33 = mysqli_fetch_assoc($run33)) {
                            $status =  $row33['status'];
                            if ($status == 0) {
                             $status = 'Active';
                             $status_class = "status_enable";
                            }else{
                             $status = 'In-active';
                             $status_class = "status_disable";
                            }
                         ?>
                          <tr>
                            <td><?php echo $sno;?></td>
                            <td><?php echo $row33['head_quarter_name'];?></td>
                            <td class="<?php echo $status_class;?>"><?php echo $status;?></td>
                            <td style="text-align: center;"><a href="?head_quarter_id=<?php echo base64_encode($row33['head_quarter_id'])?>" class="btn btn-info"><i class="nav-icon fas fa-edit"></i></a></td>                          
                          </tr>
                        <?php 
                         $sno++; 
                        }
                      }
                      
                    ?>
                    
                  </tbody>               
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->           
          </div>
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <?php include_once "footer_copy_rights.php" ?>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>  <!-- /.control-sidebar -->
</div><!-- ./wrapper -->

<?php include_once "footer_js_links.php" ?>

<?php include_once "footer_js.php" ?>

</body>
</html>
