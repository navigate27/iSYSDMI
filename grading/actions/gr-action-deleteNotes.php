<?php
include("../../dmiconnect.php");

$id = $_POST['postId'];

$query = $db->query("update gr_notes set stat='0' where id='$id' ");

if($query){

  echo "<div class='alert alert-success'><strong>Success!</strong> Note successfully deleted.</div>";

}else{

  echo "<div class='alert alert-danger'><strong>Failed!</strong> There is an error deleting your note. Please try again later.</div>";

}


?>
