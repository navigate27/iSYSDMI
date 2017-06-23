<?php

include("../db_connect.php");

session_start();
$user = $_SESSION['user'];

$findId = $db->query("select * from accounts where user='$user' ");
while($rows=$findId->fetch_assoc()){
  $user_id = $rows['id'];
  $user_fname = $rows['fname'];
  $user_lname = $rows['lname'];
  $user_gender = $rows['gender'];
  $user_user = $rows['user'];
  $user_pass = $rows['pass'];
  $user_date = $rows['date'];
  $user_stat = $rows['stat'];
}


?>
