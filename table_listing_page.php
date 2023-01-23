<?php
include_once "session.php";
$pagename = "doctor_master.php";
$status = $dr_id = 0;
$module_name = "Doctor Master";
$tabel_name = "doctor_registration";
$area_name_id = $me_hq  ="";
$read_only = $invesment_date = "";
$read_only_amt_roi = "";
$head_quarter_id = "";
$dr_code = "MH".date('YmdHsi');
?>

<?php

//--------------Generate DR code-----------//
$voucher_type = 'DR';
$v_series = $cmn->getvalfield($con,"ac_voucher_series","series_start","voucher_type='$voucher_type' ");
$v_series_digit = strlen($v_series);
if($v_series_digit < 4){
    $v_series_digit = 4;
}
$prefix1 = $cmn->getvalfield($con,"ac_voucher_series","prefix","voucher_type='$voucher_type' ");
$prefix = $prefix1.'-';
$dr_code = $cmn->genNDigitCode($prefix, $v_series, $v_series_digit);

//--------------Generate Seriece End-----------//
 ?>

<!-- geting data for update -->
<?php
  if (isset($_REQUEST['dr_id'])){
    $read_only_amt_roi = "readonly";


   $requested_dr_id =  $dr_id = base64_decode($_REQUEST['dr_id']);
    $sql11 = " SELECT * From $tabel_name WHERE delete_status = 0 AND dr_id = '$dr_id' ";
    $run11 = mysqli_query($con,$sql11);
    $row11 = mysqli_fetch_assoc($run11);
    // SELECT * FROM `sales_record_summry` WHERE dr_id = 4 ORDER BY sales_summry_id DESC;



    $dr_code  = $row11['dr_code'];
    $head_quarter_id  = $row11['head_quarter_id'];
    $dr_name  = ucfirst($row11['dr_name']);
    $me_name = ucfirst($row11['me_name']);

    $ame_name = ucfirst($row11['ame_name']);
    $dr_type = $row11['dr_type'];
    $specility = $row11['specility'];
    $roi_times  = $row11['roi_times'];
    $planned_sale_amt = $row11['planned_sale_amt'];
    $invesment_amt = $row11['invesment_amt'];
    $invesment_details = $row11['invesment_details'];
    $remark = $row11['remark'];
    $area_id = $row11['area_id'];
    $area_name = $row11['area_name'];
    $status = $row11['status'];

    $task_complete_status = $cmn->getvalfield($con,"sales_record_summry","task_complete_status"," dr_id = '$dr_id' ORDER BY sales_summry_id DESC ");
    // if ($task_complete_status > 0 || $task_complete_status == '' ) {
    if ($task_complete_status > 0 || $task_complete_status == '' || $invesment_amt == 0 ) {
        $read_only_amt_roi = '';
    }

    $supporting_dr = ucfirst($row11['supporting_dr']);
    $chemist_1 = ucfirst($row11['chemist_1']);
    $chemist_2 = ucfirst($row11['chemist_2']);
    $chemist_3 = ucfirst($row11['chemist_3']);

    if($area_id > 0 && $area_name != ""){
      $area_name_id =  $area_id.'||'.$area_name;
    }
    if ($row11['invesment_date'] != '0000-00-00' && $row11['invesment_date'] != '1970-01-01') {
      $invesment_date = date("d-m-Y",strtotime($row11['invesment_date']));
    }else{
      $invesment_date = "";
    }
    // if($invesment_date == '01-01-1970' || $invesment_date == '00-00-0000'){
    // }
  }
?>

