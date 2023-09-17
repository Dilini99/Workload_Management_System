<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php

$sql = "SELECT SUM(total_time) AS total_sum FROM (
    SELECT Round(SUM(ActualLectureTime+PreperationTimeOfPracticalSessions)) AS total_time
    FROM academic_instructions_practical_lecture_sessions
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT round(SUM(ActualLectureTime+quiz_ass_tu)) AS total_time
    FROM academic_instructions_theory_lecture_sessions
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(Required_Time) AS total_time
    FROM practical_field_visits
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(Required_Time) AS total_time
    FROM practical_viva_sessions
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(EvolutionTime) AS total_time
    FROM 4th_year_research
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(EvolutionTime) AS total_time
    FROM intern_supervision
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(t1.TotalTime + t2.TotalTime) AS total_time
    FROM marking_exam_papers AS t1
    JOIN marking_exam_papersP AS t2 ON t1.EmployeeID = t2.EmployeeID
    WHERE t1.EmployeeID = '{$_SESSION['EmployeeID']}'
        AND t1.Academic_year = '{$_SESSION['Academic_year']}'
        AND t1.is_deleted = 0
    UNION
    SELECT SUM(t1.TotalTime + t2.TotalTime) AS total_time
    FROM moderating_exam_papers AS t1
    JOIN moderating_exam_papersP AS t2 ON t1.EmployeeID = t2.EmployeeID
    WHERE t1.EmployeeID = '{$_SESSION['EmployeeID']}'
        AND t1.Academic_year = '{$_SESSION['Academic_year']}'
        AND t1.is_deleted = 0
    UNION
    SELECT SUM(t1.TotalTime + t2.TotalTime) AS total_time
    FROM setting_exam_papers AS t1
    JOIN setting_exam_papers_practical AS t2 ON t1.EmployeeID = t2.EmployeeID
    WHERE t1.EmployeeID = '{$_SESSION['EmployeeID']}'
        AND t1.Academic_year = '{$_SESSION['Academic_year']}'
        AND t1.is_deleted = 0
    UNION
    SELECT SUM(EvolutionTime) AS total_time
    FROM 3rd_year_group_project
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(TotalTime) AS total_time
    FROM computation_results
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(TotalTime) AS total_time
    FROM evolution_quiz_assignments_tutorials
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(TotalTime) AS total_time
    FROM evolution_practical_reports
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
) AS subquery";

$result = $connection->query($sql);

// Check if query was successful
if ($result && $result->num_rows > 0) {
	// Get the total time from the query result
	$row = $result->fetch_assoc();
	$total_time1 = $row['total_sum'];
} else {
	// Set the total time to 0 if there are no results
	$total_time1 = 0;
}
?>
<?php

$sql = "SELECT SUM(`direct_PGS` + `aca_advis` + `per_men` + `stu_cor` + `aca_coor` + `research_p` + `aca_sub_coor` + `aca_eve_coor` + `new_degree` + `new_course` + `resour_per` + `infra_dev` + `meeting` + `stu_advi_board` + `board_of_stu` + `VC_DVC` + `dean` + `proctor` + `stu_counce` + `coordinator` + `senior_tresh` + `advi_ndp` + `country_rep` + `outreach_act` + `coor_confere` + `serving_office` + `proffesional_dev` + `staff_dev` + `advance_prof` + `TEC` + `other`) AS total FROM `academic_cor` WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year='{$_SESSION['Academic_year']}'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$totalc = $row['total'];


?>

<?php

$sql = "SELECT SUM(no_of_research + mem_of_rct + ref_jour + non_ref_jour + conference_ppr + extended_abs + abstract + author_chap_of_bk + author_monograph + author_policyppr + author_consultancy_repo + soft_dev + media_pro + translation_pub + peer_reviewed + Editor + co_editor + member_editorial + chair_national + chair_international + workshop_cor + reviewer) AS total FROM research_supervision WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year='{$_SESSION['Academic_year']}'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$totalr = $row['total'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Workload Summary</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>






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
		th,td{
			padding: 20px;
		}
		.errmsg{
	margin: 20px 0;
	color: red;
  }

		.label{
			font-size: 25px;
			height: 25px;
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

		
		.option{
		 	margin:23px;
		 	border-radius: 5px;
		 	padding: 10px 5px;
		 	text-align: left;
		}
		.option a{
		 	color: #414190;
		 	font-size: 1.4em;
		 	text-decoration: none;
		 	font-weight: bold;
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
 	    width: 200px;
	}
		
	
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

	</style>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const tiInput = document.getElementById('ti');
    const tcInput = document.getElementById('tc');
    const trInput = document.getElementById('tr');
    const gtInput = document.getElementById('gt');

    // Calculate the grand total
    function calculateGrandTotal() {
      const ti = parseFloat(tiInput.value) || 0;
      const tc = parseFloat(tcInput.value) || 0;
      const tr = parseFloat(trInput.value) || 0;

      const grandTotal = ti + tc + tr;
      gtInput.value = grandTotal.toFixed(2);
    }

    // Call the calculateGrandTotal function initially
    calculateGrandTotal();

    // Call the calculateGrandTotal function whenever any of the input values change
    tiInput.addEventListener('input', calculateGrandTotal);
    tcInput.addEventListener('input', calculateGrandTotal);
    trInput.addEventListener('input', calculateGrandTotal);
  });
</script>




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
			
			<li>Workload Summary</li>
		</ul>
	</div>


	<div class="content">
		<div class="table">
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

				<?php

				?>

			<div id="content">
			<form method="post">
		
			


            <tr>
				<td>
					<label for="ti">Total Time for Academic instructins  (hours):</label></td>
					<td>:</td>
				<td><input type="number" placeholder=" " style="text-align:right" name="ti" id="ti" value="<?php echo $total_time1; ?>" readonly></td>
			</tr>
            
            <tr>
				<td>
					<label for="tc">Total Time for Academic coordination   (hours):</label></td>
					<td>:</td>
				<td><input type="number" placeholder=" "style="text-align:right"  name="tc" id="tc" value="<?php echo $totalc; ?>" readonly></td>
			</tr>

            
            <tr>
				<td>
					<label for="tr">Total Time for Research Supervision   (hours):</label></td>
					<td>:</td>
				<td><input type="number" placeholder=" "style="text-align:right"  name="tr" id="tr"  value="<?php echo $totalr; ?>" readonly></td>
			</tr>

            <!-- ********************************************************** -->

            <tr>
				<td>
					<label for="gt">Grand Total of the workload   (hours):</label></td>
					<td>:</td>
				<td><input type="number" placeholder=" " style="text-align:right" name="gt" id="gt"></td>
			</tr>
	
			<tr>
				<td></td>
				<td></td>

				<td>
				<a href="workload_download.php" target="_blank"><button type="button" class="btn btn-info">Download Report</button></a>
				</td>
			</tr>
		</form>

	</table>



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
