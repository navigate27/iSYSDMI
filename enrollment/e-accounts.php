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

  <link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>

  <script type="text/javascript" src="dataTables/datatables.min.js"></script>
  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
       $('#example').dataTable({
        "processing": true
    });

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
    ini();
    function ini(){
      // $("#table-data").load("loadTable.php");
        // var table = $('#example').DataTable( {
        //     ajax: "data.json"
        // } );
        // table.ajax.url( 'newData.json' ).load();
            }
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

  $checkfees = $db->query("select * from fees where level='$level_id' ");

  while($rows=$checkfees->fetch_assoc())
  {
    $books = $rows['books'];
    $tfee = $rows['tfee'];
    $pe = $rows['pe'];
    $sc = $rows['sc'];
    $misc = $rows['misc'];
  }

  while($rows=$checkfees->fetch_assoc())
  {
    $books = $rows['books'];
    $tfee = $rows['tfee'];
    $pe = $rows['pe'];
    $sc = $rows['sc'];
    $misc = $rows['misc'];
  }


  //check Requirements
  if($pic=="1"){
    $picStat = "checked='checked'";
  }else{
    $picStat = "";
  }
  if($birth=="1"){
    $birthStat = "checked";
  }else{
    $birthStat = "";
  }
  if($f137=="1"){
    $f137Stat = "checked";
  }else{
    $f137Stat = "";
  }
  if($good=="1"){
    $goodStat = "checked";
  }else{
    $goodStat = "";
  }
  if($report=="1"){
    $reportStat = "checked";
  }else{
    $reportStat = "";
  }


  //check discounts
  $checkdiscount = $db->query("select * from discounts ");
  while($rows=$checkdiscount->fetch_assoc())
  {
    $dval = $rows['val'];
    $dsal = $rows['sal'];
    $dfhm = $rows['fhm'];
    $dgrad = $rows['grad'];
    $dchoir = $rows['choir'];
    $dearly = $rows['early'];
    $dfriend = $rows['friend'];
    $dloyal = $rows['loyal'];
  }

  if($val==0&&$sal==0&&$fhm==0){
    $discStat = "checked='checked'";
    $acadDiscount = 0;
  }else{
    $discStat = "";
  }


  //CheckDiscounts
  if($val=="1"){
    $valStat = "checked='checked'";
  }else{
    $valStat = "";
  }
  if($sal=="1"){
    $salStat = "checked='checked'";
  }else{
    $salStat = "";
  }
  if($fhm=="1"){
    $fhmStat = "checked='checked'";
  }else{
    $fhmStat = "";
  }
  if($grad=="1"){
    $gradStat = "checked='checked'";
  }else{
    $gradStat = "";
  }
  if($choir=="1"){
    $choirStat = "checked='checked'";
  }else{
    $choirStat = "";
  }
  if($early=="1"){
    $earlyStat = "checked='checked'";
  }else{
    $earlyStat = "";
  }
  if($friend=="1"){
    $friendStat = "checked='checked'";
  }else{
    $friendStat = "";
  }
  if($loyal=="1"){
    $loyalStat = "checked='checked'";
  }else{
    $loyalStat = "";
  }

  //format date
  $endate = date("M d, Y",strtotime($endate));

  $total = $books+$tfee+$pe+$sc+$misc;
  $btotal = $bbooks+$btfee+$bpe+$bsc+$bmisc;

?>

<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-table"></i> <?php echo "$fname $lname's"; ?> Account</h1>
  </div>
</div>

<div class="panel panel-primary" width="50%">
  <div class="panel-heading">
      Information
  </div>

  <input type="hidden" id="form-snum" value="<?php echo $snum;?>">

  <div class="panel-body">

      <div class="row">
        <div class="col-md-4">
          <h5><label>Name: </label> <?php echo "$lname, $fname $mname[0]."; ?></h5>
        </div>
        <div class="col-md-4">
          <h5><label>Student No.: </label> <?php echo $snum; ?></h5>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <h5><label>Reference Number: </label> <?php echo $rnum; ?></h5>
        </div>
        <div class="col-md-4">
          <h5><label>Date of Enrollment: </label> <?php echo $endate; ?></h5>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <h5><label>Level/Section: </label> <?php echo "$level - $section"; ?></h5>
        </div>
        <div class="col-md-4">
          <h5><label>S/Y: </label> <?php echo $sy; ?></h5>
        </div>
      </div>

      <div class="row">
        <hr>
      </div>

