<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
if (!isset($_SESSION['EmployeeID'])) {
    header('Location: login.php');
}
?>

<?php
// Assuming you have stored the user ID in the session variable 'user_id'
$empID = $_SESSION['EmployeeID'];
$academicYear = $_SESSION['Academic_year'];

// Check if the user data already exists
$query = "SELECT * FROM academic_cor WHERE EmployeeID = '$empID' AND Academic_year = '$academicYear'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    // Create a new user data record with zero values for other variables
    $insertQuery = "INSERT INTO academic_cor (EmployeeID,Academic_year, aca_advis, direct_PGS, per_men, stu_cor, aca_coor, research_p, aca_sub_coor, aca_eve_coor, new_degree, new_course, resour_per, infra_dev, meeting, stu_advi_board, board_of_stu, VC_DVC, dean, proctor, stu_counce, coordinator, senior_tresh, advi_ndp, country_rep, outreach_act, coor_confere, serving_office, proffesional_dev, staff_dev, advance_prof, TEC, other) 
    VALUES ('$empID', '$academicYear', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0)";
    
    $insertResult = mysqli_query($connection, $insertQuery);

    if (!$insertResult) {
        die("Error: " . mysqli_error($connection));
    }
}
?>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_SERVER['HTTP_REFERER'])){
  if (!isset($_SESSION['form_submitted'])){

// Get the user input from the form
$aca_advis = isset($_POST['aca_advis']) ? intval($_POST['aca_advis']) : 0;
$direct_PGS = isset($_POST['direct_PGS']) ? intval($_POST['direct_PGS']) : 0;
$per_men = isset($_POST['per_men']) ? intval($_POST['per_men']) : 0;
$stu_cor = isset($_POST['stu_cor']) ? intval($_POST['stu_cor']) : 0;
$aca_coor = isset($_POST['aca_coor']) ? intval($_POST['aca_coor']) : 0;
$research_p = isset($_POST['research_p']) ? intval($_POST['research_p']) : 0;
$aca_sub_coor = isset($_POST['aca_sub_coor']) ? intval($_POST['aca_sub_coor']) : 0;
$aca_eve_coor = isset($_POST['aca_eve_coor']) ? intval($_POST['aca_eve_coor']) : 0;
$new_degree = isset($_POST['new_degree']) ? intval($_POST['new_degree']) : 0;
$new_course = isset($_POST['new_course']) ? intval($_POST['new_course']) : 0;
$resour_per = isset($_POST['resour_per']) ? intval($_POST['resour_per']) : 0;
$infra_dev = isset($_POST['infra_dev']) ? intval($_POST['infra_dev']) : 0;
$meeting = isset($_POST['meeting']) ? intval($_POST['meeting']) : 0;
$stu_advi_board = isset($_POST['stu_advi_board']) ? intval($_POST['stu_advi_board']) : 0;
$board_of_stu = isset($_POST['board_of_stu']) ? intval($_POST['board_of_stu']) : 0;
$VC_DVC = isset($_POST['VC_DVC']) ? intval($_POST['VC_DVC']) : 0;
$dean = isset($_POST['dean']) ? intval($_POST['dean']) : 0;
$proctor = isset($_POST['proctor']) ? intval($_POST['proctor']) : 0;
$stu_counce = isset($_POST['stu_counce']) ? intval($_POST['stu_counce']) : 0;
$coordinator = isset($_POST['coordinator']) ? intval($_POST['coordinator']) : 0;
$senior_tresh = isset($_POST['senior_tresh']) ? intval($_POST['senior_tresh']) : 0;
$advi_ndp = isset($_POST['advi_ndp']) ? intval($_POST['advi_ndp']) : 0;
$country_rep = isset($_POST['country_rep']) ? intval($_POST['country_rep']) : 0;
$outreach_act = isset($_POST['outreach_act']) ? intval($_POST['outreach_act']) : 0;
$coor_confere = isset($_POST['coor_confere']) ? intval($_POST['coor_confere']) : 0;
$serving_office = isset($_POST['serving_office']) ? intval($_POST['serving_office']) : 0;
$proffesional_dev = isset($_POST['proffesional_dev']) ? intval($_POST['proffesional_dev']) : 0;
$staff_dev = isset($_POST['staff_dev']) ? intval($_POST['staff_dev']) : 0;
$advance_prof = isset($_POST['advance_prof']) ? intval($_POST['advance_prof']) : 0;
$TEC = isset($_POST['TEC']) ? intval($_POST['TEC']) : 0;
$other = isset($_POST['other']) ? intval($_POST['other']) : 0;



// Multiply the user input value with some other values 

$mdirect_PGS =$direct_PGS * 2;
$maca_advis = $aca_advis*1;
$mper_men = $per_men*1;
$mstu_cor = $stu_cor*2;
$maca_coor = $aca_coor*1;
$mresearch_p = $research_p*1;
$maca_sub_coor = $aca_sub_coor*15;
$maca_eve_coor = $aca_eve_coor*15;
$mnew_degree = $new_degree*100;
$mnew_course = $new_course*20;
$mresour_per = $resour_per*20;
$minfra_dev = $infra_dev;
$mmeeting = $meeting;
$mstu_advi_board = $stu_advi_board;
$mboard_of_stu = $board_of_stu;
$mVC_DVC = $VC_DVC*100;
$mdean = $dean*80;
$mproctor = $proctor*80;
$mstu_counce = $stu_counce*50;
$mcoordinator = $coordinator*50;
$msenior_tresh = $senior_tresh*20;
$madvi_ndp = $advi_ndp*20;
$mcountry_rep = $country_rep*30;
$moutreach_act = $outreach_act;
$mcoor_confere = $coor_confere;
$mserving_office = $serving_office;
$mproffesional_dev= $proffesional_dev;
$mstaff_dev = $staff_dev;
$madvance_prof = $advance_prof;
$mTEC = $TEC*3;
$mother = $other;


// Update direct_PGS field
if (!empty($mdirect_PGS)) {
    $sql = "UPDATE academic_cor SET direct_PGS = $mdirect_PGS WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating direct_PGS: " . $connection->error;
    }
}

// Update aca_advis field
if (!empty($maca_advis)) {
    $sql = "UPDATE academic_cor SET aca_advis = $maca_advis WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating aca_advis: " . $connection->error;
    }
}

