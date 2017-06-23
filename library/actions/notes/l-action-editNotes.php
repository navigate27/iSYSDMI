<?php

include("../../../dmiconnect.php");

$date = date("Y-m-d H:i:s");
$id = $_POST['postId'];
$title = $_POST['postTitle'];
$notes = $_POST['postNotes'];

$title = mysql_real_escape_string($title);
$notes = mysql_real_escape_string($notes);

$query = $db->query("update lib_notes set title='$title',notes='$notes',date='$date' where id='$id' ");

if($query){

  echo "<div class='alert alert-success'><strong>Success!</strong> Note successfully updated.</div>";

}else{

  echo "<div class='alert alert-danger'><strong>Failed!</strong> There is an error saving your note. Please try again later.</div>";

}


?>
