<?php
include("../../session-validate.php");
include("../../dmiconnect.php");

$date = date("Y-m-d H:i:s");
$title = $_POST['postTitle'];
$notes = $_POST['postNotes'];

$title = mysql_real_escape_string($title);
$notes = mysql_real_escape_string($notes);

$query = $db->query("insert into gr_notes(title,notes,date,tnum) values('$title','$notes','$date','$user') ");

if($query){

  echo "<div class='alert alert-success'><strong>Success!</strong> Note successfully added.</div>";

}else{

  echo "<div class='alert alert-danger'><strong>Failed!</strong> There is an error saving your note. Please try again later.</div>";

}


?>
