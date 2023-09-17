<?php
session_start();

if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
    exit();
}

require_once('inc/connection.php');
require("library/fpdf.php");

// Fetch data from the database
$sql = "SELECT PhD_Full_Time, PhD_Part_Time, M_Phil_Full_Time, MPhil_Part_Time, MSc_Full_Time, Course_based_MSc_Part_Time, Research_projects,
        no_of_research, mem_of_rct, ref_jour, non_ref_jour, conference_ppr, extended_abs, abstract,author_of_bk,
        author_chap_of_bk, author_monograph, author_policyppr, author_consultancy_repo, soft_dev, media_pro, translation_pub, peer_reviewed,
        Editor, co_editor, member_editorial, chair_national, chair_international, workshop_cor,
        reviewer
        FROM research_supervision
        WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
$result = mysqli_query($connection, $sql);

// Calculate the total from another SQL query
$totalSql = "SELECT SUM(PhD_Full_Time+PhD_Part_Time+ M_Phil_Full_Time+ MPhil_Part_Time+MSc_Full_Time+ Course_based_MSc_Part_Time+ Research_projects+
no_of_research+ mem_of_rct+ ref_jour+ non_ref_jour+ conference_ppr+ extended_abs+ abstract+author_of_bk+
author_chap_of_bk+ author_monograph+ author_policyppr+ author_consultancy_repo+ soft_dev+ media_pro+ translation_pub+ peer_reviewed+
Editor+ co_editor+ member_editorial+ chair_national+ chair_international+ workshop_cor+
reviewer) AS total
             FROM research_supervision
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
$pdf->Cell(0, 10, 'Research Supervision', 0, 1, 'C');

// Add table heading
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 10, 'Activity', 1, 0, 'C');
$pdf->Cell(40, 10, 'Total Time(hours)', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);

// Iterate through the database result
while ($row = mysqli_fetch_array($result)) {
    // Display field name and value in separate rows
    $pdf->Cell(170, 10, "PhD Full Time:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['PhD_Full_Time'], 0, 1, 'L');

    $pdf->Cell(170, 10, "PhD Part Time:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['PhD_Part_Time'], 0, 1, 'L');

    $pdf->Cell(170, 10, "M Phil Full Time:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['M_Phil_Full_Time'], 0, 1, 'L');

    $pdf->Cell(170, 10, "MPhil Part Time:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['MPhil_Part_Time'], 0, 1, 'L');

    $pdf->Cell(170, 10, "MSc Full Time:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['MSc_Full_Time'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Course based MSc Part Time:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['Course_based_MSc_Part_Time'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Research projects which involve undergraduate students:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['Research_projects'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Research grants :", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['no_of_research'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Member of research consultants team:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['mem_of_rct'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Refereed journal:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['ref_jour'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Non-refereed journal:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['non_ref_jour'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Conference papers:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['conference_ppr'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Extended abstracts:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['extended_abs'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Abstracts:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['abstract'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Author of books:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['author_of_bk'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Author of chapters in books:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['author_chap_of_bk'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Author of monographs:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['author_monograph'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Author of policy papers:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['author_policyppr'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Author of consultancy report:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['author_consultancy_repo'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Software development:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['soft_dev'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Media projects and products:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['media_pro'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Translation and publication of books and scholarly work:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['translation_pub'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Peer-reviewed presentations at national/international conference:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['peer_reviewed'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Editor of the reputed journals and proceedings:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['Editor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Associate-/Co- editor, of reputed journals and proceedings:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['co_editor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Member of the editorial board of a reputed journal or proceeding:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['member_editorial'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Chairperson/Coordinator research symposia,
    conferences (national):", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['chair_national'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Chairperson/Coordinator research symposia,
    conferences (international):", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['chair_international'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Workshop coordinator:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['workshop_cor'], 0, 1, 'L');

    $pdf->Cell(170, 10, "Reviewer of research proposals and articles for publication:", 0, 0, 'L');
    $pdf->Cell(80, 10, $row['reviewer'], 0, 1, 'L');

    $pdf->Ln(10);
}
// Display the total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 10, 'Total', 1, 0, 'C');
$pdf->Cell(40, 10, $total, 1, 1, 'C');

mysqli_close($connection);

$pdf->Output();
