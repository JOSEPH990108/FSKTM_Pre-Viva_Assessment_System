function clickOutside(e) {
    if (e.target == modal) {
        modal.style.display = 'none';
    }
}

$(document).ready(function() {
    $('#contactusbtn').click(function() {
        var modal = document.getElementById('contactusmodal');
        modal.style.display = 'block';
    });
    $('#adminmodalbtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    });
    $('#cancelbtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    });
    $('#closebtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    });
    $('#cancelbtn1').click(function() {
        var modal = document.getElementById('modal1');
        modal.style.display = 'none';
    });
    $('#closebtn1').click(function() {
        var modal = document.getElementById('modal1');
        modal.style.display = 'none';
    });
    $('#cancelbtn2').click(function() {
        var modal = document.getElementById('modal2');
        modal.style.display = 'none';
    });
    $('#closebtn2').click(function() {
        var modal = document.getElementById('modal2');
        modal.style.display = 'none';
    });
    $('#staffmodalbtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    });
    $('#studentmodalbtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    });
    $('#applybtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    });
    $('.acceptbtn').click(function() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        $('#application_id').val(data[1]);
        $('#studentname').val(data[2]);
        $('#levelofstudy').val(data[3]);
        $('#research_title').val(data[5]);
    });
    $('.rejectbtn').click(function() {
        var modal = document.getElementById('modal1');
        modal.style.display = 'block';
        $tr1 = $(this).closest('tr');
        var data1 = $tr1.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data1);
        $('#application_id1').val(data1[1]);
    });
    $('.assessmentbtn').click(function() {
        var modal = document.getElementById('modal2');
        modal.style.display = 'block';
        $tr2 = $(this).closest('tr');
        var data2 = $tr2.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data2);
        $('#application_id2').val(data2[1]);
    });
    // $('.thesisbtn').click(function() {
    //     var modal = document.getElementById('modal3');
    //     modal.style.display = 'block';
    //     $tr3 = $(this).closest('tr');
    //     var data3 = $tr3.children("td").map(function() {
    //         return $(this).text();
    //     }).get();
    //     var thesis_name = data3[6];
    //     console.log(thesis_name);
    //     $.ajax({
    //         type: "POST",
    //         url: 'modal/thesis_file_modal.php',
    //         data: "thesis_name=" + thesis_name,
    //         success: function(data) {
    //             console.log(data);
    //         }
    //     });

    // });
    //window.addEventListener('click', clickOutside);
})