<!-- Assesors Details Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
          <h4 class="modal-title" id="viewStudentModalLabel"><strong></strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        
        <div class="form-group row">
            <label for="student_name" class="col-sm-3 col-form-label student_name"><b>Name</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="student_name" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="designation" class="col-md-3 col-form-label"><b>Level of Study</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="level_of_study" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="field" class="col-md-3 col-form-label"><b>Programme</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="programme" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="research_title" class="col-md-3 col-form-label"><b>Research Title</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="research_title" readonly>
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