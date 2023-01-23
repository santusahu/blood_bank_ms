<style>
  .status_enable {
    color: green;
    font-weight: bold;
  }

  .status_disable {
    color: red;
    font-weight: bold;

  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="Images/logo/blood_logo.webp" alt="Blood Bank" class="brand-image img-circle elevation-3" style="opacity: .8">
    <!-- <img src="Images/logo/logo2.jpeg" alt="ABMS Pharma" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Blood Bank </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="Images/logo/blood_bank.jpeg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="index.php" class="d-block">Blood Bank </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($pagename == 'index.php') {
                                                echo 'active';
                                              } ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- 2 lavel drop down -->
        <li class="nav-item <?php if ($pagename == 'blood_groop_master.php' || $pagename == 'blood_groop_list.php'  || $pagename == 'medicine_master.php' || $pagename == 'doctor_master.php') {
                              echo 'menu-open';
                            } ?>">
          <a href="#" class="nav-link <?php if ($pagename == 'blood_groop_master.php' || $pagename == 'blood_groop_list.php' || $pagename == 'medicine_master.php' || $pagename == 'doctor_master.php') {
                                        echo 'active';
                                      } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- head_quarter_master -->
            <!-- <li class="nav-item">
              <a href="blood_groop_master.php" class="nav-link <?php if ($pagename == 'blood_groop_master.php') {
                                                                  echo 'active';
                                                                } ?>">
                <i class="far fa-circle text-danger nav-icon"></i>
                <p>Blood Group Master</p>
              </a>
            </li> -->

            <li class="nav-item">
              <a href="blood_groop_list.php" class="nav-link <?php if ($pagename == 'blood_groop_list.php') {
                                                                echo 'active';
                                                              } ?>">
                <i class="far fa-circle text-success nav-icon"></i>
                <p>Blood Group List</p>
              </a>
            </li>
            <!-- area_master -->
          </ul>
        </li>


        <li class="nav-header">Transection</li>
        <!-- Sales -->
        <li class="nav-item  <?php if ($page_module == 'Donar') {
                                echo 'menu-open';
                              } ?>">
          <a href="#" class="nav-link <?php if ($page_module == 'Donar') {
                                        echo 'active';
                                      } ?>">
            <i class="nav-icon far fa-plus-square"></i>
            <p><i class="fas fa-angle-left right"></i>Donar</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="donar_registration.php" class="nav-link <?php if ($pagename == 'donar_registration.php') {
                                                                  echo 'active';
                                                                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Donar Register</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="donar_list.php" class="nav-link <?php if ($pagename == 'donar_list.php') {
                                                          echo 'active';
                                                        } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Donar List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="blood_donation.php" class="nav-link <?php if ($pagename == 'blood_donation.php') {
                                                              echo 'active';
                                                            } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Blood Donation</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="blood_donation_list.php" class="nav-link <?php if ($pagename == 'blood_donation_list.php') {
                                                                  echo 'active';
                                                                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Blood Donation List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item  <?php if ($page_module == 'Patient') {
                                echo 'menu-open';
                              } ?>">
          <a href="#" class="nav-link <?php if ($page_module == 'Patient') {
                                        echo 'active';
                                      } ?>">
            <i class="nav-icon far fa-plus-square"></i>
            <p><i class="fas fa-angle-left right"></i>Patient</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="patient_registration.php" class="nav-link <?php if ($pagename == 'patient_registration.php') {
                                                                    echo 'active';
                                                                  } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Patient Register</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="patient_list.php" class="nav-link <?php if ($pagename == 'patient_list.php') {
                                                            echo 'active';
                                                          } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Patient List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="blood_enquiry.php" class="nav-link <?php if ($pagename == 'blood_enquiry.php') {
                                                            echo 'active';
                                                          } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Blood Enquiry</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="blood_enquiry_list.php" class="nav-link <?php if ($pagename == 'blood_enquiry_list.php') {
                                                                  echo 'active';
                                                                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Blood Enquiry List</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>