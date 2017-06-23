<?php

include("../../../dmiconnect.php");

$settings = $db->query("select * from settings ")or die("Error. Settings. Please contact your administrator.");
  while($rows=$settings->fetch_assoc()){
    $upfees = $rows['upfees'];
  }



  if($upfees!=1){

    echo "
    <div class='alert alert-warning'><strong>Failed.</strong> Updating Fees is disabled by your admin.</div>
    ";

  }else{

    $level_id = $_POST['postLevel'];
    $books = $_POST['postBooks'];
    $tfee = $_POST['postTfee'];
    $pe = $_POST['postPe'];
    $sc = $_POST['postSc'];
    $misc = $_POST['postMisc'];

    $query = $db->query("update fees set books='$books',tfee='$tfee',pe='$pe',sc='$sc',misc='$misc' where level='$level_id' ");

    //insert activity
      $findlvl = $db->query("select * from levels where id='$level_id'");
      while($rows=$findlvl->fetch_assoc()){
        $level = $rows['level'];
      }
      $act = "<i class='fa fa-pencil'></i> <i class='fa fa-money'></i> <strong class='text-primary'>$level</strong> fees updated";
      $act = mysql_real_escape_string($act);
      $addAct = $db->query("insert into activities (activity) values('$act')");

    if($query){
      echo "
      <div class='alert alert-success'><strong>Success!</strong> Updated successfully.</div>
      ";

    }else{
      echo "
      <div class='alert alert-danger'><strong>Failed!</strong> There is something wrong in the process. Please contact your administrator.</div>
      ";
    }

  }
?>
