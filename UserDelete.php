
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

if (isset($_GET['id'])) {
    // getting the user information
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $sql1 = "SELECT ENo FROM usertable WHERE EmployeeID = '{$_SESSION['EmployeeID']}'";
    $result = mysqli_query($connection, $sql1);

    if ( $id == $result ) {
        // should not delete current user
        header('Location: UserView.php?err=cannot_delete_current_user');
    } else {
        // deleting the user
        $query = "UPDATE usertable SET is_deleted = 1 WHERE ENo = {$id} LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            // user deleted
            header('Location: UserView.php?msg=user_deleted');
        } else {
            header('Location: UserView.php?err=delete_failed');
        }
    }
    
} else {
    header('Location: UserView.php');
}

?>
