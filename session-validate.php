<?php
session_start();
if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
  include("dmiconnect.php");
  $findfac = $db->query("select * from teacher_records where tnum='$user' ")or die("Error. Teacher_Records.");
  if($findfac->num_rows!=0){
    while($rows=$findfac->fetch_assoc())
    {
      $f_fname = $rows['fname'];
      $f_tnum = $rows['tnum'];
      $f_mname = $rows['mname'];
      $f_lname = $rows['lname'];
      $f_bio = $rows['bio'];
      $f_alias = $rows['alias'];
    }
  }

  $findacc = $db->query("select * from accounts where tnum='$user' ")or die("Error. Accounts.");
  if($findacc->num_rows!=0)
  {
    while($rows=$findacc->fetch_assoc())
    {
      $f_stat = $rows['stat'];
      $f_pass = $rows['pass'];
      $f_type = $rows['type'];
      $f_lastsignin = $rows['lastsignin'];
    }
  }

  if($f_type!=1){
    switch($f_type){
      case 0:
      $pageauth = "grading";
      break;
      case 2:
      $pageauth = "enrollment";
      break;
      case 3:
      $pageauth = "library";
      break;
    }

    if($pageauth!=$page){
      header("location: ../$pageauth/");
    }

  }

}else{
  header("location:../index.php");
}

?>
