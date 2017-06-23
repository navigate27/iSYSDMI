<?php

include("../../../dmiconnect.php");

  $snum = $_POST['postSnum'];
  $snum = strtoupper($snum);
  $code = $_POST['postCode'];
  $bdate = $_POST['postBdate'];
  // $bdue = $_POST['postBdue'];
  $bdays = $_POST['postBdays'];

  $bdue = date('Y-m-d', strtotime("+$bdays days")); //add days depending on what user put



  $query = $db->query("insert into lib_transact(snum,book_code,date,due) values('$snum','$code','$bdate','$bdue')");

  //setting to lib_summary
  $monthnow = date("M");
  $checksumm = $db->query("select * from lib_summary where month='$monthnow' ")or die("Unable to connect");
  if($checksumm->num_rows!=0){
    while($rows=$checksumm->fetch_assoc())
    {
      $val = $rows['val'];
    }
  }

  $val = $val+1;
  $setVal = $db->query("update lib_summary set val='$val' where month='$monthnow' ")or die("Unable to connect");
  //end

  $findbook = $db->query("select * from lib_books where code='$code' ")or die("Unable to connect");
    while($rows=$findbook->fetch_assoc())
    {
      $qty = $rows['qty'];
    }

  $qty = $qty-1; //decrement qty of book/item
  if($qty<0){ //making sure it wont turn negative
    $qty = 0;
  }
  $query0 = $db->query("update lib_books set qty='$qty',stat=2 where code='$code' "); //set stat to 2 to set in borrow mode

  if($query0){
    echo "<div class='alert alert-success'><strong>Success!</strong> Book/Item borrowed successfully</div>";
  }else{
    echo "<div class='alert alert-danger'><strong>Failed!</strong> An error occcured while borrowing this book/item. Please try again later.</div>";
  }

  $act = "<i class='fa fa-sign-out'></i> <i class='fa fa-book'></i> <span class='text-danger'><strong>Book</strong></span> borrowed in the Library";
  $act = mysql_real_escape_string($act);
  $addAct = $db->query("insert into activities (activity) values('$act')");
?>
