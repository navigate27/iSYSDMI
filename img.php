<?php

include("dmiconnect.php");

session_start();
$user = $_SESSION['user'];

header("content-type: image/jpeg");
$imgq = $db->query("select * from teacher_records where tnum='$user' ") or die("Can't complete process. Please contact your Administrator.");
  while($rows=$imgq->fetch_assoc())
  {
    $img = $rows['img'];
    echo $img;
  }

?>
