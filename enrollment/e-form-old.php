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

  <script>
  $(document).ready(function(){

    function getLevel(){
      var levelVal = $('#hid-levelid').val();
      var hidSyId = $('#hid-sy-id').val();

      if(levelVal!=""){
        $.post("actions/e-section-validate.php",{levelId:levelVal,postSyId:hidSyId},function(section){
          $("#section-data").html(section);
          // var level = $("#now-level").val();
          // $("#form-level").val(level);
        });
      }
    }

    $("#form-snum").keyup(function(){

        var snum = $("#form-snum").val();

        $("#old-data").html('<div class="alert alert-info"><strong>Loading... </strong> Please wait.</div>');
        if(snum!=""){
          $.post("actions/fetch-old-student.php",{postSnum:snum},function(data){
            $("#old-data").html(data);
            readData();
            getLevel();
            });

        }else{
          $("#old-data").html('<div class="alert alert-warning"><strong>Info!</strong> Please enter student number..</div>');
        }

        function readData(){
          var rnum = $("#hid-rnum").val();
          $("#form-rnum").val(rnum);
          var fname = $("#hid-fname").val();
          $("#form-fname").val(fname);
          var mname = $("#hid-mname").val();
          $("#form-mname").val(mname);
          var lname = $("#hid-lname").val();
          $("#form-lname").val(lname);
          var oldlevel = $("#hid-level").val();
          $("#form-old-level").val(oldlevel);
          var oldsection = $("#hid-section").val();
          $("#form-old-section").val(oldsection);
          var oldsy = $("#hid-sy").val();
          $("#form-old-sy").val(oldsy);

          var pic = $("#hid-pic").val();
          if(pic==1){
            $("#form-pic").attr("checked","checked");
          }
          var birth = $("#hid-birth").val();
          if(birth==1){
            $("#form-birth").attr("checked","checked");
          }
          var f137 = $("#hid-f137").val();
          if(f137==1){
            $("#form-f137").attr("checked","checked");
          }
          var good = $("#hid-good").val();
          if(good==1){
            $("#form-good").attr("checked","checked");
          }
          var report = $("#hid-report").val();
          if(report==1){
            $("#form-report").attr("checked","checked");
          }
        }
    });

    $('#form-pic').click(function(){
      if($(this).is(":checked")){
          $('#form-pic').val("1");
          $("#hid-pic").val("1");
      }else{
          $('#form-pic').val("");
          $("#hid-pic").val("");
      }
    });

    $('#form-birth').click(function(){
      if($(this).is(":checked")){
          $('#form-birth').val("1");
          $("#hid-birth").val("1");
      }else{
          $('#form-birth').val("");
          $("#hid-pic").val("");
      }
    });

    $('#form-f137').click(function(){
      if($(this).is(":checked")){
          $('#form-f137').val("1");
          $("#hid-f137").val("1");
      }else{
          $('#form-f137').val("");
          $("#hid-f137").val("");
      }
    });

    $('#form-good').click(function(){
      if($(this).is(":checked")){
          $('#form-good').val("1");
          $("#hid-good").val("1");
      }else{
          $('#form-good').val("");
          $("#hid-good").val("");
      }
    });

    $('#form-report').click(function(){
      if($(this).is(":checked")){
          $('#form-report').val("1");
          $("#hid-report").val("1");
      }else{
          $('#form-report').val("");
          $("#hid-report").val("");
      }
    });

    $('#form-grad').click(function(){
      if($(this).is(":checked")){
          var grad = $('#form-grad').val("1");
      }else{
          var grad = $('#form-grad').val("");
      }
    });

    $('#form-choir').click(function(){
      if($(this).is(":checked")){
          var choir = $('#form-choir').val("1");
      }else{
          var choir = $('#form-choir').val("");
      }
    });

    $('#form-early').click(function(){
      if($(this).is(":checked")){
          var early = $('#form-early').val("1");
      }else{
          var early = $('#form-early').val("");
      }
    });

    $('#form-friend').click(function(){
      if($(this).is(":checked")){
          var friend = $('#form-friend').val("1");
      }else{
          var friend = $('#form-friend').val("");
      }
    });

    $('#form-loyal').click(function(){
      if($(this).is(":checked")){
          var loyal = $('#form-loyal').val("1");
      }else{
          var loyal = $('#form-loyal').val("");
      }
    });

    $("#form-validate-old").submit(function(sub){
      var snumVal = $('#form-snum').val();
      var sectionVal = $('#form-section').val();
      var syVal = $('#form-sy').val();
      var endateVal = $('#form-endate').val();
      // var ageVal = $('#form-age').val();
      var pts = $('#form-pts').val();

      //student requirements
      var picVal = $("#hid-pic").val();
      var birthVal = $("#hid-birth").val();
      var f137Val = $("#hid-f137").val();
      var goodVal = $("#hid-good").val();
      var reportVal = $("#hid-report").val();

      //student discount
      var acadVal = $('#form-acad:checked').val();
      var gradVal = $('#form-grad').val();
      var choirVal = $('#form-choir').val();
      var earlyVal = $('#form-early').val();
      var friendVal = $('#form-friend').val();
      var loyalVal = $('#form-loyal').val();
      var qeVal = $('#form-qe').val();

      $("#btn-enroll").attr("disabled","disabled");

        sub.preventDefault();

        $.post("actions/enroll/e-form-old-save.php",{
          postSnum:snumVal,
          postSection:sectionVal,
          postSy:syVal,
          postEndate:endateVal,
          // postAge:ageVal,
          postPts:pts,
          postPic:picVal,
          postBirth:birthVal,
          postF137:f137Val,
          postGood:goodVal,
          postReport:reportVal,
          postAcad:acadVal,
          postGrad:gradVal,
          postChoir:choirVal,
          postEarly:earlyVal,
          postFriend:friendVal,
          postLoyal:loyalVal,
          postQe:qeVal
        },function(suck){
          window.location.replace("e-form-pay.php?snum="+snumVal);
          $("#msg").html(suck);
        });

    });

    $('#check-pts').click(function(){
      if($(this).is(":checked")){
          $('#form-pts').removeAttr("disabled");
      }else{
          $('#form-pts option[value=""]').attr("selected","selected");
          $('#form-pts').attr("disabled","disabled");
      }
    });


  });
  </script>

