<?php

  include("../db_connect.php");

  $user = mysql_real_escape_string($_POST['postUser']);
  $pass = mysql_real_escape_string($_POST['postPass']);

  $checkAcc = $db->query("select * from accounts where user='$user' and pass='$pass' and stat=1 ");
    if($checkAcc->num_rows!=0){
      session_start();
      $_SESSION['user'] = $user;
      echo "<script> window.location.replace('channel/'); </script>";
    }else{
      echo "<div class='alert alert-danger'><b>Login Failed.</b> Invalid account name.</div>";
    }





?>
