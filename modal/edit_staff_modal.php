<!-- Edit Staff Modal -->
<div class="modal fade" id="editstaffModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editstaffModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
            <h4 class="modal-title" id="editstaffModalLabel"><strong>EDIT ACADEMIC STAFF</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_staff_form" name="edit_staff_form" class="form-row" action="<?= ROOT ?>includes/edit_staff.inc.php" method="POST" onsubmit="return checkEditStaff();">
            <h5 class="form-group col-md-12 mb-3 text-dark">Personal Information</h5>
            <div class="form-group col-md-6">
                <label for="edit_userid">User ID</label>
                <input type="text" name="edit_userid" class="form-control" id="edit_userid" placeholder="Staff ID" readonly>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_sex">Sex</label>
                <select name="edit_sex" class="form-control" id="edit_sex">
                    <option value=""></option>  
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="edit_name">Name</label>
                <input type="text" name="edit_name" class="form-control" id="edit_name" placeholder="Name">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_email">Email</label>
                <input type="email" name="edit_email" class="form-control" id="edit_email" placeholder="name@example.com">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_phone">Phone No</label>
                <input type="text" name ="edit_phone" class="form-control" id="edit_phone" placeholder="Phone Number">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_ic">IC</label>
                <input type="text" name="edit_ic" class="form-control" id="edit_ic" placeholder="xxxxxx-xx-xxxx">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_passport">Passport</label>
                <input type="text" name="edit_passport" class="form-control" id="edit_passport" placeholder="Passport">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-4">
                <label for="edit_race">Race</label>
                <select name="edit_race" class="form-control" id="edit_race">
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
                <label for="edit_religion">Religion</label>
                <select name="edit_religion" class="form-control" id="edit_religion">
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
                <label for="edit_status">Status</label>
                <select name="edit_status" class="form-control" id="edit_status">
                    <option value=""></option>    
                    <option value="1">ACTIVE</option>
                    <option value="0">INACTIVE</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_country">Country</label>
                <?php
                        echo "<select name='edit_country' class='form-control' id='edit_country'>";
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
                <label for="edit_nationality">Nationality</label>
                <?php
                        echo "<select name='edit_nationality' class='form-control' id='edit_nationality'>";
                        foreach($national_option as $n_option){
                            echo "<option value='$n_option'>$n_option</option>";
                        }
                        echo "</select>"
                    ?>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>

            <h5 class="form-group col-md-12 mb-3 text-dark">Academic Information</h5>
            <div class="form-group col-md-12">
                    <label for="edit_faculty">Faculty</label>
                    <?php
                            echo "<select name='edit_faculty' class='form-control' id='edit_faculty'>";
                            foreach($faculty_option as $f_option){
                                echo "<option value='$f_option'>$f_option</option>";
                            }
                            echo "</select>"
                    ?>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="edit_designation">Designation</label>
                <?php
                        echo "<select name='edit_designation' class='form-control' id='edit_designation'>";; 
                        foreach($designation_option as $d_option){
                            echo "<option value='$d_option'>$d_option</option>";
                        }
                        echo "</select>"
                ?>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="edit_field_category">Field Category</label>
                <input type="text" name="edit_field_category" class="form-control" id="edit_field_category" placeholder="Field Category">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-12">
                <label for="edit_field">Field</label>
                <input type="text" name="edit_field" class="form-control" id="edit_field" placeholder="Field">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="col-md-12 modal-footer">
                <button type="button" id="edit_cancelbtn" name="edit_cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" id="edit_submitbtn" name="edit_submitbtn" class="btn btn-success">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>