<div class="row">
      <div class="form-group">
            <label for="kinder_time" class="control-label col-sm-2">Requirements</label>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="checkbox-inline">
                  <input type="checkbox" name="pic" id="form-pic" <?php echo $picStat; ?> disabled> 2x2 Picture
                </label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="checkbox-inline">
                  <input type="checkbox" name="birth" id="form-birth" <?php echo $birthStat; ?> disabled> Birth Certificate
                </label>
              </div>
            </div>
            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="checkbox-inline">
                  <input type="checkbox" name="f137" id="form-f137" name="f137" <?php echo $f137Stat; ?> disabled> Form 137
                </label>
              </div>
            </div>
            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <label class="checkbox-inline">
                  <input type="checkbox" name="good" id="form-good" <?php echo $goodStat; ?> disabled> Good Moral Character
                </label>
              </div>
            </div>
            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="checkbox-inline">
                  <input type="checkbox" name="report" id="form-report" <?php echo $reportStat; ?> disabled> Report Card
                </label>
              </div>
            </div>
      </div>
</div>

<div class="row">
      <div class="form-group">
            <label class="control-label col-sm-2">Discount</label>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="radio-inline">
                  <input name="acad" type="radio" id="form-acad" value="val" <?php echo $valStat; ?> disabled> Valedictorian
                </label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="radio-inline">
                  <input name="acad" type="radio" id="form-acad" value="sal" <?php echo $salStat; ?> disabled> Salutatorian
                </label>
              </div>
            </div>
            <label class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input name="acad" type="radio" id="form-acad" value="fhm" <?php echo $fhmStat; ?> disabled> First Honorable Mention
                </label>
              </div>
            </div>
            <label class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-3">
                <label class="radio-inline">
                  <input name="acad" type="radio" id="form-acad" value="none" <?php echo $discStat; ?> disabled> None of the above
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
                  <input type="checkbox" name="grad" id="form-grad" <?php echo $gradStat; ?> disabled> DMI Graduate
                </label>
              </div>
            </div>


            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <label class="checkbox-inline">
                  <input type="checkbox" name="choir" id="form-choir" <?php echo $choirStat; ?> disabled> Choir Member/Athlete
                </label>
              </div>
            </div>
            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <label class="checkbox-inline">
                  <input type="checkbox" name="early" id="form-early" <?php echo $earlyStat; ?> disabled> Early Enrollment Discount
                </label>
              </div>
            </div>
            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <label class="checkbox-inline">
                  <input type="checkbox" name="friend" id="form-friend" <?php echo $friendStat; ?> disabled> Bring a Friend
                </label>
              </div>
            </div>
            <label for="kinder_time" class="control-label col-sm-2"></label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <label class="checkbox-inline">
                  <input type="checkbox" name="loyal" id="form-loyal" <?php echo $loyalStat; ?> disabled> Loyalty Award
                </label>
              </div>
            </div>
      </div>
</div>

</div>
</div>


<div class="panel panel-success" width="50%">
  <div class="panel-heading">
      Balance
  </div>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h3><p class="text-center">School Year of <?php echo $sy; ?></p></h3>
    </div>
  </div>
</div>
<!-- Don't change this -->
<div>
  <div class="row">
    <div class="col-md-10">
    <div class="col-md-offset-1 col-md-10">


      <div class="table-responsive">
       <table class="table table-hover">
           <thead>
             <tr class="active">
                <th>Fees</th>
                <th></th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Books</td>
              <td class="text-right"><?php echo number_format($books); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>Tuition Fee</td>
              <td class="text-right"><?php echo number_format($tfee); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>P.E. Uniform</td>
              <td class="text-right"><?php echo number_format($pe); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>School Uniform</td>
              <td class="text-right"><?php echo number_format($sc); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>Miscellaneous</td>
              <td class="text-right"><?php echo number_format($misc); ?></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Total</strong></td>
              <td class="text-right"><strong class="text-success"><?php echo number_format($total); ?></strong></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
