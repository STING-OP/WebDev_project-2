<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['school']) && !empty($_POST['course']) && !empty($_POST['branch']) && !empty($_POST['semester'])) {
        $school = $_POST['school'];
        $course = $_POST['course'];
        $branch = $_POST['branch'];
        $semester = $_POST['semester'];
        if($school=="USICT" && $course=="btech" && $branch=="CSE" && $semester=="4"){
            echo "<script>window.location.href='panel.html';</script>";
        }
        else{
            echo"Please select USICT, BTECH, CSE, 4 sem to continue";
            echo "<br><br><br>"."<a href='select.html'> Back to previous Page</a>";
        }
    } 
}
?>