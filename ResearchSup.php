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
$query = "SELECT * FROM research_supervision WHERE EmployeeID = '$empID' AND Academic_year = '$academicYear'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    // Create a new user data record with zero values for other variables
    $insertQuery = "INSERT INTO research_supervision (EmployeeID,Academic_year, no_of_research, mem_of_rct, ref_jour, non_ref_jour, conference_ppr, extended_abs, abstract, author_of_bk, author_chap_of_bk, author_monograph, author_policyppr, author_consultancy_repo, soft_dev, media_pro, translation_pub, peer_reviewed, Editor, co_editor, member_editorial, chair_national, chair_international, workshop_cor, reviewer, PhD_Full_Time, PhD_Part_Time, M_Phil_Full_Time, MPhil_Part_Time, MSc_Full_Time, Course_based_MSc_Part_Time, Research_projects) 
    VALUES ('$empID','$academicYear', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0)";
    
    
    $insertResult = mysqli_query($connection, $insertQuery);

    if (!$insertResult) {
        die("Error: " . mysqli_error($connection));
    }
}
?>


<?php
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) {

// Get the user input from the form
$checkbox1 = isset($_POST['checkbox1']) ? intval($_POST['checkbox1']) : 0;
$checkbox2 = isset($_POST['checkbox2']) ? intval($_POST['checkbox2']) : 0;
$checkbox3 = isset($_POST['checkbox3']) ? intval($_POST['checkbox3']) : 0;
$checkbox4 = isset($_POST['checkbox4']) ? intval($_POST['checkbox4']) : 0;
$checkbox5 = isset($_POST['checkbox5']) ? intval($_POST['checkbox5']) : 0;
$checkbox6 = isset($_POST['checkbox6']) ? intval($_POST['checkbox6']) : 0;
$checkbox7 = isset($_POST['checkbox7']) ? intval($_POST['checkbox7']) : 0;
$checkbox8 = isset($_POST['checkbox8']) ? intval($_POST['checkbox8']) : 0;
$checkbox9 = isset($_POST['checkbox9']) ? intval($_POST['checkbox9']) : 0;
$checkbox10 = isset($_POST['checkbox10']) ? intval($_POST['checkbox10']) : 0;
$checkbox11 = isset($_POST['checkbox11']) ? intval($_POST['checkbox11']) : 0;
$checkbox12 = isset($_POST['checkbox12']) ? intval($_POST['checkbox12']) : 0;
$checkbox13 = isset($_POST['checkbox13']) ? intval($_POST['checkbox13']) : 0;
$checkbox14 = isset($_POST['checkbox14']) ? intval($_POST['checkbox14']) : 0;
$checkbox15 = isset($_POST['checkbox15']) ? intval($_POST['checkbox15']) : 0;
$checkbox16 = isset($_POST['checkbox16']) ? intval($_POST['checkbox16']) : 0;
$checkbox17 = isset($_POST['checkbox17']) ? intval($_POST['checkbox17']) : 0;
$checkbox18 = isset($_POST['checkbox18']) ? intval($_POST['checkbox18']) : 0;
$checkbox19 = isset($_POST['checkbox19']) ? intval($_POST['checkbox19']) : 0;
$checkbox20 = isset($_POST['checkbox20']) ? intval($_POST['checkbox20']) : 0;
$checkbox21 = isset($_POST['checkbox21']) ? intval($_POST['checkbox21']) : 0;
$checkbox22 = isset($_POST['checkbox22']) ? intval($_POST['checkbox22']) : 0;

$checkbox23 = isset($_POST['checkbox23']) ? intval($_POST['checkbox23']) : 0;
$checkbox24 = isset($_POST['checkbox24']) ? intval($_POST['checkbox24']) : 0;
$checkbox25 = isset($_POST['checkbox25']) ? intval($_POST['checkbox25']) : 0;
$checkbox26 = isset($_POST['checkbox26']) ? intval($_POST['checkbox26']) : 0;
$checkbox27 = isset($_POST['checkbox27']) ? intval($_POST['checkbox27']) : 0;
$checkbox28 = isset($_POST['checkbox28']) ? intval($_POST['checkbox28']) : 0;
$checkbox29 = isset($_POST['checkbox29']) ? intval($_POST['checkbox29']) : 0;
$checkbox30 = isset($_POST['checkbox30']) ? intval($_POST['checkbox30']) : 0;


// Multiply the user input value with some other values 

$mcheckbox1 =$checkbox1 * 50;
$mcheckbox2 = $checkbox2*20;
$mcheckbox3 = $checkbox3*50;
$mcheckbox4 = $checkbox4*40;
$mcheckbox5 = $checkbox5*30;
$mcheckbox6 = $checkbox6*20;
$mcheckbox7 = $checkbox7*10;
$mcheckbox8 = $checkbox8*200;
$mcheckbox9 = $checkbox9*50;
$mcheckbox10 = $checkbox10*50;
$mcheckbox11 = $checkbox11*50;
$mcheckbox12 = $checkbox12*50;
$mcheckbox13 = $checkbox13*50;
$mcheckbox14 = $checkbox14*30;
$mcheckbox15 = $checkbox15*25;
$mcheckbox16 = $checkbox16*20;
$mcheckbox17 = $checkbox17*100;
$mcheckbox18 = $checkbox18*50;
$mcheckbox19 = $checkbox19*25;
$mcheckbox20 = $checkbox20*100;
$mcheckbox21 = $checkbox21*150;
$mcheckbox22 = $checkbox22*20;
$mcheckbox23 = $checkbox23*10;
$mcheckbox24 = $checkbox24*90;
$mcheckbox25 = $checkbox25*45;
$mcheckbox26 = $checkbox26*90;
$mcheckbox27 = $checkbox27*45;
$mcheckbox28 = $checkbox28*60;
$mcheckbox29 = $checkbox29*20;
$mcheckbox30 = $checkbox30*10;



// Update queries for each field

if (!empty($mcheckbox1)) {
    $sql = "UPDATE research_supervision SET no_of_research = $mcheckbox1 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox2)) {
    $sql = "UPDATE research_supervision SET mem_of_rct = $mcheckbox2 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox3)) {
    $sql = "UPDATE research_supervision SET ref_jour =  $mcheckbox3 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox4)) {
    $sql = "UPDATE research_supervision SET non_ref_jour = $mcheckbox4 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox5)) {
    $sql = "UPDATE research_supervision SET conference_ppr = $mcheckbox5 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox6)) {
    $sql = "UPDATE research_supervision SET extended_abs = $mcheckbox6 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox7)) {
    $sql = "UPDATE research_supervision SET abstract = $mcheckbox7 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox8)) {
    $sql = "UPDATE research_supervision SET author_of_bk = $mcheckbox8 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox9)) {
    $sql = "UPDATE research_supervision SET author_chap_of_bk = $mcheckbox9 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox10)) {
    $sql = "UPDATE research_supervision SET author_monograph = $mcheckbox10 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox11)) {
    $sql = "UPDATE research_supervision SET author_policyppr = $mcheckbox11 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox12)) {
    $sql = "UPDATE research_supervision SET author_consultancy_repo = $mcheckbox12 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox13)) {
    $sql = "UPDATE research_supervision SET soft_dev = $mcheckbox13 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox14)) {
    $sql = "UPDATE research_supervision SET media_pro =  $mcheckbox14 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox15)) {
    $sql = "UPDATE research_supervision SET translation_pub = $mcheckbox15 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox16)) {
    $sql = "UPDATE research_supervision SET peer_reviewed = $mcheckbox16 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox17)) {
    $sql = "UPDATE research_supervision SET Editor = $mcheckbox17 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox18)) {
    $sql = "UPDATE research_supervision SET co_editor = $mcheckbox18 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox19)) {
    $sql = "UPDATE research_supervision SET member_editorial = $mcheckbox19 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox20)) {
    $sql = "UPDATE research_supervision SET chair_national = $mcheckbox20 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox21)) {
    $sql = "UPDATE research_supervision SET chair_international = $mcheckbox21 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox22)) {
    $sql = "UPDATE research_supervision SET workshop_cor = $mcheckbox22 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox23)) {
    $sql = "UPDATE research_supervision SET reviewer = $mcheckbox23 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox24)) {
    $sql = "UPDATE research_supervision SET PhD_Full_Time = $mcheckbox24 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox25)) {
    $sql = "UPDATE research_supervision SET PhD_Part_Time =$mcheckbox25 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox26)) {
    $sql = "UPDATE research_supervision SET M_Phil_Full_Time = $mcheckbox26 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox27)) {
    $sql = "UPDATE research_supervision SET MPhil_Part_Time = $mcheckbox27 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox28)) {
    $sql = "UPDATE research_supervision SET MSc_Full_Time = $mcheckbox28 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox29)) {
    $sql = "UPDATE research_supervision SET Course_based_MSc_Part_Time = $mcheckbox29 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}

if (!empty($mcheckbox30)) {
    $sql = "UPDATE research_supervision SET Research_projects = $mcheckbox30 WHERE EmployeeID = '{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
    mysqli_query($connection, $sql);
}







// Build SQL statement to insert checkbox values into database
$sql1="SELECT no_of_research from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result1 = mysqli_query($connection, $sql1);$row1 = mysqli_fetch_assoc($result1);$eno_of_research = $row1['no_of_research'];$zno_of_research = $row1['no_of_research']/50;
$sql2="SELECT mem_of_rct from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result2 = mysqli_query($connection, $sql2);$row2 = mysqli_fetch_assoc($result2);$emem_of_rct = $row2['mem_of_rct'];$zmem_of_rct = $row2['mem_of_rct']/20;
$sql3="SELECT ref_jour from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result3 = mysqli_query($connection, $sql3);$row3 = mysqli_fetch_assoc($result3);$eref_jour = $row3['ref_jour'];$zref_jour = $row3['ref_jour']/50;
$sql4="SELECT non_ref_jour from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result4 = mysqli_query($connection, $sql4);$row4 = mysqli_fetch_assoc($result4);$enon_ref_jour = $row4['non_ref_jour'];$znon_ref_jour = $row4['non_ref_jour']/40;
$sql5="SELECT conference_ppr from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result5 = mysqli_query($connection, $sql5);$row5 = mysqli_fetch_assoc($result5);$econference_ppr = $row5['conference_ppr'];$zconference_ppr = $row5['conference_ppr']/30;
$sql6="SELECT extended_abs from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result6 = mysqli_query($connection, $sql6);$row6 = mysqli_fetch_assoc($result6);$eextended_abs = $row6['extended_abs'];$zextended_abs = $row6['extended_abs']/20;
$sql7="SELECT abstract from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result7 = mysqli_query($connection, $sql7);$row7 = mysqli_fetch_assoc($result7);$eabstract = $row7['abstract'];$zabstract = $row7['abstract']/10;
$sql8  ="SELECT author_of_bk from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result8 = mysqli_query($connection, $sql8);$row8 = mysqli_fetch_assoc($result8);$eauthor_of_bk = $row8['author_of_bk'];$zauthor_of_bk = $row8['author_of_bk']/200;
$sql9  ="SELECT author_chap_of_bk from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result9 = mysqli_query($connection, $sql9);$row9 = mysqli_fetch_assoc($result9);$eauthor_chap_of_bk = $row9['author_chap_of_bk'];$zauthor_chap_of_bk = $row9['author_chap_of_bk']/50;
$sql10="SELECT author_monograph from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result10 = mysqli_query($connection, $sql10);$row10 = mysqli_fetch_assoc($result10);$eauthor_monograph= $row10['author_monograph'];$zauthor_monograph= $row10['author_monograph']/50;
$sql11="SELECT author_policyppr from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result11 = mysqli_query($connection, $sql11);$row11 = mysqli_fetch_assoc($result11);$eauthor_policyppr = $row11['author_policyppr'];$zauthor_policyppr = $row11['author_policyppr']/50;
$sql12="SELECT author_consultancy_repo from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result12 = mysqli_query($connection, $sql12);$row12 = mysqli_fetch_assoc($result12);$eauthor_consultancy_repo = $row12['author_consultancy_repo'];$zauthor_consultancy_repo = $row12['author_consultancy_repo']/50;
$sql13="SELECT soft_dev from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result13 = mysqli_query($connection, $sql13);$row13 = mysqli_fetch_assoc($result13);$esoft_dev = $row13['soft_dev'];$zsoft_dev = $row13['soft_dev']/50;
$sql14="SELECT media_pro from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result14 = mysqli_query($connection, $sql14);$row14 = mysqli_fetch_assoc($result14);$emedia_pro = $row14['media_pro'];$zmedia_pro = $row14['media_pro']/30;
$sql15="SELECT translation_pub from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result15 = mysqli_query($connection, $sql15);$row15 = mysqli_fetch_assoc($result15);$etranslation_pub = $row15['translation_pub'];$ztranslation_pub = $row15['translation_pub']/25;
$sql16="SELECT peer_reviewed from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result16 = mysqli_query($connection, $sql16);$row16 = mysqli_fetch_assoc($result16);$epeer_reviewed = $row16['peer_reviewed'];$zpeer_reviewed = $row16['peer_reviewed']/20;
$sql17="SELECT Editor from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result17 = mysqli_query($connection, $sql17);$row17 = mysqli_fetch_assoc($result17);$eEditor = $row17['Editor'];$zEditor = $row17['Editor']/100;
$sql18="SELECT co_editor from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result18 = mysqli_query($connection, $sql18);$row18 = mysqli_fetch_assoc($result18);$eco_editor = $row18['co_editor'];$zco_editor = $row18['co_editor']/50;
$sql19="SELECT member_editorial from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result19 = mysqli_query($connection, $sql19);$row19 = mysqli_fetch_assoc($result19);$emember_editorial = $row19['member_editorial'];$zmember_editorial = $row19['member_editorial']/25;
$sql20="SELECT chair_national from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result20 = mysqli_query($connection, $sql20);$row20 = mysqli_fetch_assoc($result20);$echair_national = $row20['chair_national'];$zchair_national = $row20['chair_national']/100;
$sql21="SELECT chair_international from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result21 = mysqli_query($connection, $sql21);$row21 = mysqli_fetch_assoc($result21);$echair_international = $row21['chair_international'];$zchair_international = $row21['chair_international']/150;
$sql22="SELECT workshop_cor from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result22 = mysqli_query($connection, $sql22);$row22 = mysqli_fetch_assoc($result22);$eworkshop_cor = $row22['workshop_cor'];$zworkshop_cor = $row22['workshop_cor']/20;
$sql23="SELECT reviewer from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result23 = mysqli_query($connection, $sql23);$row23 = mysqli_fetch_assoc($result23);$ereviewer= $row23['reviewer'];$zreviewer= $row23['reviewer']/10;
$sql24="SELECT PhD_Full_Time from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result24 = mysqli_query($connection, $sql24);$row24 = mysqli_fetch_assoc($result24);$ePhD_Full_Time= $row24['PhD_Full_Time'];$zPhD_Full_Time= $row24['PhD_Full_Time']/90;
$sql25="SELECT PhD_Part_Time from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result25 = mysqli_query($connection, $sql25);$row25 = mysqli_fetch_assoc($result25);$ePhD_Part_Time= $row25['PhD_Part_Time'];$zPhD_Part_Time= $row25['PhD_Part_Time']/45;
$sql26="SELECT M_Phil_Full_Time from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result26 = mysqli_query($connection, $sql26);$row26 = mysqli_fetch_assoc($result26);$eM_Phil_Full_Time= $row26['M_Phil_Full_Time'];$zM_Phil_Full_Time= $row26['M_Phil_Full_Time']/90;
$sql27="SELECT MPhil_Part_Time from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result27 = mysqli_query($connection, $sql27);$row27 = mysqli_fetch_assoc($result27);$eMPhil_Part_Time= $row27['MPhil_Part_Time'];$zMPhil_Part_Time= $row27['MPhil_Part_Time']/45;
$sql28="SELECT MSc_Full_Time from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result28 = mysqli_query($connection, $sql28);$row28 = mysqli_fetch_assoc($result28);$eMSc_Full_Time= $row28['MSc_Full_Time'];$zMSc_Full_Time= $row28['MSc_Full_Time']/60;
$sql29="SELECT Course_based_MSc_Part_Time from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result29 = mysqli_query($connection, $sql29);$row29 = mysqli_fetch_assoc($result29);$eCourse_based_MSc_Part_Time= $row29['Course_based_MSc_Part_Time'];$zCourse_based_MSc_Part_Time= $row29['Course_based_MSc_Part_Time']/20;
$sql30="SELECT Research_projects from research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";$result30 = mysqli_query($connection, $sql30);$row30 = mysqli_fetch_assoc($result30);$eResearch_projects= $row30['Research_projects'];$zResearch_projects= $row30['Research_projects']/10;



  
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])){
  $sum=0;
// Get data from database
$sql = "SELECT * FROM research_supervision WHERE EmployeeID='{$_SESSION['EmployeeID']}' AND Academic_year = '{$_SESSION['Academic_year']}'";
$result = mysqli_query($connection, $sql);




// Calculate sum for each row and display in the same input tag
while ($row = mysqli_fetch_assoc($result)) {
    $sum = $row['no_of_research'] + $row['mem_of_rct'] + $row['ref_jour']+$row['non_ref_jour'] + $row['conference_ppr'] + $row['extended_abs']+
    $row['abstract'] + $row['author_of_bk']+ $row['author_chap_of_bk'] + $row['author_monograph']+$row['author_policyppr'] + $row['author_consultancy_repo'] + $row['soft_dev']+$row['media_pro'] +
     $row['translation_pub'] + $row['peer_reviewed']+$row['Editor'] + $row['co_editor'] + $row['member_editorial']+$row['chair_national'] + $row['chair_international'] + $row['workshop_cor']+
     $row['reviewer']+$row['PhD_Full_Time']+$row['PhD_Part_Time']+$row['M_Phil_Full_Time']+$row['MPhil_Part_Time']+$row['MSc_Full_Time']+$row['Course_based_MSc_Part_Time']+$row['Research_projects'];
    
}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Research Supervision</title>
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

        .tb{
            width: 100%;
            font-size: 15px;
            font-family: Times New Roman;

             
        }

      table {
            width:100%;
          
            border-radius: 30px;
            margin-top: 40px;
            padding-top: 20px;
            font-family: Times New Roman;
            
        }
        h1{
            font-size: 25px;
        }
        table,
        th,
        td {
            border: none;
            border-collapse: collapse;
            
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
            padding-left: 20px;
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
        padding: 15px 20px;
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
            margin-top: 1px;
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
          font-size: 12px;
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
            <li>Research Supervision</li>
        </ul>
    </div>
   
 <div class="tb">
 
 <form method="POST" id="myForm">
    
<table align="center">
        
         <colgroup>
    <col  style="background-color:white">
   
        </colgroup>

 

  
        <thead>
            <tr bgcolor="#178BE0">
            	<th></th>
               <th ><h1><b>Activity</b></h1></th>
               <th></th>
               <th><h1> <b>Edit</b></h1></th>
               
                
            </tr>
        </thead>
      
        <tbody>
        <tr>
           <td>1</td>
           <td>PhD Full Time</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zPhD_Full_Time; }?>"> 
        </td>
        <td><input type="number" name="checkbox24"></td>
           
        </tr>
        <tr>
           <td>2</td>
           <td>PhD Part Time</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zPhD_Part_Time; }?>"> 
        </td>
        <td><input type="number" name="checkbox25"></td>
           
        </tr>
        <tr>
           <td>3</td>
           <td>M Phil Full Time</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zM_Phil_Full_Time; }?>"> 
        </td>
        <td><input type="number" name="checkbox26"></td>
           
        </tr> 
        <tr>
           <td>4</td>
           <td>MPhil Part Time</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zMPhil_Part_Time; }?>"> 
        </td>
        <td><input type="number" name="checkbox27"></td>
           
        </tr>
        <tr>
           <td>5</td>
           <td>MSc Full Time</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zMSc_Full_Time; }?>"> 
        </td>
        <td><input type="number" name="checkbox28"></td>
           
        </tr>
        <tr>
           <td>6</td>
           <td>Course based MSc Part Time</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zCourse_based_MSc_Part_Time; }?>"> 
        </td>
        <td><input type="number" name="checkbox29"></td>
           
        </tr>
        <tr>
           <td>7</td>
           <td>Research projects which involve undergraduate students</td>
           
           <td>No of students:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zResearch_projects; }?>"> 
        </td>
        <td><input type="number" name="checkbox30"></td>
           
        </tr>

        <tr>
           <td>8</td>
           <td>No of research grants received</td>
           
           <td>Research Grants:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zno_of_research; }?>"> 
        </td>
        <td><input type="number" name="checkbox1"></td>
           
        </tr>

        <tr>
            <td>9</td>
             <td >No of years as member of research consultants team </td>
             <td>Years:
             <input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zmem_of_rct; }?>"> 
            </td>
             
             <td><input type="number" name="checkbox2" > </td>
             
        </tr>


         <tr>
           <td rowspan="6">10</td>
          
           <td colspan="3">Research Publications:</td>
           
           
        </tr>

        <tr>
        	
        	<td>No of Refereed journal</td>
            
            <td>Articles:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zref_jour; }?>">
            </td>
            <td><input type="number" name="checkbox3" ></td>
            </tr>

        <tr>
        	
        	 <td>No of Non-refereed journal</td>
             <td>Articles:<input  type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $znon_ref_jour; }?>">
            </td>
             <td><input type="number" name="checkbox4" ></td>
             
        	 
        </tr>

 <tr>
            
             <td>No of Conference papers</td>
             <td>Articles:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zconference_ppr; }?>">
            </td>
             <td><input type="number" name="checkbox5"  ></td>
             
        </tr>

        <tr>
            
             <td>No of Extended abstracts</td>
             <td>Abstracts:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zextended_abs; }?>">
            </td>
             <td><input type="number" name="checkbox6"  ></td>
        </tr>

 <tr>
         
             <td>No of Abstracts</td>
             <td>Abstracts:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zabstract; }?>">
            </td>
             <td><input type="number" name="checkbox7"  > </ts>
             
              
        </tr>


            <tr> 
                 <td> 11</td> 
          		 <td >No of books authored</td>
               
                <td>Books:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zauthor_of_bk; }?>">
            </td>
            <td><input type="number" name="checkbox8" ></td>    
     
           </tr>

           <tr> 
                 <td> </td> 
          		 <td >No of chapters authored</td>
               
                <td>Chapters:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zauthor_chap_of_bk; }?>">
            </td>
            <td><input type="number" name="checkbox9" ></td>    
     
           </tr>

            <tr> 
                 <td> 12</td> 
                 <td> No of monographs as author</td>
                 
                 <td>Monographs:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zauthor_monograph; }?>">
                </td>
                <td><input type="number" name="checkbox10" ></td>
                 
           </tr>


          <tr>
          		<td>13</td> 
          		<td >No of policy papers as author</td>
                  
                  <td>Policy papers:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zauthor_policyppr; }?>">
                </td>
                <td><input type="number" name="checkbox11"></td>
          </tr>

		<tr>
          		<td>14</td> 
          		 <td >No of consultancy reports as author</td>
                  
                   <td>Reports:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zauthor_consultancy_repo; }?>">
                </td>
                <td><input type="number" name="checkbox12" ></td>
          </tr>


          <tr>
          		<td>15</td> 
          		 <td >No of Software developments </td>
                  
                   <td>Softwares:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zsoft_dev; }?>">
                </td>
                <td><input type="number" name="checkbox13"></td>
          </tr>


			<tr>
          		<td>16</td> 
          		 <td >No of Media projects and products</td>
              
                <td>Projects/Products:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zmedia_pro; }?>">
            </td>
            <td><input type="number" name="checkbox14" ></td>
          </tr>


          <tr>
          		<td>17</td> 
          		 <td>No. of Translation and publication of books and scholarly work</td>
                
                <td>Hundred page sets:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $ztranslation_pub; }?>">
            </td>
            <td><input type="number" name="checkbox15" ></td>
          </tr>

          <tr>
          		<td>18</td> 
          		 <td >No of peer-reviewed presentations at national/international conference</td>
                  
                   <td>Presentations:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zpeer_reviewed; }?>">
                </td>
                <td><input type="number" name="checkbox16" ></td>
          </tr>


          <tr>
          		<td>19</td> 
          		 <td>No. of Editor of the reputed journals and proceedings</td>
                   
                   <td>Journals/proceedings:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zEditor; }?>"> 
                </td>
                <td><input type="number" name="checkbox17" ></td>
          </tr>

          <tr>
          		<td>20</td> 
          		 <td >No. of Associate-/Co- editor, of reputed journals and proceedings</td>
                   
                   <td>Journals/proceedings:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zco_editor; }?>">
                </td>
                <td><input type="number" name="checkbox18" ></td>
          </tr>

          <tr>
          		<td>21</td> 
          		 <td >No. of Memberships of the editorial board of a reputed journal or proceeding</td>
                   
                   <td>Journals/proceedings:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zmember_editorial; }?>">
                </td>
                <td><input type="number" name="checkbox19" ></td>
          </tr>

          

          <tr>
          		 <td rowspan="2">22</td> 
          		 <td >No of events being Chairperson/Coordinator research symposia,
            conferences (national)</td>

            <td>Events:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zchair_national; }?>">
            </td>
            <td><input type="number" name="checkbox20"  ></td>		 
                    </tr>
            <tr>
                        <td>No of events being Chairperson/Coordinator research symposia,
            conferences (international)</td>

            <td>Events:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zchair_international; }?>">
            </td>
            <td><input type="number" name="checkbox21"  > </td>     
        </tr>


           <tr>
          		<td>23</td> 
          		 <td >Workshop coordinator</td>
                 
                   <td>Events:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zworkshop_cor; }?>">
                </td>
                <td><input type="number" name="checkbox22" ></td>
          </tr>


           <tr>
          		<td>24</td> 
          		 <td> Reviewer of research proposals and articles for publication</td>
                 
                   <td> Proposal/article:<input type="text" class="texts" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_SERVER['HTTP_REFERER'])) { echo $zreviewer; }?>">
                </td>
                <td><input type="number" name="checkbox23" ></td>
          </tr>


          

        </tbody>
        <tfoot>
        <tr>
              <td colspan="3 "><B><h2>Total Time</h2> </B></td>
              <td> <input type="text" name="total_sum" value=" <?php if($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SERVER['HTTP_REFERER'])) { echo $sum; }?>"> hours</td>   
            </tr> 

        </tfoot>


    </table>
    <div class="para"> 
      
          <a href="ResearchSup_download.php" target="_blank"><button type="button" class="btn btn-info">Download</button></a>    
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
mysqli_close($connection);
?>