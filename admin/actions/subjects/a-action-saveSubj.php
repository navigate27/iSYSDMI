<?php

  include("../../../dmiconnect.php");

  $subj_code = $_POST['postSubjcode'];
  $subj = $_POST['postSubj'];
  $descrip = $_POST['postDescrip'];
  $level_id = $_POST['postLevel'];
  $section_id = $_POST['postSection'];
  $tnum = $_POST['postTnum'];

  $subj = mysql_real_escape_string($subj);
  $descrip = mysql_real_escape_string($descrip);

    $query = $db->query("update subjects set subj='$subj',descrip='$descrip',level='$level_id',section='$section_id',tnum='$tnum' where subj_code='$subj_code' ");

    if($query){

      echo "
      <div class='alert alert-success'>
        <strong>Saved!</strong>  Subject successfully updated.
      </div>
      ";

    }else{

      echo "
      <div class='alert alert-danger'>
        <strong>Failed!</strong>  Subject not successfully updated.
      </div>
      ";

    }


?>
