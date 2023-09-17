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
$fullname = '';
$department = '';
$position = '';
$email = '';
$password = '';



if(isset($_POST['submit'])){

$fullname = $_POST['fullname'];
$department = $_POST['department'];
$position = $_POST['position'];
$email = $_POST['email'];
$password = $_POST['password'];

  //Checking required field

$req_fields = array('fullname','department','position','email','password');

$errors = array_merge($errors,check_req_fields($req_fields));

//checking max length
$max_len_fields = array('fullname' =>100,'department' =>50,'position'=>30,'email'=>50,'password'=>10);

foreach($max_len_fields as $field => $max_len){
  if(strlen(trim($_POST[$field])) > $max_len){
    $errors[]=$field.' must be less than '. $max_len.' characters';
  }
}




if(empty($errors)){
  $fullname = mysqli_real_escape_string($connection,$_POST['fullname']);
  $department = mysqli_real_escape_string($connection,$_POST['department']);
  $position = mysqli_real_escape_string($connection,$_POST['position']);
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $password = mysqli_real_escape_string($connection,$_POST['password']);
    $hashed_password = sha1($password);


  $query = "UPDATE usertable SET ";
  $query .= "FullName = '{$fullname}',";
  $query .= "Department = '{$department}',";
  $query .= "Position = '{$position}',";
  $query .= "EmailID = '{$email}',";
  $query .= "Password = '{$hashed_password}'";
  $query .= "WHERE EmployeeID = '{$_SESSION['EmployeeID']}' LIMIT 1";

  

  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: profile.php?user_added=true');
  }else{
    $errors[]= 'Failed to add the new record';
  }
}









}
?>




<?php

/*

// image upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["profile_photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["profile_photo"]["name"])). " has been uploaded.";

        // store file path in database
        $sql = "INSERT INTO usertable (ProfileImage) VALUES ('$target_file')";
        if (mysqli_query($conn, $sql)) {
            echo "File path saved in database successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}*/
?>








<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Profile Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		
		input[type=text], select, input[type=date],input[type=time],input[type=email],input[type=password],textarea {
  width: 60%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  font-size: 1.06em;
  padding: 12px 23px 12px 0;
  display: inline-block;
  text-align: left;
}

.wrapper{
  height: 290px;
  width: 290px;
  position: relative;
  border: 5px solid #fff;
  border-radius: 50%;
  background: url('pictures/profile.webp');
  background-size: 100% 100%;
  margin: 50px auto;
  overflow: hidden;
}
.my_file{
  position: absolute;
  bottom: 0;
  outline: none;
  color: transparent;
  width: 100%;
  box-sizing: border-box;
  padding: 25px 120px;
  cursor: pointer;
  transition: 0.5s;
  background: rgba(0, 0, 0,0.5);
  opacity: 0.5;
}
.my_file::-webkit-file-upload-button{
  visibility: hidden;

}
.my_file::before{
  content: '\f030';
  font-size: 35px;
  font-family: fontAwesome;
  color: #fff;
  display: inline-block;
  -webkit-user-select: none;
}

.my_file::after{
  content: 'Update';
  font-weight: bold;
  color: #fff;
  display: block;
  top: 65px;
  font-size: 15px;
  position: absolute;
}
.my_file:hover{
  opacity: 1;
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
  margin: 0 160px;

}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
  
}

.col-75 {
  float: left;
  width: 75%;
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
.id input[type=text]{
  display: none;
}
.id label{
  width: 100px;
}
	
.errmsg{
	margin: 20px 0;
	color: red;
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
			<li>Profile</li>
		</ul>
	</div>
 

<?php
  if(!empty($errors)){
    display_errors($errors);
  }
?>

  	<form action="profile.php" method="post" enctype="multipart/form-data">

          <div class="wrapper">
                  <input type="file" class="my_file" id="profile_photo" name="profile_photo">
                </div>
        <div class="container">
      <div class="row">
          <div class="col-25">
            <label for="firstname">Full Name :</label>
          </div>
          <div class="col-75">
            <input type="text" id="fullname" name="fullname" placeholder="Your full Name.." <?php echo 'value="' . $fullname . '"'; ?>>
          </div>
      </div>
    



      <div class="row">
          <div class="col-25">
            <label for="department">Department :</label>
          </div>
            <div class="col-75">
              <select id="department" name="department" <?php echo 'value="' . $department . '"'; ?>>
                <option value="Physical Science">Physical Science</option>
                <option value="Bio Science">Bio Science</option>
              </select>
            </div>
      </div>

      <div class="row">
          <div class="col-25">
            <label for="position">Position :</label>
          </div>
            <div class="col-75">
              <select id="position" name="position" <?php echo 'value="' . $position . '"'; ?>>
                <option value="HOD">Head of Department/Division</option>
                <option value="SPF">Senior Professor/Professor</option>
                <option value="AF">Associate Professor</option>
                <option value="SLG">Senior Lecturer Grade I and II</option>
                <option value="L">Lecturer/Probationary Lecturer</option>
                <option value="SI">Senior ETA/ETA Grade I/Instructor Grade II</option>
                <option value="I">ETA Grade II/Instructor Grade II</option>
              </select>
            </div>
      </div>
     
      <div class="row">
          <div class="col-25">
            <label for="email">Email :</label>
          </div>
          <div class="col-75">
            <input type="email" id="email" name="email" placeholder="Your Email.." <?php echo 'value="' . $email . '"'; ?>>
          </div>
      </div>

      <div class="row">
          <div class="col-25">
            <label for="email">Password :</label>
          </div>
          <div class="col-75">
            <input type="password" id="password" name="password" placeholder="">
          </div>
      </div>

      <center><div class="option">
      <button  type="submit" name="submit" value="Upload">Save</button>
      <button style="background-color: red;" type="reset" name="reset">Cancel</button>
</div></center>
    
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