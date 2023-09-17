<?php session_start(); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php 
require_once('inc/connection.php');

 // Fetch data from the database
 $sql = "SELECT CourseCode,TheoryPractical,NumberOfStudents,NumberOfWeeks,TotalTime FROM seminar_course WHERE EmployeeID = '{$_SESSION['EmployeeID']}'  && Academic_year = '{$_SESSION['Academic_year']}' && is_deleted=0";
 $result = mysqli_query($connection, $sql);

 require("library/fpdf.php");

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();


// Add current login employee ID and employee name
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Employee ID: ' . $_SESSION['EmployeeID'], 0, 1, '');
$pdf->Cell(0, 10, ' Employee Name: ' . $_SESSION['FullName'], 0, 1, '');
$pdf->Cell(0, 10, ' Academic Year: ' . $_SESSION['Academic_year'], 0, 1, '');



$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 10, 'Seminar Course Workload Report', 0, 1, 'C');

$pdf->SetFont('Arial','B',10);
$pdf->cell(30,10,"Course code",1,0,'C');
$pdf->cell(30,10,"Theory/Practical",1,0,'C');
$pdf->cell(30,10,"No. of students",1,0,'C');
$pdf->cell(30,10,"No. of weeks",1,0,'C');
$pdf->cell(40,10,"Total Time (Hours)",1,1,'C');

$pdf->SetFont('Arial','',10);

while($row = mysqli_fetch_array($result))
{
    $pdf->cell(30,10,$row['CourseCode'],1,0,'C');
    $pdf->cell(30,10,$row['TheoryPractical'],1,0,'C');
    $pdf->cell(30,10,$row['NumberOfStudents'],1,0,'C');
    $pdf->cell(30,10,$row['NumberOfWeeks'],1,0,'C');
    $pdf->cell(40,10,$row['TotalTime'],1,1,'C');
  
    
}


$pdf->OutPut();



?>

<?php 
mysqli_close($connection);
?>