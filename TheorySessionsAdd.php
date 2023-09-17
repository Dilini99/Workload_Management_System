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

$year = '';
$Semester = '';
$coursecode = '';
$noOfCredits = '';
$noOfStudents= '';
$ActualHours= '';

if(isset($_POST['submit'])){


$year = $_POST['year'];
$Semester = $_POST['semester'];
$coursecode = $_POST['coursecode'];
$noOfCredits = $_POST['noOfCredits'];
$noOfStudents = $_POST['noOfStudents'];
$ActualHours = $_POST['ActualHours'];




  //Checking required field

$req_fields = array('year','semester','coursecode','noOfCredits','noOfStudents','ActualHours');

foreach($req_fields as $field){
  if(empty(trim($_POST[$field]))){
    $errors[]=$field.' is required.';
  }
}

}


?>
<?php
	$nc="";
	$ns="";
	$ltp="";
	$af="";
	$at="";


	
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$nc = floatval($_POST["noOfCredits"]); //number of credits
			$ns = floatval($_POST["noOfStudents"]); //number of Students
			$at = floatval($_POST["ActualHours"]); //number of Students

			if($ns>=1 && $ns<=50)
			{
				$af=1.0;
			}
			elseif($ns>=51 && $ns<=60)
			{
				$af=1.1;
			}
			elseif($ns>=61 && $ns<=70)
			{
				$af=1.2;
			}
			elseif($ns>=71 && $ns<=80)
			{
				$af=1.3;
			}
			elseif($ns>=81 && $ns<=90)
			{
				$af=1.4;
			}
			elseif($ns>=91 && $ns<=100)
			{
				$af=1.5;
			}
			elseif($ns>=101 && $ns<=110)
			{
				$af=1.6;
			}
			elseif($ns>=111 && $ns<=120)
			{
				$af=1.7;
			}
			elseif($ns>=121 && $ns<=130)
			{
				$af=1.8;
			}
			elseif($ns>=131 && $ns<=140)
			{
				$af=1.9;
			}
			elseif($ns>=141 && $ns<=150)
			{
				$af=2.0;
			}
			elseif($ns>=151 && $ns<=160)
			{
				$af=2.1;
			}
			elseif($ns>=161 && $ns<=170)
			{
				$af=2.2;
			}
			elseif($ns>=171 && $ns<=180)
			{
				$af=2.3;
			}
			elseif($ns>=181 && $ns<=190)
			{
				$af=2.4;
			}
			else
			{
				$af=2.5;
			}


			$cdt = 15*$nc;
			$ltp = (15*$nc*1*3)+($at*$af);



		
		
		}



?>
<?php
if(isset($_POST['cancel'])) {
    echo '<script type="text/javascript">';
    echo 'document.querySelectorAll("input[type=\'text\']").forEach(function(node) {node.value = "";});';
    echo '</script>';
}
?>



