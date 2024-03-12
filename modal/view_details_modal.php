<!-- Assesors Details Modal -->
<div class="modal fade" id="viewdetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewdetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
          <h4 class="modal-title" id="viewdetailsModalLabel"><strong></strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
      
      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label name"><b></b></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="name" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="designation" class="col-sm-3 col-form-label"><b>Designation</b></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="designation" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="field" class="col-sm-3 col-form-label"><b>Field</b></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="field" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="thesismark" class="col-sm-3 col-form-label"><b>Total Mark</b></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="thesismark" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="thesisreview_btn" class="col-sm-3 col-form-label"><b>Thesis Review</b></label>
        <div class="col-sm-9">
            <button type="button" class="btn btn-primary thesisreview_btn" id="thesisreview_btn" data-toggle="modal" data-target="#viewthesisassessmentModal">View</button>
        </div>
      </div>

      <div class="form-group row">
        <label for="download_commentedfile_btn" class="col-sm-3 col-form-label"><b>Commented Thesis</b></label>
        <div class="col-sm-9">
            <a href="" id="download_commentedfile_btn" target='_blank'><button type="button" class="btn btn-info download_commentedfile_btn">Download</button></a>
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