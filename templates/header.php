<!-- Topbar -->
<div class="topbar-section">
  <div class="toggle">
    <label for="nav-toggle">
      <span><i class="las la-bars"></i></span>
    </label>
  </div>

  <div class="right-side">
    <div class="action">
      <div class="profile">
        <img src="<?= ASSETS?>images/profile.jpg" alt="" />
      </div>
      <div class="menu">
        <?php
          $query = "SELECT name FROM tbl_user WHERE user_id = ?;";

          $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $query)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "home.php");
            } 
            else{
              mysqli_stmt_bind_param($statement, "s", $userid);
              mysqli_stmt_execute($statement);
              $load_result = mysqli_stmt_get_result($statement);
              if($result_row = mysqli_fetch_assoc($load_result)){
                $name = $result_row['name'];
              }
            }
          ?>
        <h3><?=$name?></h3>
        <span><?=$userid?> (<?=$usertype?>)</span></br>
        <ul>
          <li>
            <a href="<?= ROOT?>profile.php"><i class="las la-id-card"></i>My Profile</a>
          </li>
          <li>
            <a href="<?= ROOT?>update_password.php"><i class="las la-key"></i>Update Password</a>
          </li>
          <li>
            <a href="<?=ROOT?>/includes/logout.inc.php"><i class="las la-sign-out-alt"></i>Sign Out</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>