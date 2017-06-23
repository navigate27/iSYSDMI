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
  <script>
  $(document).ready(function(){

    ini();
    function ini(){
      $("#stud-sy").show();
      $("#stud-per-yr").hide();
      // $("#month-summary").hide();
    }

    $("#select-summary").change(function(){

      var select = $("#select-summary").val();

      switch(select){
        case 'stud-per-yr':
          $("#stud-sy").hide();
          $("#stud-per-yr").show();
          // $("#month-summary").show();
        break;
        case 'stud-sy':
          ini();
        break;
      }

    });


  });
  </script>
  <!-- <script src='js/Chart.min.js'></script> -->
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
          <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Students Summary</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">

          <div class="form-group">
            <div class="form-inline">
              <label>Show: </label>
              <select id="select-summary" name="show" class="form-control">
                <option value="stud-sy">All Students</option>
                <option value="stud-per-yr">Students Per Level</option>
                <!-- <option value="yearly">Year</option> -->
              </select>
            </div>
          </div>

        <div id='stud-sy'>
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title">
                  Students Per S/Y
                </div>
              </div>
              <div class="panel-body">
                <?php
                  include("includes/graph-all-students.php");
                ?>
              </div>
          </div>

        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title">
                  Gender
                </div>
              </div>

              <div class="panel-body">
                  <?php
                    $allmale = $db->query("select * from student_records where sex='Male' and stat=1");
                    $allfmale = $db->query("select * from student_records where sex='Female' and stat=1");

                    $rowMale = $allmale->num_rows;
                    $rowFmale = $allfmale->num_rows;

                    include("includes/graph-all-gender.php");
                    echo "
                    <input type='hidden' id='hid-male' value='$rowMale'>
                    <input type='hidden' id='hid-fmale' value='$rowFmale'>
                    ";
                  ?>
                </div>

          </div>
      </div>

      <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">
                New Students
              </div>
            </div>

            <div class="panel-body">
                <?php
                  $allold = $db->query("select * from student_records where type='0' and stat=1");
                  $allnew = $db->query("select * from student_records where type='1' and stat=1");

                  $rowOld = $allold->num_rows;
                  $rowNew = $allnew->num_rows;

                  include("includes/graph-all-old-new.php");
                  echo "
                  <input type='hidden' id='hid-old' value='$rowOld'>
                  <input type='hidden' id='hid-new' value='$rowNew'>
                  ";
                ?>
              </div>

        </div>
    </div>
    </div>

    <div id='stud-per-yr'>
      <div id="month-summary" class="panel panel-primary">
          <div class="panel-heading">
              Students Per Level
          </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="dataTable_wrapper">

              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                      <tr>
                          <th>Level</th>
                          <th>Students</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                    $findlvl = $db->query("select * from levels order by id asc ");
                      while($rows=$findlvl->fetch_assoc())
                      {
                        $level_id = $rows['id'];
                        $level = $rows['level'];
                        echo "<tr>";
                        echo "<td>$level</td>";
                        $temp_rowCount = 0;
                        $findsect = $db->query("select * from sections where level_id='$level_id' ");
                          while($rows=$findsect->fetch_assoc())
                          {
                            $section_id = $rows['id'];
                            $stud_count = $db->query("select * from student_records where section='$section_id' ");
                            $rowCount = $stud_count->num_rows;
                            $temp_rowCount = $rowCount + $temp_rowCount;
                          }
                        echo "<td>$temp_rowCount</td>";
                        echo "</tr>";
                      }

                    ?>
                  </tbody>
              </table>
          </div>
    </div>
    </div>

      </div>
    </div>
    <!--footer -->
    <?php
    include("../footer.php");
    ?>
  </div>
</div>





<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>

</body>






</html>
