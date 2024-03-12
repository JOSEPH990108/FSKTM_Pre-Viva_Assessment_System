<!-- Apply Pre-Viva Modal -->
<div class="modal fade" id="applyprevivaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="applyprevivaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
            <h4 class="modal-title" id="applyprevivaModalLabel"><strong>APPLY PRE-VIVA</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="apply_pre_viva_form" name="apply_pre_viva_form" class="was-validated" action="<?=ROOT?>includes/apply_application.inc.php" method="POST" enctype="multipart/form-data">
                <div class="note" style="color:red">
                    <p><b>Note!</b><b> Only PDF Format is accepted!</b> Please rename the file based on the example format given below:</p>
                    <p>MATRICNO_THESIS_FILE.pdf & MATRICNO_PLAGIARISM_REPORT.pdf & MATRICNO_PROOFREAD_RECEIPT.pdf</p> 
                    <p><b>Maximum upload file size: 5 MB</b></p>
                </div>
                <span><strong>Thesis File</strong></span>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="validatedThesisFile" name="thesis" accept="application/pdf" required>
                    <label class="custom-file-label" for="validatedThesisFile">Choose file...</label>
                    <div class="invalid-feedback">Please upload complete thesis draft!</div>
                </div>
                <label><strong>Plagiarism Report</strong></label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="validatedPlagiarismFile" name="plagiarism" accept="application/pdf" required>
                    <label class="custom-file-label" for="validatedPlagiarismFile">Choose file...</label>
                    <div class="invalid-feedback">Please upload plagiarism report!</div>
                </div>
                <label><strong>Proofread Receipt</strong></label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="validatedProofreadFile" name="proofread" accept="application/pdf" required>
                    <label class="custom-file-label" for="validatedProofreadFile">Choose file...</label>
                    <div class="invalid-feedback">Please upload proofread receipt!</div>
                </div>
                <div class="col-md-12 modal-footer">
                    <button type="button" id="cancelbtn" name="cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="applybtn" name="applybtn" class="btn btn-success">Apply</button>
                </div>
            </form>
        </div> 
    </div>
  </div>
</div>
