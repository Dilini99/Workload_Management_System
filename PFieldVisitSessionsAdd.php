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
$course='';
$date = '';
$title = '';
$description = '';
$numOfStudents = '';
$requiredTime = '';



if(isset($_POST['submit'])){

$course=$_POST['course'];
$date = $_POST['date'];
$title = $_POST['title'];
$description = $_POST['description'];
$numOfStudents = $_POST['numOfStudents'];
$requiredTime = $_POST['requiredTime'];

  //Checking required field

$req_fields = array('course','date','title','description','numOfStudents','requiredTime');

foreach($req_fields as $field){
  if(empty(trim($_POST[$field]))){
    $errors[]=$field.' is required.';
  }
}


if(empty($errors)){
	$course = mysqli_real_escape_string($connection,$_POST['course']);
  $date = mysqli_real_escape_string($connection,$_POST['date']);
  $title = mysqli_real_escape_string($connection,$_POST['title']);
  $description = mysqli_real_escape_string($connection,$_POST['description']);
  $numOfStudents = mysqli_real_escape_string($connection,$_POST['numOfStudents']);
  $requiredTime = mysqli_real_escape_string($connection,$_POST['requiredTime']);

  $query = "INSERT INTO practical_field_visits ( ";
  $query .=  "EmployeeID,CourseCode,Date,Title,Description,Number_Of_Students,Required_Time,Academic_year,is_deleted";
  $query .= ") VALUES (";
  $query .= "'{$_SESSION['EmployeeID']}','{$course}','{$date}','{$title}','{$description}','{$numOfStudents}','{$requiredTime}','{$_SESSION['Academic_year']}',0";
  $query .= ")";

  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: PFieldVisitSessionsView.php?user_added=true');
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
	<title>Fieldvisit Add</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
<style>
	table{
			margin: 15px auto;
			text-align: left;
   		z-index: 1;
  		width:50%; 
			left:350px;
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
		  padding: 15px 50px;
		  margin: 10px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 8px;
		  box-sizing: border-box;
		}

		.option {
  		margin: 60px 0;

		}
		.option a{
			margin: 20px 10px;
		}
		.option td{
			margin: 10px;
		}
		td a{
  		text-decoration: none;
  		font-size:  1.2em;
  		background-color: #2C2A7D;
  		color: whitesmoke ;
  		padding: 10px;
  		text-decoration: none;
  		border-radius: 8px;
  		display: inline-block;
 	    width: 130px;
		}
      td  button {
		
		
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		font-size:  1.2em;
  		background-color: #2C2A7D;
  		color: whitesmoke ;
  		padding: 10px;
  		text-decoration: none;
  		border-radius: 8px;
  		display: inline-block;
 	    width: 150px;
	}

	.buttons{
		margin: 60px 0;


	}

	.content
	{
		text-align: center;
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
			<li><a href="AcademicIns.php">Academic Instructions</a></li>
			<li><a href="other.php">Other </a></li>
			<li><a href="PFieldVisitSessionsView.php">Field Visits </a></li>
			<li> Add new</li>
		</ul>
	</div>

	<div class="content">

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


		<form action="PFieldVisitSessionsAdd.php" method="post">
				<table align="center">
					<tr>
						<td><label for="course">Practical course code :</label></td>
						<td><input type="text" placeholder="" name="course" <?php echo 'value="' . $course . '"'; ?>></td>
					</tr>
					<tr>
						<td><label for="date">Date :</label></td>
						<td><input type="date" placeholder="" name="date" <?php echo 'value="' . $date . '"'; ?>></td>
					</tr>

					<tr>
						<td><label for="title">Title :</label></td>
						<td><input type="text" placeholder="" name="title" <?php echo 'value="' . $title . '"'; ?>></td>
					</tr>

					<tr>
						<td><label for="des">Description :</label></td>
						<td><input type="text" placeholder="" name="description" <?php echo 'value="' . $description . '"'; ?>></td>
					</tr>

				

					<tr>
						<td><label for="students">Number of Students :</label></td>
						<td><input type="text" placeholder="" name="numOfStudents" <?php echo 'value="' . $numOfStudents . '"'; ?>></td>
					</tr>

					<tr>
						<td><label for="time">Required Time :</label></td>
						<td><input type="text" placeholder="" name="requiredTime" <?php echo 'value="' . $requiredTime . '"'; ?>></td>
					</tr>

			<tr>
		<div class="option">
      <td>
      <button  type="submit" name="submit">Save</button>
      <button style="background-color: red;" type="reset" name="reset">Cancel</button>
       </td>
      <td></td>
      </div> 
  </tr>
</table>
</form>
</div>	

	<div class="footer">
		<center><p>&copy;University of Vavuniya-FAS | TaskTimer Workload Management System</p></center>
	</div>
	<!--<script>
		function myFunction() {
		  var x = document.getElementById("mynav");
		  if (x.className === "nav") {
		    x.className += " responsive";
		  } else {
		    x.className = "nav";
		  }
		}
	</script>-->

</body>
</html>
<?php 
mysqli_close($connection);
?>