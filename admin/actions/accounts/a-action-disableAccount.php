<?php

include("../../../dmiconnect.php");

$tnum = $_POST['postTnum'];

$q = $db->query("update accounts set stat=0 where tnum = '$tnum' ");

if($q){

  echo "
  <div class='alert alert-success'>
    <strong>Saved!</strong>  Faculty account disabled successful.
  </div>
  ";

}else{

  echo "
  <div class='alert alert-danger'>
    <strong>Failed!</strong>  Faculty account disabled unsuccessful.
  </div>
  ";

}



?>
