<?php session_start(); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php 
require_once('inc/connection.php');

 // Fetch data from the database
 $sql = "SELECT RegNo,StudentName,CourseCode,Position,StartDate,EndDate,EvolutionTime FROM intern_supervision WHERE EmployeeID = '{$_SESSION['EmployeeID']}'  && Academic_year = '{$_SESSION['Academic_year']}' && is_deleted=0";
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
$pdf->Cell(0, 10, 'Internships supervision', 0, 1, 'C');

$pdf->SetFont('Arial','B',10);
$pdf->cell(20,10,"Reg No",1,0,'C');
$pdf->cell(30,10,"Student Name",1,0,'C');
$pdf->cell(30,10,"Course Code",1,0,'C');
$pdf->cell(30,10,"Position",1,0,'C');
$pdf->cell(25,10,"Start Date",1,0,'C');
$pdf->cell(25,10,"End Date",1,0,'C');
$pdf->cell(30,10,"Eval.Time (Hours)",1,1,'C');

$pdf->SetFont('Arial','',10);

while($row = mysqli_fetch_array($result))
{
    $pdf->cell(20,10,$row['RegNo'],1,0,'C');
    $pdf->cell(30,10,$row['StudentName'],1,0,'C');
    $pdf->cell(30,10,$row['CourseCode'],1,0,'C');
    $pdf->cell(30,10,$row['Position'],1,0,'C');
    $pdf->cell(25,10,$row['StartDate'],1,0,'C');
    $pdf->cell(25,10,$row['EndDate'],1,0,'C');
    $pdf->cell(30,10,$row['EvolutionTime'],1,1,'C');


}


$pdf->OutPut();



?>

<?php 
mysqli_close($connection);
?>