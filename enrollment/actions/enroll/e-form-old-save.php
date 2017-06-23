<?php

  $snum = $_POST['postSnum'];
  $section = $_POST['postSection'];
  $sy = $_POST['postSy'];
  $endate = $_POST['postEndate'];
  $pts = $_POST['postPts'];
  // $age = $_POST['postAge'];

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


  include("../../../dmiconnect.php");


  //find the level
  $findlvl = $db->query("select * from sections where id='$section' ");
    while($rows=$findlvl->fetch_assoc())
    {
      $level = $rows['level_id'];
    }

  //INSERT STUDENT IN TABLE STUDENT_GRADES

  $selectsubj = $db->query("select * from subjects where level='$level'");
  if($selectsubj->num_rows!=0){
    while($rows=$selectsubj->fetch_assoc())
    {
      $subj_code = $rows['subj_code'];

      $addSnumGrade = $db->query("insert into student_grades(snum,subj_code,quarter,sy) values('$snum','$subj_code','1st','$sy')")or die("Error. Student_Grades");
      $addSnumGrade = $db->query("insert into student_grades(snum,subj_code,quarter,sy) values('$snum','$subj_code','2nd','$sy')")or die("Error. Student_Grades");
      $addSnumGrade = $db->query("insert into student_grades(snum,subj_code,quarter,sy) values('$snum','$subj_code','3rd','$sy')")or die("Error. Student_Grades");
      $addSnumGrade = $db->query("insert into student_grades(snum,subj_code,quarter,sy) values('$snum','$subj_code','4th','$sy')")or die("Error. Student_Grades");

    }
  }else{

    echo "
    <div class='alert alert-danger'>
    <strong>Failed!</strong>  No subject in that level.
    </div>
    ";

  }


//FROM HERE WILL BE THE SAME AS SAVING PAYMENT FOR STUDENTS
  //INSERT STUDENT IN TABLE STUDENT_DISCOUNT

  if($acad=="none"){
    $query = $db->query("update student_discount set val='0',sal='0',fhm='0',grad='$grad',choir='$choir',early='$early',friend='$friend',loyal='$loyal',qe='$qe' where snum='$snum' ")or die("Error. Student_Discount");
  }else{
    $qdisc = $db->query("update student_discount set val='0',sal='0',fhm='0' where snum='$snum' ")or die("Error. Student_Discount");
    $query = $db->query("update student_discount set $acad='1',grad='$grad',choir='$choir',early='$early',friend='$friend',loyal='$loyal',qe='$qe' where snum='$snum' ")or die("Error. Student_Discount");
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

    //SET THE VALUE OF STUDENT'S BALANCE BASED ON THE VALUE BILLS
    $bbooks = $books;
    $btfee = $tfee;
    $bpe = $pe;
    $bsc = $sc;
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
    $acadDiscount = 0+($qe/100)*$tfee; //
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
  $qfin = $db->query("insert into student_finance(snum,bbooks,btfee,bpe,bsc,bmisc,disc,sy) values('$snum','$bbooks','$btfee','$bpe','$bsc','$bmisc','$totaldiscount','$sy')")or die("Error. Student_Finance");

  if($qfin){
    echo "
    <div class='alert alert-success'>
    <strong>Success!</strong>  Student_Finance.
    </div>
    ";
  }else{
    echo "
    <div class='alert alert-danger'>
    <strong>Failed!</strong>  Student_Finance.
    </div>
    ";
  }

  $qreq = $db->query("update student_req set pic='$pic',birth='$birth',f137='$f137',good='$good',report='$report' where snum='$snum' ")or die("Error. Req");

  if($qreq){
    echo "
    <div class='alert alert-success'>
    <strong>Success!</strong>  Student_Req.
    </div>
    ";
  }else{
    echo "
    <div class='alert alert-danger'>
    <strong>Failed!</strong>  Student_Req.
    </div>
    ";
  }

//TIL TO HERE

  $qrec = $db->query("update student_records set type=0,sy='$sy',endate='$endate',pts='$pts',level='$level',section='$section' where snum='$snum'")or die("Error. Student_Records") ;

  if($qrec){
    echo "
    <div class='alert alert-success'>
    <strong>Success!</strong>  Student_Rec.
    </div>
    ";
  }else{
    echo "
    <div class='alert alert-danger'>
    <strong>Failed!</strong>  Student_Rec.
    </div>
    ";
  }

  $transferee = $db->query("select * from sy where sy='$sy' ") or die("Can't complete process. Please contact your Administrator.");
    while($rows=$transferee->fetch_assoc())
    {
      $studcount = $rows['studcount'];
    }
    $studcount = $studcount+1;

  $addTransferee = $db->query("update sy set studcount='$studcount' where sy='$sy' ") or die("Can't complete process. Please contact your Administrator.");

  $act = "<i class='fa fa-plus'></i> <i class='fa fa-user'></i> Student <span class='text-primary'><strong>enrolled</strong></span>";
  $act = mysql_real_escape_string($act);
  $addAct = $db->query("insert into activities (activity) values('$act')");
?>
