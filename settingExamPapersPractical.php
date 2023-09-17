<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>

<!-------------------Setting Exam Papers------------------------------------->

<?php

$errors = array();

$coursecodesetting = '';
$noOfCreditssetting = '';
$requiredtimeforsetting = '';
$actualtimeforsetting = '';

if(isset($_POST['SubmitSetting'])){
   
    $coursecodesetting = $_POST['CourseCodeSetting'];
    $noOfCreditssetting = $_POST['NuOfCreditsSetting'];
    $requiredtimeforsetting = $_POST['ActualTimeSetting'];
	

   
    //Checking required field
    $req_fields = array('CourseCodeSetting','NuOfCreditsSetting','ActualTimeSetting');
    
    foreach($req_fields as $field){
        if(empty(trim($_POST[$field]))){
            $errors[]=$field.' is required.';
        }
    }
}


?>

<?php
	$ncs="";
	$rts="";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$ncs = floatval($_POST["NuOfCreditsSetting"]); //number of credits
			$rts = floatval($_POST["ActualTimeSetting"]); //number of Students
			$totalsetting = round(($ncs *3)+ $rts); // total time
		}
?>


<?php

if(isset($_POST['SubmitSettingFinal'])){

    $coursecodesetting = $_POST['CourseCodeSetting'];
    $noOfCreditssetting = $_POST['NuOfCreditsSetting'];
    $requiredtimeforsetting = $_POST['ActualTimeSetting'];
    $totaltimesetting = $_POST['TimeForSetting'];

  //Checking required field

$req_fields = array('CourseCodeSetting','NuOfCreditsSetting','ActualTimeSetting','TimeForSetting');

foreach($req_fields as $field){
  if(empty(trim($_POST[$field]))){
    $errors[]=$field.' is required.';
  }
}

if(empty($errors)){
  
  $CourseCode =  mysqli_real_escape_string($connection,$_POST['CourseCodeSetting']);
  $NoOfCredits =  mysqli_real_escape_string($connection,$_POST['NuOfCreditsSetting']);
  $ActualTime = mysqli_real_escape_string($connection,$_POST['ActualTimeSetting']);
  $Total_Time_for_setting =mysqli_real_escape_string($connection,$_POST['TimeForSetting']);
 
  $query = "INSERT INTO setting_exam_papers_practical ( ";
  $query .=  "EmployeeID,CourseCode,NumberOfCredits,ActualTime,TotalTime,Academic_year,is_deleted";
  $query .= ") VALUES (";
  $query .=  "'{$_SESSION['EmployeeID']}','{$CourseCode}','{$NoOfCredits}','{$ActualTime}','{$Total_Time_for_setting}','{$_SESSION['Academic_year']}',0";
  $query .= ")";



  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: SettingExamPapersPracticalView.php?user_added=true');
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
	<title>Setting Exam Papers Practical Add New</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script>
		function fillFields() {
    var courseCode = document.getElementById("CourseCodeSetting").value;
    // Extract the relevant characters from the course code
    var credits = courseCode.match(/\d+/)[0].charAt(3);
    // Set the values of the corresponding text boxes
    document.getElementById("NuOfCreditsSetting").value = credits;
}

function clearInputs() {
  document.getElementById("CourseCodeSetting").value = "";
  document.getElementById("NuOfCreditsSetting").value = "";
  document.getElementById("TimeForSetting").value = "";
  document.getElementById("ActualTimeSetting").value = "";
}


	</script>

	

	<style>
		* {
			box-sizing: border-box;
			margin:0;

		}

			.content{
			margin: 50px 15px;
			min-height: 48vh;
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
			<li><a href="SettingExamPapersView.php">Setting Exam Papers</a></li>
			<li>Add new</li>
		</ul>
	</div>


	<div class="content">
			
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset>
			
			<legend align="left" style= "font-family:arial; font-size:200%; color:#2C2A7D">
			Setting Exam Papers</legend>

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
  					<td><label for="CourseCodeSetting">Course code</label></td>
                    <td></td> <td></td> <td></td>

					<td>

<select id="CourseCodeSetting" name="CourseCodeSetting" class="text">
<option value="" disabled selected>Select a course</option>
<?php
// Fetch course codes from the theory_subjects table
$sql = "SELECT course_code,No_of_credits FROM practical_subjects";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
// Output each course code as an option in the dropdown
while ($row = $result->fetch_assoc()) {
$course_code = $row["course_code"];
$no_of_credits = $row["No_of_credits"];

// Check if the current option is the selected option
$selected = ($coursecodesetting == $course_code) ? "selected" : "";

echo "<option value='$course_code' data-credits='$no_of_credits' $selected>$course_code</option>";
}
} else {
echo "<option value=''>No course codes found</option>";
}
?>
</select>


</td>

  				</tr>

  				
				

                  <tr>
  					<td><label for="NuOfCreditsSetting">Number of Credits</label></td>
                      <td></td> <td></td> <td></td>
  					<td><input type="text" id="NuOfCreditsSetting" name="NuOfCreditsSetting"  <?php echo 'value="' . $noOfCreditssetting . '"'; ?> readonly></td>
                    <td></td>
                    <td>(3 hours need for 1 credit course)</td>
  				</tr>

				  <script>
  // Get references to the select and input elements
  var courseSelect = document.getElementById("CourseCodeSetting");
  
  var creditsInput = document.getElementById("NuOfCreditsSetting");

  // Add event listener to the course select element
  courseSelect.addEventListener("change", function() {
    // Get the selected option
    var selectedOption = courseSelect.options[courseSelect.selectedIndex];

    // Update the values of the other input fields
   
    creditsInput.value = selectedOption.getAttribute("data-credits");
  });
</script>


                  <tr>
  					<td><label for="ActualTimeSetting">Actual time type the paper (Hours)</label></td>
                      <td></td> <td></td> <td></td>
  					<td><input type="text" id="ActualTimeSetting" name="ActualTimeSetting" <?php echo 'value="' . $requiredtimeforsetting . '"'; ?>></td>
  				
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
  					<td><label for="TimeForSettingpprs">Required Time (Hours)</label></td>
                      <td></td> <td></td> <td></td>
  					<td><input type="text" id="TimeForSetting" name="TimeForSetting"  value="<?php if (isset($totalsetting)) echo $totalsetting; ?>" readonly></td>
				
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
