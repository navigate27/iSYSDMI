<?php

$rec_snum = $db->query("select * from student_records where snum='$snum' ");
$fin_snum = $db->query("select * from student_finance where snum='$snum' order by date desc limit 1");
$req_snum = $db->query("select * from student_req where snum='$snum' ");
$disc_snum = $db->query("select * from student_discount where snum='$snum' ");

while($rows=$rec_snum->fetch_assoc())
{
  $s_id = $rows['id'];
  $rnum = $rows['refnum'];
  $fname = $rows['fname'];
  $mname = $rows['mname'];
  $lname = $rows['lname'];
  $bday = $rows['bday'];
  $bplace = $rows['bplace'];
  $age = $rows['age'];
  $sex = $rows['sex'];
  $sy_rec = $rows['sy'];
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
  $sy_fin = $rows['sy'];
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

while($rows=$findsect->fetch_assoc())
{
  $section = $rows['section'];
}

?>
