<?php
include_once "session.php";
$pagename = "blood_enquiry_list.php";
$pagename1 = "blood_enquiry_AR.php";
$insert_page = "blood_enquiry.php";
$status = $patient_id = 0;
$tabel_name = "blood_enquiry";
$module_name = "Blood Enquiry";
$page_module = "Patient";
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
                                                <th>Name</th>
                                                <th>Mobile Number</th>
                                                <th>Blood Group</th>
                                                <th>Unit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql33 = " SELECT $tabel_name.* , patient_registration.patient_name , patient_registration.mobile_number From $tabel_name LEFT JOIN patient_registration ON patient_registration.id = $tabel_name.patient_id WHERE 1 ";
                                            $run33 = mysqli_query($con, $sql33);
                                            $count_rows = mysqli_num_rows($run33);
                                            $sno = 1;
                                            if ($count_rows == 0) { ?>
                                                <tr>
                                                    <td colspan="5" style="text-align: center;">No <?php echo $module_name; ?></td>
                                                </tr>
                                                <?php
                                            } else {
                                                while ($row33 = mysqli_fetch_assoc($run33)) {
                                                    $tbl_id = base64_encode($row33['id']);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sno; ?></td>
                                                        <td><?php echo $row33['patient_name']; ?></td>
                                                        <td><?php echo $row33['mobile_number']; ?></td>
                                                        <td><?php echo $row33['blood_group']; ?></td>
                                                        <td><?php echo $row33['unit']; ?></td>
                                                        <td style="text-align: center;"><a href="<?php echo $insert_page; ?>?tbl_id=<?php echo $tbl_id; ?>" class="btn btn-warning list_edit_btn"><i class="nav-icon fas fa-edit"></i></a>
                                                            <a title="Blood Enquiry_AR" href="<?php echo $pagename1; ?>?tbl_id=<?php echo $tbl_id; ?>" class="btn btn-success list_edit_btn"><i class="nav-icon fas fa-edit"></i></a>
                                                        </td>
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
    <!-- patient_id on change patch list -->
    <script>
        dr_id = '<?php echo $requested_dr_id ?>';
        area_name_id = '<?php echo $area_name_id ?>';

        // es6 function
        const getPatch = () => {
            patient_id = $('#patient_id').val();
            $.ajax({
                url: 'ajax.php',
                type: "post",
                data: {
                    patient_id: patient_id,
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


        $("#patient_id").on('change', function() {
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