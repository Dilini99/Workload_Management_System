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
$id ='';
$employeeid='';
$fullname = '';

$email = '';




if(isset($_GET['id'])){
      $id = mysqli_real_escape_string($connection,$_GET['id']);
      $query = "SELECT  ENo,EmployeeID,FullName,EmailID,LastLogin
          FROM usertable
          WHERE ENo = {$id} LIMIT 1";
  
      $result_set = mysqli_query($connection, $query);
  
      if($result_set){
          if(mysqli_num_rows($result_set) == 1){
              // record found
              $result = mysqli_fetch_assoc($result_set);

              $employeeid = $result['EmployeeID'];
              $fullname = $result['FullName'];
              $email = $result['EmailID'];
             
  
          } else {
              // record not found
              header('Location: UserView.php?err=record_not_found');
              exit;
          }
      } else {
          // query unsuccessful
          header('Location: UserView.php?err=query_failed');
          exit;
      }
  }
  



if(isset($_POST['submit'])){

$id = $_POST['id'];
$password = $_POST['password'];

$req_fields = array('id','password');

$errors = array_merge($errors,check_req_fields($req_fields));


if(empty($errors)){
  $password = mysqli_real_escape_string($connection,$_POST['password']);  
  $hashedpassword = sha1($password);

 
  
 

  $query = "UPDATE usertable SET ";
  $query .= "Password = '{$hashedpassword}'";
  $query .= "WHERE ENo = {$id} LIMIT 1";

 
  

  $result = mysqli_query($connection,$query);

  if($result){
    header('Location: UserView.php?record_modified=true');
  }else{
    $errors[]= 'Failed to modify the new record';
  }
}









}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    	input[type=text], select, input[type=date],input[type=time],input[type=email],input[type=password], textarea {
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
.content{
  margin: 50px;
  min-height: 60vh;
}
button {
		
		
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		font-size:  1.2em;
  		background-color: #2C2A7D;
  		color: whitesmoke ;
  		padding: 10px;
  		text-decoration: none;
  		border-radius: 12px;
  		display: inline-block;
 	    width: 200px;
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
      
     

      <div class="breadcrumb">
            <ul class="bc">
            <li><a href="main.php">Home</a></li>
			<li><a href="UserEdit.php">Edit users</a></li>
			
                  <li>Change Password</li>
                  
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


<form action="changePassword.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="row">
    <div class="col-25">
      <label for="firstname">Employee ID :</label>
    </div>
    <div class="col-75">
      <input type="text" id="employeeid" name="employeeid" placeholder="" <?php echo 'value="' . $employeeid . '"'; ?> disabled>
    </div>
</div>

<div class="row">
    <div class="col-25">
      <label for="firstname">Full Name :</label>
    </div>
    <div class="col-75">
      <input type="text" id="fullname" name="fullname" placeholder="Your full Name.." <?php echo 'value="' . $fullname . '"'; ?> disabled>
    </div>
</div>



<div class="row">
    <div class="col-25">
      <label for="email">Email :</label>
    </div>
    <div class="col-75">
      <input type="email" id="email" name="email" placeholder="Your Email.." <?php echo 'value="' . $email . '"'; ?> disabled>
    </div>
</div>

<div class="row">
    <div class="col-25">
      <label for="password">New Password :</label>
    </div>
    <div class="col-75">
    <input type="password" name="password" id="password">
    </div>
</div>


<div class="row">
    <div class="col-25">
      <label for="password">Show Password :</label>
    </div>
    <div class="col-75">
    <input type="checkbox" name="showpassword" id="showpassword" style="width:20px; height:20px;">
    </div>
</div>


<center><div class="option">
<button  type="submit" name="submit">Update password</button>
</div></center>

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

      <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
            <script>
               $(document).ready(function(){
			$('#showpassword').click(function(){
				if ( $('#showpassword').is(':checked') ) {
					$('#password').attr('type','text');
				} else {
					$('#password').attr('type','password');
				}
			});
		});
            </script>
</body>
</html>