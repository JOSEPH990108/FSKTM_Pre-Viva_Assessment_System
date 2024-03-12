<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=  WEBSITE_TITLE ?></title>
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/modal.css" />
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>vendors/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>vendors/css/bootstrap-4.6.1.min.css">
    
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"/>
    <!--Line Awesome Link-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
  </head>

  <body>
    <input type="checkbox" id="nav-toggle" />
    <div class="sidebar" onclick="removeToggle();">
      <div class="sidebar-brand">
        <a href="<?= ROOT ?>home.php">
          <span><img src="<?= ASSETS ?>images/uthmlogo.png" alt="UTHM Logo" /></span>
          <span>FSKTM PRE-VIVA ASSESSMENT SYSTEM</span>
        </a>
      </div>
  
      <ul class="nav-links">
        <li id="dashboard">
          <a href="<?= ROOT ?>home.php">
            <i class="bx bx-grid-alt"></i>
            <span class="link_name">Dashboard</span>
          </a>
        </li>

        <li id="profile">
          <div class="icon-link">
            <a href="">
              <i class="las la-address-book"></i>
              <span class="link_name">Profile</span>
            </a>
            <i class="bx bxs-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li>
              <a href="<?= ROOT?>profile.php"><i class="bx bxs-user-detail"></i>Profile Details</a>
            </li>
            <li>
              <a href="<?= ROOT?>update_password.php"><i class="bx bxs-key"></i>Update Password</a>
            </li>
          </ul>
        </li>

        <li id="users">
          <div class="icon-link">
            <a href="">
              <i class="las la-user"></i>
              <span class="link_name">Users</span>
            </a>
            <i class="bx bxs-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li>
              <a href="<?=ROOT?>manage_admin.php"><i class="las la-user-shield"></i>Administrators</a>
            </li>
            <li>
              <a href="<?=ROOT?>manage_staff.php"> <i class="las la-users"></i>Academic Staffs</a>
            </li>
            <li>
              <a href="<?=ROOT?>manage_student.php">
                <i class="las la-user-graduate"></i>Postgraduate Students</a
              >
            </li>
          </ul>
        </li>

        <li id="apply_pre_viva">
          <a href="<?= ROOT?>apply_pre_viva_application.php">
            <i class="las la-file-upload"></i>
            <span class="link_name">Apply Pre-Viva</span>
          </a>
        </li>

        <li id="pre_viva">
          <a href="<?= ROOT?>pre_viva_application.php">
            <i class="las la-file-upload"></i>
            <span class="link_name">Pre-Viva Application</span>
          </a>
        </li>

        <li id="all_pre_viva">
          <a href="<?= ROOT?>all_pre_viva_application.php">
            <i class="las la-file-upload"></i>
            <span class="link_name">All Application</span>
          </a>
        </li>

        <li id="analytics">
          <a href="<?= ROOT?>analytical.php">
            <i class="las la-chart-pie"></i>
            <span class="link_name">Analytics</span>
          </a>
        </li>

        <li>
          <a href="<?=ROOT?>/includes/logout.inc.php">
            <i class="bx bx-log-out"></i>
            <span class="link_name">Logout</span>
          </a>
        </li>
      </ul>
    </div>