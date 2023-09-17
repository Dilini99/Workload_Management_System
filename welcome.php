<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome Page</title>
	<style>
		* {box-sizing: border-box;}
		body {font-family: Verdana, sans-serif;}
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
		.content{
			margin: 100px 50px;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
		}
		.img{
			border-radius: 25px;
		}
		.logo img{
			width: 490px;
			height: 138px;
		}
		.p1{
			font-size: 32px;
			opacity: 0.7;
		}
		.p2{
			font-size: 20px;
			opacity: 0.9;
		}
		.left a{
			font-size: 	1.1em;
			background-color: #2C2A7D;
			color: whitesmoke	;
			padding: 10px;
			text-decoration: none;
			border-radius: 10px;
		}
	</style>
</head>
<body>
	<div class="content">
		<div class="left">
			<div class="logo">
					<img src="pictures/vau.png">
					
			</div>
			<br>
			<P class="p1">WELCOME TO <br>WORKLOAD MANAGEMENT SYSTEM</P>
			<p class="p2">Faculty of Applied Science of University of Vavuniya
			<br>Access your all workload information from our web portal
			</p>
			<br>

			<a href="login.php">Get Started</a>
			<br>
		</div>

		<div class="right">
			<br>
			<div class="slideshow-container">
				<div class="mySlides fade">
				  <img class="img" src="bg images/img1.jpeg" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <img class="img" src="bg images/img2.jpeg" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <img class="img" src="bg images/img3.jpeg" style="width:100%">
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
</body>
</html>