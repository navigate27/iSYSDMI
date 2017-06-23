<?php
$page = "library";
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

    // ini();
    // function ini(){
    //   $("#bar-summary").show();
    //   $("#year-summary").hide();
    //   $("#month-summary").hide();
    // }
    //
    // $("#select-summary").change(function(){
    //
    //   var select = $("#select-summary").val();
    //
    //   switch(select){
    //     case 'month':
    //       $("#bar-summary").hide();
    //       $("#year-summary").hide();
    //       $("#month-summary").show();
    //     break;
    //     case 'bar':
    //       ini();
    //     break;
    //     case 'yearly':
    //       $("#bar-summary").hide();
    //       $("#year-summary").show();
    //       $("#month-summary").hide();
    //     break;
    //   }

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
          <h1 class="page-header"><i class="fa fa-table"></i> Frequency of Borrow</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>

              <!-- /.row -->
              <div class="row">
                  <div class="col-lg-12">

                    <!-- <div class="form-group">
                      <div class="form-inline">
                        <label>Show: </label>
                        <select id="select-summary" name="show" class="form-control">
                          <option value="bar">Bar Graph (Yearly)</option>
                          <option value="month">Monthly</option>
                          <option value="yearly">Year</option>
                        </select>
                      </div>
                    </div> -->

                  <div id="bar-summary" class="panel panel-default">
                    <div class="panel-heading">
                      Books/Items Borrowed Per Month
                    </div>
                    <!-- CHART HERE -->
                    <canvas id="income" width="1200" height="600"></canvas>

                    <script>
                    var barData = {
                      labels : ["June","July","August","September","October","November","December","January","February","March"],
                      datasets : [
                        {
                          fillColor : "rgba(172,194,132,0.4)",
                					strokeColor : "#ACC26D",
                					pointColor : "#fff",
                					pointStrokeColor : "#9DB86D",
                          data : [

                          <?php
                          $studfee = $db->query("select * from lib_summary");
                          while ($rows = $studfee->fetch_assoc()) {
                            $val = $rows['val'];

                            echo "$val,";
                          }
                          ?>

                          ]
                        }

                      ]
                    }
                    Chart.defaults.global.responsive = true;
                    var income = document.getElementById("income").getContext("2d");
                    new Chart(income).Line(barData);

                    </script>
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
