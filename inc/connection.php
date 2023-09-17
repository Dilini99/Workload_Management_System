<?php
$connection = mysqli_connect('localhost','root','','workloadmanagementsystem');

if(mysqli_connect_error()){
    die('Database connection failed'.mysqli_connect_error());
}else{
   // echo "Connection succesfull.";
}
?>