// Update per_men field
if (!empty($mper_men)) {
    $sql = "UPDATE academic_cor SET per_men = $mper_men WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating per_men: " . $connection->error;
    }
}

// Update stu_cor field
if (!empty($mstu_cor)) {
    $sql = "UPDATE academic_cor SET stu_cor = $mstu_cor WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating stu_cor: " . $connection->error;
    }
}

// Update aca_coor field
if (!empty($maca_coor)) {
    $sql = "UPDATE academic_cor SET aca_coor = $maca_coor WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating aca_coor: " . $connection->error;
    }
}

// Update research_p field
if (!empty($mresearch_p)) {
    $sql = "UPDATE academic_cor SET research_p = $mresearch_p WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating research_p: " . $connection->error;
    }
}

// Update aca_sub_coor field
if (!empty($maca_sub_coor)) {
    $sql = "UPDATE academic_cor SET aca_sub_coor = $maca_sub_coor WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating aca_sub_coor: " . $connection->error;
    }
}

// Update aca_eve_coor field
if (!empty($maca_eve_coor)) {
    $sql = "UPDATE academic_cor SET aca_eve_coor = $maca_eve_coor WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating aca_eve_coor: " . $connection->error;
    }
}

// Update new_degree field
if (!empty($mnew_degree)) {
    $sql = "UPDATE academic_cor SET new_degree = $mnew_degree WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating new_degree: " . $connection->error;
    }
}

// Update new_course field
if (!empty($mnew_course)) {
    $sql = "UPDATE academic_cor SET new_course = $mnew_course WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating new_course: " . $connection->error;
    }
}

// Update resour_per field
if (!empty($mresour_per)) {
    $sql = "UPDATE academic_cor SET resour_per = $mresour_per WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating resour_per: " . $connection->error;
    }
}

// Update infra_dev field
if (!empty($minfra_dev)) {
    $sql = "UPDATE academic_cor SET infra_dev = $minfra_dev WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating infra_dev: " . $connection->error;
    }
}

// Update meeting field
if (!empty($mmeeting)) {
    $sql = "UPDATE academic_cor SET meeting = $mmeeting WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating meeting: " . $connection->error;
    }
}

// Update stu_advi_board field
if (!empty($mstu_advi_board)) {
    $sql = "UPDATE academic_cor SET stu_advi_board = $mstu_advi_board WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating stu_advi_board: " . $connection->error;
    }
}

// Update board_of_stu field
if (!empty($mboard_of_stu)) {
    $sql = "UPDATE academic_cor SET board_of_stu = $mboard_of_stu WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating board_of_stu: " . $connection->error;
    }
}

