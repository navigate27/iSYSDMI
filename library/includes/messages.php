<?php

if(isset($_GET['msg'])){

  $msg = $_GET['msg'];

  switch($msg){
    case '0':
      echo "
      <div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <strong>Deleted.</strong> Data successfully deleted.</div>
      ";
    break;
    case '1':
      echo "
      <div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <strong>Imported.</strong> Data has been successfully added to table.</div>
        ";
    break;
    case '2':
      echo "
      <div class='alert alert-danger'><strong>Cannot import file.</strong>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        There is a problem while importing your file. Click
        <a class=alert-link href='footer/help.html#importbooks'>here</a> for help.
      </div>";
    break;
    case '3':
      echo "
      <div class='alert alert-danger'><strong>Cannot import file.</strong>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        Invalid file type. Click
        <a class=alert-link href='footer/help.html#importbooks'>here</a> for help.
      </div>";
    break;
    case '4':
      $code = $_GET['code'];
      $title = $_GET['title'];
      echo "
      <div class='alert alert-danger'><strong>Cannot import file.</strong>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        Duplicate book / item code for <strong>$code - $title</strong>. Click
        <a class=alert-link href='footer/help.html#importbooks'>here</a> for help.
      </div>";
    break;
  }

}

?>
