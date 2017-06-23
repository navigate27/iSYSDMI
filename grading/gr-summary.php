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
  <script src='js/Chart.min.js'></script>
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
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Overview</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">

          <?php
            $subj_code = 1009;
            $sy = "2016-2017";

            $studgrall = $db->query("select * from student_grades where subj_code='$subj_code' and sy='$sy' ")or die("Failed");
            $studall = $studgrall->num_rows;

            $studgrfail = $db->query("select * from student_grades where fr<=74 and subj_code='$subj_code' and sy='$sy' ")or die("Failed");
            $fail = $studgrfail->num_rows;
            $fail = ($fail/$studall)*100;

            $studgrpass = $db->query("select * from student_grades where fr>=75 and fr<=89 and subj_code='$subj_code' and sy='$sy' ")or die("Failed");
            $pass = $studgrpass->num_rows;
            $pass = ($pass/$studall)*100;

            $studgrspass = $db->query("select * from student_grades where fr>=90 and subj_code='$subj_code' and sy='$sy' ")or die("Failed");
            $spass = $studgrspass->num_rows;
            $spass = round(($spass/$studall)*100,1);
          ?>

          <canvas id="students" width="600" height="400"></canvas>

    		<script>
    		var pieData = [
    			{
    				value: <?php echo "$spass"; ?>,
    				color:"#878BB6"
    			},
    			{
    				value : <?php echo "$pass"; ?>,
    				color : "#4ACAB4"
    			},
    			{
    				value : <?php echo "$fail"; ?>,
    				color : "#FF8153"
    			}
    		];
    		var pieOptions = {
    			segmentShowStroke : true,
    			animateScale : true,
    		}
    		var students= document.getElementById("students").getContext("2d");
    		new Chart(students).Pie(pieData, pieOptions);

    		</script>

        </div>
      </div>
  </div>
</div>





<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>

</body>






</html>
