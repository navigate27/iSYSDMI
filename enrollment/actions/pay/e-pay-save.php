<?php

include("../../../dmiconnect.php");

$snum = $_POST['postSnum'];

$bbooks = $_POST['postBooks'];
$btfee = $_POST['postTfee'];
$bpe = $_POST['postPe'];
$bsc = $_POST['postSc'];
$bmisc = $_POST['postMisc'];
$total_disc = $_POST['postDisc'];

$pbooks = $_POST['postPbooks'];
$ptfee = $_POST['postPtfee'];
$psc = $_POST['postPsc'];
$ppe = $_POST['postPpe'];
$pmisc = $_POST['postPmisc'];

$or = $_POST['postOr'];
$check_num = $_POST['postCheck'];
$date = $_POST['postDate'];
$sy = $_POST['postSy'];
$total_payment = $_POST['postPay'];
// print_r($_POST);

if($bbooks==0&&$btfee==0&&$bpe==0&&$bsc==0&&$bmisc==0){
  $stat = 0;
}else {
  $stat = 1;
}


$query = $db->query("INSERT INTO  student_finance (`id` ,`snum` ,`bbooks` ,`btfee` ,`bpe` ,`bsc` ,`bmisc` ,`payment` ,`disc` ,`or` ,`check` ,`date` ,`sy`,`stat`)
VALUES (NULL ,  '$snum',  '$bbooks',  '$btfee',  '$bpe',  '$bsc',  '$bmisc', '$total_payment', '$total_disc', '$or',  '$check_num',  '$date',  '$sy', '$stat') ")or die("Error. Student_Finance");


  $monthnow = date("M");

  //get the value of the payment summary
  $getsumm = $db->query("select * from e_summary where month='$monthnow'");
  while($rows=$getsumm->fetch_assoc())
  {
    $books = $rows['books'];
    $tfee = $rows['tfee'];
    $pe = $rows['pe'];
    $sc = $rows['sc'];
    $misc = $rows['misc'];
  }

  $pbooks = $pbooks+$books;
  $ptfee = $ptfee+$tfee;
  $psc = $psc+$sc;
  $ppe = $ppe+$pe;
  $pmisc = $pmisc+$misc;

  //Save the payment to summary
  $savePay = $db->query("update e_summary set books='$pbooks',tfee='$ptfee',sc='$psc',pe='$ppe',misc='$pmisc' where month='$monthnow'")or die("Error. E_Summmary. Please contact your administrator.");


  $act = "<i class='fa fa-money'></i> Student balance <span class='text-primary'><strong>paid</strong></span>";
  $act = mysql_real_escape_string($act);
  $addAct = $db->query("insert into activities (activity) values('$act')");

// $checkbal = $db->query("select * from student_finance where snum='$snum' and sy='$sy' order by date desc limit 1");
//   while($rows=$checkbal->fetch_assoc())
//   {
//     $id = $rows['id'];
//     $bbooks = $rows['bbooks'];
//     $btfee = $rows['btfee'];
//     $bpe = $rows['bpe'];
//     $bsc = $rows['bsc'];
//     $bmisc = $rows['bmisc'];
//   }


?>
