<!-- Assesors Details Modal -->
<div class="modal fade" id="viewAcademicStaffModal" tabindex="-1" role="dialog" aria-labelledby="viewAcademicStaffModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
          <h4 class="modal-title" id="viewAcademicStaffModalLabel"><strong></strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        
        <div class="form-group row">
            <label for="staff_name" class="col-sm-3 col-form-label staff_name"><b>Name</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="staff_name" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="designation" class="col-md-3 col-form-label"><b>Designation</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="designation" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="field" class="col-md-3 col-form-label"><b>Field Category</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="field_category" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="field" class="col-md-3 col-form-label"><b>Field</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="field" readonly>
            </div>
        </div>
    
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>