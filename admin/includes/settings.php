<?php
include("../dmiconnect.php");

$settings = $db->query("select * from settings ")or die("Error. Settings. Please contact your administrator.");
  while($rows=$settings->fetch_assoc()){
    $sysaccess = $rows['sysaccess'];
    $upfees = $rows['upfees'];
    $upbooks = $rows['upbooks'];
    $delbooks = $rows['delbooks'];
    $enrollallow = $rows['enroll'];
  }

?>
