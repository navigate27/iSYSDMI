<?php

  include("../../../dmiconnect.php");

  $tnum = $_POST['postTnum'];
  $user = $_POST['postUser'];
  $pass = $_POST['postPass'];
  $type = $_POST['postType'];

  $user = mysql_real_escape_string($user);
  $pass = mysql_real_escape_string($pass);


  $query = $db->query("update accounts set user='$user',pass='$pass',type='$type' where tnum='$tnum' ");

  if($query){

    echo "
    <div class='alert alert-success'>
      <strong>Success!</strong>  Account successfully updated.
    </div>
    ";

  }else{

    echo "
    <div class='alert alert-danger'>
      <strong>Failed!</strong>  Account not successfully updated.
    </div>
    ";

  }



?>
