<?php

if(isset($_GET['action']))
{
  $action = $_GET['action'];
  switch($action){
  case 'edit':
  edit();
  break;
  }
}


function pay(){
  include("../dmiconnect.php");
  $snum = $_GET['snum'];
  $bbooks = $_GET['bbooks'];
  $btfee = $_GET['btfee'];
  $bent = $_GET['bent'];
  $bdev = $_GET['bdev'];
  $bathpre = $_GET['bathpre'];
  $bpatch = $_GET['bpatch'];
  $bdiary = $_GET['bdiary'];
  $bnote = $_GET['bnote'];
  $bmisc = $_GET['bmisc'];

  $pbooks = $_GET['pbooks'];
  $ptfee = $_GET['ptfee'];
  $pent = $_GET['pent'];
  $pdev = $_GET['pdev'];
  $pathpre = $_GET['pathpre'];
  $ppatch = $_GET['ppatch'];
  $pdiary = $_GET['pdiary'];
  $pnote = $_GET['pnote'];
  $pmisc = $_GET['pmisc'];

  date_default_timezone_set('Asia/Taipei');
  $date =  date("m/d/Y - h:i:sa");

//  print_r($_GET);
  $query = $db->query("update student_finance set bbooks='$bbooks',btfee='$btfee',bent='$bent',bdev='$bdev',bathpre='$bathpre',bpatch='$bpatch',bdiary='$bdiary',bnote='$bnote',bmisc='$bmisc',date='$date' where snum='$snum' ")or die("Can't complete process. Please contact your Administrator.");

 header("location: e-print.php?snum=$snum&pbooks=$pbooks&ptfee=$ptfee&pent=$pent&pdev=$pdev&pathpre=$pathpre&ppatch=$ppatch&pdiary=$pdiary&pnote=$pnote&pmisc=$pmisc");
}

function edit(){

  $do = $_GET['do'];

  switch($do){
    case 'grades':
    Editgrades();
    break;
  }

}


function editGrades(){
  include("../dmiconnect.php");
  $snum = $_POST['snum'];
  $subj_code = $_POST['subj_code'];
  $a = $_POST['a'];
  $b = $_POST['b'];
  $c = $_POST['c'];
  $d = $_POST['d'];
  $fr = $_POST['fin'];

  print_r($_POST);

  $query = $db->query("update student_grades set subj_code='$subj_code',a='$a',b='$b',c='$c',d='$d',fr='$fr' where snum='$snum' and subj_code='$subj_code' ") or die("Can't complete process. Please contact your Administrator.");

 //header("location:gr-grades.php?snum=$snum&read=readonly&subj_code=$subj_code");


}
?>
