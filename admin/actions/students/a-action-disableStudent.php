<?php

include("../../../dmiconnect.php");

$snum = $_POST['postSnum'];

$q = $db->query("update student_records set stat=0 where snum = '$snum' ");

if($q){

  echo "
  <div class='alert alert-success'>
    <strong>Saved!</strong>  Student disabled successful.
  </div>
  ";

}else{

  echo "
  <div class='alert alert-danger'>
    <strong>Failed!</strong>  Student disabled unsuccessful.
  </div>
  ";

}



?>
