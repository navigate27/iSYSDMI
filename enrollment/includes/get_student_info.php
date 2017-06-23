<?php

$rec_snum = $db->query("select * from student_records where snum='$snum' ");
$req_snum = $db->query("select * from student_req where snum='$snum' ");
$disc_snum = $db->query("select * from student_discount where snum='$snum' ");

while($rows=$rec_snum->fetch_assoc())
{
  $rnum = $rows['refnum'];
  $fname = $rows['fname'];
  $mname = $rows['mname'];
  $lname = $rows['lname'];
  $bday = $rows['bday'];
  $bplace = $rows['bplace'];
  $sex = $rows['sex'];
  $sy = $rows['sy'];
  $pts = $rows['pts'];
  $father = $rows['father'];
  $mother = $rows['mother'];
  $guardian = $rows['guardian'];
  $address = $rows['address'];
  $cnum = $rows['cnum'];
  $stat = $rows['stat'];
  $endate = $rows['endate'];
  $section_id = $rows['section'];
  $img = $rows['imgpath'];
}

$findlvl = $db->query("select * from sections where id='$section_id' ");
  while($rows=$findlvl->fetch_assoc())
  {
    $level_id = $rows['level_id'];
  }


$fin_snum = $db->query("select * from student_finance where snum='$snum' and sy='$sy' order by date desc limit 1");
while($rows=$fin_snum->fetch_assoc())
{
  $bbooks = $rows['bbooks'];
  $btfee = $rows['btfee'];
  $bpe = $rows['bpe'];
  $bsc = $rows['bsc'];
  $bmisc = $rows['bmisc'];
  $check = $rows['check'];
  $or = $rows['or'];
  $date = $rows['date'];
  $sy = $rows['sy'];
}

while($rows=$req_snum->fetch_assoc())
{
  $pic = $rows['pic'];
  $birth = $rows['birth'];
  $f137 = $rows['f137'];
  $good = $rows['good'];
  $report = $rows['report'];
}

while($rows=$disc_snum->fetch_assoc())
{
  $val = $rows['val'];
  $sal = $rows['sal'];
  $fhm = $rows['fhm'];
  $grad = $rows['grad'];
  $choir = $rows['choir'];
  $early = $rows['early'];
  $friend = $rows['friend'];
  $loyal = $rows['loyal'];
  $qe = $rows['qe'];
}

$findlvl = $db->query("select * from levels where id='$level_id' ");
$findsect = $db->query("select * from sections where id='$section_id' ");

while($rows=$findlvl->fetch_assoc())
{
  $level = $rows['level'];
}

if($findsect->num_rows!=0){
  while($rows=$findsect->fetch_assoc())
  {
    $section = $rows['section'];
  }
  }else{
    $section = "N/A";
  }
?>
