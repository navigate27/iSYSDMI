<?php

include("../../../dmiconnect.php");

$level_id = $_POST['postLevel'];

?>
<div class='form-group'>
  <label class='control-label col-sm-2'>Section: </label>
  <div class="form-inline">
    <div class='col-sm-10'>
      <select id='new-section' class='form-control'>
<?php
  $findsect = $db->query("select * from sections where level_id='$level_id' ")or die("Error. Sections. Please contact your administrator.");
  if($findsect->num_rows!=0){
    while($rows=$findsect->fetch_assoc()){
      $section_id = $rows['id'];
      $section = $rows['section'];

      echo "<option value='$section_id'>$section</option>";
    }

  }else{

  }
?>
      </select>
    </div>
  </div>
</div>
