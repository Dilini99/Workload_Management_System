<?php
session_start();

if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
    exit();
}

require_once('inc/connection.php');
require("library/fpdf.php");

// Fetch data from the database
$sql = "SELECT direct_PGS, aca_advis, per_men, stu_cor, aca_coor, research_p, aca_sub_coor,
        aca_eve_coor, new_degree, new_course, resour_per, infra_dev, meeting, stu_advi_board,
        board_of_stu, VC_DVC, dean, proctor, stu_counce, coordinator, senior_tresh, advi_ndp,
        country_rep, outreach_act, coor_confere, serving_office, proffesional_dev, staff_dev,
        advance_prof, TEC, other
        FROM academic_cor
        WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
$result = mysqli_query($connection, $sql);

// Calculate the total from another SQL query
$totalSql = "SELECT SUM(direct_PGS + aca_advis + per_men + stu_cor + aca_coor + research_p + aca_sub_coor +
                aca_eve_coor + new_degree + new_course + resour_per + infra_dev + meeting + stu_advi_board +
                board_of_stu + VC_DVC + dean + proctor + stu_counce + coordinator + senior_tresh + advi_ndp +
                country_rep + outreach_act + coor_confere + serving_office + proffesional_dev + staff_dev +
                advance_prof + TEC + other) AS total
             FROM academic_cor
             WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
$totalResult = mysqli_query($connection, $totalSql);
$totalRow = mysqli_fetch_array($totalResult);
$total = $totalRow['total'];


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Add current login employee ID and employee name
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Employee ID: ' . $_SESSION['EmployeeID'], 0, 1, '');
$pdf->Cell(0, 10, 'Employee Name: ' . $_SESSION['FullName'], 0, 1, '');
$pdf->Cell(0, 10, ' Academic Year: ' . $_SESSION['Academic_year'], 0, 1, '');


$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Academic Coordination', 0, 1, 'C');

// Add table heading
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 10, 'Activity', 1, 0, 'C');
$pdf->Cell(40, 10, 'Total Time(hours)', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);

// Iterate through the database result
while ($row = mysqli_fetch_array($result)) {
    // Display field name and value in separate rows
    $pdf->Cell(170, 10, "Director/Post Graduate Studies:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['direct_PGS'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Academic Advisor:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['aca_advis'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Personal Mentor:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['per_men'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Student Coordinator/Councilors:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['stu_cor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Academic Coordination:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['aca_coor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Research project/Industrial training/Group project/Seminar Coordination:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['research_p'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Academic Subject Coordination:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['aca_sub_coor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Academic Event Coordinations:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['aca_eve_coor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "New Degree Program Development:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['new_degree'], 0, 1, 'L');

    $pdf->Cell(170, 10, "New Course Development:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['new_course'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Resource Person for Workshop/Conference:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['resour_per'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Infrastructure Development Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['infra_dev'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Meeting/Workshop/Conference Attended:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['meeting'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Student Advising Board:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['stu_advi_board'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Board of Studies Membership:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['board_of_stu'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Vice Chancellor/Deputy Vice Chancellor Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['VC_DVC'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Dean's Position:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['dean'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Proctor Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['proctor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Student Counselor:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['stu_counce'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Coordinator for Any Activity:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['coordinator'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Senior Treasurer:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['senior_tresh'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Advisor for NDP:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['advi_ndp'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Country Representative/Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['country_rep'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Outreach Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['outreach_act'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Coordinator for Conference/Workshop:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['coor_confere'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Serving in Office Bearer Positions:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['serving_office'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Professional Development Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['proffesional_dev'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Staff Development Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['staff_dev'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Advanced Professional Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['advance_prof'], 0, 1, 'L');

    $pdf->Cell(170, 10, "TEC and Course Development Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['TEC'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Other Activities:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['other'], 0, 1, 'L');

    $pdf->Ln(10);
}
// Display the total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 10, 'Total', 1, 0, 'C');
$pdf->Cell(40, 10, $total, 1, 1, 'C');

mysqli_close($connection);

$pdf->Output();
