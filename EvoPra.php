<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>

<!-------------------Evolution of quiz assignments tutorials------------------------------------->

<?php
$errors = array();

$coursecode = '';
$noOfStudents = '';
$totaltime = '';


if(isset($_POST['SubmitSetting'])){
   
    $coursecode = $_POST['CourseCode'];
    $noOfStudents =  $_POST['NoOfStudents'];
   
   
      //Checking required field
    $req_fields = array('CourseCode','NoOfStudents');
    
    foreach($req_fields as $field){
      if(empty(trim($_POST[$field]))){
        $errors[]=$field.' is required.';
      }
    }
    
    }

?>

<?php
    $ns="";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ns = floatval($_POST["NoOfStudents"]); //number of credits

			$totaltime = round($ns / 6); // total time
		}
?>


<?php

if(isset($_POST['SubmitSettingFinal'])){

    $coursecode = $_POST['CourseCode'];
    $totaltime = $_POST['TotalTime'];
   

  //Checking required field

$req_fields = array('CourseCode','NoOfStudents','TotalTime');

foreach($req_fields as $field){
  if(empty(trim($_POST[$field]))){
    $errors[]=$field.' is required.';
  }
}

if(empty($errors)){
  
  $CourseCode =  mysqli_real_escape_string($connection,$_POST['CourseCode']);
  $TotalTime =mysqli_real_escape_string($connection,$_POST['TotalTime']);
  $NoOfStudents =mysqli_real_escape_string($connection,$_POST['NoOfStudents']);

 
  $query = "INSERT INTO evolution_practical_reports ( ";
  $query .=  "EmployeeID,CourseCode,NumberOfStudents,TotalTime,Academic_year,is_deleted";
  $query .= ") VALUES (";
  $query .=  "'{$_SESSION['EmployeeID']}','{$CourseCode}','{$NoOfStudents}','{$TotalTime}','{$_SESSION['Academic_year']}',0";
  $query .= ")";

  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: EvoPraView.php?user_added=true');
  }else{
    $errors[]= 'Failed to add the new record';
  }
}

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Evaluation of Practical Reports Add New</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script>
	



function clearInputs() {
  document.getElementById("CourseCode").value = "";
  document.getElementById("TotalTime").value = "";
  document.getElementById("NoOfStudents").value = "";


}

	</script>

	

	<style>
		* {
			box-sizing: border-box;
			margin:0;

		}

		.table{
			margin: 0 auto;
   		z-index: 1;
  		width:50%; 
			left:350px;
			top:250px;
		}
		.errmsg{
	margin: 20px 0;
	color: red;
  }

		.label{
			font-size: 25px;
		}

		input[type=text],select, input[type=date],input[type=time]
		{
		  width: 100%;
		  padding: 10px 15px;
		  margin: 5px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}

		td button {
		
		
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		font-size:  1.0em;
  		background-color: #2C2A7D;
  		color: whitesmoke ;
  		padding: 5px;
  		text-decoration: none;
  		border-radius: 8px;
  		display: inline-block;
 	    width: 100px;
	}
		.content{
			margin: 50px 15px;
			min-height: 55vh;
		}
		
			fieldset{
			padding: 20px;
		}
	
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}



	
	/*------------------------------Feedback form -------------------------------*/
    input[type=text], select 
		{
		  width: 100%;
		  padding: 12px 20px;
		  margin: 15px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}

		input[type=tel], select 
		{
		  width: 100%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}

		textarea, select 
		{
		  width: 100%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}

		input[type=submit] {
		  width: 100%;
		  background-color: #2C2A7D;
		  color: white;
		  padding: 14px 20px;
		  margin: 8px 0;
		  border: none;
		  border-radius: 4px;
		  cursor: pointer;
		}

		input[type=submit]:hover {
		  background-color: #10751d;
		}

		.feedback {
	
		  padding: 20px;
		  position:relative;
		}

		h1{

			color:  #10751d;
			text-align:center;
		}
		
		h2{
			text-align:left;
		}

	</style>
