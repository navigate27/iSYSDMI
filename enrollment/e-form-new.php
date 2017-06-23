<?php
$page = "enrollment";
include("../session-validate.php");
include("/includes/settings.php");
if($enrollallow!=1){
  header("location:e-forbid.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DMI - Enrollment Portal</title>
  <?php
    include("linksource.php");
  ?>

  <link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>

  <script type="text/javascript" src="dataTables/datatables.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#example').DataTable();
    } );
  </script>

  <script type="text/javascript" src="export/tableExport.js"></script>
  <script type="text/javascript" src="export/jquery.base64.js"></script>
  <script type="text/javascript" src="export/html2canvas.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>

  <script type="text/javascript" src="myScript/eFormScript.js"></script>

</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");

      $checkid = $db->query("select id from student_records order by id desc limit 1");
      if($checkid->num_rows!=0)
      {
        while($rows=$checkid->fetch_assoc())
        {
          $id = $rows['id'];
          $id = $id+1;
        }
      }else {

        $id = 1001;
      }


      ?>


<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-table"></i> Enroll (New)</h1>
      </div>
    </div>

    <div id="msg">
    </div>

          <form id="form-validate" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="id" id="form-id" value="<?php echo $id ?>">
              <input type="hidden" id="mySnum">

          <div>
        </div>


      <div class="row">
        <div class="col-md-10">

          <input type='hidden' id='enroll-success'>
          <!-- <div class="form-group">
            <div class="col-md-offset-1">
                <label for="rnum">Student's Photo</label>
                  <input type="file" class="form-control" name="img" id="form-img">
            </div>
          </div> -->



          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="rnum">Reference Number</label>
                  <input type="text" class="form-control" name="rnum" id="form-rnum" placeholder="Learner's Reference Number" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="snum">Unique 4-digit Number</label>
                  <input type="text" placeholder="1234" class="form-control" pattern="[0-9]{4}" id="form-snum" name="snum" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="fname">Name</label>
                  <div class="form-inline">
                    <input type="text" class="form-control" name="fname" id="form-fname" placeholder="First Name" autocomplete="off" required>
                    <input type="text" class="form-control" name="mname" id="form-mname" placeholder="Middle Name" autocomplete="off" required>
                    <input type="text" class="form-control" name="lname" id="form-lname" placeholder="Last Name" autocomplete="off" required>
                  </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
              <label for="level">Level/Section</label>
                <div class="form-inline">
                <select name="level" id="form-section" class="form-control">
                  <?php
                    $selectlevel = $db->query("select * from levels ") or die("Error. Levels. Please contact your administrator.");
                      while($rows=$selectlevel->fetch_assoc())
                      {
                        $level = $rows['level'];
                        $level_id = $rows['id'];
                        echo "<optgroup class='form-control' label='$level'></optgroup>";
                        $findsect = $db->query("select * from sections where level_id='$level_id' ") or die("Error. Sections. Please contact your administrator.");
                          while($rows=$findsect->fetch_assoc())
                          {
                            $section = $rows['section'];
                            $sect_id = $rows['id'];

                            echo "<option value='$sect_id'>$section</option>";
                          }

                      }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
            <label for="sy">School Year</label>
                <div class="form-inline">
                <select  name="sy" id="form-sy" class="form-control">
                  <option>2016 - 2017</option>
                  <option>2017 - 2018</option>
                  <option>2018 - 2019</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-inline">
              <div class="col-md-offset-1">
                  <label for="rnum">Date of Enrollment</label>
              </div>
              <div class="col-md-offset-1">
              <input type="date" class="form-control" id="form-endate" name="endate" autocomplete="off" required>
              </div>
            </div>
          </div>

          <div class="form-group">
              <div class="col-md-offset-1">
                <label for="kinder_time">Preferred Time Schedule</label>
                  <div class="form-inline">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="check-pts">
                      <label for="kinder_time" class="control-label col-sm-1"></label>
                        <select name="kinder_time" class="form-control" id="form-pts" disabled>
                          <option value="" selected>---</option>
                          <option>7:30am - 10:30 am</option>
                          <option>11:00am - 2:00 pm</option>
                          <option>8:00am - 10:00 pm</option>
                          <option>10:00am - 12:00 pm</option>
                        </select>
                    </label>
                  </div>
              </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
              <label>Birth Date</label>
              <div class="form-inline">
                <input type="date" class="form-control" name="bdate" id="form-bdate" required>
              </div>
            </div>
          </div>

            <div class="form-group">
              <div class="col-md-offset-1">
            <label for="age">Age</label>
              <div class="form-inline">
                <input type="text" class="form-control" name="age" id="form-age" value='2' disabled>
                <!-- <select name="age" id="form-age" class="form-control" disabled>
                <?php
                for($forage=2;$forage<=30;$forage++)
                echo "<option value='$forage'>$forage</option>";
                ?>
                </select> -->
              </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-offset-1">
                <label for="sex">Gender</label>
                <div class="form-inline">
                  <select name="sex" id="form-gender" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </div>

          <!--<input type='hidden' id='hid-age'>-->

              <div class="form-group">
                <div class="col-md-offset-1">
    					<label for="bplace">Birth Place</label>
      						      <input type="text" class="form-control" name="bplace" placeholder="Place of Birth" autocomplete="off" id="form-bplace" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-1">
    					<label for="address">Address</label>
    						        <input type="text" class="form-control" name="address" placeholder="Current home address" autocomplete="off" id="form-address" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-1">
                    <label>Home Companion</label>
                      <div class="form-inline">
                      <div class="col-sm-3">
                        <label class="checkbox-inline">
                          <input type="radio" name="pg" id="parentOpt" checked> Parent
                        </label>
                      </div>
                      <div class="col-sm-3">
                        <label class="checkbox-inline">
                          <input type="radio" name="pg" id="guardianOpt"> Guardian
                        </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-1">
              <label for="gname">Father's Name</label>
                        <input type="text" class="form-control" id="fatherIn" name="father" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-1">
              <label for="gname">Mother's Name</label>
                        <input type="text" class="form-control" id="motherIn" name="mother" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-1">
              <label for="gname">Guardian's Name</label>
                        <input type="text" class="form-control" id="guardianIn" name="guardian" autocomplete="off" required="required" disabled>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-1">
    					<label for="address">Contact Number</label>
                  <div class="input-group">
                    <span class="input-group-addon">+63</span>
                    <input type="number" class="form-control" id="form-cnum" name="cnum" min="0" placeholder="9192821181" autocomplete="off" required>
                  </div>
                </div>
              </div>

              <hr>

              <div class="form-group">
                    <label for="kinder_time" class="control-label col-sm-2">Requirements</label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="pic" id="form-pic"> 2x2 Picture
                        </label>
                      </div>
                    </div>
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="birth" id="form-birth"> Birth Certificate
                        </label>
                      </div>
                    </div>
                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="f137" id="form-f137" name="f137"> Form 137
                        </label>
                      </div>
                    </div>
                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="good" id="form-good"> Good Moral Character
                        </label>
                      </div>
                    </div>
                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="report" id="form-report"> Report Card
                        </label>
                      </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="control-label col-sm-2">Discount</label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="radio-inline">
                          <input name="acad" type="radio" id="form-acad" value="val"> Valedictorian
                        </label>
                      </div>
                    </div>
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="radio-inline">
                          <input name="acad" type="radio" id="form-acad" value="sal"> Salutatorian
                        </label>
                      </div>
                    </div>
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="radio-inline">
                          <input name="acad" type="radio" id="form-acad" value="fhm"> First Honorable Mention
                        </label>
                      </div>
                    </div>
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-3">
                        <label class="radio-inline">
                          <input name="acad" type="radio" id="form-acad" value="none" checked> None of the above
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                                <p class="checkbox-inline"></p>
                        </div>
                    </div>

                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="grad" id="form-grad"> DMI Graduate
                        </label>
                      </div>
                    </div>


                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="choir" id="form-choir"> Choir Member/Athlete
                        </label>
                      </div>
                    </div>
                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="early" id="form-early"> Early Enrollment Discount
                        </label>
                      </div>
                    </div>
                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="friend" id="form-friend"> Bring a Friend
                        </label>
                      </div>
                    </div>
                    <label for="kinder_time" class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="loyal" id="form-loyal"> Loyalty Award
                        </label>
                      </div>
                    </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-2">
                  <label for="address">Qualifying Exam: </label>
                    <div class="form-inline">
                      <div class="input-group">
                        <input type="number" class="form-control" id="form-qe" min="0" max="100" value="0" name="qe" autocomplete="off" required>
                        <div class="input-group-addon">%</div>
                      </div>
                    </div>
                </div>
              </div>

              <hr>
              <div class="form-group">
                <div class="col-sm-12">
    					       <p class="text-right"><button type="submit" id="btn-enroll" class="btn btn-primary btn-lg">Enroll Now</button></p>
                </div>
              </div>
        </div>
      </div>
    </form>


    <!--footer -->
    <?php
    include("../footer.php");
    ?>



</div>
</div>


</body>






</html>
