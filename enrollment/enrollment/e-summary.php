<?php
$page = "enrollment";
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

    <title>DMI - Enrollment Portal</title>
  <?php
    include("linksource.php");
  ?>
  <script>
  $(document).ready(function(){

    ini();
    function ini(){
      $("#bar-summary").show();
      $("#year-summary").hide();
      $("#month-summary").hide();
      $("#ar").hide();
    }

    $("#select-summary").change(function(){

      var select = $("#select-summary").val();

      switch(select){
        case 'month':
          $("#bar-summary").hide();
          $("#year-summary").hide();
          $("#month-summary").show();
          $("#ar").hide();
        break;
        case 'bar':
          ini();
        break;
        case 'yearly':
          $("#bar-summary").hide();
          $("#year-summary").show();
          $("#month-summary").hide();
          $("#ar").hide();
        break;
        case 'ar':
          $("#bar-summary").hide();
          $("#year-summary").hide();
          $("#month-summary").hide();
          $("#ar").show();
        break;
      }

    });


  });
  </script>
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
          <h1 class="page-header"><i class="fa fa-table"></i> Summary of Payments</h1>
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
                          <option value="bar">Graph (Year)</option>
                          <option value="month">Month</option>
                          <option value="yearly">Year</option>
                          <option value="ar">Balance (Section)</option>
                        </select>
                      </div>
                    </div>

                  <div id="bar-summary" class="panel panel-default">
                    <div class="panel-heading">
                      Yearly Summary of Payments (Bar View)
                    </div>
                    <!-- CHART HERE -->
                    <canvas id="income" width="1200" height="600"></canvas>

                    <script>
                    var barData = {
                      labels : ["January","February","March","April","May","June","July","August","September","October","November","Decemeber"],
                      datasets : [
                        {
                          fillColor : "#48A497",
                          strokeColor : "#48A4D1",
                          data : [

                          <?php
                          $studfee = $db->query("select * from e_summary");
                          while ($rows = $studfee->fetch_assoc()) {
                            $books = $rows['books'];
                            $tfee = $rows['tfee'];
                            $pe = $rows['pe'];
                            $sc = $rows['sc'];
                            $misc = $rows['misc'];
                            $total = $books+$tfee+$pe+$sc+$misc;
                            echo "$total,";
                          }
                          ?>

                          ]
                        },
                        {

                          <?php
                            $feetotal = 0;
                            $studfee = $db->query("select * from fees");
                            while ($rows = $studfee->fetch_assoc()) {
                              $books = $rows['books'];
                              $tfee = $rows['tfee'];
                              $pe = $rows['pe'];
                              $sc = $rows['sc'];
                              $misc = $rows['misc'];

                              $ftotal = $books+$tfee+$pe+$sc+$misc;

                              $feetotal = $feetotal+$ftotal;
                            }
                          ?>

                          fillColor : "rgba(73,188,170,0.4)",
                          strokeColor : "rgba(72,174,209,0.4)",
                          data : [

                            <?php
                            for($i=1;$i<13;$i++){
                              echo "$feetotal,";
                            }
                            ?>

                          ]
                        }

                      ]
                    }
                    Chart.defaults.global.responsive = true;
                    var income = document.getElementById("income").getContext("2d");
                    new Chart(income).Bar(barData);

                    </script>
                  </div>

            <?php
            $months = date("M");
            $monthf = date("F");
            ?>
                      <div id="month-summary" class="panel panel-primary">
                          <div class="panel-heading">
                              Monthly Summary
                          </div>

                          <!-- /.panel-heading -->
                          <div class="panel-body">
                              <div class="dataTable_wrapper">

                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                          <tr>
                                              <th></th>
                                              <th><?php echo $monthf; ?></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                        $sumq = $db->query("select * from e_summary where month='$months' ");
                                          while($rows=$sumq->fetch_assoc())
                                          {
                                            $books = $rows['books'];
                                            $tfee = $rows['tfee'];
                                            $pe = $rows['pe'];
                                            $sc = $rows['sc'];
                                            $misc = $rows['misc'];
                                            echo "
                                            <tr>
                                              <td>Books</td>
                                              <td>$books</td>
                                            </tr>
                                            <tr>
                                              <td>Tuition Fee</td>
                                              <td>$tfee</td>
                                            </tr>
                                            <tr>
                                              <td>P.E. Uniform</td>
                                              <td>$pe</td>
                                            </tr>
                                            <tr>
                                              <td>School Uniform</td>
                                              <td>$sc</td>
                                            </tr>
                                            <tr>
                                              <td>Miscellaneous</td>
                                              <td>$misc</td>
                                            </tr>
                                            ";
                                          }

                                        ?>
                                      </tbody>
                                  </table>
                              </div>
                              <!-- /.table-responsive -->

                          </div>
                  </div>
                  <div id="year-summary" class="panel panel-primary">
                      <div class="panel-heading">
                          Yearly Summary
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <div class="dataTable_wrapper">
                            <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>Month</th>
                                          <th>Books</th>
                                          <th>Tuition Fee</th>
                                          <th>P.E. Uniform</th>
                                          <th>School Uniform</th>
                                          <th>Miscellaneous</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                    $sumq = $db->query("select * from e_summary ");
                                    while($rows=$sumq->fetch_assoc())
                                    {
                                      $books = $rows['books'];
                                      $tfee = $rows['tfee'];
                                      $pe = $rows['pe'];
                                      $sc = $rows['sc'];
                                      $misc = $rows['misc'];
                                    }

                                    $sumq = $db->query("select * from e_summary ");
                                      while($rows=$sumq->fetch_assoc())
                                      {

                                        $strmonth = $rows['month'];
                                        $books = $rows['books'];
                                        $tfee = $rows['tfee'];
                                        $pe = $rows['pe'];
                                        $sc = $rows['sc'];
                                        $misc = $rows['misc'];

                                        echo "<tr>";
                                        echo "<td>$strmonth</td>";

                                        echo "<td>$books</td>";
                                        echo "<td>$tfee</td>";
                                        echo "<td>$pe</td>";
                                        echo "<td>$sc</td>";
                                        echo "<td>$misc</td>";

                                        echo "</tr>";
                                      }
                                    ?>
                                  </tbody>
                              </table>
                          </div>
                          </div>
                          <!-- /.table-responsive -->
                      </div>
              </div>

              <div id="ar" class="panel panel-primary">
                  <div class="panel-heading">
                      Balance (Section)
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                      <div class="dataTable_wrapper">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                  <tr>
                                      <th>Level</th>
                                      <th>Section</th>
                                      <th>Balance</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                                $supertotal = 0;
                                $slctsect = $db->query("select * from sections order by level_id asc");//Selecting all sections
                                while($rows=$slctsect->fetch_assoc())
                                {
                                  $section = $rows['section'];
                                  $section_id = $rows['id'];
                                  $level_id = $rows['level_id'];

                                  $findsnum = $db->query("select * from student_records where section='$section_id' ");//Selecting all students who in that section
                                  while($rows=$findsnum->fetch_assoc())
                                  {
                                    $snum = $rows['snum'];

                                    $findfin = $db->query("select * from student_finance where snum='$snum' order by date desc limit 1");//Tracking student's current balance
                                    while($rows=$findfin->fetch_assoc())
                                    {
                                      $bbooks = $rows['bbooks'];
                                      $btfee = $rows['btfee'];
                                      $bpe = $rows['bpe'];
                                      $bsc = $rows['bsc'];
                                      $bmisc = $rows['bmisc'];
                                      $total = $bbooks+$btfee+$bpe+$bsc+$bmisc; //Total balance of 1 student
                                    }

                                    $supertotal = $supertotal+$total;

                                  }

                                  $findlvl = $db->query("select * from levels where id='$level_id' ");//Determine what level of the section
                                    while($rows=$findlvl->fetch_assoc())
                                    {

                                      $level = $rows['level'];

                                      echo "<tr>";
                                      echo "<td>$level</td>";
                                      echo "<td>$section</td>";
                                      echo "<td>$supertotal</td>";
                                      echo "</tr>";
                                    }

                                    $supertotal = 0;
                                }


                                ?>
                              </tbody>
                          </table>
                      </div>
                      </div>
                      <!-- /.table-responsive -->
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
