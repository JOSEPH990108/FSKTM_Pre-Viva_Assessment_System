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
    <div class="head-content">
        <div class="header">
            <h2>User > Student</h2>
        </div>
        <div class="add_button">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addstudentModal">Add Student</button>
        </div>
    </div>

    <!-- Table to show all academic staff -->
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" style="width: 100%">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Level of Study</th>
                        <th>Programme</th>
                        <th>Research Title</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>IC</th>
                        <th>Passport</th>
                        <th>Sex</th>
                        <th>Race</th>
                        <th>Religion</th>
                        <th>Country</th>
                        <th>Nationality</th>
                        <th>Status</th>
                    </tr>
                </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM tbl_user
                        INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.user_id 
                        WHERE user_type = ?;";
                $stmt =  mysqli_stmt_init($conn);
                //Check connection and sql statement without any error
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    //Redirect to login page
                    header("Location: " . ROOT);
                    exit();
                }
                else{
                    $user = "STUDENT";
                    mysqli_stmt_bind_param($stmt, "s", $user);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_assoc($result)){
                        $user_id = $row['user_id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone_no'];
                        $ic = $row['ic'];
                        $passport = $row['passport'];
                        $sex = $row['sex'];
                        $race = $row['race'];
                        $religion = $row['religion'];
                        $country = $row['country'];
                        $nationality = $row['nationality'];
                        $status = $row['register_status'];
                        $user_type = $row['user_type'];
                        $student_id = $row['student_id'];
                        $levelofstudy = $row['level_of_study'];
                        $programme = $row['programme'];
                        $research_title = $row['research_title'];
                        if($status == TRUE)
                            $status = "ACTIVE";
                        else
                            $status = "INACTIVE";
                        ?>

                    <tr>
                        <td>
                            <div class="action-button">
                            <button class="btn btn-success student_editbtn" id="student_editbtn" data-toggle="modal" data-target="#editstudentModal"><i class="fa fa-cog" aria-hidden="true"></i></button>
                            <button class="btn btn-danger student_deletebtn" id="student_deletebtn"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                        </td>
                        <td><?=$user_id?></td>
                        <td><?=$name?></td>
                        <td><?=$levelofstudy?></td>
                        <td><?=$programme?></td>
                        <td><?=$research_title?></td>
                        <td><?=$email?></td>
                        <td><?=$phone?></td>
                        <td><?=$ic?></td>
                        <td><?=$passport?></td>
                        <td><?=$sex?></td>
                        <td><?=$race?></td>
                        <td><?=$religion?></td>
                        <td><?=$country?></td>
                        <td><?=$nationality?></td>
                        <td><?=$status?></td>
                <?php
                        }
                    }
                ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Modal -->
<?php
    include('modal/add_student_modal.php');
    include('modal/edit_student_modal.php');
?>

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
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['error']);
        }

        if(isset($_SESSION['edit-error']) && $_SESSION['edit-error'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['edit-error']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['edit-error']);
        }

        if(isset($_SESSION['delete-error']) && $_SESSION['delete-error'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['delete-error']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['delete-error']);
        }

        if(isset($_SESSION['insert-success']) && $_SESSION['insert-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['insert-success']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['insert-success']);
        }

        if(isset($_SESSION['update-success']) && $_SESSION['update-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['update-success']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['update-success']);
        }

        if(isset($_SESSION['delete-success']) && $_SESSION['delete-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['delete-success']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['delete-success']);
        }

        if(isset($_SESSION['insert-unsuccess']) && $_SESSION['insert-unsuccess'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['insert-unsuccess']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['insert-unsuccess']);
        }

        if(isset($_SESSION['update-unsuccess']) && $_SESSION['update-unsuccess'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['update-unsuccess']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['update-unsuccess']);
        }

        if(isset($_SESSION['delete-unsuccess']) && $_SESSION['delete-unsuccess'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['delete-unsuccess']; ?>',
                    timer: 3000
                });
            </script>
            <?php
                unset($_SESSION['delete-unsuccess']);
        }
    ?>