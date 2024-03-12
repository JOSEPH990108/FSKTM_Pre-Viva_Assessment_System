    <script src="<?=ASSETS?>vendors/js/jquery-3.5.1.min.js"></script>
    <script src="<?=ASSETS?>vendors/js/popper-1.16.1.min.js"></script>
    <script src="<?=ASSETS?>vendors/js/bootstrap-4.6.1.min.js"></script>
    <script src="<?=ASSETS?>vendors/js/datatables.min.js"></script>
    <script src="<?=ASSETS?>vendors/js/bootstrap-1.11.4.dataTables.min.js"></script>
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?= ASSETS ?>js/validation.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#userid').keyup(function() {
        var usercheck = $(this).val();
          
        $.post("includes/check_user.inc.php", {user_name: usercheck} , function(data)
        {
        if (data.status == true)
        {
        $('#userid').parent('div').removeClass('error').addClass('success');
        } else {
        $('#userid').parent('div').removeClass('success').addClass('error');
        }
        $('#userid').parent('div').find('small').text(data.msg);
        },'json');
        });
        
        $('.add_user_btn').on('click', function() {
        var usercheck =  $('#userid').val();
          
        $.post("includes/check_user.inc.php", {user_name: usercheck} , function(data)
        {
        if (data.status == true)
        {
        $('#userid').parent('div').removeClass('error').addClass('success');
        } else {
        $('#userid').parent('div').removeClass('success').addClass('error');
        }
        $('#userid').parent('div').find('small').text(data.msg);
        },'json');
        });
      });
    </script>
    
    <script>
      $(document).ready(function() {
          
        //Admin Edit Button
        $('.admin_editbtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          if(data[12] == 'ACTIVE'){
            data[12] = 1;
          }
          else{
            data[12] = 0;
          }
          $('#edit_userid').val(data[1]);
          $('#edit_name').val(data[2]);
          $('#edit_email').val(data[3]);
          $('#edit_phone').val(data[4]);
          $('#edit_ic').val(data[5]);
          $('#edit_passport').val(data[6]);
          $('#edit_sex').val(data[7]);
          $('#edit_race').val(data[8]);
          $('#edit_religion').val(data[9]);
          $('#edit_country').val(data[10]);
          $('#edit_nationality').val(data[11]);
          $('#edit_status').val(data[12]);
         
        });
        
        //Admin Delete Button
        $('.admin_deletebtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var deleteid = data[1];

          Swal.fire({
            title: 'Are you sure want to delete this admin?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: 800,
          }).then((result) => {
            if(result.isConfirmed) {
              $.ajax({
                url:"includes/delete_admin.inc.php",
                method: "POST",
                data:{deleteid:deleteid},
                success: function(data){
                  Swal.fire({
                    title: 'Successfully',
                    text: "Admin data deleted successfully!",
                    icon: 'success',
                    timer: 3500,
                  }).then((result) => {
                    location.reload();
                  }); 
                }
              }); 
            }
          })
        });

        //Staff Edit Button
        $('.staff_editbtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var staff_user_id = data[1];

          $.ajax({
                url:"includes/fetch_user_details.inc.php",
                method: "POST",
                data:{staff_user_id:staff_user_id},
                dataType: "JSON",
                success: function(data){

                  $('#edit_userid').val(data.user_id);
                  $('#edit_name').val(data.name);
                  $('#edit_email').val(data.email);
                  $('#edit_phone').val(data.phone_no);
                  $('#edit_ic').val(data.ic);
                  $('#edit_passport').val(data.passport);
                  $('#edit_sex').val(data.sex);
                  $('#edit_race').val(data.race);
                  $('#edit_religion').val(data.religion);
                  $('#edit_country').val(data.country);
                  $('#edit_nationality').val(data.nationality);
                  $('#edit_status').val(data.register_status);
                  $('#edit_faculty').val(data.faculty);
                  $('#edit_designation').val(data.designation);
                  $('#edit_field_category').val(data.field_category);
                  $('#edit_field').val(data.field);
                }
              }); 

        });
        
        //Staff Delete Button
        $('.staff_deletebtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var deleteid = data[1];

          Swal.fire({
            title: 'Are you sure want to delete this staff?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: 800,
          }).then((result) => {
            if(result.isConfirmed) {
              $.ajax({
                url:"includes/delete_staff.inc.php",
                method: "POST",
                data:{deleteid:deleteid},
                success: function(data){
                  Swal.fire({
                    title: 'Successfully',
                    text: "Staff data deleted successfully!",
                    icon: 'success',
                    timer: 3500,
                  }).then((result) => {
                    location.reload();
                  }); 
                }
              }); 
            }
          })
        });
      

        //Student Edit Button
        $('.student_editbtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var student_user_id = data[1];

          $.ajax({
                url:"includes/fetch_user_details.inc.php",
                method: "POST",
                data:{student_user_id:student_user_id},
                dataType: "JSON",
                success: function(data){

                  $('#edit_userid').val(data.user_id);
                  $('#edit_name').val(data.name);
                  $('#edit_email').val(data.email);
                  $('#edit_phone').val(data.phone_no);
                  $('#edit_ic').val(data.ic);
                  $('#edit_passport').val(data.passport);
                  $('#edit_sex').val(data.sex);
                  $('#edit_race').val(data.race);
                  $('#edit_religion').val(data.religion);
                  $('#edit_country').val(data.country);
                  $('#edit_nationality').val(data.nationality);
                  $('#edit_status').val(data.register_status);
                  $('#edit_faculty').val(data.faculty);
                  $('#edit_programme').val(data.programme);
                  $('#edit_levelofstudy').val(data.level_of_study);
                  $('#edit_research_title').val(data.research_title);
                  $('#edit_supervisor').val(data.supervisor);
                }
              }); 

        });
        
        //Student Delete Button
        $('.student_deletebtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var deleteid = data[1];

          Swal.fire({
            title: 'Are you sure want to delete this student?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: 800,
          }).then((result) => {
            if(result.isConfirmed) {
              $.ajax({
                url:"includes/delete_student.inc.php",
                method: "POST",
                data:{deleteid:deleteid},
                success: function(data){
                  Swal.fire({
                    title: 'Successfully',
                    text: "Student data deleted successfully!",
                    icon: 'success',
                    timer: 3500,
                  }).then((result) => {
                    location.reload();
                  }); 
                }
              }); 
            }
          })
        });

        //Edit Personal Details button
        $('.personalbtn').on('click', function(){
          var email = $('input[name="email"]').val();
          var passport = $('input[name="passport"]').val();
          var ic = $('input[name="ic"]').val();
          var phone = $('input[name="phone"]').val();
          var userid = $('input[name="userid"]').val();
          $.ajax({
            url:"includes/update_personal_profile.inc.php",
            method: "POST",
            data:{userid:userid,
                  email:email,
                  passport:passport,
                  ic:ic,
                  phone:phone},
            dataType: "JSON",
            success: function(data){
              if(data == 1){
                Swal.fire({
                    title: 'Successfully',
                    text: 'Personal data update successfully!',
                    icon: 'success',
                    timer: 2000
                  });
              }
              else{
                Swal.fire({
                    title: 'Unsuccessfully',
                    text: 'Personal data update unsuccessfully!',
                    icon: 'error',
                    timer: 2000
                  });
              }
              setTimeout(function(){
                window.location.reload();
              }, 2000);
            }
          });
        });

        $('.studentacademicbtn').on('click', function(){
          var research_title = $('input[name="research_title"]').val();
          var userid = $('input[name="userid"]').val();
          $.ajax({
            url:"includes/update_student_academic_profile.inc.php",
            method: "POST",
            data:{userid:userid,
                  research_title:research_title},
            dataType: "JSON",
            success: function(data){
              if(data == 1){
                Swal.fire({
                    title: 'Successfully',
                    text: 'Academic data update successfully!',
                    icon: 'success',
                    timer: 2000
                  });
              }
              else{
                Swal.fire({
                    title: 'Unsuccessfully',
                    text: 'Academic data update unsuccessfully!',
                    icon: 'error',
                    timer: 2000
                  });
              }
              setTimeout(function(){
                window.location.reload();
              }, 2000);
            }
          });
        });

        //Supervisor Accept Pre-Viva Button
        $('.previva_acceptbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#application_id').val(data[1]);
          $('#student_name').val(data[3]);
          $('#levelofstudy').val(data[4]);
          $('#student_programme').val(data[5]);
          $('#research_title').val(data[6]);
        });

        //Supervisor Edit Pre-Viva Button
        $('.previva_editbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('.examiner1_remark').prop('hidden', true);
          $('.examiner2_remark').prop('hidden', true);

          $('#edit_application_id').val(data[1]);
          $('#edit_student_name').val(data[3]);
          $('#edit_levelofstudy').val(data[4]);
          $('#edit_student_programme').val(data[5]);
          $('#edit_research_title').val(data[6]);
          $('#edit_pre_viva_date').val(data[10]);
          $('#edit_pre_viva_time').val(data[11]);

          //Load examiner details from database using ajax
          var application_id = data[1];
          $.ajax({
            url:"includes/fetch_pre_viva_application.inc.php",
            method: "POST",
            data:{application_id:application_id},
            dataType: "JSON",
            success: function(data){
              console.log(data);
              $('#edit_examiner1').val(data[0].user_id);
              $('#edit_examiner2').val(data[1].user_id);
              $('#edit_examiner1_status').val(data[0].examiner_status);
              $('#edit_examiner2_status').val(data[1].examiner_status);
              $('#edit_examiner1_remark').val(data[0].remark);
              $('#edit_examiner2_remark').val(data[1].remark);

              if(data[0].examiner1_status == "REJECTED"){
                $('.examiner1_remark').prop('hidden', false);
              }
              if(data[0].examiner2_status == "REJECTED"){
                $('.examiner2_remark').prop('hidden', false);
              }
              if((data[0].examiner1_status == "PENDING" && data[0].examiner2_status == "PENDING") || (data[0].examiner1_status == "PENDING" && data[0].examiner2_status == "ACCEPTED") || (data[0].examiner1_status == "ACCEPTED" && data[0].examiner2_status == "PENDING")){
                $('#edit_examiner1 option:not(:selected)').prop('disabled', true);
                $('#edit_examiner2 option:not(:selected)').prop('disabled', true);
              }
              if((data[0].examiner1_status == "REJECTED" && data[0].examiner2_status == "PENDING") || (data[0].examiner1_status == "REJECTED" && data[0].examiner2_status == "ACCEPTED")){
                $('#edit_examiner2 option:not(:selected)').prop('disabled', true);
              }
              if((data[0].examiner1_status == "PENDING" && data[0].examiner2_status == "REJECTED") || (data[0].examiner1_status == "ACCEPTED" && data[0].examiner2_status == "REJECTED")){
                $('#edit_examiner1 option:not(:selected)').prop('disabled', true);
              }
              if(data[0].examiner1_status == "ACCEPTED" || data[0].examiner2_status == "ACCEPTED"){
                $('#edit_pre_viva_date').prop('readonly', true);
                $('#edit_pre_viva_time').prop('readonly', true);
              }
              if((data[0].examiner1_status == "ACCEPTED" && data[0].examiner2_status == "ACCEPTED") || (data[0].examiner1_status == "ACCEPTED" && data[0].examiner2_status == "PENDING") || (data[0].examiner1_status == "PENDING" && data[0].examiner2_status == "ACCEPTED")){
                $('#edit_submitbtn').prop('hidden', true);
              }
            }
          });
        });

        //Supervisor Reject Pre-Viva Button
        $('.previva_rejectbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#reject_application_id').val(data[1]);
        });

        //Examiner Accept as Examiner Button
        $('.examineracceptbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#examiner_application_id').val(data[1]);
          $('#as_examiner').val(data[2]);
          $('#examiner_staff_id').val(data[3]);
          $('#examiner_studentname').val(data[5]);
          $('#examiner_levelofstudy').val(data[6]);
          $('#examiner_student_programme').val(data[7]);
          $('#examiner_research_title').val(data[8]);
          $('#examiner_pre_viva_date').val(data[12]);
          $('#examiner_pre_viva_time').val(data[13]);

          var application_id = data[1];
          var examiner = data[2];
          var examiner_id = data[3];

          $('.examinersubmitbtn').on('click', function(){
            Swal.fire({
              title: 'Are you sure to be the examiner?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#5cb85c',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, I am Sure!',
              width: 600,
            }).then((result) => {
              if(result.isConfirmed) {
                $.ajax({
                  url:"includes/examiner_accept_inviatation.inc.php",
                  method: "POST",
                  data:{application_id:application_id, examiner:examiner, examiner_id:examiner_id},
                  success: function(data){
                    Swal.fire({
                      title: 'Successfully',
                      text: "Your are the examiner now!",
                      icon: 'success',
                      timer: 3500,
                    }).then((result) => {
                      location.reload();
                    }); 
                  }
                }); 
              }
            });
          });
        });

        //Examiner Reject as Examiner Button
        $('.examinerrejectbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#examiner_reject_application_id').val(data[1]);
          $('#reject_as_examiner').val(data[2]);
          $('#reject_as_examiner_id').val(data[3]);
        });

        //Thesis Assessment Button
        $('.assessmentbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#assessment_application_id').val(data[1]);
          $('#student_matric_no').val(data[2]);
        });

        //Presentation Assessment Button
        $('.presentationassessmentbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#presentation_assessment_application_id').val(data[1]);
          $('#presentation_student_matric_no').val(data[3]);
        });

        //View and Edit Assessment Details Button
        $('.assessmenteditbtn').on('click', function(){
          $('#thesis_assessment_form').attr('action', '<?=ROOT?>includes/edit_thesis_assessment.inc.php');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#assessment_application_id').val(data[1]);
          $('#student_matric_no').val(data[2]);
        
          var application_id = data[1];

          $.ajax({
            url:"includes/fetch_thesis_assessment_details.inc.php",
            method: "POST",
            data:{application_id:application_id},
            dataType: "JSON",
            success: function(data){
              var total_mark = 0;
              var commented_thesis_name = data.commented_version;
              var whole_commented_thesis_location = "<?=ROOT?>".concat(commented_thesis_name);

              data.abstract = data.abstract.replaceAll('\\r\\n', '\n');
              $("input[name=abstract][value=" + data.abstract_mark + "]").prop('checked', true);
              $('#abstract_comment').val(data.abstract);
              $('#abstract_mark').val(data.abstract_mark);
              
              data.introduction = data.introduction.replaceAll('\\r\\n', '\n');
              $("input[name=introduction][value=" + data.introduction_mark + "]").prop('checked', true);
              $('#introduction_comment').val(data.introduction);
              $('#introduction_mark').val(data.introduction_mark);

              $("input[name=literature_review][value=" + data.literature_review_mark + "]").prop('checked', true);
              $('#literature_review_comment').val(data.literature_review);
              $('#literature_review_mark').val(data.literature_review_mark);

              $("input[name=research_methodology][value=" + data.research_methodology_mark + "]").prop('checked', true);
              $('#research_methodology_comment').val(data.research_methodology);
              $('#research_methodology_mark').val(data.research_methodology_mark);

              $("input[name=result_discussion][value=" + data.result_discussion_mark + "]").prop('checked', true);
              $('#result_discussion_comment').val(data.result_discussion);
              $('#result_discussion_mark').val(data.result_discussion_mark);

              $("input[name=conclusion_recommendation][value=" + data.conclusion_recommendation_mark + "]").prop('checked', true);
              $('#conclusion_recommendation_comment').val(data.conclusion_recommendation);
              $('#conclusion_recommendation_mark').val(data.conclusion_recommendation_mark);


              $("input[name=reference][value=" + data.reference_mark + "]").prop('checked', true);
              $('#reference_comment').val(data.reference);
              $('#reference_mark').val(data.reference_mark);

              $("input[name=writing_format][value=" + data.writing_format_mark + "]").prop('checked', true);
              $('#writing_format_comment').val(data.writing_format);
              $('#writing_format_mark').val(data.writing_format_mark);

              $("#validatedThesisAmendmentFile").removeAttr('required');

              total_mark = data.abstract_mark + data.introduction_mark + data.literature_review_mark + data.research_methodology_mark + data.result_discussion_mark
                           + data.conclusion_recommendation_mark + data.reference_mark + data.writing_format_mark;
              
              $('#total_mark').attr('value', total_mark);
              if(total_mark >= 80 && total_mark <= 100){
                $('#total_mark').removeClass('border border-danger').addClass('border border-success');
              }
              else if(total_mark < 80){
                $('#total_mark').removeClass('border border-success').addClass('border border-danger');
              }
            }
          });
        });

        //View Supervisor Details Button
        $('.viewsupervisorbtn').on('click', function(){
          $('.modal-title').html('SUPERVISOR DETAILS');
          $('.modal-title').css("font-weight","Bold");
          $('.name').html('Supervisor');
          $('.name').css("font-weight","Bold");

          $('#thesisreview_btn').prop('hidden', true);
          $('#download_commentedfile_btn').prop('hidden', true);

          $('#thesisassessmentModal').attr('id', "viewthesisassessmentModal");

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
        
          var application_id = data[1];

          $.ajax({
            url:"includes/fetch_supervisor_details.inc.php",
            method: "POST",
            data:{application_id:application_id},
            dataType: "JSON",
            success: function(data){              
              $('#name').val(data[0].name);
              $('#designation').val(data[0].designation);
              $('#field').val(data[0].field);

              if(data[1]){
              if(Object.keys(data[1]).length > 5){ 
                var total_mark = 0;
                var commented_thesis_name = data[1].commented_version;
                //var commented_thesis_location = "<?=ROOT?>modal/open_file.php?commented_thesis_name=";
                //var whole_commented_thesis_location = commented_thesis_location.concat(commented_thesis_name);
                var whole_commented_thesis_location = "<?=ROOT?>".concat(commented_thesis_name);
                $('#thesisreview_btn').prop('hidden', false);
                $('#download_commentedfile_btn').prop('hidden', false);
                $('.thesis_assessmentbtn').prop('hidden', true);
                $('.thesis_amendment_title').prop('hidden', true);
                $('.thesis_amendment').prop('hidden', true);
                $('#thesis_assessment_form textarea').prop('readonly', true);
                $('#download_commentedfile_btn').attr('href', whole_commented_thesis_location);

                $("input[name=abstract][value=" + data[1].abstract_mark + "]").prop('checked', true);
                $('input[name=abstract]').attr("disabled",true);
                $('#abstract_comment').val(data[1].abstract);
                $('#abstract_mark').val(data[1].abstract_mark);

                $("input[name=introduction][value=" + data[1].introduction_mark + "]").prop('checked', true);
                $('input[name=introduction]').attr("disabled",true);
                $('#introduction_comment').val(data[1].introduction);
                $('#introduction_mark').val(data[1].introduction_mark);

                $("input[name=literature_review][value=" + data[1].literature_review_mark + "]").prop('checked', true);
                $('input[name=literature_review]').attr("disabled",true);
                $('#literature_review_comment').val(data[1].literature_review);
                $('#literature_review_mark').val(data[1].literature_review_mark);

                $("input[name=research_methodology][value=" + data[1].research_methodology_mark + "]").prop('checked', true);
                $('input[name=research_methodology]').attr("disabled",true);
                $('#research_methodology_comment').val(data[1].research_methodology);
                $('#research_methodology_mark').val(data[1].research_methodology_mark);

                $("input[name=result_discussion][value=" + data[1].result_discussion_mark + "]").prop('checked', true);
                $('input[name=result_discussion]').attr("disabled",true);
                $('#result_discussion_comment').val(data[1].result_discussion);
                $('#result_discussion_mark').val(data[1].result_discussion_mark);

                $("input[name=conclusion_recommendation][value=" + data[1].conclusion_recommendation_mark + "]").prop('checked', true);
                $('input[name=conclusion_recommendation]').attr("disabled",true);
                $('#conclusion_recommendation_comment').val(data[1].conclusion_recommendation);
                $('#conclusion_recommendation_mark').val(data[1].conclusion_recommendation_mark);


                $("input[name=reference][value=" + data[1].reference_mark + "]").prop('checked', true);
                $('input[name=reference]').attr("disabled",true);
                $('#reference_comment').val(data[1].reference);
                $('#reference_mark').val(data[1].reference_mark);

                $("input[name=writing_format][value=" + data[1].writing_format_mark + "]").prop('checked', true);
                $('input[name=writing_format]').attr("disabled",true);
                $('#writing_format_comment').val(data[1].writing_format);
                $('#writing_format_mark').val(data[1].writing_format_mark);

                total_mark = data[1].abstract_mark + data[1].introduction_mark + data[1].literature_review_mark + data[1].research_methodology_mark + data[1].result_discussion_mark
                            + data[1].conclusion_recommendation_mark + data[1].reference_mark + data[1].writing_format_mark;
              
                $('#thesismark').val(total_mark);

                $('#total_mark').attr('value', total_mark);
                if(total_mark >= 80 && total_mark <= 100){
                  $('#thesismark').removeClass('border border-danger').addClass('border border-success');
                  $('#total_mark').removeClass('border border-danger').addClass('border border-success');
                }
                else if(total_mark < 80){
                  $('#thesismark').removeClass('border border-success').addClass('border border-danger');
                  $('#total_mark').removeClass('border border-success').addClass('border border-danger');
                }
              }
            }
            }
          });
        });

        //View Examiner 1 Details Button
        $('.viewexaminer1btn').on('click', function(){
          $('.modal-title').html('EXAMINER 1 DETAILS');
          $('.modal-title').css("font-weight","Bold");
          $('.name').html('Examiner 1');
          $('.name').css("font-weight","Bold");

          $('#thesisreview_btn').prop('hidden', true);
          $('#download_commentedfile_btn').prop('hidden', true);

          $('#thesisassessmentModal').attr('id', "viewthesisassessmentModal");

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
        
          var application_id = data[1];
          var examiner_id = data[8];

          $.ajax({
            url:"includes/fetch_examiner_details.inc.php",
            method: "POST",
            data:{application_id:application_id, examiner_id:examiner_id},
            dataType: "JSON",
            success: function(data){        
              $('#name').val(data[0].name);
              $('#designation').val(data[0].designation);
              $('#field').val(data[0].field);

              if (data[1]){
              if(Object.keys(data[1]).length > 5){
                var total_mark = 0;
                var commented_thesis_name = data[1].commented_version;
                //var commented_thesis_location = "<?=ROOT?>modal/open_file.php?commented_thesis_name=";
                //var whole_commented_thesis_location = commented_thesis_location.concat(commented_thesis_name);
                var whole_commented_thesis_location = "<?=ROOT?>".concat(commented_thesis_name);
                $('#thesisreview_btn').prop('hidden', false);
                $('#download_commentedfile_btn').prop('hidden', false);
                $('.thesis_assessmentbtn').prop('hidden', true);
                $('.thesis_amendment_title').prop('hidden', true);
                $('.thesis_amendment').prop('hidden', true);
                $('#thesis_assessment_form textarea').prop('readonly', true);
                $('#download_commentedfile_btn').attr('href', whole_commented_thesis_location);

                $("input[name=abstract][value=" + data[1].abstract_mark + "]").prop('checked', true);
                $('input[name=abstract]').attr("disabled",true);
                $('#abstract_comment').val(data[1].abstract);
                $('#abstract_mark').val(data[1].abstract_mark);

                $("input[name=introduction][value=" + data[1].introduction_mark + "]").prop('checked', true);
                $('input[name=introduction]').attr("disabled",true);
                $('#introduction_comment').val(data[1].introduction);
                $('#introduction_mark').val(data[1].introduction_mark);

                $("input[name=literature_review][value=" + data[1].literature_review_mark + "]").prop('checked', true);
                $('input[name=literature_review]').attr("disabled",true);
                $('#literature_review_comment').val(data[1].literature_review);
                $('#literature_review_mark').val(data[1].literature_review_mark);

                $("input[name=research_methodology][value=" + data[1].research_methodology_mark + "]").prop('checked', true);
                $('input[name=research_methodology]').attr("disabled",true);
                $('#research_methodology_comment').val(data[1].research_methodology);
                $('#research_methodology_mark').val(data[1].research_methodology_mark);

                $("input[name=result_discussion][value=" + data[1].result_discussion_mark + "]").prop('checked', true);
                $('input[name=result_discussion]').attr("disabled",true);
                $('#result_discussion_comment').val(data[1].result_discussion);
                $('#result_discussion_mark').val(data[1].result_discussion_mark);

                $("input[name=conclusion_recommendation][value=" + data[1].conclusion_recommendation_mark + "]").prop('checked', true);
                $('input[name=conclusion_recommendation]').attr("disabled",true);
                $('#conclusion_recommendation_comment').val(data[1].conclusion_recommendation);
                $('#conclusion_recommendation_mark').val(data[1].conclusion_recommendation_mark);


                $("input[name=reference][value=" + data[1].reference_mark + "]").prop('checked', true);
                $('input[name=reference]').attr("disabled",true);
                $('#reference_comment').val(data[1].reference);
                $('#reference_mark').val(data[1].reference_mark);

                $("input[name=writing_format][value=" + data[1].writing_format_mark + "]").prop('checked', true);
                $('input[name=writing_format]').attr("disabled",true);
                $('#writing_format_comment').val(data[1].writing_format);
                $('#writing_format_mark').val(data[1].writing_format_mark);

                total_mark = data[1].abstract_mark + data[1].introduction_mark + data[1].literature_review_mark + data[1].research_methodology_mark + data[1].result_discussion_mark
                            + data[1].conclusion_recommendation_mark + data[1].reference_mark + data[1].writing_format_mark;
              
                $('#thesismark').val(total_mark);

                $('#total_mark').attr('value', total_mark);
                if(total_mark >= 80 && total_mark <= 100){
                  $('#thesismark').removeClass('border border-danger').addClass('border border-success');
                  $('#total_mark').removeClass('border border-danger').addClass('border border-success');
                }
                else if(total_mark < 80){
                  $('#thesismark').removeClass('border border-success').addClass('border border-danger');
                  $('#total_mark').removeClass('border border-success').addClass('border border-danger');
                }
              }
            }
            }
          });
        });

        //View Examiner 2 Details Button
        $('.viewexaminer2btn').on('click', function(){
          $('.modal-title').html('EXAMINER 2 DETAILS');
          $('.modal-title').css("font-weight","Bold");
          $('.name').html('Examiner 2');
          $('.name').css("font-weight","Bold");

          $('#thesisreview_btn').prop('hidden', true);
          $('#download_commentedfile_btn').prop('hidden', true);

          $('#thesisassessmentModal').attr('id', "viewthesisassessmentModal");

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
        
          var application_id = data[1];
          var examiner_id = data[9];

          $.ajax({
            url:"includes/fetch_examiner_details.inc.php",
            method: "POST",
            data:{application_id:application_id, examiner_id:examiner_id},
            dataType: "JSON",
            success: function(data){    

              $('#name').val(data[0].name);
              $('#designation').val(data[0].designation);
              $('#field').val(data[0].field);

              if(data[1]){
                if(Object.keys(data[1]).length > 5){
                  var total_mark = 0;
                  var commented_thesis_name = data[1].commented_version;
                  //var commented_thesis_location = "<?=ROOT?>modal/open_file.php?commented_thesis_name=";
                  //var whole_commented_thesis_location = commented_thesis_location.concat(commented_thesis_name);
                  var whole_commented_thesis_location = "<?=ROOT?>".concat(commented_thesis_name);
                  $('#thesisreview_btn').prop('hidden', false);
                  $('#download_commentedfile_btn').prop('hidden', false);
                  $('.thesis_assessmentbtn').prop('hidden', true);
                  $('.thesis_amendment_title').prop('hidden', true);
                  $('.thesis_amendment').prop('hidden', true);
                  $('#thesis_assessment_form textarea').prop('readonly', true);
                  $('#download_commentedfile_btn').attr('href', whole_commented_thesis_location);

                  $("input[name=abstract][value=" + data[1].abstract_mark + "]").prop('checked', true);
                  $('input[name=abstract]').attr("disabled",true);
                  $('#abstract_comment').val(data[1].abstract);
                  $('#abstract_mark').val(data[1].abstract_mark);

                  $("input[name=introduction][value=" + data[1].introduction_mark + "]").prop('checked', true);
                  $('input[name=introduction]').attr("disabled",true);
                  $('#introduction_comment').val(data[1].introduction);
                  $('#introduction_mark').val(data[1].introduction_mark);

                  $("input[name=literature_review][value=" + data[1].literature_review_mark + "]").prop('checked', true);
                  $('input[name=literature_review]').attr("disabled",true);
                  $('#literature_review_comment').val(data[1].literature_review);
                  $('#literature_review_mark').val(data[1].literature_review_mark);

                  $("input[name=research_methodology][value=" + data[1].research_methodology_mark + "]").prop('checked', true);
                  $('input[name=research_methodology]').attr("disabled",true);
                  $('#research_methodology_comment').val(data[1].research_methodology);
                  $('#research_methodology_mark').val(data[1].research_methodology_mark);

                  $("input[name=result_discussion][value=" + data[1].result_discussion_mark + "]").prop('checked', true);
                  $('input[name=result_discussion]').attr("disabled",true);
                  $('#result_discussion_comment').val(data[1].result_discussion);
                  $('#result_discussion_mark').val(data[1].result_discussion_mark);

                  $("input[name=conclusion_recommendation][value=" + data[1].conclusion_recommendation_mark + "]").prop('checked', true);
                  $('input[name=conclusion_recommendation]').attr("disabled",true);
                  $('#conclusion_recommendation_comment').val(data[1].conclusion_recommendation);
                  $('#conclusion_recommendation_mark').val(data[1].conclusion_recommendation_mark);


                  $("input[name=reference][value=" + data[1].reference_mark + "]").prop('checked', true);
                  $('input[name=reference]').attr("disabled",true);
                  $('#reference_comment').val(data[1].reference);
                  $('#reference_mark').val(data[1].reference_mark);

                  $("input[name=writing_format][value=" + data[1].writing_format_mark + "]").prop('checked', true);
                  $('input[name=writing_format]').attr("disabled",true);
                  $('#writing_format_comment').val(data[1].writing_format);
                  $('#writing_format_mark').val(data[1].writing_format_mark);

                  total_mark = data[1].abstract_mark + data[1].introduction_mark + data[1].literature_review_mark + data[1].research_methodology_mark + data[1].result_discussion_mark
                              + data[1].conclusion_recommendation_mark + data[1].reference_mark + data[1].writing_format_mark;

                  $('#thesismark').val(total_mark);

                  $('#total_mark').attr('value', total_mark);
                  if(total_mark >= 80 && total_mark <= 100){
                    $('#thesismark').removeClass('border border-danger').addClass('border border-success');
                    $('#total_mark').removeClass('border border-danger').addClass('border border-success');
                  }
                  else if(total_mark < 80){
                    $('#thesismark').removeClass('border border-success').addClass('border border-danger');
                    $('#total_mark').removeClass('border border-success').addClass('border border-danger');
                  }
                }
              }
            }
          });
        });

        //Admin view Student details
        $('.viewstudentdetailbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#viewStudentModalLabel').text('STUDENT');

          var matric_no = $.trim(data[2]);

          $.ajax({
            url:"includes/fetch_user_details.inc.php",
            method: "POST",
            data:{matric_no:matric_no},
            dataType: "JSON",
            success: function(data){  
              console.log(data);  
              $('#viewStudentModal, #student_name').val(data.name);
              $('#viewStudentModal, #level_of_study').val(data.level_of_study);
              $('#viewStudentModal, #programme').val(data.programme);
              $('#viewStudentModal, #research_title').val(data.research_title);
            }
          });
        });

        //Admin view Supervisor details
        $('.viewsupervisordetailbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
          
          $('#viewAcademicStaffModalLabel').text("SUPERVISOR");

          var supervisor_id = $.trim(data[3]);

          $.ajax({
            url:"includes/fetch_user_details.inc.php",
            method: "POST",
            data:{supervisor_id:supervisor_id},
            dataType: "JSON",
            success: function(data){    
              $('#viewAcademicStaffModal, #staff_name').val(data.name);
              $('#viewAcademicStaffModal, #designation').val(data.designation);
              $('#viewAcademicStaffModal, #field_category').val(data.field_category);
              $('#viewAcademicStaffModal, #field').val(data.field);
            }
          });
        });

        //Admin view Examiner 1 details
        $('.viewexaminer1detailbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#viewAcademicStaffModalLabel').text("EXAMINER 1");

          var examiner1_id = $.trim(data[4]);

          $.ajax({
            url:"includes/fetch_user_details.inc.php",
            method: "POST",
            data:{examiner1_id:examiner1_id},
            dataType: "JSON",
            success: function(data){    
              $('#viewAcademicStaffModal, #staff_name').val(data.name);
              $('#viewAcademicStaffModal, #designation').val(data.designation);
              $('#viewAcademicStaffModal, #field_category').val(data.field_category);
              $('#viewAcademicStaffModal, #field').val(data.field);
            }
          });
        });

        //Admin view Examiner 2 details
        $('.viewexaminer2detailbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          $('#viewAcademicStaffModalLabel').text("EXAMINER 2");

          var examiner2_id = $.trim(data[5]);

          $.ajax({
            url:"includes/fetch_user_details.inc.php",
            method: "POST",
            data:{examiner2_id:examiner2_id},
            dataType: "JSON",
            success: function(data){    
              $('#viewAcademicStaffModal, #staff_name').val(data.name);
              $('#viewAcademicStaffModal, #designation').val(data.designation);
              $('#viewAcademicStaffModal, #field_category').val(data.field_category);
              $('#viewAcademicStaffModal, #field').val(data.field);
            }
          });
        });
        
        //Edit Presentation Assessment
        $('.presentationassessmenteditbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
          
          $('#assessment_application_id').val(data[1]);
          $('#student_matric_no').val(data[2]);

          var application_id = data[1];

          $.ajax({
            url:"includes/fetch_presentation_assessment_details.inc.php",
            method: "POST",
            data:{application_id:application_id},
            dataType: "JSON",
            success: function(data){  
              var total_mark = 0;
              data[0].presentation = data[0].presentation.replaceAll('\\r\\n', '\n');
              $("input[name=presentation][value=" + data[0].presentation_mark + "]").prop('checked', true);
              $('#presentation_comment').val(data[0].presentation);
              $('#presentation_mark').val(data[0].presentation_mark);
              
              data[0].QNA = data[0].QNA.replaceAll('\\r\\n', '\n');
              $("input[name=qna][value=" + data[0].QNA_mark + "]").prop('checked', true);
              $('#qna_comment').val(data[0].QNA);
              $('#qna_mark').val(data[0].QNA_mark);
              
              total_mark = data[0].QNA_mark + data[0].presentation_mark;
              
              $('#presentation_total_mark').attr('value', total_mark);
              if(total_mark >= 80 && total_mark <= 100){
                $('#presentation_total_mark').removeClass('border border-danger').addClass('border border-success');
              }
              else if(total_mark < 80){
                $('#presentation_total_mark').removeClass('border border-success').addClass('border border-danger');
              }
            }
          });
        });

        //View overall Pre-Viva Assesment details
        $('.view_overall_markbtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var application_id = data[1];

          $.ajax({
            url:"includes/fetch_overall_pre_viva_details.inc.php",
            method: "POST",
            data:{application_id:application_id},
            dataType: "JSON",
            success: function(data){
            
            if(data.length == 3){
              //Supervisor
              if(data[0].role == "SUPERVISOR"){
                data[0].abstract = data[0].abstract.replaceAll('\\r\\n', '\n');
                data[0].introduction = data[0].introduction.replaceAll('\\r\\n', '\n');
                data[0].literature_review = data[0].literature_review.replaceAll('\\r\\n', '\n');
                data[0].research_methodology = data[0].research_methodology.replaceAll('\\r\\n', '\n');
                data[0].result_discussion = data[0].result_discussion.replaceAll('\\r\\n', '\n');
                data[0].conclusion_recommendation = data[0].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[0].reference = data[0].reference.replaceAll('\\r\\n', '\n');
                data[0].writing_format = data[0].writing_format.replaceAll('\\r\\n', '\n');
                $('#supervisor_abstract').text(data[0].abstract);
                $('#supervisor_abstract_mark').text(data[0].abstract_mark);
                $('#supervisor_introduction').text(data[0].introduction);
                $('#supervisor_introduction_mark').text(data[0].introduction_mark);
                $('#supervisor_literature_review').text(data[0].literature_review);
                $('#supervisor_literature_review_mark').text(data[0].literature_review_mark);
                $('#supervisor_research_methodology').text(data[0].research_methodology);
                $('#supervisor_research_methodology_mark').text(data[0].research_methodology_mark);
                $('#supervisor_result_discussion').text(data[0].result_discussion);
                $('#supervisor_result_discussion_mark').text(data[0].result_discussion_mark);
                $('#supervisor_conclusion_recommendation').text(data[0].conclusion_recommendation);
                $('#supervisor_conclusion_recommendation_mark').text(data[0].conclusion_recommendation_mark);
                $('#supervisor_reference').text(data[0].reference);
                $('#supervisor_reference_mark').text(data[0].reference_mark);
                $('#supervisor_writing_format').text(data[0].writing_format);
                $('#supervisor_writing_format_mark').text(data[0].writing_format_mark);
              }
              else if(data[1].role == "SUPERVISOR"){
                data[1].abstract = data[1].abstract.replaceAll('\\r\\n', '\n');
                data[1].introduction = data[1].introduction.replaceAll('\\r\\n', '\n');
                data[1].literature_review = data[1].literature_review.replaceAll('\\r\\n', '\n');
                data[1].research_methodology = data[1].research_methodology.replaceAll('\\r\\n', '\n');
                data[1].result_discussion = data[1].result_discussion.replaceAll('\\r\\n', '\n');
                data[1].conclusion_recommendation = data[1].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[1].reference = data[1].reference.replaceAll('\\r\\n', '\n');
                data[1].writing_format = data[1].writing_format.replaceAll('\\r\\n', '\n');
                $('#supervisor_abstract').text(data[1].abstract);
                $('#supervisor_abstract_mark').text(data[1].abstract_mark);
                $('#supervisor_introduction').text(data[1].introduction);
                $('#supervisor_introduction_mark').text(data[1].introduction_mark);
                $('#supervisor_literature_review').text(data[1].literature_review);
                $('#supervisor_literature_review_mark').text(data[1].literature_review_mark);
                $('#supervisor_research_methodology').text(data[1].research_methodology);
                $('#supervisor_research_methodology_mark').text(data[1].research_methodology_mark);
                $('#supervisor_result_discussion').text(data[1].result_discussion);
                $('#supervisor_result_discussion_mark').text(data[1].result_discussion_mark);
                $('#supervisor_conclusion_recommendation').text(data[1].conclusion_recommendation);
                $('#supervisor_conclusion_recommendation_mark').text(data[1].conclusion_recommendation_mark);
                $('#supervisor_reference').text(data[1].reference);
                $('#supervisor_reference_mark').text(data[1].reference_mark);
                $('#supervisor_writing_format').text(data[1].writing_format);
                $('#supervisor_writing_format_mark').text(data[1].writing_format_mark);
              }
              else{
                data[2].abstract = data[2].abstract.replaceAll('\\r\\n', '\n');
                data[2].introduction = data[2].introduction.replaceAll('\\r\\n', '\n');
                data[2].literature_review = data[2].literature_review.replaceAll('\\r\\n', '\n');
                data[2].research_methodology = data[2].research_methodology.replaceAll('\\r\\n', '\n');
                data[2].result_discussion = data[2].result_discussion.replaceAll('\\r\\n', '\n');
                data[2].conclusion_recommendation = data[2].conclusion_recommendation.replaceAll('\\r\\n', '<br />');
                data[2].reference = data[2].reference.replaceAll('\\r\\n', '\n');
                data[2].writing_format = data[2].writing_format.replaceAll('\\r\\n', '\n');
                $('#supervisor_abstract').text(data[2].abstract);
                $('#supervisor_abstract_mark').text(data[2].abstract_mark);
                $('#supervisor_introduction').text(data[2].introduction);
                $('#supervisor_introduction_mark').text(data[2].introduction_mark);
                $('#supervisor_literature_review').text(data[2].literature_review);
                $('#supervisor_literature_review_mark').text(data[2].literature_review_mark);
                $('#supervisor_research_methodology').text(data[2].research_methodology);
                $('#supervisor_research_methodology_mark').text(data[2].research_methodology_mark);
                $('#supervisor_result_discussion').text(data[2].result_discussion);
                $('#supervisor_result_discussion_mark').text(data[2].result_discussion_mark);
                $('#supervisor_conclusion_recommendation').text(data[2].conclusion_recommendation);
                $('#supervisor_conclusion_recommendation_mark').text(data[2].conclusion_recommendation_mark);
                $('#supervisor_reference').text(data[2].reference);
                $('#supervisor_reference_mark').text(data[2].reference_mark);
                $('#supervisor_writing_format').text(data[2].writing_format);
                $('#supervisor_writing_format_mark').text(data[2].writing_format_mark);
              }

              //Examiner 1
              if(data[0].role == "EXAMINER 1"){
                data[0].abstract = data[0].abstract.replaceAll('\\r\\n', '\n');
                data[0].introduction = data[0].introduction.replaceAll('\\r\\n', '\n');
                data[0].literature_review = data[0].literature_review.replaceAll('\\r\\n', '\n');
                data[0].research_methodology = data[0].research_methodology.replaceAll('\\r\\n', '\n');
                data[0].result_discussion = data[0].result_discussion.replaceAll('\\r\\n', '\n');
                data[0].conclusion_recommendation = data[0].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[0].reference = data[0].reference.replaceAll('\\r\\n', '\n');
                data[0].writing_format = data[0].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner1_abstract').text(data[0].abstract);
                $('#examiner1_abstract_mark').text(data[0].abstract_mark);
                $('#examiner1_introduction').text(data[0].introduction);
                $('#examiner1_introduction_mark').text(data[0].introduction_mark);
                $('#examiner1_literature_review').text(data[0].literature_review);
                $('#examiner1_literature_review_mark').text(data[0].literature_review_mark);
                $('#examiner1_research_methodology').text(data[0].research_methodology);
                $('#examiner1_research_methodology_mark').text(data[0].research_methodology_mark);
                $('#examiner1_result_discussion').text(data[0].result_discussion);
                $('#examiner1_result_discussion_mark').text(data[0].result_discussion_mark);
                $('#examiner1_conclusion_recommendation').text(data[0].conclusion_recommendation);
                $('#examiner1_conclusion_recommendation_mark').text(data[0].conclusion_recommendation_mark);
                $('#examiner1_reference').text(data[0].reference);
                $('#examiner1_reference_mark').text(data[0].reference_mark);
                $('#examiner1_writing_format').text(data[0].writing_format);
                $('#examiner1_writing_format_mark').text(data[0].writing_format_mark);
                $('#examiner1_presentation').text(data[0].presentation);
                $('#examiner1_presentation_mark').text(data[0].presentation_mark);
                $('#examiner1_qna').text(data[0].QNA);
                $('#examiner1_qna_mark').text(data[0].QNA_mark);
              }
              else if(data[1].role == "EXAMINER 1"){
                data[1].abstract = data[1].abstract.replaceAll('\\r\\n', '\n');
                data[1].introduction = data[1].introduction.replaceAll('\\r\\n', '\n');
                data[1].literature_review = data[1].literature_review.replaceAll('\\r\\n', '\n');
                data[1].research_methodology = data[1].research_methodology.replaceAll('\\r\\n', '\n');
                data[1].result_discussion = data[1].result_discussion.replaceAll('\\r\\n', '\n');
                data[1].conclusion_recommendation = data[1].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[1].reference = data[1].reference.replaceAll('\\r\\n', '\n');
                data[1].writing_format = data[1].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner1_abstract').text(data[1].abstract);
                $('#examiner1_abstract_mark').text(data[1].abstract_mark);
                $('#examiner1_introduction').text(data[1].introduction);
                $('#examiner1_introduction_mark').text(data[1].introduction_mark);
                $('#examiner1_literature_review').text(data[1].literature_review);
                $('#examiner1_literature_review_mark').text(data[1].literature_review_mark);
                $('#examiner1_research_methodology').text(data[1].research_methodology);
                $('#examiner1_research_methodology_mark').text(data[1].research_methodology_mark);
                $('#examiner1_result_discussion').text(data[1].result_discussion);
                $('#examiner1_result_discussion_mark').text(data[1].result_discussion_mark);
                $('#examiner1_conclusion_recommendation').text(data[1].conclusion_recommendation);
                $('#examiner1_conclusion_recommendation_mark').text(data[1].conclusion_recommendation_mark);
                $('#examiner1_reference').text(data[1].reference);
                $('#examiner1_reference_mark').text(data[1].reference_mark);
                $('#examiner1_writing_format').text(data[1].writing_format);
                $('#examiner1_writing_format_mark').text(data[1].writing_format_mark);
                $('#examiner1_presentation').text(data[1].presentation);
                $('#examiner1_presentation_mark').text(data[1].presentation_mark);
                $('#examiner1_qna').text(data[1].QNA);
                $('#examiner1_qna_mark').text(data[1].QNA_mark);
              }else{
                data[2].abstract = data[2].abstract.replaceAll('\\r\\n', '\n');
                data[2].introduction = data[2].introduction.replaceAll('\\r\\n', '\n');
                data[2].literature_review = data[2].literature_review.replaceAll('\\r\\n', '\n');
                data[2].research_methodology = data[2].research_methodology.replaceAll('\\r\\n', '\n');
                data[2].result_discussion = data[2].result_discussion.replaceAll('\\r\\n', '\n');
                data[2].conclusion_recommendation = data[2].conclusion_recommendation.replaceAll('\\r\\n', '<br />');
                data[2].reference = data[2].reference.replaceAll('\\r\\n', '\n');
                data[2].writing_format = data[2].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner1_abstract').text(data[2].abstract);
                $('#examiner1_abstract_mark').text(data[2].abstract_mark);
                $('#examiner1_introduction').text(data[2].introduction);
                $('#examiner1_introduction_mark').text(data[2].introduction_mark);
                $('#examiner1_literature_review').text(data[2].literature_review);
                $('#examiner1_literature_review_mark').text(data[2].literature_review_mark);
                $('#examiner1_research_methodology').text(data[2].research_methodology);
                $('#examiner1_research_methodology_mark').text(data[2].research_methodology_mark);
                $('#examiner1_result_discussion').text(data[2].result_discussion);
                $('#examiner1_result_discussion_mark').text(data[2].result_discussion_mark);
                $('#examiner1_conclusion_recommendation').text(data[2].conclusion_recommendation);
                $('#examiner1_conclusion_recommendation_mark').text(data[2].conclusion_recommendation_mark);
                $('#examiner1_reference').text(data[2].reference);
                $('#examiner1_reference_mark').text(data[2].reference_mark);
                $('#examiner1_writing_format').text(data[2].writing_format);
                $('#examiner1_writing_format_mark').text(data[2].writing_format_mark);
                $('#examiner1_presentation').text(data[2].presentation);
                $('#examiner1_presentation_mark').text(data[2].presentation_mark);
                $('#examiner1_qna').text(data[2].QNA);
                $('#examiner1_qna_mark').text(data[2].QNA_mark);
              }

              //Examiner 2
              if(data[0].role == "EXAMINER 2"){
                data[0].abstract = data[0].abstract.replaceAll('\\r\\n', '\n');
                data[0].introduction = data[0].introduction.replaceAll('\\r\\n', '\n');
                data[0].literature_review = data[0].literature_review.replaceAll('\\r\\n', '\n');
                data[0].research_methodology = data[0].research_methodology.replaceAll('\\r\\n', '\n');
                data[0].result_discussion = data[0].result_discussion.replaceAll('\\r\\n', '\n');
                data[0].conclusion_recommendation = data[0].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[0].reference = data[0].reference.replaceAll('\\r\\n', '\n');
                data[0].writing_format = data[0].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner2_abstract').text(data[0].abstract);
                $('#examiner2_abstract_mark').text(data[0].abstract_mark);
                $('#examiner2_introduction').text(data[0].introduction);
                $('#examiner2_introduction_mark').text(data[0].introduction_mark);
                $('#examiner2_literature_review').text(data[0].literature_review);
                $('#examiner2_literature_review_mark').text(data[0].literature_review_mark);
                $('#examiner2_research_methodology').text(data[0].research_methodology);
                $('#examiner2_research_methodology_mark').text(data[0].research_methodology_mark);
                $('#examiner2_result_discussion').text(data[0].result_discussion);
                $('#examiner2_result_discussion_mark').text(data[0].result_discussion_mark);
                $('#examiner2_conclusion_recommendation').text(data[0].conclusion_recommendation);
                $('#examiner2_conclusion_recommendation_mark').text(data[0].conclusion_recommendation_mark);
                $('#examiner2_reference').text(data[0].reference);
                $('#examiner2_reference_mark').text(data[0].reference_mark);
                $('#examiner2_writing_format').text(data[0].writing_format);
                $('#examiner2_writing_format_mark').text(data[0].writing_format_mark);
                $('#examiner2_presentation').text(data[0].presentation);
                $('#examiner2_presentation_mark').text(data[0].presentation_mark);
                $('#examiner2_qna').text(data[0].QNA);
                $('#examiner2_qna_mark').text(data[0].QNA_mark);
              }
              else if(data[1].role == "EXAMINER 2"){
                data[1].abstract = data[1].abstract.replaceAll('\\r\\n', '\n');
                data[1].introduction = data[1].introduction.replaceAll('\\r\\n', '\n');
                data[1].literature_review = data[1].literature_review.replaceAll('\\r\\n', '\n');
                data[1].research_methodology = data[1].research_methodology.replaceAll('\\r\\n', '\n');
                data[1].result_discussion = data[1].result_discussion.replaceAll('\\r\\n', '\n');
                data[1].conclusion_recommendation = data[1].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[1].reference = data[1].reference.replaceAll('\\r\\n', '\n');
                data[1].writing_format = data[1].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner2_abstract').text(data[1].abstract);
                $('#examiner2_abstract_mark').text(data[1].abstract_mark);
                $('#examiner2_introduction').text(data[1].introduction);
                $('#examiner2_introduction_mark').text(data[1].introduction_mark);
                $('#examiner2_literature_review').text(data[1].literature_review);
                $('#examiner2_literature_review_mark').text(data[1].literature_review_mark);
                $('#examiner2_research_methodology').text(data[1].research_methodology);
                $('#examiner2_research_methodology_mark').text(data[1].research_methodology_mark);
                $('#examiner2_result_discussion').text(data[1].result_discussion);
                $('#examiner2_result_discussion_mark').text(data[1].result_discussion_mark);
                $('#examiner2_conclusion_recommendation').text(data[1].conclusion_recommendation);
                $('#examiner2_conclusion_recommendation_mark').text(data[1].conclusion_recommendation_mark);
                $('#examiner2_reference').text(data[1].reference);
                $('#examiner2_reference_mark').text(data[1].reference_mark);
                $('#examiner2_writing_format').text(data[1].writing_format);
                $('#examiner2_writing_format_mark').text(data[1].writing_format_mark);
                $('#examiner2_presentation').text(data[1].presentation);
                $('#examiner2_presentation_mark').text(data[1].presentation_mark);
                $('#examiner2_qna').text(data[1].QNA);
                $('#examiner2_qna_mark').text(data[1].QNA_mark);
              }else{
                data[2].abstract = data[2].abstract.replaceAll('\\r\\n', '\n');
                data[2].introduction = data[2].introduction.replaceAll('\\r\\n', '\n');
                data[2].literature_review = data[2].literature_review.replaceAll('\\r\\n', '\n');
                data[2].research_methodology = data[2].research_methodology.replaceAll('\\r\\n', '\n');
                data[2].result_discussion = data[2].result_discussion.replaceAll('\\r\\n', '\n');
                data[2].conclusion_recommendation = data[2].conclusion_recommendation.replaceAll('\\r\\n', '<br />');
                data[2].reference = data[2].reference.replaceAll('\\r\\n', '\n');
                data[2].writing_format = data[2].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner2_abstract').text(data[2].abstract);
                $('#examiner2_abstract_mark').text(data[2].abstract_mark);
                $('#examiner2_introduction').text(data[2].introduction);
                $('#examiner2_introduction_mark').text(data[2].introduction_mark);
                $('#examiner2_literature_review').text(data[2].literature_review);
                $('#examiner2_literature_review_mark').text(data[2].literature_review_mark);
                $('#examiner2_research_methodology').text(data[2].research_methodology);
                $('#examiner2_research_methodology_mark').text(data[2].research_methodology_mark);
                $('#examiner2_result_discussion').text(data[2].result_discussion);
                $('#examiner2_result_discussion_mark').text(data[2].result_discussion_mark);
                $('#examiner2_conclusion_recommendation').text(data[2].conclusion_recommendation);
                $('#examiner2_conclusion_recommendation_mark').text(data[2].conclusion_recommendation_mark);
                $('#examiner2_reference').text(data[2].reference);
                $('#examiner2_reference_mark').text(data[2].reference_mark);
                $('#examiner2_writing_format').text(data[2].writing_format);
                $('#examiner2_writing_format_mark').text(data[2].writing_format_mark);
                $('#examiner2_presentation').text(data[2].presentation);
                $('#examiner2_presentation_mark').text(data[2].presentation_mark);
                $('#examiner2_qna').text(data[2].QNA);
                $('#examiner2_qna_mark').text(data[2].QNA_mark);
              }
            }
            else{
                $('.examiner2').hide();
                //Supervisor
                if(data[0].role == "SUPERVISOR"){
                data[0].abstract = data[0].abstract.replaceAll('\\r\\n', '\n');
                data[0].introduction = data[0].introduction.replaceAll('\\r\\n', '\n');
                data[0].literature_review = data[0].literature_review.replaceAll('\\r\\n', '\n');
                data[0].research_methodology = data[0].research_methodology.replaceAll('\\r\\n', '\n');
                data[0].result_discussion = data[0].result_discussion.replaceAll('\\r\\n', '\n');
                data[0].conclusion_recommendation = data[0].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[0].reference = data[0].reference.replaceAll('\\r\\n', '\n');
                data[0].writing_format = data[0].writing_format.replaceAll('\\r\\n', '\n');
                $('#supervisor_abstract').text(data[0].abstract);
                $('#supervisor_abstract_mark').text(data[0].abstract_mark);
                $('#supervisor_introduction').text(data[0].introduction);
                $('#supervisor_introduction_mark').text(data[0].introduction_mark);
                $('#supervisor_literature_review').text(data[0].literature_review);
                $('#supervisor_literature_review_mark').text(data[0].literature_review_mark);
                $('#supervisor_research_methodology').text(data[0].research_methodology);
                $('#supervisor_research_methodology_mark').text(data[0].research_methodology_mark);
                $('#supervisor_result_discussion').text(data[0].result_discussion);
                $('#supervisor_result_discussion_mark').text(data[0].result_discussion_mark);
                $('#supervisor_conclusion_recommendation').text(data[0].conclusion_recommendation);
                $('#supervisor_conclusion_recommendation_mark').text(data[0].conclusion_recommendation_mark);
                $('#supervisor_reference').text(data[0].reference);
                $('#supervisor_reference_mark').text(data[0].reference_mark);
                $('#supervisor_writing_format').text(data[0].writing_format);
                $('#supervisor_writing_format_mark').text(data[0].writing_format_mark);
              }
              else{
                data[1].abstract = data[1].abstract.replaceAll('\\r\\n', '\n');
                data[1].introduction = data[1].introduction.replaceAll('\\r\\n', '\n');
                data[1].literature_review = data[1].literature_review.replaceAll('\\r\\n', '\n');
                data[1].research_methodology = data[1].research_methodology.replaceAll('\\r\\n', '\n');
                data[1].result_discussion = data[1].result_discussion.replaceAll('\\r\\n', '\n');
                data[1].conclusion_recommendation = data[1].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[1].reference = data[1].reference.replaceAll('\\r\\n', '\n');
                data[1].writing_format = data[1].writing_format.replaceAll('\\r\\n', '\n');
                $('#supervisor_abstract').text(data[1].abstract);
                $('#supervisor_abstract_mark').text(data[1].abstract_mark);
                $('#supervisor_introduction').text(data[1].introduction);
                $('#supervisor_introduction_mark').text(data[1].introduction_mark);
                $('#supervisor_literature_review').text(data[1].literature_review);
                $('#supervisor_literature_review_mark').text(data[1].literature_review_mark);
                $('#supervisor_research_methodology').text(data[1].research_methodology);
                $('#supervisor_research_methodology_mark').text(data[1].research_methodology_mark);
                $('#supervisor_result_discussion').text(data[1].result_discussion);
                $('#supervisor_result_discussion_mark').text(data[1].result_discussion_mark);
                $('#supervisor_conclusion_recommendation').text(data[1].conclusion_recommendation);
                $('#supervisor_conclusion_recommendation_mark').text(data[1].conclusion_recommendation_mark);
                $('#supervisor_reference').text(data[1].reference);
                $('#supervisor_reference_mark').text(data[1].reference_mark);
                $('#supervisor_writing_format').text(data[1].writing_format);
                $('#supervisor_writing_format_mark').text(data[1].writing_format_mark);
              }

              //Examiner 1
              if(data[0].role == "EXAMINER 1"){
                data[0].abstract = data[0].abstract.replaceAll('\\r\\n', '\n');
                data[0].introduction = data[0].introduction.replaceAll('\\r\\n', '\n');
                data[0].literature_review = data[0].literature_review.replaceAll('\\r\\n', '\n');
                data[0].research_methodology = data[0].research_methodology.replaceAll('\\r\\n', '\n');
                data[0].result_discussion = data[0].result_discussion.replaceAll('\\r\\n', '\n');
                data[0].conclusion_recommendation = data[0].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[0].reference = data[0].reference.replaceAll('\\r\\n', '\n');
                data[0].writing_format = data[0].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner1_abstract').text(data[0].abstract);
                $('#examiner1_abstract_mark').text(data[0].abstract_mark);
                $('#examiner1_introduction').text(data[0].introduction);
                $('#examiner1_introduction_mark').text(data[0].introduction_mark);
                $('#examiner1_literature_review').text(data[0].literature_review);
                $('#examiner1_literature_review_mark').text(data[0].literature_review_mark);
                $('#examiner1_research_methodology').text(data[0].research_methodology);
                $('#examiner1_research_methodology_mark').text(data[0].research_methodology_mark);
                $('#examiner1_result_discussion').text(data[0].result_discussion);
                $('#examiner1_result_discussion_mark').text(data[0].result_discussion_mark);
                $('#examiner1_conclusion_recommendation').text(data[0].conclusion_recommendation);
                $('#examiner1_conclusion_recommendation_mark').text(data[0].conclusion_recommendation_mark);
                $('#examiner1_reference').text(data[0].reference);
                $('#examiner1_reference_mark').text(data[0].reference_mark);
                $('#examiner1_writing_format').text(data[0].writing_format);
                $('#examiner1_writing_format_mark').text(data[0].writing_format_mark);
                $('#examiner1_presentation').text(data[0].presentation);
                $('#examiner1_presentation_mark').text(data[0].presentation_mark);
                $('#examiner1_qna').text(data[0].QNA);
                $('#examiner1_qna_mark').text(data[0].QNA_mark);
              }
              else{
                data[1].abstract = data[1].abstract.replaceAll('\\r\\n', '\n');
                data[1].introduction = data[1].introduction.replaceAll('\\r\\n', '\n');
                data[1].literature_review = data[1].literature_review.replaceAll('\\r\\n', '\n');
                data[1].research_methodology = data[1].research_methodology.replaceAll('\\r\\n', '\n');
                data[1].result_discussion = data[1].result_discussion.replaceAll('\\r\\n', '\n');
                data[1].conclusion_recommendation = data[1].conclusion_recommendation.replaceAll('\\r\\n', '\n');
                data[1].reference = data[1].reference.replaceAll('\\r\\n', '\n');
                data[1].writing_format = data[1].writing_format.replaceAll('\\r\\n', '\n');
                $('#examiner1_abstract').text(data[1].abstract);
                $('#examiner1_abstract_mark').text(data[1].abstract_mark);
                $('#examiner1_introduction').text(data[1].introduction);
                $('#examiner1_introduction_mark').text(data[1].introduction_mark);
                $('#examiner1_literature_review').text(data[1].literature_review);
                $('#examiner1_literature_review_mark').text(data[1].literature_review_mark);
                $('#examiner1_research_methodology').text(data[1].research_methodology);
                $('#examiner1_research_methodology_mark').text(data[1].research_methodology_mark);
                $('#examiner1_result_discussion').text(data[1].result_discussion);
                $('#examiner1_result_discussion_mark').text(data[1].result_discussion_mark);
                $('#examiner1_conclusion_recommendation').text(data[1].conclusion_recommendation);
                $('#examiner1_conclusion_recommendation_mark').text(data[1].conclusion_recommendation_mark);
                $('#examiner1_reference').text(data[1].reference);
                $('#examiner1_reference_mark').text(data[1].reference_mark);
                $('#examiner1_writing_format').text(data[1].writing_format);
                $('#examiner1_writing_format_mark').text(data[1].writing_format_mark);
                $('#examiner1_presentation').text(data[1].presentation);
                $('#examiner1_presentation_mark').text(data[1].presentation_mark);
                $('#examiner1_qna').text(data[1].QNA);
                $('#examiner1_qna_mark').text(data[1].QNA_mark);
              }
            }
              
            }
          });
        });

        //Admin accept pre-viva
        $('.admin_acceptprevivabtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
          
          var application_id = data[1];
          var user_id = data[2];

          $.ajax({
            url:"includes/fetch_pre_viva_application_details.inc.php",
            method: "POST",
            data:{application_id:application_id,user_id:user_id},
            dataType: "JSON",
            success: function(data){    
              $('#application_id').val(data[0].application_id);
              $('#student_name').val(data[1].name);
              $('#student_programme').val(data[1].programme);
              $('#levelofstudy').val(data[1].level_of_study);
              $('#research_title').val(data[1].research_title);
              $('#pre_viva_date').val(data[0].pre_viva_date);
              $('#pre_viva_time').val(data[0].pre_viva_time);
            }
          });
        });

        //Admin reject pre-viva
        $('.admin_rejectprevivabtn').on('click', function(){
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
          console.log(data);
          
          var application_id = data[1];

          $('#reject_application_id').val(application_id);

        });
        
        //Admin delete rejected pre-viva
        $('.admin_deleteprevivabtn').on('click', function(){
          
          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          var deleteid = data[1];

          Swal.fire({
            title: 'Are you sure want to delete this pre-viva application?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: 800,
          }).then((result) => {
            if(result.isConfirmed) {
              $.ajax({
                url:"includes/delete_pre_viva_application.inc.php",
                method: "POST",
                data:{deleteid:deleteid},
                success: function(data){
                  Swal.fire({
                    title: 'Successfully',
                    text: "Pre-viva data deleted successfully!",
                    icon: 'success',
                    timer: 3500,
                  }).then((result) => {
                    location.reload();
                  }); 
                }
              }); 
            }
          })
        });

        //Clear Data When Closing Modal
        $('#addadminModal').on('hidden.bs.modal', function () {
          // var formgroup = $('.form-group');
          $('.form-group').removeClass('success');
          $('.form-group').removeClass('error');
          $('#addadminModal form')[0].reset();
        });

        $('#editadminModal').on('hidden.bs.modal', function () {
          // var formgroup = $('.form-group');
          $('.form-group').removeClass('success');
          $('.form-group').removeClass('error');
          $('#editadminModal form')[0].reset();
        });

        $('#addstaffModal').on('hidden.bs.modal', function () {
          // var formgroup = $('.form-group');
          $('.form-group').removeClass('success');
          $('.form-group').removeClass('error');
          $('#addstaffModal form')[0].reset();
        });

        $('#addstudentModal').on('hidden.bs.modal', function () {
          // var formgroup = $('.form-group');
          $('.form-group').removeClass('success');
          $('.form-group').removeClass('error');
          $('#addstudentModal form')[0].reset();
        });

        $('#rejectpendingprevivaModal').on('hidden.bs.modal', function () {
          // var formgroup = $('.form-group');
          $('.form-group').removeClass('success');
          $('.form-group').removeClass('error');
          $('#rejectpendingprevivaModal form')[0].reset();
        });

        $('#examinerrejectionModal').on('hidden.bs.modal', function () {
          // var formgroup = $('.form-group');
          $('.form-group').removeClass('success');
          $('.form-group').removeClass('error');
          $('#examinerrejectionModal form')[0].reset();
        });

        $('#applyprevivaModal').on('hidden.bs.modal', function () {
          $('#applyprevivaModal form')[0].reset();
        });

        $('#viewdetailsModal').on('hidden.bs.modal', function () {
          $('#viewdetailsModal form')[0].reset();
          $('#thesismark').removeClass('border border-success');
          $('#thesismark').removeClass('border border-danger');
          $('#viewthesisassessmentModal').attr('id', "thesisassessmentModal");
        });

        $('#pendingprevivaModal').on('hidden.bs.modal', function () {
          $('#examiner1 option').show();
          $('#examiner2 option').show();
          $('#pendingprevivaModal form')[0].reset();
        });
        
        $('#editpendingprevivaModal').on('hidden.bs.modal', function () {
          $('#examiner1 option').show();
          $('#examiner2 option').show();
          $('#editpendingprevivaModal form')[0].reset();
        });

        $('#thesisassessmentModal').on('hidden.bs.modal', function () {
          $('#thesisassessmentModal form')[0].reset();
          $('#total_mark').attr('value', 0);
          $('#total_mark').removeClass('border border-success');
          $('#total_mark').removeClass('border border-danger');
          $('#thesisassessmentModal form').attr('action', '<?=ROOT?>includes/thesis_assessment.inc.php');
        });
        
        $('#viewoverallthesismarkModal').on('hidden.bs.modal', function () {
          $('.examiner2').show();
        });
      });
    </script>


    <script>
      // Change the file name 
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
    </script>

    <script>
      let arrow = document.querySelectorAll(".arrow");
      for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
          let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
          arrowParent.classList.toggle("showMenu");
        });
      }
    </script>

    <script>
      $(document).ready(function(){
        $(".profile").click(function(){
        let menu = document.querySelector(".menu");
            menu.classList.toggle("active");
        });
    });
    </script>

    <script>
      function removeToggle() {
        let menu = document.querySelector(".menu");
        menu.classList.remove("active");
      }
    </script>

    <script>
      $(document).ready(function(){
        $('.dataTables-example').DataTable({
            lengthMenu: [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"],
              ],
            pagingType: "full_numbers",

            scrollCollapse: true,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
              {extend: 'copy'},
              {extend: 'csv'},
              {extend: 'excel', title: 'ExampleFile'},
              {extend: 'pdf', title: 'ExampleFile'},
              {extend: 'print',
            customize: function (win){
              $(win.document.body).addClass('white-bg');
              $(win.document.body).css('font-size', '10px');
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            }
          }
        ]
      });

        $('.dataTables-supervisor').DataTable({
            lengthMenu: [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"],
              ],
            pagingType: "full_numbers",

            scrollCollapse: true,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
              {extend: 'print',
            customize: function (win){
              $(win.document.body).addClass('white-bg');
              $(win.document.body).css('font-size', '10px');
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            }
          }
        ]
      });

      $('.dataTables-examiner').DataTable({
            lengthMenu: [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"],
              ],
            pagingType: "full_numbers",
          
            scrollCollapse: true,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
              {extend: 'print',
            customize: function (win){
              $(win.document.body).addClass('white-bg');
              $(win.document.body).css('font-size', '10px');
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            }
          }
        ]
      });
    });
    </script>

    <script type="text/javascript">
      var user_type = "<?php echo $usertype; ?>";
      $(document).ready(function () {
        if (user_type === "ADMIN") {
          $("#apply_pre_viva").hide();
          $("#pre_viva").hide();
          $("#staff_academic_information").hide();
          $("#student_academic_information").hide();
        }else if(user_type === "STAFF"){
          $("#users").hide();
          $("#apply_pre_viva").hide();
          $("#all_pre_viva").hide();
          $("#analytics").hide();
          //$("#overview").hide();
          //$("#recent_activities").hide();
          $("#student_academic_information").hide();
        } else if (user_type === "STUDENT") {
            $("#users").hide();
            $("#pre_viva").hide();
            $("#all_pre_viva").hide();
            $("#staff_academic_information").hide();
            $("#analytics").hide();
            //$("#overview").hide();
            //$("#recent_activities").hide();
        }
      });
    </script>

    <!-- For examiners selection -->
    <script>
      function getExaminer1(examiner1)
      {
        if(examiner1 != '')
        {
            $("#examiner2 option[value='"+examiner1+"']").hide();
            $("#examiner2 option[value!='"+examiner1+"']").show();
        }
        else
        {
          $("#examiner2 option[value!='"+examiner1+"']").show();
        }
      }

      function getExaminer2(examiner2)
      {
        if(examiner2 != '')
        {
            $("#examiner1 option[value='"+examiner2+"']").hide();
            $("#examiner1 option[value!='"+examiner2+"']").show();
        }
        else
        {
          $("#examiner1 option[value!='"+examiner2+"']").show();
        }
      }

      function getEditExaminer1(examiner1)
      {
        if(examiner1 != '')
        {
            $("#edit_examiner2 option[value='"+examiner1+"']").hide();
            $("#edit_examiner2 option[value!='"+examiner1+"']").show();
        }
        else
        {
          $("#edit_examiner2 option[value!='"+examiner1+"']").show();
        }
      }

      function getEditExaminer2(examiner2)
      {
        if(examiner2 != '')
        {
            $("#edit_examiner1 option[value='"+examiner2+"']").hide();
            $("#edit_examiner1 option[value!='"+examiner2+"']").show();
        }
        else
        {
          $("#edit_examiner1 option[value!='"+examiner2+"']").show();
        }
      }
    </script>

    <script>
      $(document).ready(function(){
        // Function to check examiner statuses and show/hide submit button accordingly
        function checkExaminerStatus() {
            var examiner1_status = $("#edit_examiner1_status").val();
            var examiner2_status = $("#edit_examiner2_status").val();
            
            // Check if either examiner's status is "REJECTED"
            if (examiner1_status == "REJECTED" || examiner2_status == "REJECTED") {
                $("#edit_submitbtn").show(); // Show submit button
            } else {
                $("#edit_submitbtn").hide(); // Hide submit button
            }
        }

        // Call the function initially when the document is ready
        checkExaminerStatus();

        // Call the function whenever the examiner status inputs change
        $("#edit_examiner1_status, #edit_examiner2_status").on("change", function() {
            checkExaminerStatus(); // Call the function to check and update submit button visibility
        });
    });
    </script>

    <script>
      $(document).ready(function(){
        $('#thesis_assessment_form input[name="abstract"]').on('click', function(){
          $('#abstract_mark').val($("input[name='abstract']:checked").val());
        });

        $('#thesis_assessment_form input[name="introduction"]').on('click', function(){
          $('#introduction_mark').val($("input[name='introduction']:checked").val());
        });

        $('#thesis_assessment_form input[name="literature_review"]').on('click', function(){
          $('#literature_review_mark').val($("input[name='literature_review']:checked").val());
        });

        $('#thesis_assessment_form input[name="research_methodology"]').on('click', function(){
          $('#research_methodology_mark').val($("input[name='research_methodology']:checked").val());
        });

        $('#thesis_assessment_form input[name="result_discussion"]').on('click', function(){
          $('#result_discussion_mark').val($("input[name='result_discussion']:checked").val());
        });

        $('#thesis_assessment_form input[name="conclusion_recommendation"]').on('click', function(){
          $('#conclusion_recommendation_mark').val($("input[name='conclusion_recommendation']:checked").val());
        });

        $('#thesis_assessment_form input[name="reference"]').on('click', function(){
          $('#reference_mark').val($("input[name='reference']:checked").val());
        });

        $('#thesis_assessment_form input[name="writing_format"]').on('click', function(){
          $('#writing_format_mark').val($("input[name='writing_format']:checked").val());
        });

        $('#presentation_assessment_form input[name="presentation"]').on('click', function(){
          $('#presentation_mark').val($("input[name='presentation']:checked").val());
        });

        $('#presentation_assessment_form input[name="qna"]').on('click', function(){
          $('#qna_mark').val($("input[name='qna']:checked").val());
        });
        
      });

      function AutoCalculation()
      {
        var total_mark = 0;

        // total_mark = parseInt($('#abstract_mark').val()) + parseInt($('#introduction_mark').val()) + parseInt($('#literature_review_mark').val()) + parseInt($('#research_methodology_mark').val()) +
        //              parseInt($('#result_discussion_mark').val()) + parseInt($('#conclusion_recommendation_mark').val()) + parseInt($('#reference_mark').val()) + parseInt($('#writing_format_mark').val());

        var abstract_mark = document.getElementById('abstract_mark').value;
        total_mark += parseInt(abstract_mark);
        var introduction_mark = document.getElementById('introduction_mark').value;
        total_mark += parseInt(introduction_mark);
        var literature_review_mark = document.getElementById('literature_review_mark').value;
        total_mark += parseInt(literature_review_mark);
        var research_methodology_mark = document.getElementById('research_methodology_mark').value;
        total_mark += parseInt(research_methodology_mark);
        var result_discussion_mark = document.getElementById('result_discussion_mark').value;
        total_mark += parseInt(result_discussion_mark);
        var conclusion_recommendation_mark = document.getElementById('conclusion_recommendation_mark').value;
        total_mark += parseInt(conclusion_recommendation_mark);
        var reference_mark = document.getElementById('reference_mark').value;
        total_mark += parseInt(reference_mark);
        var writing_format_mark = document.getElementById('writing_format_mark').value;
        total_mark += parseInt(writing_format_mark);
        
        var total = document.getElementById('total_mark');
        total.setAttribute('value', total_mark);
        if(total_mark >= 80 && total_mark <= 100){
          
          total.classList.remove('border', 'border-danger');
          total.classList.add('border', 'border-success');
        }
        else if(total_mark < 80){
          
          total.classList.remove('border', 'border-success');
          total.classList.add('border', 'border-danger');
        }
      }

      function PresentationAutoCalculation(){
        var total_mark = 0;

        var presentation_mark = document.getElementById('presentation_mark').value;
        total_mark += parseInt(presentation_mark);
        var QNA_mark = document.getElementById('qna_mark').value;
        total_mark += parseInt(QNA_mark);

        var total = document.getElementById('presentation_total_mark');
        total.setAttribute('value', total_mark);
        if(total_mark >= 80 && total_mark <= 100){
          
          total.classList.remove('border', 'border-danger');
          total.classList.add('border', 'border-success');
        }
        else if(total_mark < 80){
          
          total.classList.remove('border', 'border-success');
          total.classList.add('border', 'border-danger');
        }
      }
    </script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var total_pass = 0;
        var total_fail = 0;
        <?php
          while($pass = mysqli_fetch_assoc($pass_result)){
            ?>
            var total_pass = <?=$pass['Pass']?>;
            <?php
          }
        ?>

        <?php
          while($fail = mysqli_fetch_assoc($fail_result)){
            ?>
            var total_fail = <?=$fail['Fail']?>;
            <?php
          }
        ?>

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Pre-Viva Application'],
          ['Pass',     total_pass],
          ['Fail',      total_fail]
        ]);

        var options = {
          title: 'Overall Result of Pre-Viva (%)',
          slices: {0: {color: '#00FF08'}, 1:{color: 'red'}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </body>
</html>

