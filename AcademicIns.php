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
	<title>Academic Instructions</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.leftcon{
			margin-top: 25px;
		}

		 .content{
		 	min-height: 48vh;
		 	display: flex;
		 	justify-content: space-between;
		 	margin: 65px 60px 30px 100px;
		 	z-index: -1;
		 }
		.leftcon{
		 	display: flex;
		 	flex-direction: column;
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

		.mySlides {display: none;}
		img {vertical-align: middle;}

		/* Slideshow container */
		.slideshow-container {
		  max-width: 650px;
		  position: relative;
		  margin: auto;
		}

		/* The dots/bullets/indicators */
		.dot {
		  height: 15px;
		  width: 15px;
		  margin: 0 2px;
		  background-color: #bbb;
		  border-radius: 50%;
		  display: inline-block;
		  transition: background-color 0.6s linear;
		}

		.active {
		  background-color: #717171;
		}
		.img{
			border-radius: 25px;
		}

		/* Fading animation */
		.fade {
		  animation-name: fade;
		  animation-duration: 1.5s;
		}

		@keyframes fade {
		  from {opacity: .7} 
		  to {opacity: 1}
		}

		/* On smaller screens, decrease text size */
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
			<li>Academic Instructions</li>
		</ul>
	</div>

	<div class="content">
		<div class="leftcon">
			<div class="option"><a href="TheorySessionView.php">Theory Sessions</a></div>
			<div class="option"><a href="PracticalSessionsView.php">Practical Sessions</a></div>
			<div class="option"><a href="Evolution.php">Evaluation</a></div>
			<div class="option"><a href="other.php">Other</a></div>
			
		</div>
		<div class="rightcon">
			<div class="slideshow-container">
				<div class="mySlides fade">
				  <img class="img" src="bg images/img4.jpeg" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <img class="img" src="bg images/img5.jpeg" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <img class="img" src="bg images/img6.jpeg" style="width:100%">
				</div>

			</div>
			<br>

			<div style="text-align:center">
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			</div>

			<script>
				let slideIndex = 0;
				showSlides();

				function showSlides() {
				  let i;
				  let slides = document.getElementsByClassName("mySlides");
				  let dots = document.getElementsByClassName("dot");
				  for (i = 0; i < slides.length; i++) {
				    slides[i].style.display = "none";  
				  }
				  slideIndex++;
				  if (slideIndex > slides.length) {slideIndex = 1}    
				  for (i = 0; i < dots.length; i++) {
				    dots[i].className = dots[i].className.replace(" active", "");
				  }
				  slides[slideIndex-1].style.display = "block";  
				  dots[slideIndex-1].className += " active";
				  setTimeout(showSlides, 3000); // Change image every 2 seconds
			}
			</script>
		</div>
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