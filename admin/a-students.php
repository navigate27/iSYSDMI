<?php
$page = "admin";
include("../session-validate.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DMI - Admin Portal</title>
  <?php
    include("linksource.php");
  ?>

  <link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>
  <script type="text/javascript" src="dataTables/datatables.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>

  <script type="text/javascript" src="export/tableExport.js"></script>
  <script type="text/javascript" src="export/jquery.base64.js"></script>
  <script type="text/javascript" src="export/html2canvas.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>
  <script>
  $(document).ready(function(){

    $("#disable-student").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
        var snum = $("#edit-snum").val();
        $.post("actions/students/a-action-disableStudent.php",{
          postSnum:snum
        },function(disMsg){
          $("#edit-msg").html(disMsg)
        });
    });

    $("#active-student").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
        var snum = $("#edit-snum").val();
        $.post("actions/students/a-action-activeStudent.php",{
          postSnum:snum
        },function(actMsg){
          $("#edit-msg").html(actMsg)
        });
    });

    $("#parentOpt").click(function(){
      $("#edit-father").removeAttr("disabled");
      $("#edit-mother").removeAttr("disabled");
      $("#edit-guardian").attr("disabled","disabled").val("");
    });

    $("#guardianOpt").click(function(){
      $("#edit-father").attr("disabled","disabled").val("");
      $("#edit-mother").attr("disabled","disabled").val("");
      $("#edit-guardian").removeAttr("disabled");
    });

    if($("#parentOpt").is(":checked")){
      $("#edit-father").removeAttr("disabled");
      $("#edit-mother").removeAttr("disabled");
      $("#edit-guardian").attr("disabled","disabled").val("");
    }else{
      $("#edit-father").attr("disabled","disabled").val("");
      $("#edit-mother").attr("disabled","disabled").val("");
      $("#edit-guardian").removeAttr("disabled");
    }

    if($("#guardianOpt").is(":checked")){
      $("#edit-father").attr("disabled","disabled").val("");
      $("#edit-mother").attr("disabled","disabled").val("");
      $("#edit-guardian").removeAttr("disabled");
    }else{
      $("#edit-father").removeAttr("disabled");
      $("#edit-mother").removeAttr("disabled");
      $("#edit-guardian").attr("disabled","disabled").val("");
    }

    setLocked();
    // loadSect();
    // function loadSect(){
    //   var levelVal = $('#edit-level').val();
    //   var sectionVal = $('#hid-section').val();
    //   $.post("actions/students/a-action-load-sections.php",{
    //     postLevel:levelVal,
    //     postSection:sectionVal
    //   },function(section){
    //       $("#section-data").html(section);
    //   });
    // }

    // function setSnum(){
    //
    //   var levelLet = $('#hid-level').val();
    //   var getId = $('#edit-id').val();
    //   var mnameVal = $('#edit-mname').val();
    //   var mnameLet = mnameVal.substr(0,1);
    //
    //   var genSnum = levelLet+""+128+""+getId+""+mnameLet.toUpperCase();
    //   $('#edit-snum').val(genSnum);
    // }

    function setLocked(){

      // $("#edit-rnum").attr("readonly","readonly");
      // $("#edit-fname").attr("readonly","readonly");
      // $("#edit-mname").attr("readonly","readonly");
      // $("#edit-lname").attr("readonly","readonly");

      $("#edit-level").attr("disabled","disabled");
      //$("#edit-section").attr("disabled","disabled");

      var pts = $("#hid-pts").val();
      if(pts==""){
        $("#form-pts").hide();
      }else{
        $("#form-pts").show();
      }
      // $("#edit-endate").attr("readonly","readonly");
      // $("#edit-age").attr("readonly","readonly");
      // $("#edit-gender").attr("readonly","readonly");
      // $("#edit-bday").attr("readonly","readonly");
      // $("#edit-bplace").attr("readonly","readonly");
      // $("#edit-address").attr("readonly","readonly");
      // $("#edit-guardian").attr("readonly","readonly");
      // $("#edit-father").attr("readonly","readonly");
      // $("#edit-mother").attr("readonly","readonly");
      // $("#edit-cnum").attr("readonly","readonly");
      //
      // $("#edit-pic").attr("disabled","disabled");
      // $("#edit-birth").attr("disabled","disabled");
      // $("#edit-f137").attr("disabled","disabled");
      // $("#edit-good").attr("disabled","disabled");
      // $("#edit-report").attr("disabled","disabled");
      //
      // $('input[type="radio"]').attr('disabled',true);
      //
      // $("#edit-grad").attr("disabled","disabled");
      // $("#edit-choir").attr("disabled","disabled");
      // $("#edit-early").attr("disabled","disabled");
      // $("#edit-friend").attr("disabled","disabled");
      // $("#edit-loyal").attr("disabled","disabled");
      //
      // $("#edit-qe").attr("readonly","readonly");

      // $("#btn-save-student").hide();
      // $("#btn-edit-student").show();
      // $("#btn-cancel-edit").hide();
      // $("#btn-cancel-view").show();
    }

    //
    // $("#btn-edit-student").click(function(){
    //   $("#edit-rnum").removeAttr("readonly");
    //   $("#edit-fname").removeAttr("readonly");
    //   $("#edit-mname").removeAttr("readonly");
    //   $("#edit-lname").removeAttr("readonly");
    //   $("#edit-level").removeAttr("disabled");
    //   $("#edit-section").removeAttr("readonly");
    //   $("#edit-endate").removeAttr("readonly");
    //   $("#edit-pts").removeAttr("readonly");
    //   $("#edit-age").removeAttr("readonly");
    //   $("#edit-gender").removeAttr("readonly");
    //   $("#edit-bday").removeAttr("readonly");
    //   $("#edit-bplace").removeAttr("readonly");
    //   $("#edit-address").removeAttr("readonly");
    //   $("#edit-guardian").removeAttr("readonly");
    //   $("#edit-father").removeAttr("readonly");
    //   $("#edit-mother").removeAttr("readonly");
    //   $("#edit-cnum").removeAttr("readonly");
    //
    //   $("#edit-pic").removeAttr("disabled");
    //   $("#edit-birth").removeAttr("disabled");
    //   $("#edit-f137").removeAttr("disabled");
    //   $("#edit-good").removeAttr("disabled");
    //   $("#edit-report").removeAttr("disabled");
    //
    //   $('input[type="radio"]').removeAttr("disabled");
    //
    //   $("#edit-grad").removeAttr("disabled");
    //   $("#edit-choir").removeAttr("disabled");
    //   $("#edit-early").removeAttr("disabled");
    //   $("#edit-friend").removeAttr("disabled");
    //   $("#edit-loyal").removeAttr("disabled");
    //
    //   $("#edit-qe").removeAttr("readonly");
    //
    //   $("#btn-save-student").show();
    //   $("#btn-edit-student").hide();
    //   $("#btn-cancel-edit").show();
    //   $("#btn-cancel-view").hide();
    // });
    //
    // $("#btn-cancel-edit").click(function(){
    //   setLocked();
    // });
    //
    // $('#edit-level').change(function(){
    //   setSnum();
    //   loadSect();
    // });

    // $('#edit-mname').keyup(function(){
    //   setSnum();
    // });

    $('#edit-pic').click(function(){
      if($(this).is(":checked")){
          $('#hid-pic').val("1");
      }else{
          $('#hid-pic').val("");
      }
    });

    $('#edit-birth').click(function(){
      if($(this).is(":checked")){
          $('#hid-birth').val("1");
      }else{
          $('#hid-birth').val("");
      }
    });

    $('#edit-f137').click(function(){
      if($(this).is(":checked")){
          $('#hid-f137').val("1");
      }else{
          $('#hid-f137').val("");
      }
    });

    $('#edit-good').click(function(){
      if($(this).is(":checked")){
          $('#hid-good').val("1");
      }else{
          $('#hid-good').val("");
      }
    });

    $('#edit-report').click(function(){
      if($(this).is(":checked")){
          $('#hid-report').val("1");
      }else{
          $('#hid-report').val("");
      }
    });

    $('#edit-grad').click(function(){
      if($(this).is(":checked")){
          $('#hid-grad').val("1");
      }else{
          $('#hid-grad').val("");
      }
    });

    $('#edit-choir').click(function(){
      if($(this).is(":checked")){
          $('#hid-choir').val("1");
      }else{
          $('#hid-choir').val("");
      }
    });

    $('#edit-early').click(function(){
      if($(this).is(":checked")){
          $('#hid-early').val("1");
      }else{
          $('#hid-early').val("");
      }
    });

    $('#edit-friend').click(function(){
      if($(this).is(":checked")){
          $('#hid-friend').val("1");
      }else{
          $('#hid-friend').val("");
      }
    });

    $('#edit-loyal').click(function(){
      if($(this).is(":checked")){
          $('#hid-loyal').val("1");
      }else{
          $('#hid-loyal').val("");
      }
    });


    $("#form-edit").submit(function(sub){

      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
      var rnumVal = $('#edit-rnum').val();
      var snumVal = $('#edit-snum').val();
      var fnameVal = $('#edit-fname').val();
      var mnameVal = $('#edit-mname').val();
      var lnameVal = $('#edit-lname').val();
      // var levelVal = $('#edit-level').val();
      var sectionVal = $('#edit-section').val();
      var syVal = $('#edit-sy').val();
      var endateVal = $('#edit-endate').val();
      var ptsVal = $('#edit-pts').val();
      var ageVal = $('#edit-age').val();
      var genderVal = $('#edit-gender').val();
      var bdateVal = $('#edit-bday').val();
      var bplaceVal = $('#edit-bplace').val();
      var addressVal = $('#edit-address').val();

      var fatherVal = $('#edit-father').val();
      var motherVal = $('#edit-mother').val();
      var guardianVal = $('#edit-guardian').val();
      var cnumVal = $('#edit-cnum').val();

      //student requirements
      var picVal = $('#hid-pic').val();
      var birthVal = $('#hid-birth').val();
      var f137Val = $('#hid-f137').val();
      var goodVal = $('#hid-good').val();
      var reportVal = $('#hid-report').val();

      //student discount
      var acadVal = $('#edit-acad:checked').val();
      var gradVal = $('#hid-grad').val();
      var choirVal = $('#hid-choir').val();
      var earlyVal = $('#hid-early').val();
      var friendVal = $('#hid-friend').val();
      var loyalVal = $('#hid-loyal').val();
      var qeVal = $('#edit-qe').val();

      sub.preventDefault();

      $.post("actions/students/a-action-saveStudent.php",{
        postRnum:rnumVal,
        postSnum:snumVal,
        postFname:fnameVal,
        postMname:mnameVal,
        postLname:lnameVal,
        // postLevel:levelVal,
        postSection:sectionVal,
        postSy:syVal,
        postEndate:endateVal,
        postKinderTime:ptsVal,
        postAge:ageVal,
        postGender:genderVal,
        postBdate:bdateVal,
        postBplace:bplaceVal,
        postAddress:addressVal,
        postFather:fatherVal,
        postMother:motherVal,
        postGuardian:guardianVal,
        postCnum:cnumVal,
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
        $("#edit-msg").html(suck);
      });

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
<?php
if(isset($_GET['snum'])){
  $snum = $_GET['snum'];

    include("includes/get_student_info.php");
    $transferee = $db->query("select * from sy where sy='$sy_rec' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$transferee->fetch_assoc())
      {
        $studcount = $rows['studcount'];
      }
      $studcount = $studcount+1;

    $addTransferee = $db->query("update sy set studcount='$studcount' where sy='$sy_rec' ") or die("Can't complete process. Please contact your Administrator.");

?>
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-graduation-cap"></i> Students</h1>
      <a href="a-students.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
  </div>
</div>
<br>
              <!-- /.row -->
      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <div class="panel-title">
                        Update Student
                        <?php
                          if($stat==1){
                            echo "(Active)";
                          }else if($stat==0){
                            echo "(Disabled)";
                          }
                        ?>
                        <div class="dropdown pull-right">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i style="color:#fff" class="fa fa-chevron-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li>
                                <a href="../enrollment/e-accounts.php?snum=<?php echo $snum; ?>" target="_blank"><i class="fa fa-table fa-fw"></i> Go to Financial</a>
                              </li>
                              <li class='divider'></li>
                              <li>
                                <?php
                                  if($stat==1){
                                      echo "<a href='#' id='disable-student'><i class='fa fa-ban fa-fw'></i> Disable</a>";
                                  }else if($stat==0){
                                      echo "<a href='#' id='active-student'><i class='fa fa-check fa-fw'></i> Set to Active</a>";
                                  }
                                ?>
                              </li>
                          </ul>
                        </div>
                    </div>
                  </div>
                  <div class="panel-body">

                  <form id="form-edit" class='form-horizontal'>

                  <div id="edit-msg">
                  </div>

                  <input type='hidden' id='hid-pic' value='<?php echo $pic; ?>'>
                  <input type='hidden' id='hid-birth' value='<?php echo $birth; ?>'>
                  <input type='hidden' id='hid-f137' value='<?php echo $f137; ?>'>
                  <input type='hidden' id='hid-good' value='<?php echo $good; ?>'>
                  <input type='hidden' id='hid-report' value='<?php echo $report; ?>'>

                  <!-- <input type='hidden' id='hid-acad' value='<?php echo $acad; ?>'> -->

                  <input type='hidden' id='hid-grad' value='<?php echo $grad; ?>'>
                  <input type='hidden' id='hid-choir' value='<?php echo $choir; ?>'>
                  <input type='hidden' id='hid-early' value='<?php echo $early; ?>'>
                  <input type='hidden' id='hid-friend' value='<?php echo $friend; ?>'>
                  <input type='hidden' id='hid-loyal' value='<?php echo $loyal; ?>'>



                  <div class="form-group">
                        <label for="rnum" class="control-label col-sm-2">Reference Number: </label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="rnum" id="edit-rnum" placeholder="Learner's Reference Number" autocomplete="off" value="<?php echo $rnum; ?>" required>
                        </div>
                  </div>

                  <div class="form-group">
                        <label for="snum" class="control-label col-sm-2">Student Number: </label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="edit-snum" name="snum" autocomplete="off" value="<?php echo $snum; ?>" disabled>
                        </div>
                  </div>

                  <div class="form-group">
                        <label for="fname" class="control-label col-sm-2">Name: </label>
                    <div class="col-md-10">
                          <div class="form-inline">
                            <input type="text" class="form-control" name="fname" id="edit-fname" placeholder="First Name" autocomplete="off" value="<?php echo $fname; ?>" required>
                            <input type="text" class="form-control" name="mname" id="edit-mname" placeholder="Middle Name" autocomplete="off" value="<?php echo $mname; ?>" required>
                            <input type="text" class="form-control" name="lname" id="edit-lname" placeholder="Last Name" autocomplete="off" value="<?php echo $lname; ?>" required>
                          </div>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="level" class="control-label col-sm-2">Level:</label>
                   <div class="col-md-10">
                        <div class="form-inline">
                          <input type='text' class="form-control" id='edit-level' value="<?php echo $level; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="level" class="control-label col-sm-2">Section: </label>
                      <div class="col-md-10">
                        <div class="form-inline">
                        <select  name="level" id="edit-section" class="form-control">
                        <?php
                        $findlvl = $db->query("select * from sections where level_id='$level_id' ")or die("Error. Sections. Please contact your administrator.");
                          while($rows=$findlvl->fetch_assoc()){
                            $sect_id = $rows['id'];
                            $section = $rows['section'];
                            echo "<option value='$sect_id'"; if($section_id==$sect_id){ echo "selected"; } echo ">$section</option>";
                          }
                        ?>
                        </select>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="sy" class="control-label col-sm-2">School Year:</label>
                    <div class="col-md-10">
                        <div class="form-inline">
                            <input type="text" id="edit-sy" class="form-control" value="<?php echo $sy_rec; ?>" disabled>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-inline">
                      <label for="rnum" class="control-label col-sm-2">Date Enrolled: </label>
                      <div class="col-md-10">
                      <input type="date" class="form-control" id="edit-endate" name="endate" autocomplete="off" value="<?php echo $endate; ?>" required>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" id="hid-pts" value="<?php echo $pts; ?>">
                  <div id="form-pts" class="form-group">
                    <label for="kinder_time" class="control-label col-sm-2">Preferred Time Schedule:</label>
                      <div class="col-md-10">
                          <div class="form-inline">
                          <select name="kinder_time" class="form-control" id="edit-pts">
                            <option value="">---</option>
                            <option <?php if($pts=="7:30am - 10:30 am"){ echo "selected"; } ?>>7:30am - 10:30 am</option>
                            <option <?php if($pts=="11:00am - 2:00 pm"){ echo "selected"; } ?>>11:00am - 2:00 pm</option>
                            <option <?php if($pts=="8:00am - 10:00 pm"){ echo "selected"; } ?>>8:00am - 10:00 pm</option>
                            <option <?php if($pts=="10:00am - 12:00 pm"){ echo "selected"; } ?>>10:00am - 12:00 pm</option>
                          </select>
                          </div>
                      </div>
                  </div>

                    <div class="form-group">
                      <label for="age" class="control-label col-sm-2">Age:</label>
                      <div class="col-md-10">
                        <div class="form-inline">
                          <select name="age" id="edit-age" class="form-control">
                          <?php
                          for($forage=2;$forage<=30;$forage++){
                            echo "<option "; if($age==$forage){ echo "selected"; } echo ">$forage</option>";
                          }
                          ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="sex" class="control-label col-sm-2">Gender:</label>
                      <div class="col-md-10">
                        <div class="form-inline">
                          <select name="sex" id="edit-gender" class="form-control">
                            <option value="Male" <?php if($sex=="Male"){ echo "selected"; } ?>>Male</option>
                            <option value="Female" <?php if($sex=="Female"){ echo "selected"; } ?>>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Birth Date: </label>
                        <div class="col-md-10">
                        <div id="form-bdate" class="form-inline">
                          <input type="date" class="form-control" name="bdate" id="edit-bday" value="<?php echo $bday; ?>" required>
                        </div>
                    </div>
                  </div>

                      <div class="form-group">
                        <label for="bplace" class="control-label col-sm-2">Birth Place:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="bplace" placeholder="Place of Birth" autocomplete="off" id="edit-bplace" value="<?php echo $bplace; ?>" required>
                        </div>
                      </div>

                      <div class="form-group">
                      <label for="address" class="control-label col-sm-2">Address:</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="address" placeholder="Current home address" autocomplete="off" id="edit-address" value="<?php echo $address; ?>" required>
                        </div>
                      </div>

                      <div class="form-group">
                            <label class="control-label col-sm-2">Home Companion:</label>
                            <div class="col-md-10">
                              <div class="form-inline">
                              <div class="col-sm-3">
                                <label class="checkbox-inline">
                                  <input type="radio" name="pg" id="parentOpt" <?php if($guardian==""){ echo "checked"; }?>> Parent
                                </label>
                              </div>
                              <div class="col-sm-3">
                                <label class="checkbox-inline">
                                  <input type="radio" name="pg" id="guardianOpt" <?php if($guardian!=""){ echo "checked"; }?>> Guardian
                                </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gname" class="control-label col-sm-2">Father's Name:</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="edit-father" name="father" autocomplete="off" value="<?php echo $father; ?>" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="gname" class="control-label col-sm-2">Mother's Name:</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="edit-mother" name="mother" autocomplete="off" value="<?php echo $mother; ?>" required>
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="gname" class="control-label col-sm-2">Guardian's Name:</label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="edit-guardian" name="guardian" autocomplete="off" value="<?php echo $guardian; ?>" required="required" disabled>
                      </div>
                    </div>






                      <div class="form-group">
                      <label for="address" class="control-label col-sm-2">Contact Number:</label>
                        <div class="col-md-10">
                                <input type="text" class="form-control" id="edit-cnum" name="cnum" placeholder="(Must based answer above)" value="<?php echo $cnum; ?>" autocomplete="off" required>
                        </div>
                      </div>

                      <hr>

                      <div class="form-group">
                            <label for="kinder_time" class="control-label col-sm-2">Requirements</label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="pic" id="edit-pic" <?php if($pic==1){ echo "checked"; } ?>> 2x2 Picture
                                </label>
                              </div>
                            </div>
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="birth" id="edit-birth" <?php if($birth==1){ echo "checked"; } ?>> Birth Certificate
                                </label>
                              </div>
                            </div>
                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="f137" id="edit-f137" name="f137" <?php if($f137==1){ echo "checked"; } ?>> Form 137
                                </label>
                              </div>
                            </div>
                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-10">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="good" id="edit-good" <?php if($good==1){ echo "checked"; } ?>> Good Moral Character
                                </label>
                              </div>
                            </div>
                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="report" id="edit-report" <?php if($report==1){ echo "checked"; } ?>> Report Card
                                </label>
                              </div>
                            </div>
                      </div>
                      <div class="alert alert-warning"><strong>Note: </strong>Changing the discount will cause the student's balance to change. Please make sure that the student had at most single transaction made to avoid confusion. <a href="" class="alert-link">Click here for more details.</a></div>
                      <div class="form-group">
                            <label class="control-label col-sm-2">Discount</label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="radio-inline">
                                  <input name="acad" type="radio" name="val" id="edit-acad" value="val" <?php if($val==1){ echo "checked"; } ?>> Valedictorian
                                </label>
                              </div>
                            </div>
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="radio-inline">
                                  <input name="acad" type="radio" name="sal" id="edit-acad" value="sal" <?php if($sal==1){ echo "checked"; } ?>> Salutatorian
                                </label>
                              </div>
                            </div>
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-10">
                                <label class="radio-inline">
                                  <input name="acad" type="radio" name="fhm" id="edit-acad" value="fhm" <?php if($fhm==1){ echo "checked"; } ?>> First Honorable Mention
                                </label>
                              </div>
                            </div>
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-3">
                                <label class="radio-inline">
                                  <input name="acad" type="radio" name="none" id="edit-acad" value="none" <?php if($val==0&&$sal==0&&$fhm==0){ echo "checked"; } ?>> None of the above
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
                                  <input type="checkbox" name="grad" id="edit-grad" <?php if($grad==1){ echo "checked"; } ?>> DMI Graduate
                                </label>
                              </div>
                            </div>


                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-10">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="choir" id="edit-choir" <?php if($choir==1){ echo "checked"; } ?>> Choir Member/Athlete
                                </label>
                              </div>
                            </div>
                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-10">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="early" id="edit-early" <?php if($early==1){ echo "checked"; } ?>> Early Enrollment Discount
                                </label>
                              </div>
                            </div>
                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-10">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="friend" id="edit-friend" <?php if($friend==1){ echo "checked"; } ?>> Bring a Friend
                                </label>
                              </div>
                            </div>
                            <label for="kinder_time" class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              <div class="col-sm-10">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="loyal" id="edit-loyal" <?php if($loyal==1){ echo "checked"; } ?>> Loyalty Award
                                </label>
                              </div>
                            </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-offset-2">
                          <label for="address">Qualifying Exam: </label>
                            <div class="form-inline">
                              <div class="input-group">
                                <input type="number" class="form-control" id="edit-qe" name="qe" autocomplete="off" value="<?php echo $qe; ?>" required>
                                <div class="input-group-addon">%</div>
                              </div>
                            </div>
                        </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-12">
                           <p class="text-right">
                             <a id="btn-cancel-view" href="a-students.php" class="btn btn-default">Cancel</a>
                             <!-- <a id="btn-cancel-edit" class="btn btn-default">Cancel</a> -->
                             <input type="submit" id="btn-save-student" class="btn btn-primary" value="Save Changes">
                             <!-- <a id="btn-edit-student" class="btn btn-primary">Edit Data</a> -->
                           </p>
                      </div>
                    </div>

                  </form>

              </div>
          </div>
        </div>
      </div>

<?php
}else{
?>
  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-graduation-cap"></i> Students</h1>

        <p>
          <a href="../enrollment/e-form-new.php" class="btn btn-primary"><span class="fa fa-plus"></span> Enroll</a>
          <a href="a-students.php" class="btn btn-outline btn-info"><span class="fa fa-refresh"></span></a>
          <span class="pull-right">
            <a href="export/a-export-students.php" class="btn btn-success"><i class="fa fa-download"></i> Export</a>
          </span>
        </p>
    </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">
                    List of Accounts
                </div>
              </div>

              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <div class="table-responsive">
                    <table id="example" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student No.</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Level/Section</th>
                                <th>Contact</th>
                                <th>Date enrolled</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $num = 1;
                            $slctstud = $db->query("select * from student_records") or die("Can't complete process. Please contact your Administrator.");
                            if($slctstud->num_rows!=0)
                            {
                              while($rows=$slctstud->fetch_assoc())
                              {
                                $snum = $rows['snum'];
                                $fname = $rows['fname'];
                                $mname = $rows['mname'];
                                $lname = $rows['lname'];
                                $sex = $rows['sex'];
                                $cnum = $rows['cnum'];
                                $stat = $rows['stat'];
                                $type = $rows['type'];
                                $endate = $rows['endate'];
                                $level_id = $rows['level'];
                                $section_id = $rows['section'];


                                $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                                if($findsect->num_rows!=0){
                                  while($rows=$findsect->fetch_assoc())
                                  {
                                    $level_id = $rows['level_id'];
                                    $section = $rows['section'];
                                  }
                                }else{
                                  $section = "N/A";
                                }
                                $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                                if($findlvl->num_rows!=0){
                                  while($rows=$findlvl->fetch_assoc())
                                  {
                                    $level = $rows['level'];
                                  }
                                }else{
                                  $level = "N/A";
                                }

                                $endate = date("M d, Y",strtotime($endate));

                                if($stat!=1){
                                  $status = "<a class='btn btn-danger btn-block'>Disabled</a>";
                                  $t_stat = "Disabled";
                                }else{
                                  $status = "<a class='btn btn-success btn-block'>Active</a>";
                                  $t_stat = "Active";
                                }

                                echo "<tr>
                                    <td>$num</td>
                                    <td>$snum</td>
                                    <td>$lname, $fname $mname[0]</td>
                                    <td>$sex</td>
                                    <td>$level - $section</td>
                                    <td>$cnum</td>
                                    <td>$endate</td>
                                    <td><div class='tooltip-demo'><span data-toggle='tooltip' data-placement='top' title='$t_stat'>$status</span></div></td>
                                    <td class='text-center'><div class='tooltip-demo'><a href='a-students.php?snum=$snum'  class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit'><div class='fa fa-pencil'></div></a> </div></td>
                                    </tr>";
                                    $num++;
                              }
                            }
                          ?>
                        </tbody>
                    </table>
                  </div>
                </div>
                </div>
            </div>
          </div>
        </div>
<?php
}
?>

<!--footer -->
<?php
include("../footer.php");
?>

      </div>
  </div>

    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>
    <script type="text/javascript">
    	// For demo to fit into DataTables site builder...
    	$('#example')
    		.removeClass( 'display' )
    		.addClass('table table-striped table-bordered');
    </script>

</body>






</html>
