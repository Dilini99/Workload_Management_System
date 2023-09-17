<?php
    require 'connection.php';
    $output='';
    $sql="SELECT * FROM practical_courses WHERE Year='".$_POST['yearID']."' ORDER BY CourseCode_Practical";
    $result=mysqli_query($connection,$sql);
    $output.='<option name="" value="" disabled selected>Select Course</option>';
    while($row=mysqli_fetch_array($result)){
        $output.='<option value="'.$row["cid"].'">'.$row["CourseCode_Practical"].'</option>';

    }
    echo $output;
?>