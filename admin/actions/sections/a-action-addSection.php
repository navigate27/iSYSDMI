<?php

  include("../../../dmiconnect.php");

  $section = $_POST['postSection'];
  $level_id = $_POST['postLevel'];
  $tnum = $_POST['postTnum'];

  $selectfac = $db->query("select * from sections where tnum='$tnum' ") or die("Error. Subjects. Please contact your administrator.");
  if($selectfac->num_rows!=0){
    while($rows=$selectfac->fetch_assoc())
    {
      $tnum = $rows['tnum'];
      $section = $rows['section'];
      $section_id = $rows['id'];
    }

    echo "
    <div class='alert alert-danger'>
      <strong>Failed!</strong>  The adviser you have chosen is already assigned to other section. Please choose a different one.</a>.
    </div>
    ";

  }else{

  $section = mysql_real_escape_string($section);

    $selectsect = $db->query("select * from sections order by id desc limit 1") or die("Error. Subjects. Please contact your administrator.");
      while($rows=$selectsect->fetch_assoc())
      {
        $section_id = $rows['id'];
      }
      $section_id = $section_id+1;

    $query = $db->query("insert into sections(id,section,level_id,tnum) values('$section_id','$section','$level_id','$tnum') ");

    if($query){

      echo "
      <div class='alert alert-success'>
        <strong>Saved!</strong>  Section successfully added.
      </div>
      ";

    }else{

      echo "
      <div class='alert alert-danger'>
        <strong>Failed!</strong>  Section not successfully added.
      </div>
      ";

    }

  }
?>
