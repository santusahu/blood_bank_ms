<?php
include_once "session.php";
$pagename = "blood_group_list.php";
$pagename_1 = "blood_group_master.php";

$status = $dr_id = 0;
$module_name = "Blood Group";
$tabel_name = "blood_group_master";
?>

<?php
//--------------Generate Seriece End-----------//
?>

<!-- geting data for update -->
<?php
if (isset($_REQUEST['dr_id'])) {
  $read_only_amt_roi = "readonly";


  $requested_dr_id =  $dr_id = base64_decode($_REQUEST['dr_id']);
  $sql11 = " SELECT * From $tabel_name WHERE delete_status = 0 AND dr_id = '$dr_id' ";
  $run11 = mysqli_query($con, $sql11);
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

  $task_complete_status = $cmn->getvalfield($con, "sales_record_summry", "task_complete_status", " dr_id = '$dr_id' ORDER BY sales_summry_id DESC ");
  // if ($task_complete_status > 0 || $task_complete_status == '' ) {
  if ($task_complete_status > 0 || $task_complete_status == '' || $invesment_amt == 0) {
    $read_only_amt_roi = '';
  }

  $supporting_dr = ucfirst($row11['supporting_dr']);
  $chemist_1 = ucfirst($row11['chemist_1']);
  $chemist_2 = ucfirst($row11['chemist_2']);
  $chemist_3 = ucfirst($row11['chemist_3']);

  if ($area_id > 0 && $area_name != "") {
    $area_name_id =  $area_id . '||' . $area_name;
  }
  if ($row11['invesment_date'] != '0000-00-00' && $row11['invesment_date'] != '1970-01-01') {
    $invesment_date = date("d-m-Y", strtotime($row11['invesment_date']));
  } else {
    $invesment_date = "";
  }
  // if($invesment_date == '01-01-1970' || $invesment_date == '00-00-0000'){
  // }
}
?>


<!-- extra for css  -->
<?php



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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo $module_name; ?> List</h1>
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
                  <h3 class="card-title h3_font_size"><?php echo $module_name; ?> List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-striped" style="width: 100%; overflow-x: scroll;">
                    <thead>
                      <tr>
                        <th>S.no</th>
                        <th>Blood Group</th>
                        <th>Stock</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql33 = " SELECT * From $tabel_name WHERE 1 ";
                      $run33 = mysqli_query($con, $sql33);
                      $count_rows = mysqli_num_rows($run33);
                      $sno = 1;
                      if ($count_rows == 0) { ?>
                        <tr>
                          <td colspan="11" style="text-align: center;">No <?php echo $module_name; ?></td>
                        </tr>
                        <?php
                      } else {
                        while ($row33 = mysqli_fetch_assoc($run33)) {
                          $tbl_id = base64_encode($row33['id']);
                        ?>
                          <tr>
                            <td><?php echo $sno; ?></td>
                            <td><?php echo $row33['blood_group']; ?></td>
                            <td><?php echo $row33['stock']; ?></td>
                            <!-- <td style="text-align: center;"><a href="<?php echo $pagename_1; ?>?tbl_id=<?php echo $tbl_id; ?>" class="btn btn-warning list_edit_btn"><i class="nav-icon fas fa-edit"></i></a></td> -->
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
    </div> <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <?php include_once "footer_copy_rights.php" ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div><!-- ./wrapper -->

  <?php // include_once $footer_js_links 
  ?>
  <?php include_once "footer_js_links.php" ?>
  <?php include_once "footer_js.php" ?>

  <!-- new js for this page below -->
  <!-- head_quarter_id on change patch list -->
  <script>
    dr_id = '<?php echo $requested_dr_id ?>';
    area_name_id = '<?php echo $area_name_id ?>';

    // es6 function
    const getPatch = () => {
      head_quarter_id = $('#head_quarter_id').val();
      $.ajax({
        url: 'ajax.php',
        type: "post",
        data: {
          head_quarter_id: head_quarter_id,
          get_patch_list: 1
        },
        success: function(response) {
          // console.log(response)
          document.getElementById('area_name_id').innerHTML = "";
          document.getElementById('area_name_id').innerHTML += response;
          if (area_name_id != '') {
            document.querySelector("#area_name_id").value = area_name_id
          }
        }
      })
    }
    // console.log({dr_id})
    if (dr_id > 0) {
      getPatch()
    }


    $("#head_quarter_id").on('change', function() {
      getPatch()
    });
  </script>


  <script>
    $('.datetime_pick123').datetimepicker({
      format: 'd-m-Y',
      maxDate: new Date(),
      // timepicker:true,
      scrollMonth: true,
      changeMonth: true,
      changeYear: false,
      changeHour: false,
      timepicker: false,
    })
  </script>




  <script>
    $('.cal_planned_sale_amt').on('keyup change', function() {
      var invesment_amt = document.querySelector('#invesment_amt').value;
      var roi_times = document.querySelector('#roi_times').value;
      // console.log({roi_times},{invesment_amt});
      if (roi_times != "" && invesment_amt != "") {
        document.querySelector('#planned_sale_amt').value = parseFloat(invesment_amt) * parseFloat(roi_times);
      } else {
        document.querySelector('#planned_sale_amt').value = '';
      }
    });
  </script>


</body>

</html>