<?php
if(isset($_POST['submit1'])){
  $year = $_POST['year'];
  $semester = $_POST['semester'];
  $coursecode = $_POST['coursecode'];
  $noOfCredits = $_POST['noOfCredits'];
  $noOfStudents = $_POST['noOfStudents'];
  $actualHours = $_POST['ActualHours'];
  $creditTime = $_POST['creditTime'];

  // Checking required fields
  $req_fields = array('coursecode','noOfCredits','noOfStudents','ActualHours','creditTime');

  foreach($req_fields as $field){
    if(empty(trim($_POST[$field]))){
      $errors[] = $field.' is required.';
    }
  }

  if(empty($errors)){
    $CourseCode = mysqli_real_escape_string($connection, $_POST['coursecode']);
    
    // Check if the course code already exists
    $query = "SELECT CourseCode FROM academic_instructions_theory_lecture_sessions WHERE CourseCode = '$CourseCode'";
    $result = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($result) > 0){
      $errors[] = 'Course code already exists.';
    } else {
      $Year = mysqli_real_escape_string($connection, $_POST['year']);
      $Semester = mysqli_real_escape_string($connection, $_POST['semester']);
      $NumberOfCredits = mysqli_real_escape_string($connection, $_POST['noOfCredits']);
      $NumberOfStudents = mysqli_real_escape_string($connection, $_POST['noOfStudents']);
      $ActualLectureTime = mysqli_real_escape_string($connection, $_POST['ActualHours']);
      $creditTime = mysqli_real_escape_string($connection, $_POST['creditTime']);
      $quiz_ass_tu = mysqli_real_escape_string($connection, $_POST['Lectures_tutorials']);
      
      $query = "INSERT INTO academic_instructions_theory_lecture_sessions ( ";
      $query .= "EmployeeID, Year, Semester, CourseCode, NumberOfCredits, NumberOfStudents, ActualLectureTime, creditTime, Academic_year, quiz_ass_tu, is_deleted";
      $query .= ") VALUES (";
      $query .= "'{$_SESSION['EmployeeID']}', '{$Year}', '{$Semester}', '{$CourseCode}', '{$NumberOfCredits}', '{$NumberOfStudents}', '{$ActualLectureTime}', '{$creditTime}', '{$_SESSION['Academic_year']}', '{$quiz_ass_tu}', 0";
      $query .= ")";
    
      $result = mysqli_query($connection, $query);
    
      if($result){
        header('Location: TheorySessionView.php?user_added=true');
      }else{
        $errors[] = 'Failed to add the new record';
      }
    }
  }
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Theory Sessions Add New</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	

	

	<style>
		* {
			box-sizing: border-box;
			margin:0;

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
			margin: 50px;
			align-items: center;
			flex-direction: row;
		 	justify-content: center;
			display: flex;
			justify-content: space-around;
			min-height: 55vh;
  				}
		
		.table2 .txt{
			font-size: 28px;
			padding: 42px 0;
		}
		.btn button{
			margin-left: 100px;
			margin-top: 90px;
		}
		.btn1 button{
			margin-top: 10px;
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
			<li><a href="TheorySessionView.php">Theory Sessions</a></li>
			<li> Add New</li>
		</ul>
	</div>


	<div class="content">
		<div class="table1">
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
				<td>
					<label for="coursecode">Course Code</label></td>
					<td>:</td>
				
					<td>

				    <select id="coursecode" name="coursecode" class="text">
      <option value="" disabled selected>Select a course</option>
      <?php
      // Fetch course codes from the theory_subjects table
      $sql = "SELECT course_code, Year_of_study, Semester, No_of_credits FROM theory_subjects";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
        // Output each course code as an option in the dropdown
		while ($row = $result->fetch_assoc()) {
			$course_code = $row["course_code"];
			$year_of_study = $row["Year_of_study"];
			$semester = $row["Semester"];
			$no_of_credits = $row["No_of_credits"];
			
			// Check if the current option is the selected option
			$selected = ($coursecode == $course_code) ? "selected" : "";
			
			echo "<option value='$course_code' data-year='$year_of_study' data-semester='$semester' data-credits='$no_of_credits' $selected>$course_code</option>";
		}
      } else {
        echo "<option value=''>No course codes found</option>";
      }
      ?>
    </select>


					</td>
					
			</tr>
			
			<tr>
				<td>
					<label for="year">Year</label></td>
					<td>:</td>
				<td><input type="text" placeholder=" " name="year" id="year" <?php echo 'value="' . $year . '"'; ?> readonly ></td>
			</tr>
			<td>
					<label for="semester">Semester</label></td>
					<td>:</td>
				<td><input type="text" placeholder=" " name="semester" id="semester" <?php echo 'value="' . $Semester . '"'; ?> readonly ></td>
			</tr>

			<tr>
				<td>
					<label for="credits">Number Of Credits</label></td>
					<td>:</td>
				<td><input type="text" placeholder=" " name="noOfCredits" id="noOfCredits" <?php echo 'value="' . $noOfCredits . '"'; ?> readonly ></td>
			</tr>


			<script>
  // Get references to the select and input elements
  var courseSelect = document.getElementById("coursecode");
  var yearInput = document.getElementById("year");
  var semesterInput = document.getElementById("semester");
  var creditsInput = document.getElementById("noOfCredits");

  // Add event listener to the course select element
  courseSelect.addEventListener("change", function() {
    // Get the selected option
    var selectedOption = courseSelect.options[courseSelect.selectedIndex];

    // Update the values of the other input fields
    yearInput.value = selectedOption.getAttribute("data-year");
    semesterInput.value = selectedOption.getAttribute("data-semester");
    creditsInput.value = selectedOption.getAttribute("data-credits");
  });
</script>



			
			<tr>
				<td>
					<label for="students">Number Of Students</label></td>
					<td>:</td>
				<td><input type="text" placeholder=" " name="noOfStudents" id="noOfStudents" <?php echo 'value="' . $noOfStudents . '"'; ?>></td>
			</tr>

			<tr>
				<td>
					<label for="students">Actual Hours Spent</label></td>
					<td>:</td>
				<td><input type="text" placeholder=" " name="ActualHours" id="ActualHours" <?php echo 'value="' . $ActualHours . '"'; ?>></td>
			</tr>
		
			

			<tr>
			

			<tr class="btn1">
				<td></td>
   				<td> <button  type="submit" name="submit" id="submit" onclick="disableFields()">Save</button></td>  
   				<td><button style="background-color: red;" type="submit" name="cancel">Cancel</button></td>
      
			</tr>

	</table>

 </div>	
 <div class="table2">
 	<table>
 		<tr>
			<td class="txt"><b>Total Time For</b></td>
			<td></td>
		</tr>
		


		<tr>
			<td><label for="practical">Hours should have been spent in the class as per the Theory credits</label></td>
					<td>:</td>
				<td><input type="text" name="creditTime" placeholder=" "  value="<?php if (isset($cdt)) echo $cdt; ?>" readonly></td>
				
		</tr>	
			
		

		<tr>
			<td><label for="pre">Lectures/ Tutorials/ Presentations (hours)</label></td>
					<td>:</td>
				<td><input type="text" name="Lectures_tutorials" placeholder="" value="<?php if (isset($ltp)) echo $ltp; ?>" readonly></td>
		</tr>
		
			<tr class="btn">
   				<td> <button  type="submit" name="submit1">Submit</button></td>  
   				
      
			</tr>
 	</table>
	 </form>

 </div>
 	</div>	

 
	
	<div class="footer">
		<center><p>&copy;University of Vavuniya-FAS | TaskTimer Workload Management System</p></center>
	</div>

</body>
</html>
<?php 
mysqli_close($connection);
?>
