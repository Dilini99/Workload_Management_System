<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php
$errors = array();
$id = '';
$coursecode = '';
$noOfStudents = '';
$totaltime = '';
$theorypractical = '';
$nweeks ='';



if(isset($_GET['id'])){

	$id = mysqli_real_escape_string($connection,$_GET['id']);
	$query = "SELECT SC_No,CourseCode,TheoryPractical,NumberOfStudents,NumberOfWeeks,TotalTime
		FROM seminar_course
		WHERE SC_No = {$id} LIMIT 1";

	$result_set = mysqli_query($connection, $query);

	if($result_set){
		if(mysqli_num_rows($result_set) == 1){
			// record found
			$result = mysqli_fetch_assoc($result_set);

			$coursecode = $result['CourseCode'];
			$noOfStudents= $result['NumberOfStudents'];
			$totaltime= $result['TotalTime'];
            $theorypractical = $result['TheoryPractical'];
            $nweeks = $result['NumberOfWeeks'];

		} else {
			// record not found
			header('Location: SeminarCourseView.php?err=record_not_found');
			exit;
		}
	} else {
		// query unsuccessful
		header('Location: SeminarCourseView.php?err=query_failed');
		exit;
	}
}


if(isset($_POST['SubmitSetting'])){

	$id = $_POST['id'];
    $coursecode = $_POST['CourseCode'];
    $noOfStudents =  $_POST['NoOfStudents'];
    $nweeks = $_POST['NoOfWeeks'];

	if(isset($_POST['radio_button'])) {
		$theorypractical = $_POST['radio_button'];
	  }



  //Checking required field

  $req_fields = array('id','CourseCode','NoOfStudents','NoOfWeeks','radio_button');

  foreach($req_fields as $field){
    if(empty(trim($_POST[$field]))){
      $errors[]=$field.' is required.';
    }
  }
}
?>
<?php
    $ns="";
    $nw="";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ns = floatval($_POST["NoOfStudents"]); //number of credits
            $nw = floatval($_POST["NoOfWeeks"]); 
			$totaltime = round($ns * $nw); // total time
		}
?>


<?php




if(isset($_POST['SubmitSettingFinal'])){


	


$id = $_POST['id'];
$coursecode = $_POST['CourseCode'];
    $totaltime = $_POST['TotalTime'];
    $noOfStudents =  $_POST['NoOfStudents'];
    $nweeks = $_POST['NoOfWeeks'];

	if(isset($_POST['radio_button'])) {
		$theorypractical = $_POST['radio_button'];
	  }


  //Checking required field

  $req_fields = array('CourseCode','NoOfStudents','NoOfWeeks','TotalTime','radio_button');

  foreach($req_fields as $field){
    if(empty(trim($_POST[$field]))){
      $errors[]=$field.' is required.';
    }
  }
  
  if(empty($errors)){
    
    $CourseCode =  mysqli_real_escape_string($connection,$_POST['CourseCode']);
    $TotalTime =mysqli_real_escape_string($connection,$_POST['TotalTime']);
    $NoOfStudents =mysqli_real_escape_string($connection,$_POST['NoOfStudents']);
   $Theory_Practical = isset($_POST['radio_button']) ? $_POST['radio_button'] : null;
   $nweeks =mysqli_real_escape_string($connection,$_POST['NoOfWeeks']);


	$query = "UPDATE seminar_course SET ";
	$query .= "CourseCode = '{$CourseCode}', ";
	$query .= "NumberOfStudents = '{$NoOfStudents}', ";
    $query .= "NumberOfWeeks = '{$nweeks}', ";

	$query .= "TheoryPractical = '{$Theory_Practical}',";
	$query .= "TotalTime = '{$TotalTime}' ";
	$query .= "WHERE SC_No = {$id} LIMIT 1";
	



  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: SeminarCourseView.php?user_added=true');
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
	<title>Seminar Course Edit</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script>


	</script>

	<style>
		* {
			box-sizing: border-box;
			margin:0;

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
		
		.pra
		{  
		  margin: 15px 10px;
		  padding: 15px 20px; 
		}
		fieldset{
			padding: 20px;
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

		
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
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
			<li><a href="other.php">Other</a></li>
			<li><a href="SeminarCourseView.php">Seminar course</a></li>
			<li>Edit</li>
		</ul>
	</div>




	<div class="content">
			
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset>
			
			<legend align="left" style= "font-family:arial; font-size:200%; color:#2C2A7D">
			Computation of course results</legend>

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
              <input type="hidden" name="id" value="<?php echo $id; ?>">

  				<tr>
  					<td><label for="CourseCode">Course code</label></td>
                    <td></td> <td></td> <td></td>
  					<td><input type="text" id="CourseCode" name="CourseCode"  <?php echo 'value="' . $coursecode . '"'; ?> onchange="fillFields()"></td>
  				</tr>

  				<tr>
				<input type="radio" id='radio_button' name="radio_button" value="theory" <?php if(isset($_POST['radio_button']) && $_POST['radio_button'] == 'theory') echo 'checked="checked"'; ?>>Theory
				<td></td> <td></td> <td></td>
				<input type="radio"  id='radio_button' name="radio_button" value="practical" <?php if(isset($_POST['radio_button']) && $_POST['radio_button'] == 'practical') echo 'checked="checked"'; ?>>Practical
				</tr>

                <tr>
  					<td><label for="NoOfWeeks">Number of weeks</label></td>
                    <td></td> <td></td> <td></td>
  					<td><input type="text" id="NoOfWeeks" name="NoOfWeeks"  <?php echo 'value="' . $nweeks . '"'; ?>></td>
                      <td>(1 hour for 1 week)</td> 
  				</tr>

                

                  <tr>
                  <td><label for="NoOfStudents">Number of Students</label></td>
                      <td></td> <td></td> <td></td>
  					<td><input type="text" id="NoOfStudents" name="NoOfStudents"  <?php echo 'value="' . $noOfStudents . '"'; ?> ></td>
                    <td>(0.1 hours for one student)</td> 
  				<td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
  				<td> <button  type="submit" name="SubmitSetting" id="SubmitSetting" onclick="disableFields()">OK</button></td>
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
		<center><p>&copy;Group-02 | TaskTimer Workload Management System</p></center>
	</div>
	
</body>
</html>
<?php 
mysqli_close($connection);
?>