<!-- til here -->

      <div class="table-responsive">
       <table class="table table-hover">
           <thead>
             <tr class="warning">
                <th>Discount</th>
                <th></th>
                <th></th>
            </tr>
          </thead>
          <tbody>

      <?php
        //compute discount
        if($qe!=0){
          echo "
          <tr>
            <td>Qualifying Exam</td>
            <td class='text-right'>$qe%</td>
            <td></td>
          </tr>
          ";
        }

        if($val=="1"){
          echo "
          <tr>
            <td>Valedictorian</td>
            <td class='text-right'>No Tuition Fee + QE </td>
            <td></td>
          </tr>
          ";
        }else if($sal=="1"){
          echo "
          <tr>
            <td>Salutatorian</td>
            <td class='text-right'>$dsal% on Tuition Fee + QE </td>
            <td></td>
          </tr>
          ";
        }else if($fhm=="1"){
          echo "
          <tr>
            <td>First Honorable Mention</td>
            <td class='text-right'>$dfhm% on Tuition Fee + QE </td>
            <td></td>
          </tr>
          ";
        }else{

        }

        $btotal = $bbooks+$btfee+$bpe+$bsc+$bmisc;

        if($grad=="1"){
          echo "
          <tr>
            <td>DMI Graduate</td>
            <td class='text-right'>$dgrad </td>
            <td></td>
          </tr>
          ";
        }
        if($choir=="1"){
          echo "
          <tr>
            <td>Choir Member/Athlete</td>
            <td class='text-right'>$dchoir </td>
            <td></td>
          </tr>
          ";
        }
        if($early=="1"){
          echo "
          <tr>
            <td>Early Enrollment</td>
            <td class='text-right'>$dearly </td>
            <td></td>
          </tr>
          ";
        }
        if($friend=="1"){
          echo "
          <tr>
            <td>Bring a Friend</td>
            <td class='text-right'>$dfriend </td>
            <td></td>
          </tr>
          ";
        }
        if($loyal=="1"){
          echo "
          <tr>
            <td>Loyalty Award</td>
            <td class='text-right'>$dloyal </td>
            <td></td>
          </tr>
          ";
        }
      ?>
      <!-- <tr>
        <td>&nbsp</td>
        <td>&nbsp</td>
        <td>&nbsp</td>
      </tr> -->
      <tr class="active">
        <td>Tuition Fee</td>
        <td class='text-right'><?php echo $btfee; ?> </td>
        <td></td>
      </tr>
      <tr class="active">
        <td>Miscellaneous</td>
        <td class='text-right'><?php echo $bmisc; ?> </td>
        <td></td>
      </tr>
      <tr>
        <td><strong>Total</strong></td>
        <td class='text-right'><?php echo $btfee+$bmisc; ?> </td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>


            <div class="table-responsive">
             <table class="table table-hover">
                 <thead>
                   <tr class="info">
                      <th>Balance</th>
                      <th class="text-right">Month</th>
                      <th class="text-right">Year</th>
                      <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Books</td>
                    <td class="text-right"><?php echo number_format($bbooks/10); ?></td>
                    <td class="text-right"><?php echo number_format($bbooks); ?></td>
                  </tr>
                  <tr>
                    <td>Tuition Fee</td>
                    <td class="text-right"><?php echo number_format($btfee/10); ?></td>
                    <td class="text-right"><?php echo number_format($btfee); ?></td>
                  </tr>
                  <tr>
                    <td>P.E. Uniform</td>
                    <td class="text-right"><?php echo number_format($bpe/10); ?></td>
                    <td class="text-right"><?php echo number_format($bpe); ?></td>
                  </tr>
                  <tr>
                    <td>School Uniform</td>
                    <td class="text-right"><?php echo number_format($bsc/10); ?></td>
                    <td class="text-right"><?php echo number_format($bsc); ?></td>
                  </tr>
                  <tr>
                    <td>Miscellaneous</td>
                    <td class="text-right"><?php echo number_format($bmisc/10); ?></td>
                    <td class="text-right"><?php echo number_format($bmisc); ?></td>
                  </tr>
                  <tr class="info">
                    <td><strong class="text-primary">Total Balance</strong></td>
                    <td class="text-right"><strong class="text-primary"><?php echo number_format($btotal/10); ?></strong></td>
                    <td class="text-right"><strong class="text-primary"><?php echo number_format($btotal); ?></strong></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>

            </div>

            <?php

            //CHECK IF HAS BACK ACCOUNTS
            $temp_bal = 0;//initial value
            $slctsy = $db->query("select * from sy order by id desc") or die("Can't complete process. Please contact your Administrator.");
              while($rows=$slctsy->fetch_assoc())
              {
                $ctrsy = $rows['sy'];

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
                  $temp_bal = $bal+$temp_bal;
                }

              }
              //____>
              $temp_bal = number_format($temp_bal);

              if($temp_bal!=0){
                $paylink = "<a class='btn btn-block btn-success' href='e-form-pay.php?snum=$snum'>Make Payment</a>";
              }else{
                $paylink = "";
              }

            ?>

              <div class="row">
                <div class="col-md-12">
                  <?php echo $paylink ?>
                </div>
              </div>
            <br>

    </div>
  </div>
  </div>
</div>

</div>

