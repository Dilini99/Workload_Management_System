<?php session_start();?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php 
    // check for form submission
    if (isset($_POST['login'])) {

        $errors = array();

        // check if the username and password has been entered
        if (!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1 ) {
            $errors[] = 'Username is Missing / Invalid';
        }

        if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
            $errors[] = 'Password is Missing / Invalid';
        }

		if (!isset($_POST['academicyear']) || strlen(trim($_POST['academicyear'])) < 1 ) {
            $errors[] = 'Academic year is missing';
        }

        // check if there are any errors in the form
        if (empty($errors)) {
            // save username and password into variables
            $EmployeeID         = mysqli_real_escape_string($connection, $_POST['username']);
            $PassWord   = mysqli_real_escape_string($connection, $_POST['password']);
			$AcademicYear   = mysqli_real_escape_string($connection, $_POST['academicyear']);
            $Hashed_password = sha1($PassWord);

            // prepare database query
            $query = "SELECT * FROM usertable 
                        WHERE EmployeeID = '{$EmployeeID}' 
                        AND Password = '{$Hashed_password}' 
                        LIMIT 1";

			$academicYearQuery = "SELECT * FROM academicyear 
				WHERE Academic_year = '{$AcademicYear}' 
				LIMIT 1";

            $result_set = mysqli_query($connection, $query);
			$academicYearResult = mysqli_query($connection, $academicYearQuery);


            verify_query($result_set);
			verify_query($academicYearResult);

            // query successful

            if (mysqli_num_rows($result_set) == 1) {
                // valid user found
                $user = mysqli_fetch_assoc($result_set);
				$academicYear = mysqli_fetch_assoc($academicYearResult);

                $_SESSION['EmployeeID'] = $user['EmployeeID'];
                $_SESSION['FullName'] = $user['FullName'];
                $_SESSION['Actor'] = $user['Actor'];
				$_SESSION['Academic_year'] = $academicYear['Academic_year'];

                
                $query = "UPDATE usertable SET LastLogin = NOW() ";
                $query .= "WHERE EmployeeID = '{$_SESSION['EmployeeID']}' LIMIT 1";

                $result_set = mysqli_query($connection, $query);

                verify_query($result_set);
                // updating last login

                // redirect to the appropriate page
                if ($user['Actor'] == 'Admin') {
                    header('Location: adminPage.php');
                } else {
                    header('Location: main.php');
                }
            } else {
                // user name and password invalid
                $errors[] = 'Invalid Username / Password';
            }
            
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login Page</title>
	<link rel="stylesheet" type="text/css" href="">
	<style>
		* {box-sizing: border-box;}
		.logo img{
			width: 350px;
			height: 90px;
			margin-top: 1px;
		}
        p.error{
            background:red;
            color: white;
            padding: 10px;
        }
		p.info{
            background:green;
            color: white;
            padding: 10px;
        }
		.login{
			color: black;
			
			background: 
			    -webkit-linear-gradient(to right, #FFFFFF, #FFFFFF);
			background: 
			    linear-gradient(to right, #FFFFFF, #FFFFFF);
			margin: 100px 0;
			box-shadow: 
				0px 2px 10px rgba(0,0,0,0.2),
				0px 10px 20px rgba(0,0,0,0.3),
				0px 30px 60px 1px rgba(0,0,0,0.5);
			border-radius: 10px;
			padding: 42px 55px 60px 55px;
			height: 550px;
			width: 500px;
		}

		.login .head .websitename{
			margin-top: 8px;
			font-size: 2.2em;
		}
		.login .form input[type=text].text{
			padding: 10px;
			border: 2px solid black;
			border-radius: 15px;
			background: none;
			box-shadow: 0px 2px 0px 0px white;
			width: 100%;
			margin-top: 20px;
			color: black;
			font-size: 1.2em;
			outline: none;
		}

		.form select.text {
            padding: 10px;
            border: 2px solid black;
            border-radius: 15px;
            background: none;
            box-shadow: 0px 2px 0px 0px white;
            width: 100%;
            margin-top: 20px;
            color: black;
            font-size: 1.2em;
            outline: none;
			margin-bottom: 20px;

		}
		.login .form input[type=password].password{
			padding: 10px;
			border: 2px solid black;
			border-radius: 15px;
			background: none;
			box-shadow: 0px 2px 0px 0px white;
			width: 100%;
			color: black;
			font-size: 1.2em;
			outline: none;
			margin-top: 25px;
		}
		.login .form .text::placeholder{
			color: black;
		}
		.login .form .password::placeholder{
			color: black;
		}
		.btn-login{
			background-color: #2C2A7D;
			color: white;
			text-decoration: none;
			border-radius: 10px;
			color: whitesmoke;
			box-shadow: 0px 0px 0px 2px white;
			padding: 8px 1em;
			transition: 0.5s;
			font-size: 1.1em;
		}
		.forgot{
			text-decoration: none;
			color: black;
			font-size: 1.1em;
		}

		
	</style>
</head>
<body>
	
		<center><section class="login" id="login">
			<div class="logo"><img src="pictures/vau.png"></div>
			<div class="head"><h1 class="websitename">TaskTimer</h1></div>
			 
			<div class="form">
				<form action="login.php" method="post">
                   
				<?php 
					if (isset($errors) && !empty($errors)) {
						echo '<p class="error">Invalid Username / Password</p>';
					}
				?> 
				<?php
				if(isset($_GET['logout'])){
					echo '<p class="info">You have successfully logged out from the system</p>';

				}
				?>
                   
					<input type="text" placeholder="User Name" class="text" name="username" id="username" required><br>
					<input type="password" placeholder="Password" name="password" class="password"><br>

					<select id="academicyear" name="academicyear" class="text">
					<option value="" disabled selected>Select an academic year</option>

            <?php
           
            // Fetch Academic_year values from the academicyear table
            $sql = "SELECT Academic_year FROM academicyear";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // Output each Academic_year value as an option in the dropdown
                while ($row = $result->fetch_assoc()) {
                    $academicYear = $row["Academic_year"];
                    echo "<option value='$academicYear'>$academicYear</option>";
                }
            } else {
                echo "<option value=''>No Academic Years found</option>";
            }
            ?>
        </select>











				<!--	<input type="text" placeholder="Academic year" class="text" name="academicyear" id="academicyear" required><br>-->
			
					<button type="submit" class="btn-login" id="do-login" name="login">Log In</button>
				
					<!--<a href="#" class="btn-create" id="do-create">Create Account</a>-->
				</form>
			</div>
		</section></center>
	
	<script src="./script.js"></script>
</body>
</html>
<?php 
mysqli_close($connection);
?>