<?php
include("../../../dmiconnect.php");

$snum = $_POST['postSnum'];
$sy = $_POST['postSy'];

if($sy==""){

  echo "<input type='hidden' id='bal-stat' value='0'>";

}else{


  $checkbal = $db->query("select * from student_finance where snum='$snum' and sy='$sy' order by date desc limit 1");
  while($rows=$checkbal->fetch_assoc())
  {
    $bbooks = $rows['bbooks'];
    $btfee = $rows['btfee'];
    $bpe = $rows['bpe'];
    $bsc = $rows['bsc'];
    $bmisc = $rows['bmisc'];
    $sy = $rows['sy'];
    $disc = $rows['disc'];
    $stat = $rows['stat'];
  }

  $checkdiscount = $db->query("select * from discounts ");
  while($rows=$checkdiscount->fetch_assoc())
  {
    $dval = $rows['val'];
    $dsal = $rows['sal'];
    $dfhm = $rows['fhm'];
    $dgrad = $rows['grad'];
    $dchoir = $rows['choir'];
    $dearly = $rows['early'];
    $dfriend = $rows['friend'];
    $dloyal = $rows['loyal'];
  }

  $checkmydiscount = $db->query("select * from student_discount where snum='$snum' ");
  while($rows=$checkmydiscount->fetch_assoc())
  {
    $myval = $rows['val'];
    $mysal = $rows['sal'];
    $myfhm = $rows['fhm'];
    $mygrad = $rows['grad'];
    $mychoir = $rows['choir'];
    $myearly = $rows['early'];
    $myfriend = $rows['friend'];
    $myloyal = $rows['loyal'];
    $myqe = $rows['qe'];
  }

  //the value here are percentages
  if($myval==1){
    $acad = $dval+$myqe;
  }else if($mysal==1) {
    $acad = $dsal+$myqe;
  }else if($myfhm==1) {
    $acad = $dfhm+$myqe;
  }else{
    $acad = $myqe;
  }

  //initital discount for miscellaneous
  $totaldiscount = 0;

  //find what are my discounts for miscellaneous
  if($mygrad==1){
    $totaldiscount = $totaldiscount+$dgrad/2;
  }
  if($mychoir==1){
    $totaldiscount = $totaldiscount+$dchoir/2;
  }
  if($myearly==1){
    $totaldiscount = $totaldiscount+$dearly/2;
  }
  if($myfriend==1){
    $totaldiscount = $totaldiscount+$dfriend/2;
  }
  if($myloyal==1){
    $totaldiscount = $totaldiscount+$dloyal/2;
  }

  //compute the all disccounts (misc and tfee)
  // $disc = $totaldiscount+();

  $checksynow = $db->query("select * from student_records where snum='$snum' ");
  while($rows=$checksynow->fetch_assoc())
  {
    $current_sy = $rows['sy'];
  }

  if($sy==$current_sy){//If the selected sy is currently the sy
    echo "
    <input type='hidden' id='hid-discount-tfee' value='$acad%'>
    <input type='hidden' id='hid-discount-misc' value='$totaldiscount'>
    <input type='hidden' id='hid-discount-total' value='$disc'>
    ";
  }else {//if the selected sy is not currently the sy
    echo "
    <input type='hidden' id='hid-discount-tfee' value=''>
    <input type='hidden' id='hid-discount-misc' value=''>
    <input type='hidden' id='hid-discount-total' value='$disc'>
    ";
  }


  if($stat==0){
    echo "ZERO BALANCE!";
  }

  echo "

  <input type='hidden' id='bal-books' value='$bbooks'>
  <input type='hidden' id='bal-tfee' value='$btfee'>
  <input type='hidden' id='bal-pe' value='$bpe'>
  <input type='hidden' id='bal-sc' value='$bsc'>
  <input type='hidden' id='bal-misc' value='$bmisc'>

  ";

  echo "<input type='hidden' id='bal-stat' value='1'>";

}
?>