<div id="payment-history" class="panel panel-info" width="50%">
  <div class="panel-heading">
      Payment History
  </div>

  <div class="panel-body">
    <div class="dataTable_wrapper">
      <div class="table-responsive">
      <table id="example" class="display" cellspacing="0">
        <thead>
            <tr>
              <th>#</th>
              <th>Ref. No.</th>
              <!-- <th>Books</th>
              <th>P.E.</th>
              <th>Schl Uniform</th>
              <th>Tuition</th>
              <th>Misc</th> -->
              <th>Total Balance</th>
              <th>Total Payment</th>
              <th>Date</th>
              <th>S/Y</th>
              <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
          $num = 1;


          $studfin = $db->query("select * from student_finance where snum='$snum' order by date desc ") or die("Can't complete process. Please contact your Administrator.");
          while($rows=$studfin->fetch_assoc())
          {
            $bbooks = $rows['bbooks'];
            $btfee = $rows['btfee'];
            $bpe = $rows['bpe'];
            $bsc = $rows['bsc'];
            $bmisc = $rows['bmisc'];
            $or = $rows['or'];
            $payment = $rows['payment'];
            $date = $rows['date'];
            $sy = $rows['sy'];
            $condate = date("M d, Y / h:ia",strtotime($date));
            $bal = $bbooks+$btfee+$bpe+$bsc+$bmisc;
            //$bal = number_format($bal);

            if($date!="0000-00-00 00:00:00"){
              echo "
              <tr>
                  <td>$num</td>
                  <td>$or</td>
                  <!-- <td>$bbooks</td>
                  <td>$bpe</td>
                  <td>$bsc</td>
                  <td>$btfee</td>
                  <td>$bmisc</td> -->
                  <td>$bal</td>
                  <td>$payment</td>
                  <td>$condate</td>
                  <td>$sy</td>
                  <td><a href='e-receipt.php?or=$or' class='btn btn-success' title='Print' target='_blank'>
                    <div class='fa fa-print'></div></a>
                  </td>
              </tr>";
            }
              $num++;
          }

        ?>

        </tbody>
      </table>
    </div>

  </div>
  </div>
</div>

<?php
}else{
?>


<!-- <a class="btn btn-primary" id="btn" href="#">Refresh</a> -->

<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-table"></i> Student Accounts</h1>
  </div>
</div>
<div class="panel panel-primary" width="50%">
  <div class="panel-heading">
      Account Table
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
                      <th>Grade/Level</th>
                      <!-- <th>Balance</th> -->
                      <th>Last Payment</th>
                      <th>Status</th>
                      <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody>
                <?php
                      include("../dmiconnect.php");
                  $q = $db->query("select * from student_records order by endate desc");
                  $num = 1;
                    while($rows=$q->fetch_assoc())
                    {
                      $snum = $rows['snum'];
                      $fname = $rows['fname'];
                      $mname = $rows['mname'];
                      $lname = $rows['lname'];
                      $age = $rows['age'];
                      $section_id = $rows['section'];


                      $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                        while($rows=$findsect->fetch_assoc())
                        {
                          $section = $rows['section'];
                          $level_id = $rows['level_id'];
                        }

                        $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                        while($rows=$findlvl->fetch_assoc())
                        {
                          $level = $rows['level'];
                        }

                        //CHECK IF HAS BACK ACCOUNTS
                        $temp_bal = 0;//initial value
                        $slctsy = $db->query("select * from sy order by id desc") or die("Can't complete process. Please contact your Administrator.");
                          while($rows=$slctsy->fetch_assoc())
                          {
                            $ctrsy = $rows['sy'];

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
                              $temp_bal = $bal+$temp_bal;
                            }

                          }
                          //____>
                          $temp_bal = number_format($temp_bal);

                          $condate = date("M d, Y - h:ia",strtotime($date));

                          if($temp_bal!=0){
                            $snumlink = "href='e-form-pay.php?snum=$snum'";

                          }else{
                            $snumlink = "";
                          }

                          if($temp_bal!=0){
                            $p_status = "<a $snumlink class='btn btn-warning btn-block'>Pending</a>";
                            $t_stat = "Pending";
                          }else{
                            $p_status = "<a $snumlink class='btn btn-success btn-block'>Clear</a>";
                            $t_stat = "Clear";
                          }

                        echo "
                        <tr>
                            <td>$num</td>
                            <td><a href='e-accounts.php?snum=$snum'>$snum</a></td>
                            <td>$lname, $fname $mname[0].</td>
                            <td>$level - $section</td>
                            <td class='center'>$condate</td>
                            <!--<td class='center'>$temp_bal</td>-->
                            <td><span data-toggle='tooltip' data-placement='top' title='$t_stat'>$p_status</span></td>
                            <!--<td>
                              <span data-toggle='tooltip' data-placement='top' title='Pay'>
                                <a href='e-form-pay.php?snum=$snum' class='btn btn-info'>
                                  <div class='fa fa-angle-double-right'></div>
                                </a>
                              </span>
                            </td>-->
                        </tr>";

                      $num++;
                  }
                ?>

                </tbody>
              </table>
            </div>
            </div>
          </div>
      </div>
<p class="text-right"><a class="btn btn-success" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});">Export to Excel</a></p>

<div id='table-data'></div>

<?php
}
?>
<!--footer -->
<?php
include("../footer.php");
?>


</div>
</div>


<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>
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
</body>






</html>
