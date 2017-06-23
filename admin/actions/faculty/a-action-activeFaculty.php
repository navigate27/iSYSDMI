<?php

include("../../../dmiconnect.php");

$tnum = $_POST['postTnum'];

$q = $db->query("update teacher_records set stat=1 where tnum = '$tnum' ");

if($q){

  echo "
  <div class='alert alert-success'>
    <strong>Saved!</strong>  Faculty successfully activated.
  </div>
  ";

}else{

  echo "
  <div class='alert alert-danger'>
    <strong>Failed!</strong>  Faculty unsuccessfully activated.
  </div>
  ";

}



?>
