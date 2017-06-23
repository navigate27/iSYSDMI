<?php
  include("../../../dmiconnect.php");

$trans_id = rand(1000,9999);

date_default_timezone_set('Asia/Taipei');
$paydate =  date("Y-m-d H:i:s");
$conpaydate = date("M d, Y - h:ia",strtotime($paydate));

$ornum =  date("Y$trans_id-mdwH");

$checktransid = $db->query("select * from student_finance where `student_finance`.or='$ornum' ");
if($checktransid->num_rows!=0){
   header("location:e-form-pay.php");
}
?>
