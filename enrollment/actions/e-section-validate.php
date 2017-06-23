

<?php

include("../../dmiconnect.php");

if(isset($_POST['levelId'])){

  $level_id = $_POST['levelId'];
  $current_sy_id = $_POST['postSyId'];

  $new_sy_id = $current_sy_id+1;
  $level_id = $level_id+1;

  $findsy = $db->query("select * from sy where id='$new_sy_id' ")or die("Error. Levels. Please contact your administrator.");
  while($rows=$findsy->fetch_assoc())
  {
     $new_sy = $rows['sy'];
  }


  if($level_id!=2015){

      $findlvl = $db->query("select * from levels where id='$level_id' ")or die("Error. Levels. Please contact your administrator.");
      while($rows=$findlvl->fetch_assoc())
      {
         $level = $rows['level'];
      }
      ?>
      <div class="form-group">
        <div class="col-md-offset-1">
            <label for="fname">New Level</label>
              <div class="form-inline">
                <input type="text" class="form-control" name="level" id="form-level"  value='<?php echo $level; ?>' placeholder="Level"  autocomplete="off" disabled>
              </div>
        </div>
      </div>
  <?php
      $query2 = $db->query("select * from sections where level_id='$level_id' ")or die("Error. Sections. Please contact your administrator.");
      if($query2->num_rows!=0){
      ?>
      <div class="form-group">
        <div class="col-md-offset-1">
          <label for="level">New Section</label>
            <div class="form-inline">
            <select  name="level" id="form-section" class="form-control">
      <?php
        while($rows=$query2->fetch_assoc()){
          $id = $rows['id'];
          $section = $rows['section'];
          echo "<option value='$id'>$section</option>";
        }
      }else{
      ?>
      <div class="form-group">
        <div class="col-md-offset-1">
          <label for="level">New Section</label>
            <div class="form-inline">
            <select  name="level" id="form-section" class="form-control" disabled>
    <?php
      }
    ?>

    </select>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-md-offset-1">
      <label for="fname">New School Year</label>
        <div class="form-inline">
          <input type="text" class="form-control" name="level" id="form-sy"  value='<?php echo $new_sy; ?>' placeholder="S/Y"  autocomplete="off" disabled>
        </div>
  </div>
</div>

<script>
$('#btn-enroll').removeAttr('disabled');
</script>

<?php
    }else{
      echo "
      <script>
      $('#btn-enroll').attr('disabled','disabled');
      </script>";
    }

}
?>
