
<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php
    // checking if a user is logged in
	if (!isset($_SESSION['EmployeeID'])) {
		header('Location: login.php');
	}
if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($connection,$_GET['id']);

    // deleting the user
    $query = "UPDATE academic_instructions_theory_lecture_sessions SET is_deleted = 1 WHERE TNo = {$id} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        // user deleted
        header('Location: TheorySessionView.php?msg=user_deleted');
    } else {
        header('Location: TheorySessionView.php?err=delete_failed');
    }

} else {
header('Location: TheorySessionView.php');
}
?>