// Update VC_DVC field
if (!empty($mVC_DVC)) {
    $sql = "UPDATE academic_cor SET VC_DVC = $mVC_DVC WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating VC_DVC: " . $connection->error;
    }
}

// Update dean field
if (!empty($mdean)) {
    $sql = "UPDATE academic_cor SET dean = $mdean WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating dean: " . $connection->error;
    }
}

// Update proctor field
if (!empty($mproctor)) {
    $sql = "UPDATE academic_cor SET proctor = $mproctor WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating proctor: " . $connection->error;
    }
}

// Update stu_counce field
if (!empty($mstu_counce)) {
    $sql = "UPDATE academic_cor SET stu_counce = $mstu_counce WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating stu_counce: " . $connection->error;
    }
}

// Update coordinator field
if (!empty($mcoordinator)) {
    $sql = "UPDATE academic_cor SET coordinator = $mcoordinator WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating coordinator: " . $connection->error;
    }
}

// Update senior_tresh field
if (!empty($msenior_tresh)) {
    $sql = "UPDATE academic_cor SET senior_tresh = $msenior_tresh WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating senior_tresh: " . $connection->error;
    }
}

// Update advi_ndp field
if (!empty($madvi_ndp)) {
    $sql = "UPDATE academic_cor SET advi_ndp = $madvi_ndp WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating advi_ndp: " . $connection->error;
    }
}

// Update country_rep field
if (!empty($mcountry_rep)) {
    $sql = "UPDATE academic_cor SET country_rep = $mcountry_rep WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating country_rep: " . $connection->error;
    }
}

// Update outreach_act field
if (!empty($moutreach_act)) {
    $sql = "UPDATE academic_cor SET outreach_act = $moutreach_act WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating outreach_act: " . $connection->error;
    }
}

// Update coor_confere field
if (!empty($mcoor_confere)) {
    $sql = "UPDATE academic_cor SET coor_confere = $mcoor_confere WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating coor_confere: " . $connection->error;
    }
}

// Update serving_office field
if (!empty($mserving_office)) {
    $sql = "UPDATE academic_cor SET serving_office = $mserving_office WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating serving_office: " . $connection->error;
    }
}

// Update proffesional_dev field
if (!empty($mproffesional_dev)) {
    $sql = "UPDATE academic_cor SET proffesional_dev = $mproffesional_dev WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating proffesional_dev: " . $connection->error;
    }
}

// Update staff_dev field
if (!empty($mstaff_dev)) {
    $sql = "UPDATE academic_cor SET staff_dev = $mstaff_dev WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating staff_dev: " . $connection->error;
    }
}

// Update publication field
if (!empty($mpublication)) {
    $sql = "UPDATE academic_cor SET publication = $mpublication WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    if ($connection->query($sql) !== TRUE) {
        echo "Error updating publication: " . $connection->error;
    }
}



