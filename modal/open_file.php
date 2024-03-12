<?php
    if(isset($_GET['thesis_name'])){
        $thesis_name = $_GET['thesis_name'];  
    
?>

<embed id="thesis_file" src="../<?php echo $thesis_name; ?>" width="100%" height="100%" type="application/pdf"></embed>
 
<?php

    }

?>

<?php
    if(isset($_GET['plagiarism_name'])){
        $plagiarism_name = $_GET['plagiarism_name'];  
    
?>

<embed id="plagiarism_file" src="../<?php echo $plagiarism_name; ?>" width="100%"height="100%" type="application/pdf"></embed>
 
<?php

    }

?>

<?php
    if(isset($_GET['proofread_name'])){
        $proofread_name = $_GET['proofread_name'];  
    
?>

<embed id="proofread_file" src="../<?php echo $proofread_name; ?>" width="100%" height="100%" type="application/pdf"></embed>
 
<?php

    }

?>

<?php
    if(isset($_GET['thesis_name1'])){
        $thesis_name1 = $_GET['thesis_name1'];  
    
?>

<embed id="thesis_file1" src="../<?php echo $thesis_name1; ?>" width="100%" height="100%" type="application/pdf"></embed>
 
<?php

    }

?>

<?php
    if(isset($_GET['plagiarism_name1'])){
        $plagiarism_name1 = $_GET['plagiarism_name1'];  
    
?>

<embed id="plagiarism_file1" src="../<?php echo $plagiarism_name1; ?>" width="100%" height="100%" type="application/pdf"></embed>
 
<?php

    }

?>

<?php
    if(isset($_GET['proofread_name1'])){
        $proofread_name1 = $_GET['proofread_name1'];  
    
?>

<embed id="proofread_file1" src="../<?php echo $proofread_name1; ?>" width="100%" height="100%" type="application/pdf"></embed>
 
<?php

    }

?>
