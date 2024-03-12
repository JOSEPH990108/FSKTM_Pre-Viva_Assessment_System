<?php
  //Include database connection and constants
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>/css/util.css" />
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>/css/login.css" />
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>/css/modal.css" />
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>vendors/css/bootstrap-4.6.1.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= ASSETS ?>vendor/css/bootstrap.min.css"
    />
  </head>

  <body>
    <!--Login Page-->
    <div class="container1">
      <div class="login-container">
        <div class="login-wrapper">
          <span class="login-form-title">
            FSKTM PRE-VIVA ASSESSMENT SYSTEM
          </span>
          <form
            id="login_form"
            action="<?= ROOT?>/includes/signin.inc.php"
            class="login-form"
            method="POST"
            name="loginform"
            onsubmit="return validateform()"
          >
            <div class="field">
              <span class="fa fa-user"></span>
              <input
                type="text"
                name="username"
                id="username"
                placeholder="Staff ID or Matric ID"
              />
            </div>
            <?php if(isset($_SESSION['username-error'])) {?>
            <span id="userempty"><?php echo $_SESSION['username-error'];?></span>
            <?php unset($_SESSION['username-error']);?>
            <?php } ?>
            <div class="field space">
              <span class="fa fa-lock"></span>
              <input
                type="password"
                class="pass-key"
                name="password"
                id="password"
                placeholder="Password"
              />
              <span class="show">SHOW</span>
            </div>
            <?php if(isset($_SESSION['password-error'])) {?>
            <span id="passempty"><?php echo $_SESSION['password-error'];?></span>
            <?php unset($_SESSION['password-error']); ?>
            <?php } ?>
            <br />
            <?php
              if (isset($_SESSION['error'])) {
                echo $_SESSION['error']; //Displaying Session message
                unset($_SESSION['error']); //Removing Session message
              }
              if (isset($_SESSION['no-user'])) {
                echo $_SESSION['no-user']; //Displaying Session message
                unset($_SESSION['no-user']); //Removing Session message
              }
              if (isset($_SESSION['login-fail'])) {
                echo $_SESSION['login-fail']; //Displaying Session message
                unset($_SESSION['login-fail']); //Removing Session message
              }
              if (isset($_SESSION['first-time-success'])) {
                echo $_SESSION['first-time-success']; //Displaying Session message
                unset($_SESSION['first-time-success']); //Removing Session message
              }
              if (isset($_SESSION['first-time-unsuccess'])) {
                echo $_SESSION['first-time-unsuccess']; //Displaying Session message
                unset($_SESSION['first-time-unsuccess']); //Removing Session message
              }
              if (isset($_SESSION['admin-already-exists'])) {
                echo $_SESSION['admin-already-exists']; //Displaying Session message
                unset($_SESSION['admin-already-exists']); //Removing Session message
              }
          ?>
            <div class="field">
              <input type="submit" id="login_submit" name="login_submit" value="LOGIN" />
            </div>
          </form>
          <br />
          <div class="contactus">
            <p>
              Only UTHM postgraduate students with active status are allowed to
              login to this system. For any enquires, please click
            </p>
            <a href="" data-toggle="modal" data-target="#contactusModal">Contact Us</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="contactusModal" tabindex="-1" aria-labelledby="contactusModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="header-title">
              <h5 class="modal-title" id="contactusModalLabel"><strong>Contact Us</strong></h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <h5>Academic Management Office</h5>
            <div class="icon">
              <i class="fa fa-phone"></i>
              <span class="link_name">+607-4537696</span>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-o"></i>
              <span class="link_name">pa@uthm.edu.my</span>
            </div>
            <div class="icon">
              <i class="fa fa-globe"></i>
              <span class="link_name">ppa.uthm.edu.my</span>
            </div>
            <h5>Centre For Graduate Studies</h5>
            <div class="icon">
              <i class="fa fa-phone"></i>
              <span class="link_name">+607-4537509 / 7906 / 7677 / 7557</span>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-o"></i>
              <span class="link_name">graduatestudies@uthm.edu.my</span>
            </div>
            <div class="icon">
              <i class="fa fa-globe"></i>
              <span class="link_name">ps.uthm.edu.my</span>
            </div>
            <h5>Forgot Password</h5>
            <div class="icon">
              <i class="fa fa-phone"></i>
              <span class="link_name">+607-4537292 / 7295</span>
            </div>
            <div class="icon">
              <i class="fa fa-whatsapp"></i>
              <span class="link_name">UTHM Whatsapp Report Channel</span>
            </div>
            <div class="icon">
              <i class="fa fa-facebook-official"></i>
              <span class="link_name">www.facebook.com/ptmuthm</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=ASSETS?>vendors/js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?=ASSETS?>vendors/js/popper-1.16.1.min.js"></script>
    <script src="<?=ASSETS?>vendors/js/bootstrap-4.6.1.min.js"></script>
    <!--Script for show and hide password-->
    <script>
      const pass_field = document.querySelector(".pass-key");
      const showBtn = document.querySelector(".show");
      showBtn.addEventListener("click", function () {
        if (pass_field.type === "password") {
          pass_field.type = "text";
          showBtn.textContent = "HIDE";
          showBtn.style.color = "#222";
        } else {
          pass_field.type = "password";
          showBtn.textContent = "SHOW";
          showBtn.style.color = "#222";
        }
      });
    </script>
    <!--Script for login validation-->
    <script src="<?= ASSETS ?>/js/login.js"></script>
  </body>
</html>