$sql1="SELECT direct_PGS from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result1 = mysqli_query($connection, $sql1);$row1 = mysqli_fetch_assoc($result1);$zdirect_PGS = $row1['direct_PGS']/2;
$sql2="SELECT aca_advis from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result2 = mysqli_query($connection, $sql2);$row2 = mysqli_fetch_assoc($result2);$zaca_advis = $row2['aca_advis'];
$sql3="SELECT per_men from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result3 = mysqli_query($connection, $sql3);$row3 = mysqli_fetch_assoc($result3);$zper_men = $row3['per_men'];
$sql4="SELECT stu_cor from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result4 = mysqli_query($connection, $sql4);$row4 = mysqli_fetch_assoc($result4);$zstu_cor = $row4['stu_cor']/2;
$sql5="SELECT aca_coor from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result5 = mysqli_query($connection, $sql5);$row5 = mysqli_fetch_assoc($result5);$zaca_coor = $row5['aca_coor'];
$sql6="SELECT research_p from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result6 = mysqli_query($connection, $sql6);$row6 = mysqli_fetch_assoc($result6);$zresearch_p = $row6['research_p'];
$sql7="SELECT aca_sub_coor from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result7 = mysqli_query($connection, $sql7);$row7 = mysqli_fetch_assoc($result7);$zaca_sub_coor = $row7['aca_sub_coor']/15;
$sql8="SELECT aca_eve_coor from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result8 = mysqli_query($connection, $sql8);$row8 = mysqli_fetch_assoc($result8);$zaca_eve_coor = $row8['aca_eve_coor']/15;
$sql9="SELECT new_degree from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result9 = mysqli_query($connection, $sql9);$row9 = mysqli_fetch_assoc($result9);$znew_degree = $row9['new_degree']/100;
$sql10="SELECT new_course from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result10 = mysqli_query($connection, $sql10);$row10 = mysqli_fetch_assoc($result10);$znew_course = $row10['new_course']/20;
$sql11="SELECT resour_per from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result11 = mysqli_query($connection, $sql11);$row11 = mysqli_fetch_assoc($result11);$zresour_per = $row11['resour_per']/20;
$sql12="SELECT infra_dev from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result12 = mysqli_query($connection, $sql12);$row12 = mysqli_fetch_assoc($result12);$zinfra_dev = $row12['infra_dev'];
$sql13="SELECT meeting from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result13 = mysqli_query($connection, $sql13);$row13 = mysqli_fetch_assoc($result13);$zmeeting = $row13['meeting'];
$sql14="SELECT stu_advi_board from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result14 = mysqli_query($connection, $sql14);$row14 = mysqli_fetch_assoc($result14);$zstu_advi_board = $row14['stu_advi_board'];
$sql15="SELECT board_of_stu from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result15 = mysqli_query($connection, $sql15);$row15 = mysqli_fetch_assoc($result15);$zboard_of_stu = $row15['board_of_stu'];
$sql16="SELECT VC_DVC from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result16 = mysqli_query($connection, $sql16);$row16 = mysqli_fetch_assoc($result16);$zVC_DVC = $row16['VC_DVC']/100;
$sql17="SELECT dean from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result17 = mysqli_query($connection, $sql17);$row17 = mysqli_fetch_assoc($result17);$zdean = $row17['dean']/80;
$sql18="SELECT proctor from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result18 = mysqli_query($connection, $sql18);$row18 = mysqli_fetch_assoc($result18);$zproctor = $row18['proctor']/80;
$sql19="SELECT stu_counce from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result19 = mysqli_query($connection, $sql19);$row19 = mysqli_fetch_assoc($result19);$zstu_counce = $row19['stu_counce']/50;
$sql20="SELECT coordinator from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result20 = mysqli_query($connection, $sql20);$row20 = mysqli_fetch_assoc($result20);$zcoordinators = $row20['coordinator']/50;
$sql21="SELECT senior_tresh from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result21 = mysqli_query($connection, $sql21);$row21 = mysqli_fetch_assoc($result21);$zsenior_tresh = $row21['senior_tresh']/20;
$sql22="SELECT advi_ndp from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result22 = mysqli_query($connection, $sql22);$row22 = mysqli_fetch_assoc($result22);$zadvi_ndp = $row22['advi_ndp']/20;
$sql23="SELECT country_rep from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result23 = mysqli_query($connection, $sql23);$row23 = mysqli_fetch_assoc($result23);$zcountry_rep = $row23['country_rep']/30;
$sql24="SELECT outreach_act from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}'AND Academic_year = '{$_SESSION['Academic_year']}'";$result24 = mysqli_query($connection, $sql24);$row24 = mysqli_fetch_assoc($result24);$zoutreach_act = $row24['outreach_act'];
$sql25="SELECT coor_confere from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result25 = mysqli_query($connection, $sql25);$row25 = mysqli_fetch_assoc($result25);$zcoor_confere = $row25['coor_confere'];
$sql26="SELECT serving_office from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result26 = mysqli_query($connection, $sql26);$row26 = mysqli_fetch_assoc($result26);$zserving_office = $row26['serving_office'];
$sql27="SELECT proffesional_dev from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result27 = mysqli_query($connection, $sql27);$row27 = mysqli_fetch_assoc($result27);$zproffesional_dev = $row27['proffesional_dev'];
$sql28="SELECT staff_dev from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result28 = mysqli_query($connection, $sql28);$row28 = mysqli_fetch_assoc($result28);$zstaff_dev = $row28['staff_dev'];
$sql29="SELECT advance_prof from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result29 = mysqli_query($connection, $sql29);$row29 = mysqli_fetch_assoc($result29);$zadvance_prof = $row29['advance_prof'];
$sql30="SELECT TEC from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result30 = mysqli_query($connection, $sql30);$row30 = mysqli_fetch_assoc($result30);$zTEC = $row30['TEC']/3;
$sql31="SELECT other from academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result31 = mysqli_query($connection, $sql31);$row31 = mysqli_fetch_assoc($result31);$zother = $row31['other'];

  }}