<!-- Insert and update -->
<?php
  if (isset($_POST['submit'])) {

    // print_r($_POST);die;
    $dr_id = $_POST['dr_id'];
    $dr_code  = $_POST['dr_code'];
    $dr_name  = ucfirst(trim($_POST['dr_name']," "));
    $me_name = ucfirst($_POST['me_name']);
     $head_quarter_id = ucfirst($_POST['head_quarter_id']);
    $head_quarter_name = $cmn->getvalfield($con,"head_quarter_master","head_quarter_name"," head_quarter_id = '$head_quarter_id' ");
// die;
    $ame_name = ucfirst($_POST['ame_name']);
    $dr_type = $_POST['dr_type'];
    $specility = $_POST['specility'];
    $invesment_amt = $_POST['invesment_amt'];
    $roi_times  = $_POST['roi_times'];

    $planned_sale_amt = $_POST['planned_sale_amt'];
    $old_roi_amt = $_POST['old_roi_amt'];
    $invesment_details = $_POST['invesment_details'];
    $invesment_date = date("Y-m-d",strtotime($_POST['invesment_date']));
    $remark = $_POST['remark'];
    $area_name_id  = $_POST['area_name_id'];
    $name_id_arr = explode('||',$area_name_id);
    $area_id = $name_id_arr[0];
    $area_name = $name_id_arr[1];
    $status = $_POST['status'];


    $supporting_dr = ucfirst($_POST['supporting_dr']);
    $chemist_1 = ucfirst($_POST['chemist_1']);
    $chemist_2 = ucfirst($_POST['chemist_2']);
    $chemist_3 = ucfirst($_POST['chemist_3']);

    //--------------Generate DR code-----------//
    $voucher_type = 'DR';
    $v_series = $cmn->getvalfield($con,"ac_voucher_series","series_start","voucher_type='$voucher_type' ");

    $prefix1 = $cmn->getvalfield($con,"ac_voucher_series","prefix","voucher_type='$voucher_type' ");
    $prefix = $prefix1.'-';

    if($dr_id == 0){ // insert

      $dr_code = $cmn->genNDigitCode($prefix, $v_series, $v_series_digit);
      $dr_code =trim($dr_code);
      $insert_sql = "INSERT INTO $tabel_name SET dr_code  = '$dr_code' , dr_name  = '$dr_name' , me_name = '$me_name' , head_quarter_id  = '$head_quarter_id' , head_quarter_name  = '$head_quarter_name' , ame_name = '$ame_name' , dr_type = '$dr_type' , specility = '$specility' , roi_times = '$roi_times', planned_sale_amt='$planned_sale_amt' ,  invesment_amt = '$invesment_amt',invesment_details = '$invesment_details',invesment_date = '$invesment_date',remark = '$remark',area_id = '$area_id',area_name = '$area_name', supporting_dr = '$supporting_dr', chemist_1 = '$chemist_1', chemist_2 = '$chemist_2', chemist_3 = '$chemist_3', status = '$status',  create_date = '$create_date' ";
      $run = mysqli_query($con,$insert_sql);
      if ($run) {
        $msg = 1; // inserted
        $message = $dr_name." Added Successfull  "; // inserted

        // //////////////// upade serice  //////////////////
        $series_start = $cmn->getvalfield($con,"ac_voucher_series","series_start","voucher_type='$voucher_type' ")+1;
        $series_start = $cmn->genNDigitCode("", $series_start, $v_series_digit);
        $query_2 = mysqli_query($con,"update ac_voucher_series set series_start='$series_start' where voucher_type='$voucher_type' ");
      }else{
        $msg = 3; // not added
        $message = "Error Unable to Add ".$dr_name." Try again" ; // inserted
      }

    }else{ // update
      $update_sql = "UPDATE $tabel_name SET dr_code  = '$dr_code' , dr_name  = '$dr_name' , me_name = '$me_name' , head_quarter_id  = '$head_quarter_id' ,head_quarter_name  = '$head_quarter_name' , ame_name = '$ame_name' , dr_type = '$dr_type' , specility = '$specility' , roi_times = '$roi_times', planned_sale_amt='$planned_sale_amt' ,  invesment_amt = '$invesment_amt',invesment_details = '$invesment_details',invesment_date = '$invesment_date',remark = '$remark',area_id = '$area_id',area_name = '$area_name', supporting_dr = '$supporting_dr', chemist_1 = '$chemist_1', chemist_2 = '$chemist_2', chemist_3 = '$chemist_3', status = '$status', update_date = '$update_date' WHERE dr_id = '$dr_id' ";
      $run = mysqli_query($con,$update_sql);
      if ($run) {
          if ($old_roi_amt == 0) {
            $max_id = $cmn->getvalfield($con,"sales_record_summry","max(task_complete_status)"," dr_id = '$dr_id'");
            $max_task_complete_status = $max_id +1;
            $update_task_sql = " UPDATE sales_record_summry SET task_complete_status = $max_task_complete_status,update_date = '$update_date' WHERE dr_id = '$dr_id' AND task_complete_status = 0 ";
            $run_update_task_sql = mysqli_query($con,$update_task_sql);
          }

        $msg = 2; // updated
        $message = $dr_name." Successfull Updated "; // inserted

      }else{
        $msg = 4; // not updated
        $message = "Error Unable to Update ".$dr_name; // inserted
      }
    } ?>
    <script>
      alert('<?php echo $message;?>')
      var msg = "<?php echo $msg;?>"
      // console.log({msg})
      if (msg < 3) {
       window.location = '<?php echo $pagename?>';
    }
    </script>

 <?php }
?>
<!-- extra for css  -->
<?php

