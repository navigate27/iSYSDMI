<?php

  include("../../../dmiconnect.php");

  $tnum = $_POST['postTnum'];
  $fname = $_POST['postFname'];
  $mname = $_POST['postMname'];
  $lname = $_POST['postLname'];
  $bio = $_POST['postBio'];
  $endate = $_POST['postEndate'];
  $section_id = $_POST['postSection'];

  $fname = mysql_real_escape_string($fname);
  $mname = mysql_real_escape_string($mname);
  $lname = mysql_real_escape_string($lname);



    if($section_id==""){

      $queryq = $db->query("update sections set tnum='' where tnum='$tnum' ");
      $query = $db->query("update teacher_records set fname='$fname',mname='$mname',lname='$lname',bio='$bio',endate='$endate' where tnum='$tnum' ");

      if($query){

        echo "
        <div class='alert alert-success'>
        <strong>Saved!</strong>  Faculty member successfully updated.
        </div>
        ";

      }else{

        echo "
        <div class='alert alert-danger'>
        <strong>Failed!</strong>  Faculty member not successfully updated.
        </div>
        ";

      }

    }else{

      //check if section is already taken
      $selectsect = $db->query("select * from sections where id='$section_id' ") or die("Error. Subjects. Please contact your administrator.");
      while($rows=$selectsect->fetch_assoc())
      {
        $sect_tnum = $rows['tnum'];
      }

      if($sect_tnum!=""){

        if($sect_tnum==$tnum){

          $queryq = $db->query("update sections set tnum='' where tnum='$tnum' ");
          $query2 = $db->query("update sections set tnum='$tnum' where id='$section_id' ");
          $query = $db->query("update teacher_records set fname='$fname',mname='$mname',lname='$lname',bio='$bio',endate='$endate' where tnum='$tnum' ");

          if($query){

            echo "
            <div class='alert alert-success'>
            <strong>Saved!</strong>  Faculty member successfully updated.
            </div>
            ";

          }else{

            echo "
            <div class='alert alert-danger'>
            <strong>Failed!</strong>  Faculty member not successfully updated.
            </div>
            ";

          }

          if(!$query2){

            echo "
            <div class='alert alert-danger'>
              <strong>Failed!</strong> Section not successfully assigned.
            </div>
            ";

          }
          
        }else{

          echo "
          <div class='alert alert-danger'>
          <strong>Failed!</strong> The section you requested is already taken. Please choose a different one.
          </div>
          ";

        }
      }else{

        $queryq = $db->query("update sections set tnum='' where tnum='$tnum' ");
        $query2 = $db->query("update sections set tnum='$tnum' where id='$section_id' ");
        $query = $db->query("update teacher_records set fname='$fname',mname='$mname',lname='$lname',bio='$bio',endate='$endate' where tnum='$tnum' ");

        if($query){

          echo "
          <div class='alert alert-success'>
          <strong>Saved!</strong>  Faculty member successfully updated.
          </div>
          ";

        }else{

          echo "
          <div class='alert alert-danger'>
          <strong>Failed!</strong>  Faculty member not successfully updated.
          </div>
          ";

        }

        if(!$query2){

          echo "
          <div class='alert alert-danger'>
            <strong>Failed!</strong> Section not successfully assigned.
          </div>
          ";

        }


      }

    }


?>