?>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])){
  if (!isset($_SESSION['form_submitted'])){
  $sum=0;
// Get data from database
$sql = "SELECT * FROM academic_cor WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
$result = mysqli_query($connection, $sql);

// Calculate sum for each row and display in the same input tag
while ($row = mysqli_fetch_assoc($result)) {
    $sum = $row['direct_PGS'] + $row['aca_advis'] + $row['per_men']+$row['stu_cor'] + $row['aca_coor'] + $row['research_p']+
    $row['aca_sub_coor'] + $row['aca_eve_coor'] + $row['new_degree']+$row['new_course'] + $row['resour_per'] + $row['infra_dev']+$row['meeting'] +
     $row['stu_advi_board'] + $row['board_of_stu']+$row['VC_DVC'] + $row['dean'] + $row['proctor']+$row['stu_counce'] + $row['coordinator'] + $row['senior_tresh']+
     $row['advi_ndp'] + $row['country_rep'] + $row['outreach_act']+$row['coor_confere'] + $row['serving_office'] + $row['proffesional_dev']+$row['staff_dev'] +
      $row['advance_prof'] + $row['TEC']+$row['other'] ;
    
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Academic Coordination</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

 
  
	<style>
		
	*{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        .right img{
            height: 72px;
            width: 80px;
        }
        .header{
            display: flex;
            justify-content: space-between;
            padding: 0 50px;
            background-color: #414190;
        }
        .left img{
            height: 70px;
            width: 300px;
        }
        .right, .left{
            padding: 12px 0;

        }
        
        .topnav {
            margin-top: 1px;
            padding-left: 350px;
        overflow: hidden;
        background-color: #a0a0c8;
        }

        .topnav a {
        float: left;
        display: block;
        text-align: center;
        text-decoration: none;
        font-size: 1.3em;
            color: #ffffff;
            padding: 10px 15px;
        }

        .topnav .icon {
        display: none;
        }

        .dropdown {
        float: left;
        overflow: hidden;
        }

        .dropdown .dropbtn {  
        border: none;
        outline: none;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
        font-size: 1.3em;
            color: #ffffff;
            padding: 10px 15px;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content a {
          float: none;
          color: black;
          padding: 12px 19px;
          text-decoration: none;
          display: block;
          text-align: left;

        }

        .topnav a:hover, .dropdown:hover .dropbtn {
          background-color: #555;
          color: white;
        }

        .dropdown-content a:hover {
          background-color: #ddd;
          color: black;
        }

        .dropdown:hover .dropdown-content {
          display: block;
        }

        @media screen and (max-width: 600px) {
          .topnav a:not(:first-child), .dropdown .dropbtn {
            display: none;
          }
          .topnav a.icon {
            float: right;
            display: block;
          }
        }

        @media screen and (max-width: 600px) {
          .topnav.responsive {position: relative;}
          .topnav.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
          }
          .topnav.responsive a {
            float: none;
            display: block;
            text-align: left;
          }
          .topnav.responsive .dropdown {float: none;}
          .topnav.responsive .dropdown-content {position: relative;}
          .topnav.responsive .dropdown .dropbtn {
            display: block;
            width: 100%;
            text-align: left;
          }
        }

        .leftcon{
            margin-top: 25px;
        }
        @media screen and (max-width: 500px){
            .nav a:not(:first-child) {display: none;}
            .nav a.icon {
                float: right;
                display: block;
            }
        }
        @media screen and (max-width: 600px) {
            .nav.responsive {position: relative;}
            .nav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }
            .nav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
         }

         ul.bc {
            padding: 10px 16px;
            list-style: none;
        }
        ul.bc li {
            display: inline-block;
            font-size: 18px;
        }
        ul.bc li+li:before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }
        ul.bc li a {
            color: #0275d8;
            text-decoration: none;
        }
        ul.bc li a:hover {
            color: #01447e;
            text-decoration: underline;
        }

         .content{
            min-height: 48vh;
            display: flex;
            justify-content: space-between;
            margin: 65px 60px 30px 100px;
            z-index: -1;
         }
        .leftcon{
            display: flex;
            flex-direction: column;
        }
        
        .option{
            margin:23px;
            border-radius: 5px;
            padding: 10px 5px;
            text-align: left;
        }
        .option a{
            color: #414190;
            font-size: 1.4em;
            text-decoration: none;
            font-weight: bold;
        }

       

        

      table {
            width: 100%;
            border-collapse: collapse;
             margin-top: 40px;
            padding-top: 20px;
            margin-bottom: 25px;
            font-family: Times New Roman;
            

        }
        table,
        th,
        td {
            border: none;
            border-collapse: collapse;
            padding: 5px;
        }
 
        tr:nth-child(odd) {
            background-color: whitesmoke;
        }
        tr:nth-child(even) {
            background-color: white;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-family: Times New Roman;
        }

        td{
        	font-size: 16px;
        	font-family:Times New Roman ;
          border-bottom: 1px solid #ddd;
        }

        th{
            background-color: #2C2A7D ; 
            font-size: 12px;
            color: white;
        }
.para{
        text-align: right;
        text-decoration: none;
       
        font-family:Times New Roman  ;
        margin-bottom: 20px;
        margin-top: 15px;
        margin-right: 25px;
        font-weight: bold;
        color: white;
    }
    .para button{
        padding: 10px 20px;
         cursor: pointer;
        font-family:Times New Roman  ;
        font-size: 20px;
        background-color: #2C2A7D  ;
       color: white;
       border: none;
        border-radius: 8px;


    }

.para button a{
	text-decoration: none;
	 color: white;

}
button:hover{
	 background-color:#136590 ;
	  text-decoration: none;
	  

}

  
.footer{
            background-color: #414190;
            font-size: 1.3em;
            color: white;
            padding: 15px 0;
         }


        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
          .text {font-size: 11px}
        }

        input{
          width:70px;
          text-align: center;
          border-radius: 8px;
          margin: 6px;
        }

        .updates{
          background-color: black;
          color: white;
          font-weight: bold;
          border-radius: 3px;
          padding: 2px;
          text-align: center;
        }

        .texts{
          border-style: none;
          border-radius: 8px;
          font-weight: bold;
        }

        

        
        

	</style>


</head>
<body>


<div class="header">
		<div class="left">
			<img src="pictures/logo-fas_n.png">
		</div>
		<div class="right">
        <p class="loggedin" style="font-family: inherit;font-size: 1.3em;color: #ffffff;">Welcome <a  style="font-family: inherit;font-size: 1.0em;color: #ffffff;" href="profile.php"><?php echo $_SESSION['FullName'] ?></a>!</p>
        <p class="loggedin" style="font-family: inherit;font-size: 1.3em;color: #ffffff;">Academic year <a  style="font-family: inherit;font-size: 1.0em;color: #ffffff;" href="#"><?php echo $_SESSION['Academic_year'] ?></a></p>
   
        <p><a style="font-family: inherit;font-size: 1.3em;color: #ffffff;" href="logout.php">  Log out</a></p>
			
		</div>
	</div>
	
  <div class="topnav" id="myTopnav">
	  	<div class="dropdown">
	    	<button class="dropbtn">Academic Instructions 
	      		<i class="fa fa-caret-down"></i>
	    	</button>
	    	<div class="dropdown-content">
			<a href="TheorySessionView.php">Theory Sessions</a>
			      <a href="PracticalSessionsView.php">Practical Sessions</a>
			      <a href="Evolution.php">Evaluation</a>
			      <a href="other.php">Other</a>
	    	</div>
	  </div> 
	  <a href="AcademicCoor.php">Academic Coordination</a>
	  <a href="ResearchSup.php">Research Supervision</a>
	  <a href="WorkLoad.php">Workload Summary</a>
	</div>

	<div class="breadcrumb">
		<ul class="bc">
			<li><a href="main.php">Home</a></li>
			<li>Academic Coordination</li>
		</ul>
	</div>


 <div class="tb">
 <form method="POST" id="myForm">
    <table align="center">
         <colgroup>
    <col  style="background-color:#bbb ">
   
  </colgroup>

     
        <thead >
            <tr bgcolor="#178BE0">
            	<th></th>
               <th colspan="2"><h1><b>Activity</b></h1></th>
               <th></th>
               <th><h1> <b>Edit</b></h1></th>
                
            </tr>
        </thead>
      
        <tbody>
           
       

        <tr>
           <td>1</td>
           <td>Faculty (Degree Program) Coordination</td>
           <td>No. of weeks Programme Coordinator/Director PGD Studies</td>
           
           <td> Weeks:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zdirect_PGS;} ?>"></td>
          </td>
          <td><input type="number" name="direct_PGS" ></td>     
        </tr>


         


         <tr>
           <td>2</td>
           <td rowspan="3">Level/Academic Coordination</td>
           <td>No. of weeks academic advisors</td>
           
          
           <td> Weeks:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zaca_advis; }?>"></td></td>
           <td><input type="number" name="aca_advis" >  </td> 
          </tr>

        <tr>
        	<td></td>
        	<td>No. of weeks personal mentor</td>
          	 
             <td>Weeks: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zper_men;} ?>"></td></td>
             <td><input type="number" name="per_men" ></td>  
            </tr>

        <tr>
        	<td></td>
        	 <td>No. of weeks Student Coordinator/Councilors</td>
        	  
            <td> Weeks:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zstu_cor; }?>"></td></td>
            <td><input type="number" name="stu_cor" > </td> 
          </tr>


        <tr>
        	<td>3</td>
        	 <td colspan="2">Academic Coordination</td>
        	
           <td>Weeks: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zaca_coor; }?>"></td></td>
           <td><input type="number" name="aca_coor" ></td> 
          </tr>


               <tr> 
                 <td> 4</td> 
          		 <td colspan="2">No. of students for Research project/Industrial training/Group project/Seminar Coordination</td>
          		 
               <td>Students: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zresearch_p; }?>"></td></td>    
               <td><input type="number" name="research_p" ></td> 
           </tr>
            <tr> 
                 <td> 5</td> 
          		 <td colspan="2">Academic Subject Coordination (e.g. where visiting staff take all the lectures)</td>
          		   
                <td> Subjects per semester:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zaca_sub_coor; }?>"></td></td>
                <td><input type="number" name="aca_sub_coor" ></td> 
           </tr>


          <tr>
          		<td>6 </td> 
          		 <td colspan="2">No of Academic event coordinations </td>
          		  
               <td> Events:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zaca_eve_coor;} ?>"></td></td>
               <td><input type="number" name="aca_eve_coor" ></td>
              </tr>

		<tr>
          <td>7</td> 
          		 <td colspan="2">No. of degree programmes developed </td>
          		 
               <td> Programs:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $znew_degree; }?>"></td></td>
               <td><input type="number" name="new_degree" > </td> 
              </tr>
    
          <tr>
          		<td>8</td> 
          		 <td colspan="2">No. of new courses developed</td>
          		
               <td>Courses: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $znew_course; }?>"></td></td>
               <td><input type="number" name="new_course" ></td> 
              </tr>


          <tr>
          		<td>9</td> 
          		 <td colspan="2">Resource person at curriculum development workshops and training programs </td>
          		 
               <td>Programs:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zresour_per; }?>"></td></td>
               <td><input type="number" name="resour_per" ></td> 
              </tr>

          <tr>
          		<td>10</td> 
          		 <td colspan="2">Contribution to infrastructure development at department, faculty, and university </td>
          		 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zinfra_dev;} ?>"></td></td>
               <td><input type="number" name="infra_dev" ></td> 
              </tr>


          <tr>
          		<td>11</td> 
          		 <td colspan="2">Active engagement in Departmental <br>meetings, Faculty Boards, Faculty Board-subcommittees,<br> Senate, Senate-subcommittees and Representation to Council
