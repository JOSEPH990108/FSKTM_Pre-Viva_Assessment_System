<!-- Add Admin Modal -->
<div class="modal fade" id="addadminModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addadminModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
            <h4 class="modal-title" id="addadminModalLabel"><strong>ADD ADMINISTATOR</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_admin_form" name="add_admin_form" class="form-row " action="<?= ROOT ?>includes/add_admin.inc.php" method="POST" onsubmit="return checkAdmin();">
            <h5 class="col-md-12 mb-3 text-dark">Personal Information</h5>
            <div class="form-group col-md-6">
                <label for="userid">User ID</label>
                <input type="text" name="userid" class="form-control" id="userid" placeholder="Staff ID OR Matric NO">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="sex">Sex</label>
                <select name="sex" class="form-control" id="sex">
                    <option value=""></option>    
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone No</label>
                <input type="text" name ="phone" class="form-control" id="phone" placeholder="Phone Number">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="ic">IC</label>
                <input type="text" name="ic" class="form-control" id="ic" placeholder="IC Number">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="passport">Passport</label>
                <input type="text" name="passport" class="form-control" id="passport" placeholder="Passport">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-4">
                <label for="race">Race</label>
                <select name="race" class="form-control" id="race">
                    <option value=""></option>   
                    <option value="CHINESE">CHINESE</option>
                    <option value="INDIA">INDIA</option>
                    <option value="MALAY">MALAY</option> 
                    <option value="OTHERS">OTHERS</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-4">
                <label for="religion">Religion</label>
                <select name="religion" class="form-control" id="religion">
                    <option value=""></option>   
                    <option value="BUDDHIST">BUDDHIST</option> 
                    <option value="CHRISTIAN">CHRISTIAN</option>
                    <option value="HINDU">HINDU</option>
                    <option value="MUSLIM">MUSLIM</option>
                    <option value="NO RELIGIONS">NO RELIGIONS</option>
                    <option value="OTHERS">OTHERS</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-4">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option value=""></option>    
                    <option value="1">ACTIVE</option>
                    <option value="0">INACTIVE</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="country">Country</label>
                <?php
                        echo "<select name='country' class='form-control' id='country'>";
                        foreach($countries_list as $c_option){
                            echo "<option value='$c_option'>$c_option</option>";
                        }
                        echo "</select>"
                    ?>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="nationality">Nationality</label>
                <?php
                        echo "<select name='nationality' class='form-control' id='nationality'>";
                        foreach($national_option as $n_option){
                            echo "<option value='$n_option'>$n_option</option>";
                        }
                        echo "</select>"
                    ?>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="usertype">User Type</label>
                <input type="text" name="usertype" class="form-control" id="usertype" value="ADMIN" readonly>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="col-md-12 modal-footer">
                <button type="button" id="cancelbtn" name="cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" id="submitbtn" name="submitbtn" class="btn btn-success add_user_btn">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>