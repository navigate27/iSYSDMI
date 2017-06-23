<?php


include("../../dmiconnect.php");
$level_id = $_POST['postLevelId'];


?>




<div class="form-group">
  <div class="col-md-offset-1">
    <label for="level">Level</label>
      <div class="form-inline">
      <select name="level" id="form-level" class="form-control">
          <?php
          $slctlvl = $db->query("select * from levels where id > '$level_id' ") or die("Error. Levels. Please contact your administrator.");
            while($rows=$slctlvl->fetch_assoc())
            {
              $id = $rows['id'];
              $level = $rows['level'];

              echo "<option value='$id'>$level</option>";

            }

          ?>
      </select>
    </div>
  </div>
</div>
