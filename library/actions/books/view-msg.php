<?php


$viewMsg = $_POST['postView'];

  switch($viewMsg){
    case '0':
      echo "
        <div class='alert alert-info'><strong>Success!</strong> Books and items loaded successfully.</div>
      ";
    break;
    case '1':
      echo "
        <div class='alert alert-info'><strong>Success!</strong> Book/Item deleted successfully.</div>
      ";
    break;
    case '2':
      echo "
        <div class='alert alert-warning'><strong>Failed!</strong> Deleting books/items is disabled by your admin.</div>
      ";
    break;

  }

?>
