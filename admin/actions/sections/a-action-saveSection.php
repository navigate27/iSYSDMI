<?php

//   include("../../../dmiconnect.php");
//
//   $section_id = $_POST['postId'];
//   $section = $_POST['postSection'];
//   $level_id = $_POST['postLevel'];
//   $tnum = $_POST['postTnum'];
//
//   $section = mysql_real_escape_string($section);
//
// if($tnum==""){
//
//   $query = $db->query("update sections set section='$section',level_id='$level_id',tnum='' where id='$section_id' ");
//
//   if($query){
//
//     echo "
//     <div class='alert alert-success'>
//       <strong>Saved!</strong>  Section successfully update.
//     </div>
//     ";
//
//   }else{
//
//     echo "
//     <div class='alert alert-danger'>
//       <strong>Failed!</strong>  Section not successfully update.
//     </div>
//     ";
//
//   }
//
// }else{
//
//   $selectfac = $db->query("select * from sections where tnum='$tnum' ") or die("Error. Subjects. Please contact your administrator.");
//   if($selectfac->num_rows!=0){
//     while($rows=$selectfac->fetch_assoc())
//     {
//       $t_tnum = $rows['tnum'];
//       $sect = $rows['section'];
//       $sect_id = $rows['id'];
//       $lvl_id = $rows['level_id'];
//     }
//
//     $findlvl = $db->query("select * from levels where id='$lvl_id' ") or die("Error. Subjects. Please contact your administrator.");
//       while($rows=$findlvl->fetch_assoc())
//       {
//         $level = $rows['level'];
//       }
//
//     $selecttnum = $db->query("select * from teacher_records where tnum='$t_tnum' ") or die("Error. Subjects. Please contact your administrator.");
//       while($rows=$selecttnum->fetch_assoc())
//       {
//         $fname = $rows['fname'];
//         $mname = $rows['mname'];
//         $lname = $rows['lname'];
//       }
//
//     if($sect_id==$section_id){
//
//       $query = $db->query("update sections set tnum='' where tnum='$tnum' ");
//       $query = $db->query("update sections set section='$section',level_id='$level_id' where id='$section_id' ");
//
//       if($query){
//
//         echo "
//         <div class='alert alert-success'>
//           <strong>Saved!</strong>  Section successfully update.
//         </div>
//         ";
//
//       }else{
//
//         echo "
//         <div class='alert alert-danger'>
//           <strong>Failed!</strong>  Section not successfully update.
//         </div>
//         ";
//
//       }
//
//
//     }else{
//
//       echo "
//       <div class='alert alert-danger'>
//       <strong>Failed!</strong>   $fname $lname is already assigned to $level - $sect. <a class='alert-link' href='a-sections.php?section_id=$sect_id'>Click to Reassign</a>.
//       </div>
//       ";
//
//     }
//
//   }else{
//
//
//     $query = $db->query("update sections set tnum='' where tnum='$tnum' ");
//     $query = $db->query("update sections set section='$section',level_id='$level_id',tnum='$tnum' where id='$section_id' ");
//
//     if($query){
//
//       echo "
//       <div class='alert alert-success'>
//         <strong>Saved!</strong>  Section successfully update.
//       </div>
//       ";
//
//     }else{
//
//       echo "
//       <div class='alert alert-danger'>
//         <strong>Failed!</strong>  Section not successfully update.
//       </div>
//       ";
//
//     }
//
//   }
// }

include("../../../dmiconnect.php");

$section_id = $_POST['postId'];
$section = $_POST['postSection'];
$level_id = $_POST['postLevel'];
$tnum = $_POST['postTnum'];

  $selectfac = $db->query("select * from sections where tnum='$tnum' ") or die("Error. Subjects. Please contact your administrator.");
    if($selectfac->num_rows!=0){
      while($rows=$selectfac->fetch_assoc())
      {
        $t_tnum = $rows['tnum'];
        $sect = $rows['section'];
        $sect_id = $rows['id'];
        $lvl_id = $rows['level_id'];
      }



      if($sect_id==$section_id){

        $query = $db->query("update sections set tnum='' where tnum='$tnum' ");
        $query = $db->query("update sections set section='$section',level_id='$level_id' where id='$section_id' ");

        if($query){

          echo "
          <div class='alert alert-success'>
            <strong>Saved!</strong>  Section successfully update.
          </div>
          ";

        }else{

          echo "
          <div class='alert alert-danger'>
            <strong>Failed!</strong>  Section not successfully update.
          </div>
          ";

        }


      }else{
        //If Adviser is BLANK
        if($tnum==""){

          $query = $db->query("update sections set section='$section',level_id='$level_id' where id='$section_id' ");
          if($query){

            echo "
            <div class='alert alert-success'>
              <strong>Saved!</strong>  Section successfully update.
            </div>
            ";

          }else{

            echo "
            <div class='alert alert-danger'>
              <strong>Failed!</strong>  Section not successfully update.
            </div>
            ";

          }


        }else{
          echo "
          <div class='alert alert-danger'>
            <strong>Failed!</strong>  The adviser you have chosen is already assigned to other section. Please choose a different one.</a>.
          </div>
          ";
        }


      }

    }else{


      $query = $db->query("update sections set tnum='' where tnum='$tnum' ");
      $query = $db->query("update sections set section='$section',level_id='$level_id',tnum='$tnum' where id='$section_id' ");

      if($query){

        echo "
        <div class='alert alert-success'>
          <strong>Saved!</strong>  Section successfully update.
        </div>
        ";

      }else{

        echo "
        <div class='alert alert-danger'>
          <strong>Failed!</strong>  Section not successfully update.
        </div>
        ";

      }

    }

?>
