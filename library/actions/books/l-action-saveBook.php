<?php
  include("../../../dmiconnect.php");

  $settings = $db->query("select * from settings ")or die("Error. Settings. Please contact your administrator.");
    while($rows=$settings->fetch_assoc()){
      $upbooks = $rows['upbooks'];
    }

    if($upbooks!=1){

      echo "
      <div class='alert alert-warning'><strong>Failed.</strong> Updating Data is disabled by your admin.</div>
      ";

    }else{

      $book_id = $_POST['postId'];
      $code = $_POST['postCode'];
      $title = $_POST['postTitle'];
      $author = $_POST['postAuthor'];
      $edtn = $_POST['postEdi'];
      $descrip = $_POST['postDescrip'];
      $cat = $_POST['postCat'];
      $qty = $_POST['postQty'];
      $stat = $_POST['postStat'];

      $title = mysql_real_escape_string($title);
      $author = mysql_real_escape_string($author);
      $descrip = mysql_real_escape_string($descrip);
      $edtn = mysql_real_escape_string($edtn);

      $findcode = $db->query("select * from lib_books where code='$code' and id!='$book_id' ");
      if($findcode->num_rows!=0){

        echo "<div class='alert alert-danger'><strong>Failed!</strong> Code already exists.</div>";

      }else{

        $query = $db->query("update lib_books set code='$code',title='$title',author='$author',edition='$edtn',descrip='$descrip',cat='$cat',qty='$qty',stat='$stat' where id='$book_id' ");

        if($query){
          echo "
          <div class='alert alert-success'>
          <strong>Saved!</strong> Data has been successfully updated.
          </div>
          ";

        }else{

          echo "
          <div class='alert alert-danger'>
          <strong>Failed!</strong> Data has not successfully updated.
          </div>
          ";

        }

        $act = "<i class='fa fa-pencil'></i> <i class='fa fa-book'></i> <span class='text-danger'><strong>$title</strong></span> edited in the Library";
        $act = mysql_real_escape_string($act);
        $addAct = $db->query("insert into activities (activity) values('$act')");

    }
  }
?>
