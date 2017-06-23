<?php

include("../db_connect.php");

$user = $_POST['postUser'];
$msg = $_POST['postMsg'];
$datetime = date("Y-m-d H:i:s");

$saveMsg = $db->query("insert into messages(msg,sender,datetime) values('$msg','$user','$datetime') ")or die("Cant insert.");

include("../includes/loadContent.php");


?>
