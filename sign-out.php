<?php
include("dmiconnect.php");
session_start();

  $user = $_SESSION['user'];
  $currentDateTime = date("Y-m-d H:i:s");
  $lastsignin = $db->query("update accounts set lastsignin='$currentDateTime' ");
  $findacc = $db->query("select * from accounts where tnum='$user' ")or die("Error. Accounts.");
  if($findacc->num_rows!=0)
  {
    while($rows=$findacc->fetch_assoc())
    {
      $f_type = $rows['type'];
    }
  }

  if($f_type!=1){
    switch($f_type){
      case 0:
        $act = "<i class='fa fa-sign-out'></i> <span class='text-success'><strong>Tr. $lname</strong></span> signed out";
        $act = mysql_real_escape_string($act);
        $addAct = $db->query("insert into activities (activity) values('$act')");
      break;
      case 2:
        $act = "<i class='fa fa-sign-out'></i> <span class='text-primary'><strong>Financial Dept. Head</strong></span> signed out";
        $act = mysql_real_escape_string($act);
        $addAct = $db->query("insert into activities (activity) values('$act')");
      break;
      case 3:
        $act = "<i class='fa fa-sign-out'></i> <span class='text-danger'><strong>Librarian</strong></span> signed out";
        $act = mysql_real_escape_string($act);
        $addAct = $db->query("insert into activities (activity) values('$act')");
      break;
    }
  }


session_destroy();
header("location: index.php");
?>