</td>
          		
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zmeeting; }?>"></td></td>
               <td><input type="number" name="meeting" ></td> 
              </tr>

          <tr>
          		<td>12</td> 
          		 <td colspan="2">Contribution to student advisory boards, disciplinary inquiry boards </td>
          		 
               <td> Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zstu_advi_board;} ?>"></td></td>
               <td><input type="number" name="stu_advi_board" ></td> 
              </tr>

          <tr>
          		<td>13</td> 
          		 <td colspan="2">Members of the board of studies </td>
          	
               <td>Hours: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zboard_of_stu;} ?>"></td></td>
               <td><input type="number" name="board_of_stu" > </td> 
              </tr>

          <tr>
          		<td>14</td> 
          		 <td colspan="2">Serving as Vice-chancellor, Deputy Vice-chancellor</td>
          		  
               <td>Years:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zVC_DVC;} ?>"></td></td>
               <td><input type="number" name="VC_DVC" ></td>
              </tr>

          <tr>
          		<td>15</td> 
          		 <td colspan="2">Serving as Deans, Directors of Institutes/Centers, Heads of Departments </td>
          		 
               <td>Years: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zdean;} ?>"></td></td>
               <td><input type="number" name="dean" ></td> 
              </tr>


           <tr>
          		<td>16</td> 
          		 <td colspan="2">Serving in positions of Proctor/Deputy Proctor/Senior student Counsellor/Warden </td>
          		
               <td>Years:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zproctor; }?>"></td></td>
               <td><input type="number" name="proctor" ></td> 
              </tr>


           <tr>
          		<td>17</td> 
          		 <td colspan="2">Student Counselor/Sub-Warden </td>
          		
               <td> Years:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zstu_counce; }?>"></td></td>
               <td><input type="number" name="stu_counce" ></td> 
              </tr>


           <tr>
          		<td>18</td> 
          		 <td colspan="2">Serving as Coordinators of faculty/university units </td>
          		 
               <td> Years:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zcoordinators;} ?>"></td></td>
               <td><input type="number" name="coordinator" ></td> 
              </tr>


           <tr>
          		<td>19</td> 
          		 <td colspan="2">Time period as Senior Treasurer of student societies</td>
          		
               <td>Semesters:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zsenior_tresh; }?>"></td></td>
               <td><input type="number" name="senior_tresh" ></td> 
              </tr>

           <tr>
          		<td>20</td> 
          		 <td colspan="2">No. of projects Serving as advisor of national development  </td>
          		
               <td>Projects: <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zadvi_ndp; }?>"></td></td>
               <td><input type="number" name="advi_ndp" ></td> 
              </tr>

           <tr>
          		<td>21</td> 
          		 <td colspan="2">No of projects serving as country representatives of regional/international bodies</td>
          		 
               <td>Projects:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zcountry_rep;}?>"></td></td>
               <td><input type="number" name="country_rep" ></td> 
              </tr>

           <tr>
          		<td>22</td> 
          		 <td colspan="2">Serving as Members of formalized links in outreach activities with private organizations</td>
          		 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zoutreach_act; }?>"></td></td>
               <td><input type="number" name="outreach_act" ></td> 
              </tr>

           <tr>
          		<td>23</td> 
          		 <td colspan="2">Serving as Coordinators of international/national conferences/congresses</td>
          		 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zcoor_confere; }?>"></td></td>
               <td><input type="number" name="coor_confere" > </td> 
              </tr>

           <tr>
          		<td>24</td> 
          		 <td colspan="2">Time period for Serving in any Office of professional bodies /societies</td>
          	 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zserving_office;} ?>"></td></td>
               <td><input type="number" name="serving_office" ></td>
              </tr>

           <tr>
          		<td>25</td> 
          		 <td colspan="2">Time period for Contribution to professional development activities (participation in workshops/training programs, etc.)</td>
          	
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zproffesional_dev; }?>"></td></td>
               <td><input type="number" name="proffesional_dev" ></td> 
              </tr>

           <tr>
          		<td>26</td> 
          		 <td colspan="2">Time period for Contribution to staff development</td>
          		 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zstaff_dev;} ?>"></td></td>
               <td><input type="number" name="staff_dev" ></td> 
              </tr>

           <tr>
          		<td>27</td> 
          		 <td colspan="2">Time period for Contribution to advancement of the profession</td>
          		 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zadvance_prof;} ?>"></td></td>
               <td><input type="number" name="advance_prof" ></td> 
              </tr>

           <tr>
          		<td>28</td> 
          		 <td colspan="2">Time period as Member of technical evaluation committee (TEC)</td>
          		 
               <td> TECH reports:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zTEC; }?>"></td></td>
               <td><input type="number" name="TEC" ></td> 
              </tr>


           <tr>
          		<td>29</td> 
          		 <td colspan="2">Time for any other activity in institutional and/or national development</td>
          		 
               <td>Hours:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $zother;} ?>"></td></td>
               <td><input type="number" name="other" ></td> 
              </tr>

        </tbody>
        <tfoot>
            <tr>
              <td colspan="4 "><B><h2>Total Time</h2> </B></td>
              <td> <input type="text" name="total_sum" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $sum; }?>"> hours</td>   
            </tr>

           
        </tfoot>


    </table>
    <div class="para">   
          <a href="AcademicCoor_download.php" target="_blank"><button type="button" class="btn btn-info">Download</button></a>  
          <button type="submit" value="Submit">Save Changes</button>
          <script>
                function clearForm() {
              document.getElementById("myForm").reset();
            }
    </script>
          <button type="button" onclick="clearForm()">Cancel</button>

    </div>
</form>
   

          


	</div>

	<div class="footer">
    <center><p>&copy;University of Vavuniya-FAS | TaskTimer Workload Management System</p></center>
	</div>
</body>
</html>


<?php 
$connection->close();

?>