if($dr_id > 0 && $invesment_date != ""){
  $read_only = 'readonly';
}

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $module_name; ?></h1>

          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section><!-- Main content -->

    <!-- section 3 listing -->
    <section class="content list_section" id="list_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title h3_font_size" >Doctor List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped" style="width: 100%; overflow-x: scroll;">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Dr. Code</th>
                      <th>DR. Name </th>
                      <th>Type</th>
                      <th>Specility</th>
                      <th>ME HQ</th>
                      <th>Area</th>
                      <th>Invesment Amt</th>
                      <th>Planned RIO Amt</th>
                      <th>Invesment Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql33 = " SELECT * From $tabel_name WHERE delete_status = 0  ORDER BY dr_name ASC ";
                      $run33 = mysqli_query($con,$sql33);
                      $count_rows = mysqli_num_rows($run33);
                      $sno = 1;
                      if ($count_rows == 0) { ?>
                        <tr>
                          <td colspan="11" style="text-align: center;">No Head Quarter</td>
                        </tr>
                      <?php
                      }else{
                        while ($row33 = mysqli_fetch_assoc($run33)) {
                          $dr_id = base64_encode($row33['dr_id']);
                            $status =  $row33['status'];
                            if ($status == 0) {
                             $status = 'Active';
                             $status_class = "status_enable";
                            }else{
                             $status = 'In-active';
                             $status_class = "status_disable";
                            }

                             ($row33['dr_type'] == 0) ? $dr_type = 'Prescriber' : $dr_type = 'Dispansor';
                             ($row33['invesment_date'] != '1970-01-01' && $row33['invesment_date'] != '0000-00-00' ) ? $invesment_date = date('d-m-Y',strtotime($row33['invesment_date'])) : $invesment_date = '';
                         ?>
                          <tr>
                            <td><?php echo $sno;?></td>
                            <td><?php echo $row33['dr_code'];?></td>
                            <td><?php echo $row33['dr_name'];?></td>
                            <td><?php echo $dr_type;?></td>
                            <td><?php echo $row33['specility'];?></td>
                            <td><?php echo $row33['head_quarter_name'];?></td>
                            <td><?php echo $row33['area_name'];?></td>
                            <td><?php echo $row33['invesment_amt'];?></td>
                            <td><?php echo $row33['planned_sale_amt'];?></td>
                            <td><?php echo $invesment_date;?></td>
                            <td class="<?php echo $status_class;?>"><?php echo $status;?></td>
                            <td style="text-align: center;"><a href="?dr_id=<?php echo $dr_id;?>" class="btn btn-warning list_edit_btn"><i class="nav-icon fas fa-edit"></i></a></td>
                          </tr>
                        <?php
                         $sno++;
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <?php include_once "footer_copy_rights.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div><!-- ./wrapper -->

<?php // include_once $footer_js_links ?>
<?php include_once "footer_js_links.php" ?>
<?php include_once "footer_js.php" ?>

<!-- new js for this page below -->
<!-- head_quarter_id on change patch list -->
<script>
  dr_id = '<?php echo $requested_dr_id?>';
  area_name_id = '<?php echo $area_name_id?>';

  // es6 function
  const getPatch = () => {
    head_quarter_id = $('#head_quarter_id').val();
    $.ajax({
      url:'ajax.php',
      type:"post",
      data:{
        head_quarter_id:head_quarter_id,
        get_patch_list:1
      },
      success: function(response){
        // console.log(response)
        document.getElementById('area_name_id').innerHTML = "";
        document.getElementById('area_name_id').innerHTML += response;
        if(area_name_id != ''){
          document.querySelector("#area_name_id").value=area_name_id
        }
      }
    })
  }
  // console.log({dr_id})
  if(dr_id > 0 ){
    getPatch()
  }


  $("#head_quarter_id").on('change',function(){
    getPatch()
  });

</script>


<script>
  $('.datetime_pick123').datetimepicker({
    format:'d-m-Y',
    maxDate: new Date(),
    // timepicker:true,
    scrollMonth:true,
    changeMonth: true,
    changeYear: false,
    changeHour: false,
    timepicker:false,
  })
</script>




<script>
    $('.cal_planned_sale_amt').on('keyup change', function(){
      var invesment_amt = document.querySelector('#invesment_amt').value;
      var roi_times = document.querySelector('#roi_times').value;
      // console.log({roi_times},{invesment_amt});
      if(roi_times != "" && invesment_amt != ""){
      document.querySelector('#planned_sale_amt').value = parseFloat(invesment_amt)*parseFloat(roi_times);
      }else{
        document.querySelector('#planned_sale_amt').value = '';
      }
   });
  </script>


</body>
</html>
