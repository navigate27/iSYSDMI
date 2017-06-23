<?php

include("dmiconnect.php");


$user = $_POST['postUser'];
$pass = $_POST['postPass'];



  $findacc = $db->query("select * from accounts where user='$user' and pass='$pass' ")or die("<div class='alert alert-danger'><strong>Error. </strong>There is a problem while signing in. Please try again.</div>");
  if($findacc->num_rows!=0){
    while($rows=$findacc->fetch_assoc())
    {
      $type = $rows['type'];
      $stat = $rows['stat'];
    }
      $findtnum = $db->query("select * from teacher_records where tnum='$user' ")or die("<div class='alert alert-danger'><strong>Error. </strong>There is a problem while signing in. Please try again.</div>");
        while($rows=$findtnum->fetch_assoc())
        {
          $fname = $rows['fname'];
          $lname = $rows['lname'];
        }

      if($type!=1){
        switch($type){
          case 0:
            $act = "<i class='fa fa-sign-in'></i> Teacher<span class='text-success'><strong>$lname</strong></span> signed in";
            $act = mysql_real_escape_string($act);
            $addAct = $db->query("insert into activities (activity) values('$act')");
          break;
          case 2:
            $act = "<i class='fa fa-sign-in'></i> <span class='text-primary'><strong>Financial Dept. Head</strong></span> signed in";
            $act = mysql_real_escape_string($act);
            $addAct = $db->query("insert into activities (activity) values('$act')");
          break;
          case 3:
            $act = "<i class='fa fa-sign-in'></i> <span class='text-danger'><strong>Librarian</strong></span> signed in";
            $act = mysql_real_escape_string($act);
            $addAct = $db->query("insert into activities (activity) values('$act')");
          break;
        }
      }
      // $settings = $db->query("select * from settings ")or die("Error. Settings. Please contact your administrator.");
      //   while($rows=$settings->fetch_assoc()){
      //     $sysacc = $rows['sysaccess'];
      //   }
      //
      //   if($sysacc!=1){
      //
      //     if($type==1){
      //
      //     }else{
      //
      //     }
      //
      //   }else{
      //
      //   }


    if($stat==1){

      session_start();
      $_SESSION['user'] = $user;

      echo "
      <input type='hidden' id='login-type' value='$type'>
      <div class='alert alert-success>
      <strong>Login Success!</strong>
      </div>
      ";

    }else{

      echo "
      <div class='alert alert-warning alert-dismissable'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      <strong>Login Failed. Account disabled.</strong>
      </div>
      ";

    }

  }else{
  ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Login Failed.</strong> Invalid username or password.
    </div>
  <?php
  }
  ?>
