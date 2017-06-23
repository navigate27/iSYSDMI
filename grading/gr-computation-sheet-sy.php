<?php

  $findsnum = $db->query("select * from student_records where level='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
  while($rows=$findsnum->fetch_assoc())
  {
    $snum = $rows['snum'];
    $fname = $rows['fname'];
    $mname = $rows['mname'];
    $lname = $rows['lname'];

    $findgr = $db->query("select * from student_grades where level='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
    while($rows=$findgr->fetch_assoc())
    {
      $fname = $rows['fname'];
      $mname = $rows['mname'];
      $lname = $rows['lname'];
    }

  }

?>
