<?php

include("../../../dmiconnect.php");
$trans_id = $_POST['trans_id'];
$books_id = $_POST['books_id'];
$book_code = $_POST['book_code'];
$pen = $_POST['pen'];

$query = $db->query("update lib_transact set pen='$pen',stat=0 where id='$trans_id' ") or die("Can't complete process. Please contact your Administrator.");

//get the current qty of book borrowed
$lib_books = $db->query("select * from lib_books where id='$books_id' ") or die("Can't complete process. Please contact your Administrator.");
  while($rows=$lib_books->fetch_assoc())
  {
    $qty = $rows['qty'];
  }
$qty = $qty+1; //then add one (return)

//check if there is an active transaction of the book
$checkCode = $db->query("select * from lib_transact where book_code='$book_code' and stat=1 ") or die("Can't complete process. Please contact your Administrator.");
if($checkCode->num_rows!=0){
  $query = $db->query("update lib_books set qty='$qty' where id='$books_id' ") or die("Can't complete process. Please contact your Administrator.");
}else{
  $query = $db->query("update lib_books set qty='$qty',stat=1 where id='$books_id' ") or die("Can't complete process. Please contact your Administrator.");
}

$act = "<i class='fa fa-sign-in'></i> <i class='fa fa-book'></i> <span class='text-danger'><strong>Book</strong></span> returned in the Library";
$act = mysql_real_escape_string($act);
$addAct = $db->query("insert into activities (activity) values('$act')");

header("location: ../../l-transaction.php");

?>