</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");

      ?>


<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-table"></i> Enroll (Old)</h1>
      </div>
    </div>

    <div id='msg'>
    </div>
      <div id='old-data'>
        <div class="alert alert-warning"><strong>Info!</strong> Please enter student number..</div>
      </div>

    	<form id="form-validate-old" class="form-horizontal">

      <div class="row">
        <div class="col-md-10">

          <!-- <div class="form-group">
            <div class="col-md-offset-1">
                <label for="rnum">Student's Photo</label>
                  <input type="file" class="form-control" name="img">
            </div>
          </div> -->


          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="rnum">Reference Number</label>
                  <input type="text" class="form-control" name="rnum" id="form-rnum" placeholder="Learner's Reference Number" autocomplete="off" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="snum">Student Number</label>
                  <input type="text" class="form-control" name="snum" id="form-snum" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="fname">Name</label>
                  <div class="form-inline">
                    <input type="text" class="form-control" name="fname" id="form-fname" placeholder="First Name" autocomplete="off" disabled>
                    <input type="text" class="form-control" name="mname" id="form-mname" placeholder="Middle Name" autocomplete="off" disabled>
                    <input type="text" class="form-control" name="lname" id="form-lname" placeholder="Last Name" autocomplete="off" disabled>
                  </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="fname">Last Level</label>
                  <div class="form-inline">
                    <input type="text" class="form-control" name="old_level" id="form-old-level" placeholder="Recently enrolled level" autocomplete="off" disabled>
                    <input type="text" class="form-control" name="old_section" id="form-old-section" placeholder="Recently enrolled section" autocomplete="off" disabled>
                  </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="fname">Last School Year</label>
                  <div class="form-inline">
                    <input type="text" class="form-control" name="old_level" id="form-old-sy" placeholder="Recently enrolled S/Y" autocomplete="off" disabled>
                  </div>
            </div>
          </div>

          <hr>

          <div id="section-data">
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
            <div class="form-inline">
              <div class="col-md-offset-1">
                  <label for="rnum">Date of Enrollment</label>
              </div>
              <div class="col-md-offset-1">
              <input type="date" class="form-control" name="endate" id="form-endate" autocomplete="off" required>
              </div>
            </div>
          </div>


            <!-- <div class="form-group">
              <div class="col-md-offset-1">
            <label for="age">Age</label>
              <div class="form-inline">
                <select name="age" class="form-control" id="form-age">
                <?php
                for($forage=2;$forage<=30;$forage++)
                echo "<option>$forage</option>";
                ?>
                </select>
              </div>
              </div>
            </div> -->

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
                    <label for="kinder_time" class="control-label col-sm-2"></label>
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
                      <hr>
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
                        <input type="number" class="form-control" id="form-qe" min="0" value="0" name="qe" autocomplete="off" required>
                        <div class="input-group-addon">%</div>
                      </div>
                    </div>
                </div>
              </div>

              <hr>
              <div class="form-group">
                <div class="col-sm-12">
    					       <p class="text-right"><input type="submit" id="btn-enroll" class="btn btn-primary btn-lg" name="submit" value="Enroll Now" /></p>
                </div>
              </div>
    			</form>

        </div>
      </div>

      <!--footer -->
      <?php
      include("../footer.php");
      ?>



</div>
</div>

</body>






</html>
