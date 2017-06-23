<?php
  include("../../../dmiconnect.php");

  $book_id = $_POST['postId'];

  $settings = $db->query("select * from settings ")or die("Error. Settings. Please contact your administrator.");
    while($rows=$settings->fetch_assoc()){
      $delbooks = $rows['delbooks'];
    }


    if($delbooks!=1){

    echo "
    <script>
      $('#hid-view-msg').val('2');
    </script>
    ";

   }else{



    $query = $db->query("update lib_books set stat='0' where id='$book_id' ");

    if($query){
      echo "
      <div class='alert alert-success'>
        <strong>Removed!</strong>  The book/item has been successfully removed.
      </div>
      ";

    }else{

      echo "
      <div class='alert alert-danger'>
        <strong>Failed!</strong>  The book/item has not successfully removed.
      </div>
      ";

    }

    echo "
    <script>
      $('#hid-view-msg').val('1');
    </script>
    ";
  }
?>
