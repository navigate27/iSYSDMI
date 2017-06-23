<?php

include("../../../dmiconnect.php");

$level_id = $_POST['postLevel'];
$section_id = $_POST['postSection'];

$query2 = $db->query("select * from sections where level_id='$level_id' ")or die("HAHAHA");
if($query2->num_rows!=0){
?>
<div class="form-group">
    <label for="level" class="control-label col-sm-2">Section:</label>
    <div class="col-md-10">
      <div class="form-inline">
      <select  name="level" id="edit-section" class="form-control" readonly>
        <option value="">---</option>
<?php
  while($rows=$query2->fetch_assoc()){
    $section = $rows['section'];
    $sect_id = $rows['id'];
    echo "<option value='$sect_id' "; if($section_id==$sect_id){ echo "selected"; } echo ">$section</option>";
  }
}else{
?>
<div class="form-group">
  <label for="level" class="control-label col-sm-2">Section:</label>
  <div class="col-md-10">
      <div class="form-inline">
      <select  name="level" id="edit-section" class="form-control" readonly>
        <option value="">---</option>
<?php
}
?>

  </select>
  </div>
</div>
</div>
