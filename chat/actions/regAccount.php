<?php

  include("../db_connect.php");

  $fname = mysql_real_escape_string($_POST['postFname']);
  $lname = mysql_real_escape_string($_POST['postLname']);
  $gender = mysql_real_escape_string($_POST['postGender']);
  $user = mysql_real_escape_string($_POST['postUser']);
  $pass = mysql_real_escape_string($_POST['postPass']);

  $checkUser = $db->query("select * from accounts where user='$user' ");
  if($checkUser->num_rows!=0){
    echo "<div class='alert alert-danger'><b>Failed.</b> Username already taken.</div>";
  }else{
    $date = date("Y-m-d H-i-s");
    $addAcc = $db->query("insert accounts (fname,lname,gender,user,pass,date) values('$fname','$lname','$gender','$user','$pass','$date')");
    echo "<script> window.location.replace('index.php'); </script>";
  }

?>
