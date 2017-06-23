<?php

include("../dmiconnect.php");

if(isset($_GET['section'])){

  $section_id = $_GET['section'];

  $findlvl = $db->query("select * from levels where section_id='$section_id' ");
  while($rows=$findlvl->fetch_assoc()){
    $level_id = $rows['id'];
  }

}else{


}

?>

<html>
<head>

<style>
#tbl-comp{
border:collapse;

}
</style>

</head>
<body>

<table id="tbl-comp">
  <thead>
    <?php
    $findsub = $db->query("select * from subjects where level_id='$level_id' ");
    while($rows=$findsub->fetch_assoc()){
      $subj = $rows['subj'];
      echo "<th>$subj</th>";
    }
    ?>
  </thead>

  <tbody>
    <tr>
      <td>
      </td>
    </tr>
  </tbody>
</table>


</body>
</html>
