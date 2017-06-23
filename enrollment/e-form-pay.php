<?php
$page = "enrollment";
include("../session-validate.php");
include("/includes/settings.php");
if($enrollallow!=1){
  header("location:e-forbid.php");
}
?>

<?php
  if(isset($_GET['snum'])){
    $snum = $_GET['snum'];
  }else{
    header("location: e-form-new.php");
  }

  $trans_id = rand(10000,99999);

  date_default_timezone_set('Asia/Taipei');
  $paydate =  date("Y-m-d H:i:s");
  $conpaydate = date("M d, Y - h:ia",strtotime($paydate));

  $ornum =  date("Y$trans_id-mdwH");

  $checktransid = $db->query("select * from student_finance where `student_finance`.or='$ornum' ");
  if($checktransid->num_rows!=0){
     header("location:e-form-pay.php?snum=$snum");
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

  <!-- <script type="text/javascript" src="myScript/eFormScript.js"></script> -->

  <script type="text/javascript">
  $(document).ready(function(){

    ini();
    function ini(){
      var tpay = $("#total-payment").html();
      parseInt(tpay);
      if(tpay==0){
        $("#btn-pay").attr("disabled","disabled");
      }else{
        $("#btn-pay").removeAttr("disabled");
      }
    }

    getSyData();
  function getSyData(){
    var sy = $("#form-sy").val();
    var snum = $("#form-snum").val();
    $.post("actions/pay/e-pay-check-sy.php",{
      postSnum:snum,
      postSy:sy
    },function(baldata){
      $("#bal-data").html(baldata);

      var disc_tfee = $("#hid-discount-tfee").val();
      $("#discount-tfee").html(disc_tfee);
      var disc_misc = $("#hid-discount-misc").val();
      $("#discount-misc").html(disc_misc);
      var disc_total = $("#hid-discount-total").val();
      $("#discount-total").html(disc_total);
      // alert(disc_total);
      var bal_books = $("#bal-books").val();
      $("#books-bal-year").html(bal_books);
      $("#books-bal-month").html(bal_books/10);

      var bal_tfee = $("#bal-tfee").val();
      $("#tfee-bal-year").html(bal_tfee);
      $("#tfee-bal-month").html(bal_tfee/10);

      var bal_pe = $("#bal-pe").val();
      $("#pe-bal-year").html(bal_pe);
      $("#pe-bal-month").html(bal_pe/10);

      var bal_sc = $("#bal-sc").val();
      $("#sc-bal-year").html(bal_sc);
      $("#sc-bal-month").html(bal_sc/10);

      var bal_misc = $("#bal-misc").val();
      $("#misc-bal-year").html(bal_misc);
      $("#misc-bal-month").html(bal_misc/10);

      // alert(bal_books);
      // alert(bal_btfee);
      // alert(bal_bpe);
      // alert(bal_bsc);
      // alert(bal_bmisc);

      var html_bal_books = $("#books-bal-year").html();
      var html_bal_tfee = $("#tfee-bal-year").html();
      var html_bal_pe = $("#pe-bal-year").html();
      var html_bal_sc = $("#sc-bal-year").html();
      var html_bal_misc = $("#misc-bal-year").html();

      var val_bal_year = parseInt(html_bal_books)+parseInt(html_bal_tfee)+parseInt(html_bal_pe)+parseInt(html_bal_sc)+parseInt(html_bal_misc);
      $("#total-bal-year").html(val_bal_year);
      $("#total-bal-month").html(val_bal_year/10);

      var val_payment = parseInt(input_books)+parseInt(input_tfee)+parseInt(input_pe)+parseInt(input_sc)+parseInt(input_misc);
      $("#total-payment").html(val_payment);

      var bal_stat = $("#bal-stat").val();
      alert(bal_stat);
      if(bal_stat==1){
        $("#btn-pay").removeAttr("disabled");
      }else{
        $("#btn-pay").attr("disabled","disabled");
      }

    });
  }


    function calculateVal(){

      if(input_books<0){
        $("#input-books").val("0");
      }
      if(input_tfee<0){
        $("#input-tfee").val("0");
      }
      if(input_pe<0){
        $("#input-pe").val("0");
      }
      if(input_sc<0){
        $("#input-sc").val("0");
      }
      if(input_misc<0){
        $("#input-misc").val("0");
      }

      var input_books = $("#input-books").val();
      var input_tfee = $("#input-tfee").val();
      var input_pe = $("#input-pe").val();
      var input_sc = $("#input-sc").val();
      var input_misc = $("#input-misc").val();

      if(input_books==""){
        input_books = 0;
      }
      if(input_tfee==""){
        input_tfee = 0;
      }
      if(input_pe==""){
        input_pe = 0;
      }
      if(input_sc==""){
        input_sc = 0;
      }
      if(input_misc==""){
        input_misc = 0;
      }

      if(input_books<0){
        $("#input-books").val("0");
      }
      if(input_tfee<0){
        $("#input-tfee").val("0");
      }
      if(input_pe<0){
        $("#input-pe").val("0");
      }
      if(input_sc<0){
        $("#input-sc").val("0");
      }
      if(input_misc<0){
        $("#input-misc").val("0");
      }



      var bal_books = $("#bal-books").val();

      //BOOKS
      var bal_bbooks = bal_books-input_books;
      if(bal_bbooks<0){
        bal_bbooks = 0;
      }

      $("#books-bal-year").html(bal_bbooks);
      $("#books-bal-month").html(bal_bbooks/10);



      var bal_tfee = $("#bal-tfee").val();
      //TFEE
      var bal_btfee = bal_tfee-input_tfee;
      if(bal_btfee<0){
        bal_btfee = 0;
      }
      $("#tfee-bal-year").html(bal_btfee);
      $("#tfee-bal-month").html(bal_btfee/10);


      var bal_pe = $("#bal-pe").val();
      //PE
      var bal_bpe = bal_pe-input_pe;
      if(bal_bpe<0){
        bal_bpe = 0;
      }
      $("#pe-bal-year").html(bal_bpe);
      $("#pe-bal-month").html(bal_bpe/10);



      var bal_sc = $("#bal-sc").val();
      //SCHOOL
      var bal_bsc = bal_sc-input_sc;
      if(bal_bsc<0){
        bal_bsc = 0;
      }
      $("#sc-bal-year").html(bal_bsc);
      $("#sc-bal-month").html(bal_bsc/10);



      var bal_misc = $("#bal-misc").val();
      //MISC
      var bal_bmisc = bal_misc-input_misc;
      if(bal_bmisc<0){
        bal_bmisc = 0;
      }
      $("#misc-bal-year").html(bal_bmisc);
      $("#misc-bal-month").html(bal_bmisc/10);

      var html_bal_books = $("#books-bal-year").html();
      var html_bal_tfee = $("#tfee-bal-year").html();
      var html_bal_pe = $("#pe-bal-year").html();
      var html_bal_sc = $("#sc-bal-year").html();
      var html_bal_misc = $("#misc-bal-year").html();

      var val_bal_year = parseInt(html_bal_books)+parseInt(html_bal_tfee)+parseInt(html_bal_pe)+parseInt(html_bal_sc)+parseInt(html_bal_misc);
      $("#total-bal-year").html(val_bal_year);
      $("#total-bal-month").html(val_bal_year/10);


      var val_payment = parseInt(input_books)+parseInt(input_tfee)+parseInt(input_pe)+parseInt(input_sc)+parseInt(input_misc);
      if(val_payment<0){
        val_payment = 0;
      }

      $("#total-payment").html(val_payment);

      var tpay = $("#total-payment").html();
      parseInt(tpay);
      if(tpay==0){
        $("#btn-pay").attr("disabled","disabled");
      }else{
        $("#btn-pay").removeAttr("disabled");
      }
    }

    $("#input-books").bind('keyup mouseup', function(){
      calculateVal();
    });

    $("#input-tfee").bind('keyup mouseup', function(){
      calculateVal();
    });

    $("#input-pe").bind('keyup mouseup', function(){
      calculateVal();
    });

    $("#input-sc").bind('keyup mouseup', function(){
      calculateVal();
    });

    $("#input-misc").bind('keyup mouseup', function(){
      calculateVal();
    });

    $("#pay-validate").submit(function(evt){
      evt.preventDefault();
      var sy = $("#form-sy").val();
      var snum = $("#snum").val();
      var date = $("#form-date").val();
      var paycheck = $("#check-number").val();
      var or = $("#form-or").html();
      var bal_books = $("#books-bal-year").html();
      var bal_tfee = $("#tfee-bal-year").html();
      var bal_pe = $("#pe-bal-year").html();
      var bal_sc = $("#sc-bal-year").html();
      var bal_misc = $("#misc-bal-year").html();
      var total_payment = $("#total-payment").html();
      var total_disc = $("#discount-total").html();

      var p_books = $("#input-books").val();
      var p_tfee = $("#input-tfee").val();
      var p_sc = $("#input-sc").val();
      var p_pe = $("#input-pe").val();
      var p_misc = $("#input-misc").val();

      $("#btn-pay").attr("disabled","disabled");
      $.post("actions/pay/e-pay-save.php",{
        postSnum:snum,
        postSy:sy,
        postCheck:paycheck,
        postOr:or,
        postDate:date,
        postBooks:bal_books,
        postTfee:bal_tfee,
        postPe:bal_pe,
        postSc:bal_sc,
        postMisc:bal_misc,
        postDisc:total_disc,
        postPbooks:p_books,
        postPtfee:p_tfee,
        postPsc:p_sc,
        postPpe:p_pe,
        postPmisc:p_misc,
        postPay:total_payment
      },function(suck){
          $("#msg").html(suck);
          window.location.replace("e-accounts.php?snum="+snum+"#payment-history");
      });
    });

    $("#type-check").click(function(){
      $("#check-number").removeAttr("disabled");
      $("#check-number").attr("required","required");
    });
    $("#type-cash").click(function(){
      $("#check-number").removeAttr("required");
      $("#check-number").attr("disabled","disabled");
      $("#check-number").val("");
    });

    $("#form-sy").change(function(){
      getSyData();
    });

  });
  </script>

</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");

      include("includes/get_student_info.php");

        $checkTfee = $db->query("select * from fees where level='$level_id' ");
        while($rows=$checkTfee->fetch_assoc())
        {
          $books = $rows['books'];
          $tfee = $rows['tfee'];
          $pe = $rows['pe'];
          $sc = $rows['sc'];
          $misc = $rows['misc'];
        }

        $total = $books+$tfee+$pe+$sc+$misc;

      ?>


<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-table"></i> Payment</h1>
      </div>
    </div>

      <div class="panel panel-primary" width="50%">
        <div class="panel-heading">
            Payment Form
        </div>

        <input type="hidden" id="form-snum" value="<?php echo $snum;?>">

        <div class="panel-body">
            <form id="pay-validate" class="form-horizontal">

            <div class="row">
              <div class="col-md-4">
                <h5><label>Name: </label> <?php echo "$lname, $fname $mname[0]."; ?></h5>
              </div>
              <div class="col-md-4">
                <h5><label>Student No.: </label> <?php echo $snum; ?></h5>
              </div>
            </div>

            <div class="row">
              <!-- <div class="col-md-4">
                <h5><label>Reference Number: </label> <?php echo $rnum; ?></h5>
              </div> -->
              <div class="col-md-4">
                <h5><label>Level/Section: </label> <?php echo "$level - $section"; ?></h5>
              </div>
              <div class="col-md-4">
                <h5><label>Date: </label> <?php echo $conpaydate; ?></h5>
              </div>
              <input type="hidden" id="form-date" value="<?php echo $paydate; ?>">
            </div>

            <!-- <div class="row">
              <div class="col-md-4">
                <h5><label>Level: </label> <?php echo $level; ?></h5>
              </div>
              <div class="col-md-4">
                <h5><label>Section: </label> <?php echo $section; ?></h5>
              </div>
            </div> -->
            <hr>
            <?php
            $checkidsy = $db->query("select * from sy where sy='$sy' ") or die("Can't complete process. Please contact your Administrator.");
              while($rows=$checkidsy->fetch_assoc())
              {
                $sy_id_stud = $rows['id'];
              }

            //CHECK IF HAS BACK ACCOUNTS
            $temp_bal = 0;//initial value
            $slctsy = $db->query("select * from sy where id<$sy_id_stud order by id desc") or die("Can't complete process. Please contact your Administrator.");
              while($rows=$slctsy->fetch_assoc())
              {
                $ctrsy = $rows['sy'];

                //sy now must not be equal to ctrsy
                if($ctrsy!=$sy){

                  //check if ctrsy exist in student_finance which means the student is enrolled in that sy
                  $checksyexist = $db->query("select * from student_finance where snum='$snum' and sy='$ctrsy' ") or die("Can't complete process. Please contact your Administrator.");

                  if($checksyexist->num_rows!=0){


                    //check last balance depending on S/Y ($ctrsy)
                    $studfin = $db->query("select * from student_finance where snum='$snum' and sy='$ctrsy' order by date desc limit 1") or die("Can't complete process. Please contact your Administrator.");
                    while($rows=$studfin->fetch_assoc())
                    {
                      $bbooks = $rows['bbooks'];
                      $btfee = $rows['btfee'];
                      $bpe = $rows['bpe'];
                      $bsc = $rows['bsc'];
                      $bmisc = $rows['bmisc'];
                      $or = $rows['or'];
                      $date = $rows['date'];

                      $bal = $bbooks+$btfee+$bpe+$bsc+$bmisc;
                      if($bal!=0){
                        echo "<div class='alert alert-danger'><strong><i class='fa fa-info-circle'></i> Notice!</strong> This student has unpaid fee(s) for the schoolyear of <b>$ctrsy</b>.</div>";
                      }
                      // $temp_bal = $bal+$temp_bal;
                    }

                    // if($temp_bal!=0){
                    //   echo "<div class='alert alert-danger'><strong><i class='fa fa-info-circle'></i> Notice!</strong> This student has unpaid fee for the schoolyear of <b>$ctrsy</b>.</div>";
                    // }

                  }

                }

              }
              //____>
            ?>

          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <h5>
                    <label>Reference No.: </label><div id="form-or"><?php echo $ornum; ?></div>
                </h5>
              </div>
              <div class="col-md-4">
                    <div class="form-inline">
                      <h5><label>S/Y: </label>
                    <select name="sy" class="form-control" id="form-sy">
                      <?php
                      $checksy = $db->query("select * from sy order by id desc");
                        while($rows=$checksy->fetch_assoc())
                        {
                          $supersy = $rows['sy'];

                          $findsy = $db->query("select * from student_finance where snum='$snum' and sy='$supersy' order by date desc limit 1");
                            while($rows=$findsy->fetch_assoc())
                            {
                              $sy = $rows['sy'];
                              $trans_stat = $rows['stat'];
                              if($trans_stat!=0){
                                echo "<option>$sy</option>";
                              }
                            }
                        }
                      ?>
                    </select>
                    </div>
                </h5>
              </div>
          </div>
        </div>
          <div class="row">
            <div class="col-md-4">
              <h5>
                <label>Payment Type: </label>
                <div class="form-inline">
                  <label class="checkbox-inline">
                    <input type="radio" name="pay" id="type-cash" checked> Cash
                  </label>
                  <label class="checkbox-inline">
                    <input type="radio" name="pay" id="type-check"> Check
                  </label>
                </div>
              </h5>
            </div>
            <div class="col-md-4">
              <h5>
                <label>Check No.: </label>
                <div class="form-inline">
                  <input type="text" class="form-control" id="check-number" autocomplete="off" disabled>
                </div>
              </h5>
            </div>

          </div>

          <div class="row">

          </div>


        <table class="table table-hover text-center">
          <tr class="active text-left">
            <th>Fees</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Discount</th>
            <th class="text-center">Balance</th>
            <!-- <th class="text-center">Balance(Month)</th> -->
            <th class="text-center">Payment</th>
          </tr>

          <tr>
            <td class="text-left">Books</td>
            <td class="text-center"><?php echo number_format($books); ?></td>
            <td></td>
            <td><div id="books-bal-year">0</div></td>
            <!-- <td><div id="books-bal-month">0</div></td> -->
            <td>
              <div class="form-inline">
                <input type="number" min="0" id="input-books" style="width:70%" class="text-center" value="0" required/>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-left">Tuition Fee</td>
            <td class="text-center"><?php echo number_format($tfee); ?></td>
            <td id="discount-tfee"></td>
            <td><div id="tfee-bal-year">0</div></td>
            <!-- <td><div id="tfee-bal-month">0</div></td> -->
            <td>
              <div class="form-inline">
                <input type="number" min="0" id="input-tfee" style="width:70%" class="text-center" value="0" required/>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-left">P.E. Uniform</td>
            <td class="text-center"><?php echo number_format($pe); ?></td>
            <td></td>
            <td><div id="pe-bal-year">0</div></td>
            <!-- <td><div id="pe-bal-month">0</div></td> -->
            <td>
              <div class="form-inline">
                <input type="number" min="0" id="input-pe" style="width:70%" class="text-center" value="0" required/>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-left">School Uniform</td>
            <td class="text-center"><?php echo number_format($sc); ?></td>
            <td></td>
            <td><div id="sc-bal-year">0</div></td>
            <!-- <td><div id="sc-bal-month">0</div></td> -->
            <td>
              <div class="form-inline">
                <input type="number" min="0" id="input-sc" style="width:70%" class="text-center" value="0" required/>
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-left">Miscellaneous</td>
            <td class="text-center"><?php echo number_format($misc); ?></td>
            <td id="discount-misc">0</td>
            <td><div id="misc-bal-year">0</div></td>
            <!-- <td><div id="misc-bal-month">0</div></td> -->
            <td>
              <div class="form-inline">

                <input type="number" min="0" id="input-misc" style="width:70%" class="text-center" value="0" required/>

              </div>
            </td>
          </tr>
          <tr class="success text-center">
            <td class="text-left">Total</td>
            <td class="text-center"><?php echo number_format($total); ?></td>
            <td class="text-warning"><strong><div id="discount-total"></div></strong></td>
            <td class="text-primary"><strong><div id="total-bal-year">0</div></strong></td>
            <!-- <td class="text-primary"><div id="total-bal-month">0</div></td> -->
            <td class="text-success"><strong><div id="total-payment">0</div></strong></td>
          </tr>
        </table>
        <div id="msg">
        </div>
        <div id="pay-msg">
        </div>
        <input type="hidden" id="pay-validate" value="1">
              <hr>
              <div class="form-group">
                <div class="col-sm-12">
    					       <p class="text-right"><button type="submit" id="btn-pay" class="btn btn-primary btn-lg">Done</button></p>
                </div>
              </div>
    </form>
  </div>
</div>

    <input type="hidden" id="snum" value="<?php echo $snum;?>">
    <input type="hidden" id="fee-books" value="<?php echo $books;?>">
    <input type="hidden" id="fee-tfee" value="<?php echo $tfee;?>">
    <input type="hidden" id="fee-pe" value="<?php echo $pe;?>">
    <input type="hidden" id="fee-sc" value="<?php echo $sc;?>">
    <input type="hidden" id="fee-misc" value="<?php echo $misc;?>">

    <div id="bal-data">
    </div>

    <input type="hidden" id="post-books">

    <!--footer -->
    <?php
    include("../footer.php");
    ?>



</div>
</div>

</body>






</html>
