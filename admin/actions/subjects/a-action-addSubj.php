<?php

  include("../../../dmiconnect.php");

  $subj = $_POST['postSubj'];
  $descrip = $_POST['postDescrip'];
  $level_id = $_POST['postLevel'];
  $section_id = $_POST['postSection'];
  $tnum = $_POST['postTnum'];

  $subj = mysql_real_escape_string($subj);
  $descrip = mysql_real_escape_string($descrip);

    $selectsubj = $db->query("select * from subjects order by subj_code desc limit 1") or die("Error. Subjects. Please contact your administrator.");
      while($rows=$selectsubj->fetch_assoc())
      {
        $subj_code = $rows['subj_code'];
      }
      $subj_code = $subj_code+1;

    $query = $db->query("insert into subjects(subj_code,subj,descrip,level,section,tnum) values('$subj_code','$subj','$descrip','$level_id','$section_id','$tnum') ");

    if($query){

      echo "
      <div class='alert alert-success'>
        <strong>Saved!</strong>  Subject successfully added.
      </div>
      ";

    }else{

      echo "
      <div class='alert alert-danger'>
        <strong>Failed!</strong>  Subject not successfully added.
      </div>
      ";

    }
?>
