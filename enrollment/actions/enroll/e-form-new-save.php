<?php


  $rnum = $_POST['postRnum'];

  $rnum = strtoupper($rnum);

  //THIS IS REALLY AN ID
  $id = $_POST['postSnum'];
  //$snum = ucfirst($snum);

  $fname = $_POST['postFname'];
  $fname = ucwords($fname);

  $mname = $_POST['postMname'];
  $mname = ucwords($mname);

  $lname = $_POST['postLname'];
  $lname = ucwords($lname);

  $section = $_POST['postSection'];
  $sy = $_POST['postSy'];
  $endate = $_POST['postEndate'];
  $pts = $_POST['postPts'];
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

  $bplace = ucwords($bplace);
  $address = ucwords($address);

  $father = $_POST['postFather'];
  $mother = $_POST['postMother'];
  $guardian = $_POST['postGuardian'];
  $cnum = $_POST['postCnum'];

  $father = ucwords($father);
  $mother = ucwords($mother);
  $guardian = ucwords($guardian);

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

  include("../../../dmiconnect.php");

  $checkSnum = $db->query("select * from student_records where id='$id' ") or die("Error. Student_Records");
  if($checkSnum->num_rows!=0){
    echo "<div class='alert alert-danger'>Failed. 4-digit number already exists.</div>";
    echo "
    <script>
      $('#enroll-success').val('0');
      $('#btn-enroll').removeAttr('disabled');
    </script>
    ";
  }else{

    $myYear = substr($sy,0,4);
    $default = 128;
    $snum = "S$myYear$default$id";

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
    $query = $db->query("insert into student_discount(snum,grad,choir,early,friend,loyal,qe) values('$snum','$grad','$choir','$early','$friend','$loyal','$qe')")or die("Error. Student_Discount");
  }else{
    $query = $db->query("insert into student_discount(snum,$acad,grad,choir,early,friend,loyal,qe) values('$snum',1,'$grad','$choir','$early','$friend','$loyal','$qe')")or die("Error. Student_Discount");
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

  $btfee = $tfee - $acadDiscount; //THEN SUBTRACT IT TO THE VALUE OF TUITION FEE TO GET AMOUNT OF TUITION FEE

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

  $qreq = $db->query("insert into student_req(snum,pic,birth,f137,good,report) values('$snum','$pic','$birth','$f137','$good','$report')")or die("Error. Req");

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

  $qrec = $db->query("insert into student_records(id,snum,fname,mname,lname,bday,age,bplace,sex,sy,endate,pts,section,father,mother,guardian,address,cnum,refnum,stat,type)
  values('$id','$snum','$fname','$mname','$lname','$bdate','$age','$bplace','$gender','$sy','$endate','$pts','$section','$father','$mother','$guardian','$address','$cnum','$rnum','1','1')")or die("Error. Student_Records") ;

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

  echo "
  <input type='hidden' id='mySnum' value='$snum'>
  <script>
    $('#enroll-success').val('1');


  </script>
  ";

  //increment 1 to students per school year
  $transferee = $db->query("select * from sy where sy='$sy' ") or die("Can't complete process. Please contact your Administrator.");
    while($rows=$transferee->fetch_assoc())
    {
      $studcount = $rows['studcount'];
    }
    $studcount = $studcount+1;

  $addTransferee = $db->query("update sy set studcount='$studcount' where sy='$sy' ") or die("Can't complete process. Please contact your Administrator.");


  //add activity
  $act = "<i class='fa fa-plus'></i> <i class='fa fa-user'></i> Student <span class='text-primary'><strong>enrolled</strong></span>";
  $act = mysql_real_escape_string($act);
  $addAct = $db->query("insert into activities (activity) values('$act')");

}

  // $del = $db->query("delete from student_grades where id>1");


?>
