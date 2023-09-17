<?php session_start(); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php 
require_once('inc/connection.php');

 // Fetch data from the database
 $sql = "SELECT GPNo,GroupNo,CourseCode,ProjectTitle,StartDate,EndDate,EvolutionTime FROM 3rd_year_group_project WHERE EmployeeID = '{$_SESSION['EmployeeID']}' && is_deleted=0";
 $result = mysqli_query($connection, $sql);

 require("library/fpdf.php");

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();





// Add current login employee ID and employee name
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Employee ID: ' . $_SESSION['EmployeeID'], 0, 1, '');
$pdf->Cell(0, 10, ' Employee Name: ' . $_SESSION['FullName'], 0, 1, '');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 10, '3rd year group project supervision', 0, 1, 'C');


$pdf->SetFont('Arial','B',10);
$pdf->cell(20,10,"Group No",1,0,'C');
$pdf->cell(30,10,"Course Code",1,0,'C');
$pdf->cell(60,10,"Project Title",1,0,'C');
$pdf->cell(30,10,"Start Date",1,0,'C');
$pdf->cell(30,10,"End Date",1,0,'C');
$pdf->cell(20,10,"Time (Hours)",1,1,'C');


$pdf->SetFont('Arial','',10);

while($row = mysqli_fetch_array($result))
{
    $pdf->cell(20,10,$row['GroupNo'],1,0,'C');
    $pdf->cell(30,10,$row['CourseCode'],1,0,'C');
    $pdf->cell(60,10,$row['ProjectTitle'],1,0,'C');
    $pdf->cell(30,10,$row['StartDate'],1,0,'C');
    $pdf->cell(30,10,$row['EndDate'],1,0,'C');
    $pdf->cell(20,10,$row['EvolutionTime'],1,1,'C');


}


$pdf->OutPut();



?>

<?php 
mysqli_close($connection);
?>