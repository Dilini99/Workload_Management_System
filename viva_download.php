<?php session_start(); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php 
require_once('inc/connection.php');

 // Fetch data from the database
 $sql = "SELECT Course_Code,Date,Title,Description,Number_Of_Students,Required_Time FROM practical_viva_sessions WHERE EmployeeID = '{$_SESSION['EmployeeID']}'  && Academic_year = '{$_SESSION['Academic_year']}' && is_deleted=0";
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
$pdf->Cell(0, 10, 'Viva session workload report', 0, 1, 'C');

$pdf->SetFont('Arial','B',10);
$pdf->cell(30,10,"Course Code",1,0,'C');
$pdf->cell(30,10,"Date",1,0,'C');
$pdf->cell(30,10,"Title",1,0,'C');
$pdf->cell(50,10,"Description",1,0,'C');
$pdf->cell(30,10,"No of Students",1,0,'C');
$pdf->cell(30,10,"Spent time",1,1,'C');

$pdf->SetFont('Arial','',10);

while($row = mysqli_fetch_array($result))
{
    $pdf->cell(30,10,$row['Course_Code'],1,0,'C');
    $pdf->cell(30,10,$row['Date'],1,0,'C');
    $pdf->cell(30,10,$row['Title'],1,0,'C');
    $pdf->cell(50,10,$row['Description'],1,0,'C');
    $pdf->cell(30,10,$row['Number_Of_Students'],1,0,'C');
    $pdf->cell(30,10,$row['Required_Time'],1,1,'C');


}


$pdf->OutPut();



?>

<?php 
mysqli_close($connection);
?>