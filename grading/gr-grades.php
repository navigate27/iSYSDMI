<?php
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

    <title>DMI - Grading Portal</title>
  <?php
    include("linksource.php");
  ?>


  <script>
  $(document).ready(function(){

    // getGr();
    // function getGr(){
    //   $("#btn-save-grade").hide();
    //
    //   var sy = $("#form-sy").val();
    //   var qtr = $("#form-qtr").val();
    //   var snum = $("#form-snum").val();
    //   var subj_code = $("#form-subj").val();
    //
    //   $.post("gr-load-grades.php",{
    //     postQtr:qtr,
    //     postSy:sy,
    //     postSnum:snum,
    //     postSubj:subj_code
    //   },function(grData){
    //     $("#gr-data").html(grData);
    //       var val_a = $("#val-a").val();
    //       var val_b = $("#val-b").val();
    //       var val_c = $("#val-c").val();
    //       var val_d = $("#val-d").val();
    //       var val_fr = $("#val-fr").val();
    //
    //       $("#gr-a").val(val_a);
    //       $("#gr-b").val(val_b);
    //       $("#gr-c").val(val_c);
    //       $("#gr-d").val(val_d);
    //       $("#gr-fr").val(val_fr);
    //
    //   });
    // }
    //
    // $("#form-qtr").change(function(){
    //   getGr();
    // });
    //
    // $("#form-sy").change(function(){
    //   getGr();
    // });
    //
    // function calcGr(){
    //   var val_a = $("#gr-a").val();
    //   var val_b = $("#gr-b").val();
    //   var val_c = $("#gr-c").val();
    //   var val_d = $("#gr-d").val();
    //
    //   if(val_a==""){
    //     val_a = 50;
    //   }
    //   if(val_b==""){
    //     val_b = 50;
    //   }
    //   if(val_c==""){
    //     val_c = 50;
    //   }
    //   if(val_d==""){
    //     val_d = 50;
    //   }
    //
    //
    //   var ave = (parseInt(val_a)+parseInt(val_b)+parseInt(val_c)+parseInt(val_d))/4;
    //   $("#gr-fr").val(ave);
    // }
    //
    // $("#gr-a").keyup(function(){
    //   calcGr();
    // });
    // $("#gr-b").keyup(function(){
    //   calcGr();
    // });
    // $("#gr-c").keyup(function(){
    //   calcGr();
    // });
    // $("#gr-d").keyup(function(){
    //   calcGr();
    // });
    //
    // $("#btn-edit-grade").click(function(){
    //   $("#btn-edit-grade").hide();
    //   $("#btn-save-grade").show();
    //   $("#gr-a").removeAttr("disabled");
    //   $("#gr-b").removeAttr("disabled");
    //   $("#gr-c").removeAttr("disabled");
    //   $("#gr-d").removeAttr("disabled");
    // });
    //
    // $("#btn-save-grade").click(function(){
    //   var val_a = $("#gr-a").val();
    //   var val_b = $("#gr-b").val();
    //   var val_c = $("#gr-c").val();
    //   var val_d = $("#gr-d").val();
    //   var val_fr = $("#gr-fr").val();
    //   var sy = $("#form-sy").val();
    //   var qtr = $("#form-qtr").val();
    //   var snum = $("#form-snum").val();
    //   var subj_code = $("#form-subj").val();
    //
    //   $.post("gr-save-grades.php",{
    //     postA:val_a,
    //     postB:val_b,
    //     postC:val_c,
    //     postD:val_d,
    //     postFr:val_fr,
    //     postQtr:qtr,
    //     postSy:sy,
    //     postSnum:snum,
    //     postSubj:subj_code
    //   },function(grMsg){
    //     $("#gr-msg").html(grMsg);
    //   });
    //
    //
    //   $("#btn-save-grade").hide();
    //   $("#btn-edit-grade").show();
    //   $("#gr-a").attr("disabled","disabled");
    //   $("#gr-b").attr("disabled","disabled");
    //   $("#gr-c").attr("disabled","disabled");
    //   $("#gr-d").attr("disabled","disabled");
    //
    // });

    alert("asda");


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
    <?php

    if(isset($_GET['snum'])){

      $subj_code = $_GET['subj_code'];
      $snum = $_GET['snum'];

    }else{
      header("location: gr-grades.php");

    }


    $checksubj = $db->query("select * from subjects where subj_code='$subj_code' ");
      while($rows=$checksubj->fetch_assoc())
      {
        $subj = $rows['subj'];
      }
    $studrec = $db->query("select * from student_records where snum='$snum' ");
      while($rows=$studrec->fetch_assoc())
      {
        $fname = $rows['fname'];
        $lname = $rows['lname'];
        $mname = $rows['mname'];
        $section_id = $rows['section'];
        $level_id = $rows['level'];
      }

      $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$findlvl->fetch_assoc())
      {
        $level = $rows['level'];
      }

      $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
      if($findsect->num_rows!=0){
        while($rows=$findsect->fetch_assoc())
        {
          $section = $rows['section'];
        }
      }else{
        $section = "N/A";
      }

    ?>
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-heart"></i> Grades</h1>
          <a href="gr-subjects.php?subj_code=<?php echo $subj_code; ?>" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
      </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="panel-title">
                    <div class="panel-title">
                      <?php echo "$level - $section ($subj)"; ?>
                    </div>
                  </div>
                </div>
                <div class="panel-body">

                <form class='form-horizontal'>

                <div id="edit-msg">
                </div>

    <!-- <?php

    echo "
    <div class='form-group'>
      <div class='form-inline'>
        <label>Quarter: </label>
        <select class='form-control' id='form-qtr'>
    ";
    $checkqtr = $db->query("select * from quarter order by id asc ");
      while($rows=$checkqtr->fetch_assoc())
      {
        $qtr = $rows['qtr'];
        echo "<option>$qtr</option>";
      }

    echo "</select>
          </div>
        </div>
        ";

      echo "
      <div class='form-group'>
        <div class='form-inline'>
          <label>SY: </label>
          <select class='form-control' id='form-sy'>
      ";

      $checksy = $db->query("select * from sy order by id desc ");
        while($rows=$checksy->fetch_assoc())
        {
          $sy = $rows['sy'];
          $studgr = $db->query("select * from student_grades where snum='$snum' and subj_code='$subj_code' and sy='$sy' ");
          if($studgr->num_rows!=0){
            while($rows=$studgr->fetch_assoc())
            {
              echo "<option>$sy</option>";
            }
          }
        }

      echo "</select>
            </div>
          </div>
          ";
    ?> -->

        <div id="gr-data"></div>
        <input type="hidden" name="gr-snum" value="<?php echo $snum; ?>">
        <input type="hidden" name="gr-subj-code" value="<?php echo $subj_code; ?>">

        <div class="form-group">
          <label for="code" class="control-label col-sm-2">1st Quarter: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="gr-a">
            </div>
        </div>
        <div class="form-group">
          <label for="code" class="control-label col-sm-2">2nd Quarter: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="gr-b">
            </div>
        </div>
        <div class="form-group">
          <label for="code" class="control-label col-sm-2">3rd Quarter: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="gr-c">
            </div>
        </div>
        <div class="form-group">
          <label for="code" class="control-label col-sm-2">4th Quarter: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="gr-d">
            </div>
        </div>
        <div class="form-group">
          <label for="code" class="control-label col-sm-2">Final Rating: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="gr-fr">
            </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
               <p class="text-right">
                 <a id="btn-cancel-view" href="gr-subjects.php?subj_code=<?php echo $subj_code; ?>" class="btn btn-default">Cancel</a>
                 <a id="btn-cancel-edit" class="btn btn-default">Cancel</a>
                 <button  class="btn btn-primary" id="btn-edit-grade">Edit</button>
                 <button  class='btn btn-primary' id='btn-save-grade'>Save</button>
               </p>
          </div>
        </div>
        </form>

      </div>
  </div>
</div>
</div>

		<div id="footer-container">
			<div id="copyright">
				<p></p>
			</div>
		</div>



</div>
</div>
</div>
</body>


</html>
