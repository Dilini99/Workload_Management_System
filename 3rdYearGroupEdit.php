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
$groupNo ='';
$projectTitle = '';
$noOfStudents='';
$courseCode = '';
$startDate = '';
$endDate = '';
$evolutionTime = '';


if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($connection,$_GET['id']);
  $query = "SELECT GPNo,GroupNo,CourseCode,ProjectTitle,StartDate,EndDate,noOfStudents,EvolutionTime
      FROM 3rd_year_group_project
      WHERE GPNo = {$id} LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if($result_set){
      if(mysqli_num_rows($result_set) == 1){
          // record found
          $result = mysqli_fetch_assoc($result_set);
          $groupNo =$result['GroupNo'];
          $projectTitle = $result['ProjectTitle'];
         
          $courseCode = $result['CourseCode'];
          $startDate = $result['StartDate'];
          $endDate = $result['EndDate'];
          $noOfStudents = $result['noOfStudents'];
          $evolutionTime = $result['EvolutionTime'];
          

      } else {
          // record not found
          header('Location: 3rdYearGroupView.php?err=record_not_found');
          exit;
      }
  } else {
      // query unsuccessful
      header('Location: 3rdYearGroupView.php?err=query_failed');
      exit;
  }
}



if(isset($_POST['submit'])){
  $id = $_POST['id'];
    $groupNo =$_POST['grpNo'];
    $projectTitle = $_POST['title'];
   
    $courseCode = $_POST['coursecode'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $noOfStudents = $_POST['noOfStudents'];
    $evolutionTime = $_POST['etime'];


  //Checking required field

$req_fields = array('id','grpNo','title','coursecode','startDate','endDate','noOfStudents');

foreach($req_fields as $field){
  if(empty(trim($_POST[$field]))){
    $errors[]=$field.' is required.';
  }
}


if(empty($errors)){
 $GroupNo =mysqli_real_escape_string($connection,$_POST['grpNo']);   
  $CourseCode = mysqli_real_escape_string($connection,$_POST['coursecode']);
  $ProjectTitle = mysqli_real_escape_string($connection,$_POST['title']);

  $StartDate = mysqli_real_escape_string($connection,$_POST['startDate']);
  $EndDate = mysqli_real_escape_string($connection,$_POST['endDate']);
  $noOfStudents = mysqli_real_escape_string($connection,$_POST['noOfStudents']);

  $EvolutionTime = mysqli_real_escape_string($connection,$_POST['etime']);

  $query = "UPDATE 3rd_year_group_project SET ";
  $query .= "GroupNo = '{$GroupNo}',";
  $query .= "CourseCode = '{$CourseCode}',";
  $query .= "ProjectTitle = '{$ProjectTitle}',";
  
  $query .= "StartDate = '{$StartDate}',";
  $query .= "EndDate = '{$EndDate}',";
  $query .= "noOfStudents = '{$noOfStudents}',";

  $query .= "EvolutionTime = '{$EvolutionTime}'";
  $query .= "WHERE GPNo = {$id} LIMIT 1";

  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: 3rdYearProjectsView.php?record_updated=true');
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
	<title>3rd Year Project Edit</title>
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
      <li><a href="academicIns.html">Academic Instructions</a></li>
      <li><a href="other.php">Other</a></li>
      <li><a href="3rdYearProjectsView.php">3rd Year Projects</a></li>
			<li>Edit</li>
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
  <form action="3rdYearGroupEdit.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row">
      <div class="col-25">
        <label for="grpNo">Group Number :</label>
      </div>
      <div class="col-75">
        <select id="grpNo" name="grpNo" <?php echo 'value="' . $groupNo . '"'; ?>>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="courseCode">Course Code :</label>
      </div>
      <div class="col-75">
      <input type="text" id="coursecode" name="coursecode" placeholder="Course code.." <?php echo 'value="' . $courseCode . '"'; ?>>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="title">Project Title :</label>
      </div>
      <div class="col-75">
        <input type="text" id="title" name="title" placeholder="Project Title.." <?php echo 'value="' . $projectTitle . '"'; ?>>
      </div>
    </div>
    
    <div class="row">
      <div class="col-25">
        <label for="title">No of students :</label>
      </div>
      <div class="col-75">
        <input type="text" id="noOfStudents" name="noOfStudents" placeholder="No of students.." <?php echo 'value="' . $noOfStudents . '"'; ?>>
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
  const noOfStudents = document.getElementById("noOfStudents");
  const weeksInput = document.getElementById("etime");

  // Listen for changes to the StartDate and EndDate inputs
  noOfStudents.addEventListener("change", calculateTime);

  function calculateTime() {

    weeksInput.value = noOfStudents.value*1*15;
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