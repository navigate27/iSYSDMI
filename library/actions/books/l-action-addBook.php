<?php

  include("../../../dmiconnect.php");

  $code = $_POST['postCode'];
  $title = $_POST['postTitle'];
  $author = $_POST['postAuthor'];
  $edtn = $_POST['postEdi'];
  $descrip = $_POST['postDescrip'];
  $cat = $_POST['postCat'];
  $qty = $_POST['postQty'];

  $findcode = $db->query("select * from lib_books where code='$code' and stat!=0");
  if($findcode->num_rows!=0){
    echo "
    <div class='alert alert-danger'>
      <strong>Failed!</strong>  The book/item code already exists.
    </div>
    ";
  }else{

  $title = mysql_real_escape_string($title);
  $author = mysql_real_escape_string($author);
  $descrip = mysql_real_escape_string($descrip);
  $edtn = mysql_real_escape_string($edtn);

  $query = $db->query("insert into lib_books(code,title,author,edition,descrip,cat,qty) values('$code','$title','$author','$edtn','$descrip','$cat','$qty')");

  if($query){

    echo "
    <div class='alert alert-success'>
      <strong>Saved!</strong>  The book/item has been successfully added.
    </div>
    ";

  }else{

    echo "
    <div class='alert alert-danger'>
      <strong>Failed!</strong>  The book/item has not successfully added.
    </div>
    ";

  }

  $act = "<i class='fa fa-plus'></i> <i class='fa fa-book'></i> <span class='text-danger'><strong>Book</strong></span> added in the Library";
  $act = mysql_real_escape_string($act);
  $addAct = $db->query("insert into activities (activity) values('$act')");
}


?>
