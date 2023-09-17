<?php session_start(); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>
<?php 
require_once('inc/connection.php');

 // Fetch data from the database
 $sql1 = "SELECT SUM(total_time) AS total_sum FROM (
    SELECT Round(SUM(ActualLectureTime+PreperationTimeOfPracticalSessions)) AS total_time
    FROM academic_instructions_practical_lecture_sessions
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT round(SUM(ActualLectureTime+quiz_ass_tu)) AS total_time
    FROM academic_instructions_theory_lecture_sessions
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(Required_Time) AS total_time
    FROM practical_field_visits
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(Required_Time) AS total_time
    FROM practical_viva_sessions
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(EvolutionTime) AS total_time
    FROM 4th_year_research
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(EvolutionTime) AS total_time
    FROM intern_supervision
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(t1.TotalTime + t2.TotalTime) AS total_time
    FROM marking_exam_papers AS t1
    JOIN marking_exam_papersP AS t2 ON t1.EmployeeID = t2.EmployeeID
    WHERE t1.EmployeeID = '{$_SESSION['EmployeeID']}'
        AND t1.Academic_year = '{$_SESSION['Academic_year']}'
        AND t1.is_deleted = 0
    UNION
    SELECT SUM(t1.TotalTime + t2.TotalTime) AS total_time
    FROM moderating_exam_papers AS t1
    JOIN moderating_exam_papersP AS t2 ON t1.EmployeeID = t2.EmployeeID
    WHERE t1.EmployeeID = '{$_SESSION['EmployeeID']}'
        AND t1.Academic_year = '{$_SESSION['Academic_year']}'
        AND t1.is_deleted = 0
    UNION
    SELECT SUM(t1.TotalTime + t2.TotalTime) AS total_time
    FROM setting_exam_papers AS t1
    JOIN setting_exam_papers_practical AS t2 ON t1.EmployeeID = t2.EmployeeID
    WHERE t1.EmployeeID = '{$_SESSION['EmployeeID']}'
        AND t1.Academic_year = '{$_SESSION['Academic_year']}'
        AND t1.is_deleted = 0
    UNION
    SELECT SUM(EvolutionTime) AS total_time
    FROM 3rd_year_group_project
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(TotalTime) AS total_time
    FROM computation_results
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(TotalTime) AS total_time
    FROM evolution_quiz_assignments_tutorials
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}'
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
    UNION
    SELECT SUM(TotalTime) AS total_time
    FROM evolution_practical_reports
    WHERE EmployeeID = '{$_SESSION['EmployeeID']}' 
        AND Academic_year='{$_SESSION['Academic_year']}' 
        AND is_deleted = 0
) AS subquery";
$result1 = mysqli_query($connection, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$totalTimeAcademicInstructions = $row1['total_sum'];

 $sql2 = "SELECT SUM(`direct_PGS` + `aca_advis` + `per_men` + `stu_cor` + `aca_coor` + `research_p` + `aca_sub_coor` + `aca_eve_coor` + `new_degree` + `new_course` + `resour_per` + `infra_dev` + `meeting` + `stu_advi_board` + `board_of_stu` + `VC_DVC` + `dean` + `proctor` + `stu_counce` + `coordinator` + `senior_tresh` + `advi_ndp` + `country_rep` + `outreach_act` + `coor_confere` + `serving_office` + `proffesional_dev` + `staff_dev` + `advance_prof` + `TEC` + `other`) AS total FROM `academic_cor` WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year='{$_SESSION['Academic_year']}'";
 $result2 = mysqli_query($connection, $sql2);
 $row2 = mysqli_fetch_assoc($result2);
 $totalTimeAcademicCoordination = $row2['total'];


$sql3 = "SELECT SUM(no_of_research + mem_of_rct + ref_jour + non_ref_jour + conference_ppr + extended_abs + abstract + author_chap_of_bk + author_monograph + author_policyppr + author_consultancy_repo + soft_dev + media_pro + translation_pub + peer_reviewed + Editor + co_editor + member_editorial + chair_national + chair_international + workshop_cor + reviewer) AS total FROM research_supervision WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year='{$_SESSION['Academic_year']}'";
$result3 = mysqli_query($connection, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$totalTimeResearchSupervision = $row3['total'];

$grandtotal = $totalTimeAcademicInstructions + $totalTimeAcademicCoordination + $totalTimeResearchSupervision;

 require("library/fpdf.php");

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();

// Add current login employee ID and employee name
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Employee ID: ' . $_SESSION['EmployeeID'], 0, 1, '');
$pdf->Cell(0, 10, ' Employee Name: ' . $_SESSION['FullName'], 0, 1, '');
$pdf->Cell(0, 10, ' Academic Year: ' . $_SESSION['Academic_year'], 0, 1, '');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 10, 'Workload Summary', 0, 1, 'C');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(80, 10, 'Total time for academic instructions (hours)		:', 0, 0, '');
$pdf->SetX(150); // Set the horizontal position for the next cell
$pdf->Cell(0, 10, $totalTimeAcademicInstructions, 0, 1, '');

$pdf->Cell(80, 10, 'Total time for academic coordination (hours)		:', 0, 0, '');
$pdf->SetX(150);
$pdf->Cell(0, 10, $totalTimeAcademicCoordination, 0, 1, '');

$pdf->Cell(80, 10, 'Total time for research supervision (hours)			:', 0, 0, '');
$pdf->SetX(150);
$pdf->Cell(0, 10, $totalTimeResearchSupervision, 0, 1, '');

$pdf->Cell(80, 10, 'Total time of your workload (hours)																:', 0, 0, '');
$pdf->SetX(150);
$pdf->Cell(0, 10, $grandtotal, 0, 1, '');






$pdf->OutPut();



?>

<?php 
mysqli_close($connection);
?>