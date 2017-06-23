<?php
  include("info.php");
  date_default_timezone_set('Asia/Taipei');
  $db= new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db_name) or die("Unable to connect");
?>
