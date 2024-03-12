<?php 
    //Check login session first
    include('includes/login_check.inc.php');
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    include('templates/sidebar.php'); 
    include('templates/header.php');
?>

<!-- Main Content -->
<div class="main-content" onclick="removeToggle();">
    <div class="content">
        <h2>Change Password</h2>
        <form id="changepass_form" name="changepass_form" class="row g-3" action="<?= ROOT ?>includes/update_password.inc.php" method="POST" onsubmit="return checkPassword();">
            <div class="form-group col-md-12">
                <label for="oldpass">Odd Password</label>
                <input type="password" name="oldpass" class="form-control" id="oldpass" placeholder="Old Password">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="newpass">New Password</label>
                <input type="password" name="newpass" class="form-control" id="newpass" placeholder="New Password">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="confirmpass">Confirm Password</label>
                <input type="password" name="confirmpass" class="form-control" id="confirmpass" placeholder="Confirm Password">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12 text-right">
                <a href="<?=ROOT?>home.php"><button type="button" name="cancelbtn" class="btn btn-danger">Cancel</button></a>
                <button type="submit" id="submitbtn" name="submitbtn" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>

<?php
    include('templates/footer.php');
?>

<?php
    if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: '<?php echo $_SESSION['error']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['error']);
    }

    if(isset($_SESSION['no-user-found']) && $_SESSION['no-user-found'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: '<?php echo $_SESSION['no-user-found']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['no-user-found']);
    }

    if(isset($_SESSION['incorrect-oldpass']) && $_SESSION['incorrect-oldpass'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: '<?php echo $_SESSION['incorrect-oldpass']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['incorrect-oldpass']);
    }

    if(isset($_SESSION['cannot-repeat-oldpass']) && $_SESSION['cannot-repeat-oldpass'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: '<?php echo $_SESSION['cannot-repeat-oldpass']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['cannot-repeat-oldpass']);
    }

    if(isset($_SESSION['not-match-confirmpass']) && $_SESSION['not-match-confirmpass'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: '<?php echo $_SESSION['not-match-confirmpass']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['not-match-confirmpass']);
    }
?>