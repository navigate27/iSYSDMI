<?php

include("../../../dmiconnect.php");

$sysacc = $_POST['postSysAcc'];
$upfees = $_POST['postUpFees'];
$upbooks = $_POST['postUpBooks'];
$delbooks = $_POST['postDelBooks'];
$allowenroll = $_POST['postAllowEnroll'];

$query = $db->query("update settings set sysaccess='$sysacc',upfees='$upfees',upbooks='$upbooks',enroll='$allowenroll' ");

?>
