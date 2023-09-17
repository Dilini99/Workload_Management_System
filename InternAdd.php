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
$position = '';
$stRegNo = '';
$stName = '';
$courseCode = '';
$startDate = '';
$endDate = '';
$evolutionTime = '';



if(isset($_POST['submit'])){

    $position = $_POST['position'];
    $stRegNo = $_POST['stRegNo'];
    $stName = $_POST['stName'];
    $courseCode = $_POST['coursecode'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $evolutionTime = $_POST['etime'];


  //Checking required field

$req_fields = array('position','stRegNo','stName','coursecode','startDate','coursecode','startDate','endDate');

foreach($req_fields as $field){
  if(empty(trim($_POST[$field]))){
    $errors[]=$field.' is required.';
  }
}


if(empty($errors)){
 $RegNo =mysqli_real_escape_string($connection,$_POST['stRegNo']);   
  $StudentName = mysqli_real_escape_string($connection,$_POST['stName']);
  $CourseCode = mysqli_real_escape_string($connection,$_POST['coursecode']);
  $position = mysqli_real_escape_string($connection,$_POST['position']);
  $StartDate = mysqli_real_escape_string($connection,$_POST['startDate']);
  $EndDate = mysqli_real_escape_string($connection,$_POST['endDate']);
  $EvolutionTime = mysqli_real_escape_string($connection,$_POST['etime']);

  $query = "INSERT INTO intern_supervision ( ";
  $query .=  "EmployeeID,RegNo,StudentName,CourseCode,Position,StartDate,EndDate,EvolutionTime,Academic_year,is_deleted";
  $query .= ") VALUES (";
  $query .= "'{$_SESSION['EmployeeID']}','{$RegNo}','{$StudentName}','{$CourseCode}','{$position}','{$StartDate}','{$EndDate}','{$EvolutionTime}','{$_SESSION['Academic_year']}',0";
  $query .= ")";

  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: InternView.php?record_added=true');
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
  

	<style>
		
		input[type=text], select, input[type=date],input[type=time],textarea {
  width: 300%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
.errmsg{
	margin: 20px 0;
	color: red;
  }

label {
  font-size: 1.06em;
  padding: 12px 30px 12px 0;
  display: inline-block;
  margin-left: 20px;
}

.option {
  margin: 60px 0;

}

.option a{
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

.content{
  min-height: 48vh;
}

.container {
  border-radius: 5px;
  padding: 20px;
  display: flex;
  margin: 60px 60px;
  flex-flow: row wrap;
  flex-grow: 1;
}
.leftcon,.rightcon{
  width: 50%;
  padding: 10px 30px;

}
.option button {
		
		
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
.col-25 {
  float: left;
  width: 80%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 20%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
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
        <li><a href="academicIns.php">Academic Instructions</a></li>
        <li><a href="other.php">Other</a></li>
      <li><a href="InternView.php">Internship Supervision</a></li>
			<li>Add New</li>
		</ul>
	</div>

	<div class="container">
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
  <form action="InternAdd.php" method="post">

  <div class="row">
      <div class="col-25">
        <label for="stRegNo">Reg No :</label>
      </div>
      <div class="col-75">
      <input type="text" id="stRegNo" name="stRegNo" placeholder="Registration number.." <?php echo 'value="' . $stRegNo . '"'; ?>>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="stName">Student Name :</label>
      </div>
      <div class="col-75">
      <input type="text" id="stName" name="stName" placeholder="Student Name.." <?php echo 'value="' . $stName . '"'; ?>>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="coursecode">Course Code :</label>
      </div>
      <div class="col-75">
      <input type="text" id="coursecode" name="coursecode" placeholder="Course code.." <?php echo 'value="' . $courseCode . '"'; ?>>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="resTitle">Position :</label>
      </div>
      <div class="col-75">
        <input type="text" id="position" name="position" placeholder="Position.." <?php echo 'value="' . $position . '"'; ?>>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="startDate">Start Date :</label>
      </div>
      <div class="col-75">
        <input type="date" id="startDate" name="startDate" placeholder="Start Date.." <?php echo 'value="' . $startDate . '"'; ?>>
      </div>
    </div>


    <div class="row">
      <div class="col-25">
        <label for="endDate">End Date :</label>
      </div>
      <div class="col-75">
        <input type="date" id="endDate" name="endDate" placeholder="End Date.." <?php echo 'value="' . $endDate . '"'; ?>>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="time">Evolution Time hours:</label>
      </div>
      <div class="col-75">
        <input type="text" id="etime" name="etime" placeholder="" readonly <?php echo 'value="' . $evolutionTime . '"'; ?>>
      </div>
    </div>    
 <script>
  // Get references to the form elements
  const noOfStudents = document.getElementById("stRegNo");
  const weeksInput = document.getElementById("etime");

  // Listen for changes to the StartDate and EndDate inputs
  noOfStudents.addEventListener("change", calculateTime);

  function calculateTime() {

    weeksInput.value = 1*1*15;
  }
</script>
   

    

        <center><div class="option">
    <button  type="submit" name="submit">Save</button>
        <button style="background-color: red;" type="reset" name="reset">Cancel</button>     
    </div></center>
    
  </form>
  </div>
  
</div>


	<div class="footer">
		<center><p>&copy;University of Vavuniya-FAS | TaskTimer Workload Management System</p></center>
	</div>
</body>
</html>