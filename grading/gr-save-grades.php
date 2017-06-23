<?php

include("../dmiconnect.php");

$a = $_POST['postA'];
$b = $_POST['postB'];
$c = $_POST['postC'];
$d = $_POST['postD'];
$fr = $_POST['postFr'];
$qtr = $_POST['postQtr'];
$sy = $_POST['postSy'];
$snum = $_POST['postSnum'];
$subj_code = $_POST['postSubj'];


$query = $db->query("update student_grades set a='$a',b='$b',c='$c',d='$d',fr='$fr' where snum='$snum' and subj_code='$subj_code' and quarter='$qtr' and sy='$sy' ")or die("Error. Student_Grades. Save.");

if($query){
  echo "Success.";
}else{
  echo "Error.";
}
?>
