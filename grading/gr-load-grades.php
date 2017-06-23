<?php

include("../dmiconnect.php");

$snum = $_POST['postSnum'];
$sy = $_POST['postSy'];
$qtr = $_POST['postQtr'];
$subj_code = $_POST['postSubj'];

$studgr = $db->query("select * from student_grades where snum='$snum' and subj_code='$subj_code' and quarter='$qtr' and sy='$sy' ");
  while($rows=$studgr->fetch_assoc())
  {
    $a = $rows['a'];
    $b = $rows['b'];
    $c = $rows['c'];
    $d = $rows['d'];
    $fr = $rows['fr'];
  }

    echo "
    <input type='hidden' id='val-a' value='$a'>
    <input type='hidden' id='val-b' value='$b'>
    <input type='hidden' id='val-c' value='$c'>
    <input type='hidden' id='val-d' value='$d'>
    <input type='hidden' id='val-fr' value='$fr'>
    ";

?>
