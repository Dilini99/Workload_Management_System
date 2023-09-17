<?php
session_start();
require_once('inc/connection.php');
require_once('inc/functions.php');

if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
    exit;
}

$selectedCourse = $_GET['course']; // Assuming the course code is passed as a query parameter

// Prepare the SQL statement with a parameterized query
$sql = "SELECT Year, Semester, NumberOfCredits, NumberOfStudents FROM courses WHERE CourseCode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedCourse); // "s" represents a string parameter
$stmt->execute();
$result = $stmt->get_result();

// Store the course information in an associative array
$courseInfo = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $courseInfo["Year"] = $row["Year"];
    $courseInfo["Semester"] = $row["Semester"];
    $courseInfo["NumberOfCredits"] = $row["NumberOfCredits"];
    $courseInfo["NumberOfStudents"] = $row["NumberOfStudents"];
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Send the course information as a JSON response
header("Content-Type: application/json");
echo json_encode($courseInfo);
?>
