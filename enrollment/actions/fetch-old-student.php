<?php

include("../../dmiconnect.php");

$snum = $_POST['postSnum'];

$checkSnum = $db->query("select * from student_records where snum='$snum' ");


if($checkSnum->num_rows!=0){

  include("../includes/get_student_info.php");

  if($stat!=0){

      $findsy = $db->query("select * from sy where sy='$sy' ")or die("Error. Levels. Please contact your administrator.");
      while($rows=$findsy->fetch_assoc())
      {
         $sy_id = $rows['id'];
      }
      // if($stat!=)

      echo "
      <div class='alert alert-success'>
        <strong>Success!</strong>  Student number found.
      </div>
      <input type='hidden' id='hid-rnum' value='$rnum'>
      <input type='hidden' id='hid-level' value='$level'>
      <input type='hidden' id='hid-levelid' value='$level_id'>
      <input type='hidden' id='hid-section' value='$section'>
      <input type='hidden' id='hid-fname' value='$fname'>
      <input type='hidden' id='hid-mname' value='$mname'>
      <input type='hidden' id='hid-lname' value='$lname'>
      <input type='hidden' id='hid-sy' value='$sy'>
      <input type='hidden' id='hid-sy-id' value='$sy_id'>

      <input type='hidden' id='hid-pic' value='$pic'>
      <input type='hidden' id='hid-birth' value='$birth'>
      <input type='hidden' id='hid-f137' value='$f137'>
      <input type='hidden' id='hid-good' value='$good'>
      <input type='hidden' id='hid-report' value='$report'>
      ";

      echo "
      <script>
      $('#btn-enroll').removeAttr('disabled');
      </script>";
  }else{
      echo "
      <div class='alert alert-warning'>
      <strong>Failed!</strong> Student number is <b>disabled<b>.
      </div>
      ";

      echo "
      <script>
      $('#btn-enroll').attr('disabled','disabled');
      </script>";
    }

}else{
  echo "
  <div class='alert alert-danger'>
  <strong>Failed!</strong>  Student number not found.
  </div>
  ";

  echo "
  <script>
  $('#btn-enroll').attr('disabled','disabled');
  </script>";
}


?>
