<?php

if(isset($_POST['postBdate']))
{
  $birthDate = $_POST['postBdate'];


  $from = new DateTime("$birthDate");
	$to   = new DateTime('today');
	echo $from->diff($to)->y, "\n";
}
?>