</head>
<body>
	<div class="header">
		<div class="left">
			<img src="pictures/logo-fas_n.png">
		</div>
		<div class="right">
		<p class="loggedin" style="font-family: inherit;font-size: 1.3em;color: #ffffff;">Welcome <a  style="font-family: inherit;font-size: 1.0em;color: #ffffff;" href="profile.php"><?php echo $_SESSION['FullName'] ?></a>!</p>
		<p class="loggedin" style="font-family: inherit;font-size: 1.3em;color: #ffffff;">Academic year <a  style="font-family: inherit;font-size: 1.0em;color: #ffffff;" href="#"><?php echo $_SESSION['Academic_year'] ?></a></p>
   
		<p><a style="font-family: inherit;font-size: 1.3em;color: #ffffff;" href="logout.php">  Log out</a></p>
			
		</div>
	</div>
	
	<div class="topnav" id="myTopnav">
	  	<div class="dropdown">
	    	<button class="dropbtn">Academic Instructions 
	      		<i class="fa fa-caret-down"></i>
	    	</button>
	    	<div class="dropdown-content">
			<a href="TheorySessionView.php">Theory Sessions</a>
			      <a href="PracticalSessionsView.php">Practical Sessions</a>
			      <a href="Evolution.php">Evaluation</a>
			      <a href="other.php">Other</a>
	    	</div>
	  </div> 
	  <a href="AcademicCoor.php">Academic Coordination</a>
	  <a href="ResearchSup.php">Research Supervision</a>
	  <a href="WorkLoad.php">Workload Summary</a>
	</div>

	<div class="breadcrumb">
		<ul class="bc">
			<li><a href="main.php">Home</a></li>
			<li><a href="Academicins.php">Academic Instructions</a></li>
			<li><a href="Evolution.php">Evaluation</a></li>
			<li><a href="EvoPraView.php">Evolution of Practical reports</a></li>
			<li>Add new</li>
		</ul>
	</div>


	<div class="content">
			
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset>
			
			<legend align="left" style= "font-family:arial; font-size:200%; color:#2C2A7D">
			Evolution of practical reports</legend>

			<div class="feedback">

  			<table>
              <?php
  if(!empty($errors)){
    echo '<div class="errmsg">';
    echo '<b></b>There were errors on your form.</b><br>';
    foreach($errors as $error){
      echo $error .'<br>';
    }
    echo '</div>';
  }
?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

  				<tr>
  					<td><label for="CourseCode">Course code</label></td>
                    <td></td> <td></td> <td></td>
  					<td><input type="text" id="CourseCode" name="CourseCode"  <?php echo 'value="' . $coursecode . '"'; ?> onchange="fillFields()"></td>
  				</tr>

  				


                

                  <tr>
                  <td><label for="NoOfStudents">Number of Students</label></td>
                      <td></td> <td></td> <td></td>
  					<td><input type="text" id="NoOfStudents" name="NoOfStudents"  <?php echo 'value="' . $noOfStudents . '"'; ?> ></td>
                    <td>(1/6 hours for one student)</td> 
  				<td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
  				<td> <button  type="submit" name="SubmitSetting" id="SubmitSetting" onclick="disableFields()">OK</button></td>
                <td><button style="background-color: red;" type="submit" name="cancel" onclick="clearInputs()">Cancel</button></td>
            </tr>

            <tr>
            	<td><br><br><br></td>
            	<td><br><br><br></td>
            </tr>
                  <tr>
  					<td><label for="TotalTime">Required Time (Hours)</label></td>
                      <td></td> <td></td> <td></td>
  					<td><input type="text" id="TotalTime" name="TotalTime"  value="<?php if (isset($totaltime)) echo $totaltime; ?>" readonly></td>
				
				 <td></td>
  				<td></td>
  				<td></td>
                <td></td>
  				<td></td>
                  <td></td>
                  <td></td>
  				<td> <button  type="submit" name="SubmitSettingFinal" id="SubmitSettingFinal" onclick="disableFields()">Submit</button></td>
               
            </tr>
  			

  				
  			</table>

    			
  
  			</form>
		
	</div>
		</fieldset>
	</form>


 	</div>	

 
	
	<div class="footer">
		<center><p>&copy;University of Vavuniya-FAS | TaskTimer Workload Management System</p></center>
	</div>

</body>
</html>
<?php 
mysqli_close($connection);
?>
