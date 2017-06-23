<?php

  include("../../../dmiconnect.php");
  $rnum = $_POST['postRnum'];
  $snum = $_POST['postSnum'];
  $fname = $_POST['postFname'];
  $mname = $_POST['postMname'];
  $lname = $_POST['postLname'];
  // $level_id = $_POST['postLevel'];
  $section = $_POST['postSection'];
  $sy = $_POST['postSy'];
  $endate = $_POST['postEndate'];
  $pts = $_POST['postKinderTime'];
  $age = $_POST['postAge'];
  $gender = $_POST['postGender'];
  $bdate = $_POST['postBdate'];
  $bplace = $_POST['postBplace'];
  $address = $_POST['postAddress'];

  $rnum = mysql_real_escape_string($rnum);
  $fname = mysql_real_escape_string($fname);
  $mname = mysql_real_escape_string($mname);
  $lname = mysql_real_escape_string($lname);
  $bplace = mysql_real_escape_string($bplace);
  $address = mysql_real_escape_string($address);

  $father = $_POST['postFather'];
  $mother = $_POST['postMother'];
  $guardian = $_POST['postGuardian'];
  $cnum = $_POST['postCnum'];

  $father = mysql_real_escape_string($father);
  $mother = mysql_real_escape_string($mother);
  $guardian = mysql_real_escape_string($guardian);
  $cnum = mysql_real_escape_string($cnum);

  $pic = $_POST['postPic'];
  $birth = $_POST['postBirth'];
  $f137 = $_POST['postF137'];
  $good = $_POST['postGood'];
  $report = $_POST['postReport'];

  $acad = $_POST['postAcad'];

  $grad = $_POST['postGrad'];
  $choir = $_POST['postChoir'];
  $early = $_POST['postEarly'];
  $friend = $_POST['postFriend'];
  $loyal = $_POST['postLoyal'];
  $qe = $_POST['postQe'];

  $findlvl = $db->query("select * from sections where id='$section' ");
    while($rows=$findlvl->fetch_assoc())
    {
      $level = $rows['level_id'];//this is a level_id
    }

  $qreq = $db->query("update student_req set pic='$pic',birth='$birth',f137='$f137',good='$good',report='$report' where snum='$snum' ")or die("Error. Req");

  $qrec = $db->query("update student_records set fname='$fname',mname='$mname',lname='$lname',section='$section',bday='$bdate',age='$age',bplace='$bplace',sex='$gender',endate='$endate',
  father='$father',mother='$mother',guardian='$guardian',address='$address',cnum='$cnum',refnum='$rnum' where snum='$snum'");

  if($acad=="none"){
    $qdisc = $db->query("update student_discount set val='0',sal='0',fhm='0',grad='$grad',choir='$choir',early='$early',friend='$friend',loyal='$loyal',qe='$qe' where snum='$snum' ")or die("Error. Student_Discount");
  }else{
    $qdisc = $db->query("update student_discount set val='0',sal='0',fhm='0' where snum='$snum' ")or die("Error. Student_Discount");
    $qdisc = $db->query("update student_discount set $acad='1',grad='$grad',choir='$choir',early='$early',friend='$friend',loyal='$loyal',qe='$qe' where snum='$snum' ")or die("Error. Student_Discount");
  }

    //CHECK STUDENT'S LEVEL TO SET THE CORRECT AMOUNT OF BILLS
    $checkfees = $db->query("select * from fees where level='$level' ");
      while($rows=$checkfees->fetch_assoc())
      {
        $books = $rows['books'];
        $tfee = $rows['tfee'];
        $pe = $rows['pe'];
        $sc = $rows['sc'];
        $misc = $rows['misc'];
      }

    $checkbal = $db->query("select * from student_finance where snum='$snum' and sy='$sy' order by date desc limit 1");
      while($rows=$checkbal->fetch_assoc())
      {
        $bbooks = $rows['bbooks'];
        $btfee = $rows['btfee'];
        $bpe = $rows['bpe'];
        $bsc = $rows['bsc'];
        $bmisc = $rows['bmisc'];
      }

      $btfee = $tfee;
      $bmisc = $misc;

      //CHECK THE VALUE OF THE DISCOUNTS TO SET TO STUDENT'S BALANCE CORRECTLY
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

    //GET THE STUDENT'S DISCOUNT TO SET THE BALANCE VALUE CORRECTLY
    if($acad=="val"){
      $wqe = $dval + $qe;
      $acadDiscount = ($wqe/100)*$tfee; //GET X PERCENTAGE OF TUITION FEE
    }else if($acad=="sal"){
      $wqe = $dsal + $qe;
      $acadDiscount = ($wqe/100)*$tfee;
    }else if($acad=="fhm"){
      $wqe = $dfhm + $qe;
      $acadDiscount = ($wqe/100)*$tfee;
    }else{
      $acadDiscount = 0;
    }

    $btfee = $tfee - $acadDiscount; //THEN SUBTRACT IT TO THE VALUE OF TUITION FEE TO GET AMOUNT OF DISCOUNT

    if($btfee<0){ //CHECK WHETHER BALANCE TUITION IS NEGATIVE
      $btfee = 0;
    }

    $totaldiscount = $acadDiscount; //THEN SET TO STUDENT'S TUITION FEE BALANCE

    //ADDING THE DISCOUNTED/NOT TUITION FEE TO MISCELLANEOUS
    //----->
    if($grad=="1"){
      $totaldiscount = $totaldiscount+$dgrad;
      $dgrad = $dgrad/2; //THE VALUE OF DISCOUNT WILL BE DIVIDED BY TWO TO DISTRIBUTE FOR TUITION AND MISCELLANEOUS
      $btfee = $btfee - $dgrad;
      $bmisc = $bmisc - $dgrad;
    }
    if($choir=="1"){
      $totaldiscount = $totaldiscount+$dchoir;
      $dchoir = $dchoir/2;
      $btfee = $btfee - $dchoir;
      $bmisc = $bmisc - $dchoir;
    }
    if($early=="1"){
      $totaldiscount = $totaldiscount+$dearly;
      $dearly = $dearly/2;
      $btfee = $btfee - $dearly;
      $bmisc = $bmisc - $dearly;
    }
    if($friend=="1"){
      $totaldiscount = $totaldiscount+$dfriend;
      $dfriend = $dfriend/2;
      $btfee = $btfee - $dfriend;
      $bmisc = $bmisc - $dfriend;
    }
    if($loyal=="1"){
      $totaldiscount = $totaldiscount+$dloyal;
      $dloyal = $dloyal/2;
      $btfee = $btfee - $dloyal;
      $bmisc = $bmisc - $dloyal;
    }

    if($btfee<0){ //CHECK WHETHER BALANCE TUITION IS NEGATIVE
      $btfee = 0;
    }

    if($bmisc<0){ //CHECK WHETHER BALANCE MISCELLANEOUS IS NEGATIVE
      $bmisc = 0;
    }


    // echo "$btfee TFEE";
    // echo "<br>";
    // echo "$bmisc MISC";
    // echo "<br>";
    // echO "$totaldiscount TOTAL DISCOUNT";
    // echo "<br>";
    // echo $btfee+$bmisc;
    // echo " TFEE & MISC";

    //----->
    //INSERT DISCOUNTED/NOT BILLS TO STUDENT_FINANCE
    $qfin = $db->query("update student_finance set bbooks='$bbooks',btfee='$btfee',bpe='$bpe',bsc='$bsc',bmisc='$bmisc',disc='$totaldiscount' where snum='$snum' ")or die("Error. Student_Finance");


  if($qreq){

    if($qrec){

      if($qdisc){
        echo "
        <div class='alert alert-success'>
        <strong>Saved!</strong>  Student successfully updated.
        </div>
        ";
      }else{
        echo "
        <div class='alert alert-danger'>
        <strong>Failed!</strong>  Student not successfully updated. Disc.
        </div>
        ";
      }
    }else{
      echo "
      <div class='alert alert-danger'>
      <strong>Failed!</strong>  Student not successfully updated. Rec.
      </div>
      ";
    }

  }else{

    echo "
    <div class='alert alert-danger'>
    <strong>Failed!</strong>  Student not successfully updated.
    </div>
    ";

  }



  //
  // if($qrec){
  //
  //   if($qreq){
  //
  //     if($qfin){
  //       echo "
  //       <div class='alert alert-success'>
  //       <strong>Saved!</strong>  Student successfully updated.
  //       </div>
  //       ";
  //
  //     }else{
  //       echo "
  //       <div class='alert alert-danger'>
  //       <strong>Failed!</strong>  Student not successfully updated. Fin.
  //       </div>
  //       ";
  //     }
  //
  //   }else{
  //     echo "
  //     <div class='alert alert-danger'>
  //     <strong>Failed!</strong>  Student not successfully updated. Req.
  //     </div>
  //     ";
  //   }
  //
  // }else{
  //
  //   echo "
  //   <div class='alert alert-danger'>
  //   <strong>Failed!</strong>  Student not successfully updated. Rec.
  //   </div>
  //   ";
  //
  // }
  //



?>
