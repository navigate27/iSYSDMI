<?php
if(isset($_GET['post_id'])){
  include("../../dmiconnect.php");
  $section_id = $_GET['post_id'];

  $findsect = $db->query("select * from sections where id='$section_id' ")or die("Error. Levels. Please contact your administrator.");
    while($rows=$findsect->fetch_assoc()){
      $section = $rows['section'];
      $tnum = $rows['tnum'];
      $level_id = $rows['level_id'];
    }

?>
  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-heart"></i> Sections</h1>
        <a href="a-sections.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
    </div>
  </div>
  <br>



              <form class='form-horizontal'>


              <input type="hidden" id="edit-id" value="<?php echo $section_id; ?>">
              <div class='form-group'>
                <label class='control-label col-sm-2'>Section Name: </label>
                  <div class='col-sm-10'>
                    <input type='text' id='edit-section' class='form-control' value="<?php echo $section; ?>" required>
                  </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-sm-2'>Level: </label>
                <div class="form-inline">
                  <div class='col-sm-10'>
                    <select id='edit-level' class='form-control'>
                    <?php
                      $selectlvl = $db->query("select * from levels ")or die("Error. Levels. Please contact your administrator.");
                        while($rows=$selectlvl->fetch_assoc()){
                          $lvl_id = $rows['id'];
                          $level = $rows['level'];

                          echo "<option value='$lvl_id'" ; if($lvl_id==$level_id){ echo "selected"; } echo ">$level</option>";
                        }
                    ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class='form-group'>
                <label class='control-label col-sm-2'>Adviser: </label>
                <div class="form-inline">
                  <div class='col-sm-10'>
                    <select name='cat' id='edit-tnum' class='form-control'>
                      <option value="">---</option>
                      <?php
                      $selectfac = $db->query("select * from teacher_records ") or die("Error. Teacher_Records. Please contact your administrator.");
                        while($rows=$selectfac->fetch_assoc())
                        {
                          $t_tnum = $rows['tnum'];
                          $fname = $rows['fname'];
                          $mname = $rows['mname'];
                          $lname = $rows['lname'];

                          echo "<option value='$t_tnum'" ; if($t_tnum==$tnum){ echo "selected"; } echo ">$fname $mname[0] $lname</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                     <p class="text-right">
                       <a href="a-sections.php" class="btn btn-default">Cancel</a>
                       <a class="btn btn-primary" id="btn-save-section">Save Changes</a>
                    </p>
                </div>
              </div>

            </form>


<?php
}
