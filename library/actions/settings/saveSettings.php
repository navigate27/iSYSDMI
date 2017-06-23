<?php

include("../../../dmiconnect.php");

$penalty = $_POST['postPenalty'];

$query = $db->query("update lib_settings set penalty='$penalty' ");
if($query)
{

  echo "

  <div class='alert alert-success'>
    <strong>Success. </strong> Changes saved.
  </div>

  ";

}else{

  echo "

  <div class='alert alert-danger'>
    <strong>Failed.</strong> Error occured.
  </div>

  ";


}

$act = "<i class='fa fa-pencil'></i> <i class='fa fa-money'></i> <span class='text-danger'><strong>Penalty</strong></span> set to $penalty in the Library";
$act = mysql_real_escape_string($act);
$addAct = $db->query("insert into activities (activity) values('$act')");

?>
