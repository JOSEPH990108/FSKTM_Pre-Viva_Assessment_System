<!-- Presentation Assessment Modal -->
<div class="modal fade" id="presentationassessmentModal" tabindex="-1" role="dialog" aria-labelledby="presentationassessmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="presentationassessmentModalLabel">Presentation Assessment</h5>
        <div>
            <input type="text" name="presentation_total_mark" class="ml-5 w-50 text-center text-black" id="presentation_total_mark" value="0" readonly> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
      <div class="modal-body">
      <form id="presentation_assessment_form" name="presentation_assessment_form" class="form-row was-validated" action="<?= ROOT ?>includes/presentation_assessment.inc.php" method="POST" onchange="return PresentationAutoCalculation();">
                <div class="form-group col-md-6" hidden>
                    <label for="presentation_assessment_application_id"><strong>Application ID</strong></label>
                    <input type="text" name="presentation_assessment_application_id" class="form-control" id="presentation_assessment_application_id" readonly>
                </div>
                <div class="form-group col-md-6" hidden>
                    <label for="presentation_student_matric_no"><strong>MATRIC NO</strong></label>
                    <input type="text" name="presentation_student_matric_no" class="form-control" id="presentation_student_matric_no" readonly>
                </div>
                <!-- Presentation -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= PRESENTATION ?></h3>
                      <input type="text" name="presentation_mark" class="col-md-1 text-center text-black" id="presentation_mark" value="0" readonly>  
                    </div>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Criteria</th>
                        <th class="text-center" scope="col">Rating</th>
                        <th class="text-center" scope="col">Weightage</th>
                        <th class="text-center" scope="col">Marks(Rating * Weightage)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Presentation materials are <b>very systematic</b> and very interesting</p>
                                <p>Presentation is <b>very solid</b></p>
                                <p>Time management is <b>very good</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="presentation" value="<?=RATING5*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Presentation materials are <b>very systematic</b> and very interesting</p>
                                <p>Presentation is <b>very solid</b></p>
                                <p>Time management is <b>very good</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="presentation" value="<?=RATING4*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Presentation materials are <b>satisfactory</b></p>
                                <p>Presentation is <b>satisfactory</b></p>
                                <p>Time management is <b>satisfactory</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="presentation" value="<?=RATING3*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Presentation materials are <b>unsystematic</b></p>
                                <p>Presentation is <b>not solid</b></p>
                                <p>Time management is <b>poor</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="presentation" value="<?=RATING2*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Presentation materials <b>are not consistent</b> with the content</p>
                                <p>Presentation is <b>very weak</b></p>
                                <p><b>No</b> time management at all</p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="presentation" value="<?=RATING1*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="presentation_comment">Comment:</label>
                                    <textarea class="form-control" name="presentation_comment" id="presentation_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- QNA -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= QNA ?></h3>
                      <input type="text" name="qna_mark" class="col-md-1 text-center text-black" id="qna_mark" value="0" readonly>  
                    </div>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Criteria</th>
                        <th class="text-center" scope="col">Rating</th>
                        <th class="text-center" scope="col">Weightage</th>
                        <th class="text-center" scope="col">Marks(Rating * Weightage)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Able to answer all questions <b>very effectively</b></p>
                                <p>The answer given are <b>highly relevant</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="qna" value="<?=RATING5*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Able to answer all questions <b>effectively</b></p>
                                <p>The answer given are <b>relevant</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="qna" value="<?=RATING4*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Able to answer all questions <b>moderately well</b></p>
                                <p>Some of the answer given are <b>irrelevant</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="qna" value="<?=RATING3*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>unable to answer <b>some</b> questions</p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="qna" value="<?=RATING2*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Unable to answer <b>all</b> questions</p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE10?></td>
                            <td class="text-center"><input type="radio" name="qna" value="<?=RATING1*WEIGHTAGE10?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="qna_comment">Comment:</label>
                                    <textarea class="form-control" name="qna_comment" id="qna_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="modal-footer col-md-12">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="presentation_assessmentbtn" class="btn btn-success presentation_assessmentbtn">Submit</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
