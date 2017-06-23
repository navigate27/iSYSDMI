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


</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");
      if(isset($_GET['or'])){
        $or = $_GET['or'];

        $findsnum = $db->query("select * from student_finance where student_finance.or='$or' ")or die("Error. Student_Finance. Receipt.");
          while($rows=$findsnum->fetch_assoc())
          {
            $snum = $rows['snum'];
            $bbooks = $rows['bbooks'];
            $btfee = $rows['btfee'];
            $bpe = $rows['bpe'];
            $bsc = $rows['bsc'];
            $bmisc = $rows['bmisc'];
            $or = $rows['or'];
            $payment = $rows['payment'];
            $disc = $rows['disc'];
            $sy = $rows['sy'];
            $date = $rows['date'];
          }

          $btotal = $bbooks+$btfee+$bpe+$bsc+$bmisc;

          $checkdiscount = $db->query("select * from discounts ")or die("Error. Discounts.");
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

        $rec_snum = $db->query("select * from student_records where snum='$snum' ");
        while($rows=$rec_snum->fetch_assoc())
        {
          $rnum = $rows['refnum'];
          $fname = $rows['fname'];
          $mname = $rows['mname'];
          $lname = $rows['lname'];
          $sy = $rows['sy'];
          $address = $rows['address'];
          $section_id = $rows['section'];
          $img = $rows['imgpath'];
        }
        $disc_snum = $db->query("select * from student_discount where snum='$snum' ");
        while($rows=$disc_snum->fetch_assoc())
        {
          $val = $rows['val'];
          $sal = $rows['sal'];
          $fhm = $rows['fhm'];
          $grad = $rows['grad'];
          $choir = $rows['choir'];
          $early = $rows['early'];
          $friend = $rows['friend'];
          $loyal = $rows['loyal'];
          $qe = $rows['qe'];
        }
        $findsect = $db->query("select * from sections where id='$section_id' ");
        if($findsect->num_rows!=0){
          while($rows=$findsect->fetch_assoc())
          {
            $level_id = $rows['level_id'];
            $section = $rows['section'];
          }
        }else{
          $section = "N/A";
        }

        $findlvl = $db->query("select * from levels where id='$level_id' ");
        while($rows=$findlvl->fetch_assoc())
        {
          $level = $rows['level'];
        }


        $findfees = $db->query("select * from fees where level='$level_id' ")or die("Error. Fees.");
          while($rows=$findfees->fetch_assoc())
          {
            $books = $rows['books'];
            $tfee = $rows['tfee'];
            $pe = $rows['pe'];
            $sc = $rows['sc'];
            $misc = $rows['misc'];
          }
        $total = $books+$tfee+$pe+$sc+$misc;


      }else{
        header("location: e-accounts.php");
      }

      $condate = date("M d, Y - h:ia",strtotime($date));


      ?>

<div class="col-md-8">
    <h4><p class="text-center">Daughters of Mary Immaculate School</p></h4>
    <small><p class="text-center">F. Laurena St., Tanauan City, Batangas</p></small>

    <div class="row">
      <h3><p class="text-center">Billing Statement</p></h3>
    </div>

    <br>


    <div class="row">
        <div class="col-xs-12">
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Name:</strong>
    					<?php echo "$fname $mname[0]. $lname"; ?>
    				</address>
            <address>
    				<strong>Reference Number:</strong>
    					<?php echo $or; ?>
    				</address>
            <address>
    				<strong>S/Y:</strong>
    					<?php echo $sy; ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Level/Section:</strong>
              <?php echo "$level - $section"; ?>
    				</address>
            <address>
        			<strong>Last Payment:</strong>
              <?php echo $condate; ?>
            </address>
    			</div>
    		</div>

    	</div>
    </div>

<br>
  <div class="row">
    <div class="col-md-10">

<!-- til here -->
    <div class="table-responsive">
     <table class="table table-bordered">
         <thead>
           <tr>
              <th>Balance</th>
              <th class="text-right">Month</th>
              <th class="text-right">Year</th>
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
          </tr>
        </tbody>
      </table>
    </div>


    <!-- <h2><p class="text-center">This is not valid as official receipt.</p></h2> -->

    <div class="row">
        <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-6">
            <address>
              Issued by: ___________
            </address>
          </div>

          <div class="col-xs-6 text-right">
            <address>
              Date of Issue: ___________

            </address>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 text-center">
            <address>
              _______________________________
              <br>
              Signature Over Printed Name of Authorized Personnel
            </address>
          </div>
        </div>

      </div>
    </div>



  </div>


</div>



<!--footer -->
		<div id="footer-container">
			<div id="copyright">
				<p></p>
			</div>
		</div>

</div>

</body>






</html>
