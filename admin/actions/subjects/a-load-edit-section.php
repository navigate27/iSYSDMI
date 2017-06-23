<?php

include("../../../dmiconnect.php");

$level_id = $_POST['postLevel'];
$section_id = $_POST['postSection'];

?>
<div class='form-group'>
  <label class='control-label col-sm-2'>Section: </label>
  <div class="form-inline">
    <div class='col-sm-10'>
      <select id='edit-section' class='form-control'>
<?php
  $selectsect = $db->query("select * from sections where level_id='$level_id'") or die("Error. Levels. Please contact your administrator.");
  if($selectsect->num_rows!=0){
    while($rows=$selectsect->fetch_assoc())
    {
      $section = $rows['section'];
      $sect_id = $rows['id'];

      echo "<option value='$sect_id' "; if($sect_id==$section_id){ echo "selected"; } echo ">$section</option>";
    }

  }else{

  }
?>
      </select>
    </div>
  </div>
</div>
