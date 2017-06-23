<?php

  include("../../../dmiconnect.php");

  $fname = $_POST['postFname'];
  $mname = $_POST['postMname'];
  $lname = $_POST['postLname'];
  $bio = $_POST['postBio'];
  $endate = $_POST['postEndate'];
  $section_id = $_POST['postSection'];


  $yearen = date("Y",strtotime($endate));

  $fname = mysql_real_escape_string(ucwords($fname));
  $mname = mysql_real_escape_string(ucwords($mname));
  $lname = mysql_real_escape_string(ucwords($lname));

  $findbio = $db->query("select * from teacher_records where bio='$bio' ") or die("Error. Subjects. Please contact your administrator.");
  if($findbio->num_rows!=0){
    echo "
    <div class='alert alert-danger'>
      <strong>Failed!</strong> Biometric number is already registered. Please try another valid one.
    </div>
    ";
  }else{

    if($section_id==""){
      $selectfaculty = $db->query("select * from teacher_records order by id desc limit 1") or die("Error. Teacher_Records. Please contact your administrator.");
      while($rows=$selectfaculty->fetch_assoc())
      {
        $t_id = $rows['id'];
      }

      $t_id = $t_id+1;
      $def = "128";

      $tnum = "F$yearen$def$t_id";
      $pass = date("mdY",strtotime($endate));

      $query = $db->query("insert into teacher_records(id,tnum,fname,mname,lname,bio,endate) values('$t_id','$tnum','$fname','$mname','$lname','$bio','$endate') ");
      $query3 = $db->query("insert into accounts(id,tnum,user,pass,type) values('$t_id','$tnum','$tnum','$pass','0') ");

      if($query){

        echo "
        <div class='alert alert-success'>
        <strong>Saved!</strong>  New faculty member successfully added.
        </div>
        ";

      }else{

        echo "
        <div class='alert alert-danger'>
        <strong>Failed!</strong>  New faculty member not successfully added.
        </div>
        ";

      }

    }else{

      $selectsect = $db->query("select * from sections where id='$section_id' ") or die("Error. Subjects. Please contact your administrator.");
      while($rows=$selectsect->fetch_assoc())
      {
        $sect_tnum = $rows['tnum'];
      }

      if($sect_tnum!=""){

        echo "
        <div class='alert alert-danger'>
          <strong>Failed!</strong> The section you requested is already taken. Please choose a different one.
        </div>
        ";

      }else{

        $selectfaculty = $db->query("select * from teacher_records order by id desc limit 1") or die("Error. Teacher_Records. Please contact your administrator.");
        while($rows=$selectfaculty->fetch_assoc())
        {
          $t_id = $rows['id'];
        }
        $t_id = $t_id+1;

        $def = "128";

        $tnum = "F$yearen$def$t_id";
        $pass = date("mdY",strtotime($endate));
        $query = $db->query("insert into teacher_records(id,tnum,fname,mname,lname,bio,endate) values('$t_id','$tnum','$fname','$mname','$lname','$bio','$endate') ");
        $query2 = $db->query("update sections set tnum='$tnum' where id='$section_id' ");
        $query3 = $db->query("insert into accounts(id,tnum,user,pass,type) values('$t_id','$tnum','$tnum','$pass','0') ");

        if($query){

          echo "
          <div class='alert alert-success'>
          <strong>Saved!</strong>  New faculty member successfully added.
          </div>
          ";

        }else{

          echo "
          <div class='alert alert-danger'>
          <strong>Failed!</strong>  New faculty member not successfully added.
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



  }


?>
