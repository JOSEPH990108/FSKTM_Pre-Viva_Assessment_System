<!-- Thesis Assessment Modal -->
<div class="modal fade" id="thesisassessmentModal" tabindex="-1" role="dialog" aria-labelledby="thesisassessmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="thesisassessmentModalLabel">Thesis Assessment</h5>
        <div>
            <input type="text" name="total_mark" class="ml-5 w-50 text-center text-black" id="total_mark" value="0" readonly> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
      <div class="modal-body">
      <form id="thesis_assessment_form" name="thesis_assessment_form" class="form-row was-validated" action="<?= ROOT ?>includes/thesis_assessment.inc.php" method="POST" onchange="return AutoCalculation();" enctype="multipart/form-data">
                <div class="form-group col-md-6" hidden>
                    <label for="assessment_application_id"><strong>Application ID</strong></label>
                    <input type="text" name="assessment_application_id" class="form-control" id="assessment_application_id" readonly>
                </div>
                <div class="form-group col-md-6" hidden>
                    <label for="student_matric_no"><strong>MATRIC NO</strong></label>
                    <input type="text" name="student_matric_no" class="form-control" id="student_matric_no" readonly>
                </div>
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= ABS ?></h3>
                      <input type="text" name="abstract_mark" class="col-md-1 text-center text-black" id="abstract_mark" value="0" readonly>  
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
                                <p>There are statements that <b>very clearly</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• How the study is carried out</p>
                                <p>• Key findings</p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="abstract" value="<?=RATING5*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are statements that <b>clearly</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• How the study is carried out</p>
                                <p>• Key findings</p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="abstract" value="<?=RATING4*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are statements that <b>satisfactorily</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• How the study is carried out</p>
                                <p>• Key findings</p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="abstract" value="<?=RATING3*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are statements that <b>vaguely</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• How the study is carried out</p>
                                <p>• Key findings</p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="abstract" value="<?=RATING2*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are <b>no</b> statements that include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• How the study is carried out</p>
                                <p>• Key findings</p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="abstract" value="<?=RATING1*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="abstract_comment">Comment:</label>
                                    <textarea class="form-control" name="abstract_comment" id="abstract_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- INTRODUCTION -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= INTRO ?></h3>
                      <input type="text" name="introduction_mark" class="col-md-1 text-center text-black" id="introduction_mark" value="0" readonly>  
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
                                <p>There are statements that <b>very clearly</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• Supporting literature</p>
                                <p>• Justification for the study</p>
                                <p>• Importance of the study</p>
                                <p>• Limitations / scope of the study</p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="introduction" value="<?=RATING5*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are statements that <b>clearly</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• Supporting literature</p>
                                <p>• Justification for the study</p>
                                <p>• Importance of the study</p>
                                <p>• Limitations / scope of the study</p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="introduction" value="<?=RATING4*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are statements that <b>satisfactorily</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• Supporting literature</p>
                                <p>• Justification for the study</p>
                                <p>• Importance of the study</p>
                                <p>• Limitations / scope of the study</p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="introduction" value="<?=RATING3*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are statements that <b>vaguely</b> include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• Supporting literature</p>
                                <p>• Justification for the study</p>
                                <p>• Importance of the study</p>
                                <p>• Limitations / scope of the study</p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="introduction" value="<?=RATING2*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>There are <b>no</b> statements that include the following:</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• The problem being investigated (objectives / questions / hypotheses)</p>
                                <p>• Supporting literature</p>
                                <p>• Justification for the study</p>
                                <p>• Importance of the study</p>
                                <p>• Limitations / scope of the study</p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE2?></td>
                            <td class="text-center"><input type="radio" name="introduction" value="<?=RATING1*WEIGHTAGE2?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="introduction_comment">Comment:</label>
                                    <textarea class="form-control" name="introduction_comment" id="introduction_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- LITERATURE REVIEW -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= LR ?></h3>
                      <input type="text" name="literature_review_mark" class="col-md-1 text-center text-black" id="literature_review_mark" value="0" readonly>  
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
                                <p>• The LR is <b>very relevant</b> and comprehensive</p>
                                <p>• The LR is <b>critically</b> written and balanced</p>
                                <p>• Its sources of reference are <b>extremely reliable</b> (from verified journals or original sources)</p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="literature_review" value="<?=RATING5*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The LR is <b>relevant</b> and comprehensive</p>
                                <p>• The LR is <b>well</b> written and balanced</p>
                                <p>• Its sources of reference are <b>reliable</b> (from verified journals or original sources)</p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="literature_review" value="<?=RATING4*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The LR is <b>only slightly</b> relevant</p>
                                <p>• The LR is written in <b>general</b> terms</p>
                                <p>• Its sources of reference are <b>not very reliable</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="literature_review" value="<?=RATING3*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The LR is <b>irrelevant</b></p>
                                <p>• The LR is <b>not very well</b> written</p>
                                <p>• Its sources of reference are <b>unreliable</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="literature_review" value="<?=RATING2*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The LR is <b>irrelevant</b></p>
                                <p>• The LR is <b>poorly</b> written</p>
                                <p>• The LR <b>does not have</b> any suitable sources of reference</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="literature_review" value="<?=RATING1*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="literature_review_comment">Comment:</label>
                                    <textarea class="form-control" name="literature_review_comment" id="literature_review_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                
                <!-- RESEARCH METHODOLOGY -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= RM ?></h3>
                      <input type="text" name="research_methodology_mark" class="col-md-1 text-center text-black" id="research_methodology_mark" value="0" readonly>  
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
                                <p>• The research methodology is <b>highly suitable</b> for achieving the study objectives</p>
                                <p>• Procedures are described in <b>great detail</b></p>
                                <p>• The selected methods for data analysis are <b>highly suitable</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="research_methodology" value="<?=RATING5*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The research methodology is <b>good</b> for achieving the study objectives</p>
                                <p>• Procedures are described in <b>detail</b></p>
                                <p>• The selected methods for data analysis are <b>good</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="research_methodology" value="<?=RATING4*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The research methodology is <b>satisfactory</b> for achieving the study objectives</p>
                                <p>• Procedures are described in <b>general terms</b></p>
                                <p>• The selected methods for data analysis are <b>suitable</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="research_methodology" value="<?=RATING3*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The research methodology is <b>not very suitable</b> for achieving the study objectives</p>
                                <p>• Procedures are <b>not very well</b> described</p>
                                <p>• The selected methods for data analysis are <b>not very suitable</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="research_methodology" value="<?=RATING2*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The research methodology is <b>unsuitable</b> for achieving the study objectives</p>
                                <p>• Procedures are <b>not well</b> described</p>
                                <p>• The selected methods for data analysis are <b>unsuitable</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE3?></td>
                            <td class="text-center"><input type="radio" name="research_methodology" value="<?=RATING1*WEIGHTAGE3?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="research_methodology_comment">Comment:</label>
                                    <textarea class="form-control" name="research_methodology_comment" id="research_methodology_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- RESULT AND DISCUSSION -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= RND ?></h3>
                      <input type="text" name="result_discussion_mark" class="col-md-1 text-center text-black" id="result_discussion_mark" value="0" readonly>  
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
                                <p>• Data is analyzed using <b>highly suitable</b> methods</p>
                                <p>• Data is presented using <b>highly suitable</b> techniques</p>
                                <p>• Discussion of findings is <b>highly structured</b> and critical, taking into account the findings of previous researchers</p>
                                <p>• Interpretation of findings is <b>very accurate</b> and is comprehensively linked to the overall objectives / hypotheses</p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="result_discussion" value="<?=RATING5*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Data is analyzed using <b>good</b> methods</p>
                                <p>• Data is presented using <b>good</b> techniques</p>
                                <p>• Discussion of findings is <b>structured</b> and critical, taking into account the findings of previous researchers</p>
                                <p>• Interpretation of findings is <b>accurate</b> and is linked to the overall objectives / hypotheses</p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="result_discussion" value="<?=RATING4*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Data is analyzed using <b>satisfactory</b> methods</p>
                                <p>• Data is presented using <b>satisfactory</b> techniques</p>
                                <p>• Discussion of findings is <b>structured</b> and critical, taking into account the findings of previous researchers</p>
                                <p>• Interpretation of findings is <b>good</b> and is linked to the overall objectives / hypotheses</p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="result_discussion" value="<?=RATING3*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Data is analyzed using methods that are <b>not quite suitable</b></p>
                                <p>• Data is presented using techniques that are <b>not quite suitable</b></p>
                                <p>• Discussion of findings is <b>inadequately structured</b> and critical, and did not take into account the findings of previous researchers</p>
                                <p>• Interpretation of findings is <b>not linked</b> to the objectives / hypotheses</p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="result_discussion" value="<?=RATING2*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Data is analyzed using <b>unsuitable</b> methods</p>
                                <p>• Data is presented using <b>unsuitable</b> techniques</p>
                                <p>• Discussion of findings is <b>unstructured</b> and uncritical</b></p>
                                <p>• The findings are <b>not interpreted</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="result_discussion" value="<?=RATING1*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="result_discussion_comment">Comment:</label>
                                    <textarea class="form-control" name="result_discussion_comment" id="result_discussion_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- CONCLUSION AND RECOMMENDATION -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= CNR ?></h3>
                      <input type="text" name="conclusion_recommendation_mark" class="col-md-1 text-center text-black" id="conclusion_recommendation_mark" value="0" readonly>  
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
                                <p>• The conclusion <b>very clearly</b> describes the key findings of the study</p>
                                <p>• The conclusion is <b>highly consistent</b> with and is linked to the objectives of the study</p>
                                <p>• The proposed follow-up actions are <b>extremely significant</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="conclusion_recommendation" value="<?=RATING5*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The conclusion <b>clearly</b> describes the key findings of the study</p>
                                <p>• The conclusion is <b>consistent</b> with and is linked to the objectives of the study</p>
                                <p>• The proposed follow-up actions are <b>significant</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="conclusion_recommendation" value="<?=RATING4*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The conclusion <b>satisfactory</b> describes the key findings of the study</p>
                                <p>• The conclusion is <b>satisfactory</b> and is linked to the objectives of the study</p>
                                <p>• The proposed follow-up actions are <b>satisfactory</b></p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="conclusion_recommendation" value="<?=RATING3*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The conclusion <b>vaguely</b> describes the key findings of the study</p>
                                <p>• The conclusion is <b>not quite suitable</b></p>
                                <p>• The proposed follow-up actions are <b>not quite suitable</b></b></p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="conclusion_recommendation" value="<?=RATING2*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• The conclusion <b>does not</b> describes the key findings of the study</p>
                                <p>• The conclusion is <b>unsuitable</b></p>
                                <p>• The proposed follow-up actions are <b>unsuitable</b></b></p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE4?></td>
                            <td class="text-center"><input type="radio" name="conclusion_recommendation" value="<?=RATING1*WEIGHTAGE4?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="conclusion_recommendation_comment">Comment:</label>
                                    <textarea class="form-control" name="conclusion_recommendation_comment" id="conclusion_recommendation_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- REFERENCE -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= REF ?></h3>
                      <input type="text" name="reference_mark" class="col-md-1 text-center text-black" id="reference_mark" value="0" readonly>  
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
                                <p>• Sources of reference are <b>very reliable</b> (from verified journals or original sources)</p>
                                <p>• All sources of citations are stated in the text and in the list of references</p>
                                <p>• References are written according to the prescribed format</p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="reference" value="<?=RATING5*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Sources of reference are <b>reliable</b> (from verified journals or original sources)</p>
                                <p>• All sources of citations are stated in the text and in the list of references</p>
                                <p>• References are written according to the prescribed format</p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="reference" value="<?=RATING4*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Sources of reference are <b>suitable</b> (from verified journals or original sources)</p>
                                <p>• All sources of citations are stated in the text and in the list of references</p>
                                <p>• References are written according to the prescribed format</p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="reference" value="<?=RATING3*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Sources of reference are <b>not very reliable</b></p>
                                <p>• <b>Not all</b> sources of citations are stated in the text and in the list of references</p>
                                <p>• References are written according to the prescribed format</p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="reference" value="<?=RATING2*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Sources of reference are <b>unreliable</b></p>
                                <p>• <b>None</b> sources of citations are stated in the text and in the list of references</p>
                                <p>• References are <b>not written according</b> to the prescribed format</p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="reference" value="<?=RATING1*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="reference_comment">Comment:</label>
                                    <textarea class="form-control" name="reference_comment" id="reference_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- WRITING FORMAT -->
                <div class="assessment_table table-responsive">
                    <div class="form-group col-md-12 d-md-flex justify-content-between mt-3">
                      <h3 class="m-0 p-0"><?= WF ?></h3>
                      <input type="text" name="writing_format_mark" class="col-md-1 text-center text-black" id="writing_format_mark" value="0" readonly>  
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
                                <p>• Follows the format of UTHM’s Thesis Writing Guide <b>very closely</b></p>
                                <p>• Uses a <b>very good</b> and consistent writing style</p>
                                <p>• There is continuity and a <b>very accurate</b> unity of ideas</p>
                            </td>
                            <td class="text-center"><b><?php echo $excellent;?><br>[<?=RATING5?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="writing_format" value="<?=RATING5*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Follows the format of UTHM’s Thesis Writing Guide <b>closely</b></p>
                                <p>• Uses a <b>good</b> and consistent writing style</p>
                                <p>• There is continuity and a <b>accurate</b> unity of ideas</p>
                            </td>
                            <td class="text-center"><b><?php echo $good;?><br>[<?=RATING4?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="writing_format" value="<?=RATING4*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• Follows the format of UTHM’s Thesis Writing Guide <b>reasonably</b></p>
                                <p>• Uses a <b>appropriate</b> and consistent writing style</p>
                                <p>• There is continuity and a <b>reasonable</b> unity of ideas</p>
                            </td>
                            <td class="text-center"><b><?php echo $fair;?><br>[<?=RATING3?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="writing_format" value="<?=RATING3*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• <b>Roughly</b> follows the format of UTHM’s Thesis Writing Guide</b></p>
                                <p>• Uses a <b>not very appropriate</b> writing style</p>
                                <p>• <b>Lacks</b> continuity and unity of ideas</p>
                            </td>
                            <td class="text-center"><b><?php echo $poor;?><br>[<?=RATING2?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="writing_format" value="<?=RATING2*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>• <b>Does not</b> follow the format of UTHM’s Thesis Writing Guide</p>
                                <p>• Uses an <b>inappropriate</b> writing style</p>
                                <p>• <b>There is no</b> continuity and unity of ideas</p>
                            </td>
                            <td class="text-center"><b><?php echo $verypoor;?><br>[<?=RATING1?>]</b></td>
                            <td class="text-center"><?=WEIGHTAGE1?></td>
                            <td class="text-center"><input type="radio" name="writing_format" value="<?=RATING1*WEIGHTAGE1?>"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div>
                                    <label for="writing_format_comment">Comment:</label>
                                    <textarea class="form-control" name="writing_format_comment" id="writing_format_comment" cols="4" rows="3"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <span class="thesis_amendment_title"><strong>Thesis Amendment File</strong></span>
                <div class="custom-file mb-4 thesis_amendment">
                    <input type="file" class="custom-file-input" id="validatedThesisAmendmentFile" name="thesis_amendment" src="" accept=".doc, .docx" required>
                    <label class="custom-file-label" for="validatedThesisAmendmentFile">Choose file...</label>
                    <div class="invalid-feedback">Please upload thesis recommendations file!</div>
                </div>
                <div class="modal-footer col-md-12">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="thesis_assessmentbtn" class="btn btn-success thesis_assessmentbtn">Submit</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
