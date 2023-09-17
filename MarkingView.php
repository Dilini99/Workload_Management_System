<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Marking Exam Papers View</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


	<style>
		*{
			box-sizing: border-box;
			padding: 0;
			margin: 0;
		}
		.right img{
			height: 72px;
			width: 80px;
		}
		.header{
			display: flex;
			justify-content: space-between;
			padding: 0 50px;
			background-color: #414190;
		}
		.left img{
			height: 70px;
			width: 300px;
		}
		.right, .left{
			padding: 12px 0;
		}
				
		.topnavi {
			margin-top: 1px;
			padding-left: 350px;
		  overflow: hidden;
		  background-color: #a0a0c8;
		}

		.topnavi a {
			float: left;
			display: block;
			text-align: center;
			text-decoration: none;
			font-size: 1.3em;
			color: #ffffff;
			padding: 10px 15px;
		}

		.topnavi .icon {
		  display: none;
		}

		.dropdowns {
		  float: left;
		  overflow: hidden;
		}

		.dropdowns .dropbtns {  		  	
			border: none;
	  	outline: none;
	  	background-color: inherit;
		 	font-family: inherit;
		 	margin: 0;
		  font-size: 1.3em;
			color: #ffffff;
			padding: 10px 15px;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
		}

		.dropdown-content a {
			float: none;
			color: black;
			padding: 12px 19px;
			text-decoration: none;
			display: block;
			text-align: left;
		}

		.topnavi a:hover, .dropdowns:hover .dropbtns {
			background-color: #555;
			color: white;
		}

		.dropdown-content a:hover {
			background-color: #ddd;
			color: black;
		}

		.dropdowns:hover .dropdown-content {
			display: block;
		}

		@media screen and (max-width: 600px) {
			.topnavi a:not(:first-child), .dropdowns .dropbtns {
				display: none;
			}
			.topnavi a.icon {
				float: right;
				display: block;
			}
		}

		@media screen and (max-width: 600px) {
			.topnavi.responsive {position: relative;}
			.topnavi.responsive .icon {
				position: absolute;
				right: 0;
				top: 0;
			}
			.topnavi.responsive a {
				float: none;
				display: block;
				text-align: left;
			}
			.topnavi.responsive .dropdowns {float: none;}
			.topnavi.responsive .dropdown-content {position: relative;}
			.topnavi.responsive .dropdowns .dropbtns {
				display: block;
				width: 100%;
				text-align: left;
			}
		}


		@media screen and (max-width: 500px){
			.nav a:not(:first-child) {display: none;}
			.nav a.icon {
				float: right;
				display: block;
			}
		}
		@media screen and (max-width: 600px) {
			.nav.responsive {position: relative;}
			.nav.responsive .icon {
				position: absolute;
				right: 0;
				top: 0;
			}
			.nav.responsive a {
				float: none;
				display: block;
				text-align: left;
			}
		}

		 ul.bcm {
			padding: 10px 16px;
			list-style: none;
		}
		ul.bcm li {
			display: inline-block;
			font-size: 20px;
		}
		ul.bcm li+li:before {
			padding: 8px;
			color: black;
			content: "/\00a0";
		}
		ul.bcm li a {
			color: #0275d8;
			text-decoration: none;
		}
		ul.bcm li a:hover {
			color: #01447e;
			text-decoration: underline;
		}
		.footers{
			background-color: #414190;
			font-size: 1.3em;
			color: white;
			padding: 15px 0;
			margin-top: 1px;
		}
		.content{
			margin: 50px;
			min-height: 48vh;
		}
		@media only screen and (max-width: 300px) {
		  .text {font-size: 11px}
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
			
            <!--<a href="profile.html"><img src="pictures/user.png" width="20px" height="20px"></a>-->
        </div>
	</div>
	
	<div class="topnavi" id="myTopnav">
	  	<div class="dropdowns">
	    	<button class="dropbtns">Academic Instructions 
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

	<div class="breadcrumbs">
		<ul class="bcm">
			<li><a href="AcademicIns.php">Academic Instructions</a></li>
			<li><a href="Evolution.php">Evaluation </a></li>
			<li>Marking Exam papers </li>
		</ul>
	</div>

	<div class="content">
	
    <div class="container">
   
   <table class="table">
     <thead class="thead-dark">
       <tr>
		 
         <th>Course code</th>
         <th>Number of credits</th>
         <th>Number of students</th>
         <th>Total time</th>
		 <th>Edit</th>
		 <th>Delete</th>
                </tr>
     </thead>
     <tbody>
       <?php
     

       // Fetch data from the database
       $sql = "SELECT Mex,CourseCode,NumberOfCredits,NumberOfStudents,TotalTime FROM marking_exam_papers WHERE EmployeeID = '{$_SESSION['EmployeeID']}' && Academic_year = '{$_SESSION['Academic_year']}' && is_deleted=0";
       $result = mysqli_query($connection, $sql);

       // Loop through the data and display it in the table
       if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
           echo "<tr>";
		   
           echo "<td>" . $row["CourseCode"] . "</td>";
           echo "<td>" . $row["NumberOfCredits"] . "</td>";
           echo "<td>" . $row["NumberOfStudents"] . "</td>";
           echo "<td>" . $row["TotalTime"] . "</td>";
		   echo "<td><a href='MarkingEdit.php?id=" . $row["Mex"] . "'>Edit</a></td>"; 
		   echo "<td><a href='MarkingDelete.php?id=" . $row["Mex"] . "' onclick=\"return confirm('Are you sure?');\">Delete</a></td>"; 

           echo "</tr>";
         }
       } else {
         echo "<tr><td colspan='15'>No data found</td></tr>";
       }

       // Close the database connection
    
       ?>
     </tbody>
   </table>
   <a href="marking.php"><button type="button" class="btn btn-primary">Add New</button></a>
   <a href="marking_download.php"><button type="button" class="btn btn-info">Download</button></a>
 </div>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		
	</div>



	
	<div class="footers">
		<center><p>&copy;University of Vavuniya-FAS | TaskTimer Workload Management System</p></center>
	</div>

</body>
</html>
<?php 
mysqli_close($connection);
?>