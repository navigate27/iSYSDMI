<?php

  $datetime1 = new DateTime($datetime1); //$datetime1 is usually the current date
  $datetime2 = new DateTime($datetime2);

  $diff=date_diff($datetime1, $datetime2);
  $timemsg="";

  if($diff->y > 0){
      if($diff->y <= 1){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"s":'');
      }else{
        //$timemsg = date("M d,Y - h:ia",strtotime($datetime));
      }
  }
  else if($diff->m > 0){
   $timemsg = $diff->m . ' month'. ($diff->m > 1?"s":'');
  }
  else if($diff->d > 0){
      if($diff->d == 1){
        $timemsg = "Yesterday";
      }else{
        $timemsg = $diff->d .' day'. ($diff->d > 1?"s":'');
      }
  }
  else if($diff->h > 0){
      $timemsg = $diff->h .' hour'.($diff->h > 1 ? "s":'');
  }
  else if($diff->i > 0){
   $timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
  }
  else if($diff->s > 0){
   $timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
  }

?>
