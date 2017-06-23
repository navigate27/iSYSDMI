<?php

if(isset($_GET['msg'])){

  $msg = $_GET['msg'];

  switch($msg){
    case '0':
      echo "<div class='alert alert-danger'><strong>Deleted.</strong> Data successfully deleted.</div>";
    break;
    case '1':
      echo "<div class='alert alert-success'><strong>Imported.</strong> Data has been successfully added to table.</div>";
    break;
    case '2':
      echo "
      <div class='alert alert-danger'><strong>Cannot import file.</strong>
        There is something wrong while importing your file. Click
        <a class=alert-link href='footer/help.html#importbooks'>here</a> for help.
      </div>";
    break;
  }

}

?>
