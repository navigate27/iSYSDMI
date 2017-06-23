<?php
  include("info.php");
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die(mysql_error());
$db=mysql_select_db($mysql_db_name, $conn) or die(mysql_error());
?>
