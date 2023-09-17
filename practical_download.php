<?php session_start(); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php 
require_once('inc/connection.php');

 // Fetch data from the database
 $sql = "SELECT Year,Semester,CourseCode,NumberOfCredits,NumberOfStudents,ActualLectureTime,PreperationTimeOfPracticalSessions,CreditTime FROM academic_instructions_practical_lecture_sessions WHERE EmployeeID = '{$_SESSION['EmployeeID']}'  && Academic_year = '{$_SESSION['Academic_year']}' && is_deleted=0";
 $result = mysqli_query($connection, $sql);

 require("library/fpdf.php");

$pdf = new FPDF('l','mm','A4');
$pdf->AddPage();





// Add current login employee ID and employee name
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Employee ID: ' . $_SESSION['EmployeeID'], 0, 1, '');
$pdf->Cell(0, 10, ' Employee Name: ' . $_SESSION['FullName'], 0, 1, '');
$pdf->Cell(0, 10, ' Academic Year: ' . $_SESSION['Academic_year'], 0, 1, '');



$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 10, 'Practical Demonstration Workload Report', 0, 1, 'C');


$pdf->SetFont('Arial','B',10);
$pdf->cell(10,10,"Year",1,0,'C');
$pdf->cell(20,10,"Semester",1,0,'C');
$pdf->cell(30,10,"Course code",1,0,'C');
$pdf->cell(25,10,"No. of credits",1,0,'C');
$pdf->cell(40,10,"No. of students",1,0,'C');
$pdf->cell(50,10,"Actual demonstration time",1,0,'C');
$pdf->cell(40,10,"Preperation time ",1,0,'C');
$pdf->cell(50,10,"Credit Based Time (Hours)",1,1,'C');


$pdf->SetFont('Arial','',10);

while($row = mysqli_fetch_array($result))
{
    $pdf->cell(10,10,$row['Year'],1,0,'C');
    $pdf->cell(20,10,$row['Semester'],1,0,'C');
    $pdf->cell(30,10,$row['CourseCode'],1,0,'C');
    $pdf->cell(25,10,$row['NumberOfCredits'],1,0,'C');
    $pdf->cell(40,10,$row['NumberOfStudents'],1,0,'C');
    $pdf->cell(50,10,$row['ActualLectureTime'],1,0,'C');
    $pdf->cell(40,10,$row['PreperationTimeOfPracticalSessions'],1,0,'C');
    $pdf->cell(50,10,$row['CreditTime'],1,1,'C');
    
}


$pdf->OutPut();



?>

<?php 
mysqli_close($connection);
?>