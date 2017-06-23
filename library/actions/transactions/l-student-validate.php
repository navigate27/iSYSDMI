<?php
include("../../../dmiconnect.php");

  $school_id = $_POST['partSnum'];

  $query = $db->query("SELECT * FROM student_records WHERE snum='$school_id' ")or die("Unable to connect");
  $query2 = $db->query("SELECT * FROM teacher_records WHERE tnum='$school_id' ")or die("Unable to connect");
  if($query->num_rows!=0)
  {

    while($rows=$query->fetch_assoc())
    {
      $stat = $rows['stat'];
    }
    if($stat!=1){
      echo "<div class='alert alert-danger'><strong>Failed!</strong> The student account is disabled.</div>
      <script>
      $('#borrow-stat').val('0');
      </script>
      ";
    }else{

    $query = $db->query("SELECT * FROM lib_transact WHERE snum='$school_id' and stat=1 order by date desc limit 1")or die("Unable to connect");
    if($query->num_rows!=0)
    {
      echo "<div class='alert alert-danger'><strong>Failed!</strong> This student has a pending book to return.</div>
      <script>
      $('#borrow-stat').val('0');
      </script>
      ";
    }else{

      $query = $db->query("SELECT * FROM student_records WHERE snum='$school_id' ")or die("Unable to connect");
        while($rows=$query->fetch_assoc())
        {
          $snum = $rows['snum'];
          $fname = $rows['fname'];
          $lname = $rows['lname'];
          $mname = $rows['mname'];
          $level_id = $rows['level'];
          $section_id = $rows['section'];
        }
        $query = $db->query("select * from sections where id='$section_id'")or die("Unable to connect");
        if($query->num_rows!=0){
          while($rows=$query->fetch_assoc())
          {
            $level_id = $rows['level_id'];
            $section = $rows['section'];
          }
        }else{
          $section = "N/A";
        }

        $query = $db->query("select * from levels where id='$level_id'")or die("Unable to connect");
          while($rows=$query->fetch_assoc())
          {
            $level = $rows['level'];
          }


        echo "
            <div class='form-group'>
              <label for='name' class='control-label col-sm-2'>Name: </label>
                <div class='col-sm-10'>
                  <input type='text' class='form-control' name='name' value='$fname $mname[0]. $lname' disabled>
                </div>
            </div>

            <div class='form-group'>
              <label for='level' class='control-label col-sm-2'>Level: </label>
                <div class='col-sm-10'>
                  <input type='text' class='form-control' name='level' value='$level' readonly>
                </div>
            </div>

            <div class='form-group'>
              <label for='level' class='control-label col-sm-2'>Section: </label>
                <div class='col-sm-10'>
                  <input type='text' class='form-control' name='level' value='$section' readonly>
                </div>
            </div>
            ";
?>
      <script>
      $("#borrow-stat").val("1");
      </script>
<?php
    }

  }//if stat!=1

} else if($query2->num_rows!=0){

  $query2 = $db->query("SELECT * FROM teacher_records WHERE tnum='$school_id' ")or die("Unable to connect");
    while($rows=$query2->fetch_assoc())
    {
      $tnum = $rows['tnum'];
      $fname = $rows['fname'];
      $lname = $rows['lname'];
      $mname = $rows['mname'];
      $stat = $rows['stat'];
    }

    if($stat!=1){
      echo "<div class='alert alert-danger'><strong>Failed!</strong> The faculty account is disabled.</div>
      <script>
      $('#borrow-stat').val('0');
      </script>
      ";
    }else{
      $tquery = $db->query("SELECT * FROM lib_transact WHERE snum='$school_id' and stat=1 order by date desc limit 1")or die("Unable to connect");
      if($tquery->num_rows!=0)
      {
        echo "<div class='alert alert-danger'><strong>Failed!</strong> This faculty has a pending book to return.</div>
        <script>
        $('#borrow-stat').val('0');
        </script>
        ";
      }else{
        echo "
            <div class='form-group'>
              <label for='name' class='control-label col-sm-2'>Name: </label>
                <div class='col-sm-10'>
                  <input type='text' class='form-control' name='name' value='$fname $mname[0]. $lname' disabled>
                </div>
            </div>

            ";
            echo "
            <script>
            $('#borrow-stat').val('1');
            </script>
            ";
        }
      }


}else{
?>
<script>
$("#borrow-stat").val("0");
</script>
    <div class="alert alert-danger">
        <strong>Invalid School ID.</strong> The school id you entered doesn't exist.
    </div>
<?php
}
?>
