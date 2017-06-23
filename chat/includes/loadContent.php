<?php

include("../db_connect.php");

$showMsg = $db->query("select * from messages");

if($showMsg->num_rows!=0){
  while($rows=$showMsg->fetch_assoc()){
    $myUser = $rows['sender'];
    $myMsg = $rows['msg'];
    $myDatetime = $rows['datetime'];

    //$myDatetimecon = date("Y-m-d",strtotime($myDatetime));
    $currentDateTime = date("Y-m-d H:i:s");

    $datetime1 = $currentDateTime;
    $datetime2 = $myDatetime;

    // if($user==$myUser){
    //   $dir = "right";
    // }else{
    //   $dir = "left";
    // }

    include("lastTime.php");

    echo "
    <li class='right clearfix'>
      <span class='chat-img pull-right'></span>
      <div class='chat-body clearfix'>
        <div class='header'><small class='text-muted'>
          <i class='fa fa-clock-o fa-fw'></i> $timemsg ago</small>
          <strong class='pull-right primary-font'>$myUser</strong>
        </div><p>$myMsg</p>
      </div>
      </li>
    ";


  }

}else{


}



?>
