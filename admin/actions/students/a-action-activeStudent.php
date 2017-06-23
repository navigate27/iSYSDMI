<?php

include("../../../dmiconnect.php");

$snum = $_POST['postSnum'];

$q = $db->query("update student_records set stat=1 where snum = '$snum' ");

if($q){

  echo "
  <div class='alert alert-success'>
    <strong>Saved!</strong>  Student successfully activated.
  </div>
  ";

}else{

  echo "
  <div class='alert alert-danger'>
    <strong>Failed!</strong>  Student unsuccessfully activated.
  </div>
  ";

}



?>
