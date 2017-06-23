<?php
$page = "library";
include("../session-validate.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DMI - Library Portal</title>
  <?php
    include("linksource.php");
  ?>

  <link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>

  <script type="text/javascript" src="dataTables/datatables.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#example').DataTable();
    } );
  </script>
  <script type="text/javascript" src="export/tableExport.js"></script>
  <script type="text/javascript" src="export/jquery.base64.js"></script>
  <script type="text/javascript" src="export/html2canvas.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>

  <!--for snum-->
  <script type="text/javascript" src="myScript/libScript.js"></script>



</head>
<body>

<div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");
      ?>


<div id="page-wrapper">

    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-steam"></i> Transaction</h1>
          <div id="save_data">
          </div>
<?php

  if(isset($_GET['transaction'])){
    $trans = $_GET['transaction'];

    if($trans=="borrow"){
?>
      <div class="row">
        <div class="col-sm-10">

          <form id="form-borrow" action="l-transaction.php?transaction=borrow#" class="form-horizontal">

            <h3>
              Student/Faculty
              <hr>
            </h3>


            <div id="form-snum" class="form-group">
              <label for="snum" class="control-label col-sm-2">School ID.: </label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" id="input-snum" name="snum">
                </div>
            </div>

            <div id="stud_data">
            </div>


            <h3>
              Book/Item
              <hr>
            </h3>

            <div id='book-msg'></div>

            <div id="form-code" class="form-group">
              <label for="snum" class="control-label col-sm-2">Code: </label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" id="input-code" name="code" autocomplete="off">
                   <div id="feedback-code">
                   </div>
                </div>
            </div>

            <div id="book_data">
            </div>

          <div class="form-group">
            <label for="snum" class="control-label col-sm-2">Date Borrowed: </label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="bdate" id="bdate" value="<?php echo $currentDate = date("Y-m-d"); ?>" disabled>
              </div>
          </div>

          <!-- <div class="form-group">
            <label for="snum" class="control-label col-sm-2">Date Due: </label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="bdue" id="bdue" required>
              </div>
          </div> -->

          <div class="form-group">
            <label class="control-label col-sm-2">Day(s): </label>
            <div class="form-inline">
              <div class="col-sm-10">
                <select class="form-control" id="bdays">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
            </div>
          </div>


            <div class="form-group">
              <div class="col-sm-12">
                   <p class="text-right"><a href="l-transaction.php" class="btn btn-default">Cancel</a>
                     <button class="btn btn-primary" id="btn-borrow-book">Done</button></p>
              </div>
            </div>
            <input type="hidden" id="borrow-stat" value="0">
          </form>
      </div>
    </div>

<?php
  }else{
  $trans_id = $_GET['trans_id'];
  $book_code = $_GET['book_code'];
  $school_id = $_GET['transaction'];

  

  //Get records on lib_transact
  $lib_trans = $db->query("select * from lib_transact where id='$trans_id' ");
  while($rows=$lib_trans->fetch_assoc())
  {
    $bdue = $rows['due'];
  }

  //get the penalty value
  $lib_settings = $db->query("select * from lib_settings")or die("Unable to connect");//status is always not equal to 0 to make sure book is not deleted
    while($rows=$lib_settings->fetch_assoc())
    {
      $penalty = $rows['penalty'];
    }


  //Calculate the penalty
  $currentDate = date("Y-m-d");
  if($currentDate<$bdue){

    $myPen = 0;

  }else{
    $date1 = new DateTime("$bdue");
    $date2 = new DateTime("$currentDate");
    $daysInterval = $date2->diff($date1)->format("%a");//days between date due and date now

    $myPen = $penalty*$daysInterval; //penalty * days between the due ad now

  }


  $rec_snum = $db->query("select * from student_records where snum='$school_id' ");
  $rec_tnum = $db->query("select * from teacher_records where tnum='$school_id' ");

  if($rec_snum->num_rows!=0){
    while($rows=$rec_snum->fetch_assoc())
    {
      $fname = $rows['fname'];
      $mname = $rows['mname'];
      $lname = $rows['lname'];
      $section_id = $rows['section'];
    }
  }else if($rec_tnum->num_rows!=0){
      while($rows=$rec_tnum->fetch_assoc())
      {
        $fname = $rows['fname'];
        $mname = $rows['mname'];
        $lname = $rows['lname'];
        $section_id = "N/A";
      }
  }else{
      $section_id = "N/A";
  }

  $findlvl = $db->query("select * from sections where id='$section_id' ");
  if($findlvl->num_rows!=0){
    while($rows=$findlvl->fetch_assoc())
    {
      $level_id = $rows['level_id'];
    }
  }else{
      $level_id = "N/A";
  }

    $findlvl = $db->query("select * from levels where id='$level_id' ");
    $findsect = $db->query("select * from sections where id='$section_id' ");
    if($findlvl->num_rows!=0){
      while($rows=$findlvl->fetch_assoc())
      {
        $level = $rows['level'];
      }
    }else{
        $level = "N/A";
    }
    if($findsect->num_rows!=0){
      while($rows=$findsect->fetch_assoc())
      {
        $section = $rows['section'];
      }
    }else{
        $section = "N/A";
    }


  $libbooks = $db->query("select * from lib_books where code='$book_code' and stat!=0 ") or die("Can't complete process. Please contact your Administrator.");
  while($rows=$libbooks->fetch_assoc())
  {
    $books_id = $rows['id'];
    $code = $rows['code'];
    $title = $rows['title'];
    $descrip = $rows['descrip'];
  }

?>
<div class="row">
  <div class="col-sm-10">

    <form action="actions/transactions/l-action.php" method="post" class="form-horizontal">

      <h3>
        Student/Faculty
        <hr>
      </h3>

      <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>">
      <input type="hidden" name="books_id" value="<?php echo $books_id; ?>">
      <input type="hidden" name="book_code" value="<?php echo $book_code; ?>">

        <div class="form-group">
          <label for="snum" class="control-label col-sm-2">School ID: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="snum" value="<?php echo $school_id; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
          <label for="name" class="control-label col-sm-2">Name: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" value="<?php echo "$fname $mname[0]. $lname"; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
          <label for="level" class="control-label col-sm-2">Level: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="level" value="<?php echo $level; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
          <label for="level" class="control-label col-sm-2">Section: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="section" value="<?php echo $section; ?>" readonly>
            </div>
        </div>


        <h3>
          Book/Item
          <hr>
        </h3>

        <div class="form-group">
          <label for="title" class="control-label col-sm-2">Code: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="code" value="<?php echo $code; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
          <label for="title" class="control-label col-sm-2">Title: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="title" value="<?php echo $title; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
          <label for="author" class="control-label col-sm-2">Edition: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="descrip" value="<?php echo $descrip; ?>" readonly>
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="control-label col-sm-2">Penalty: </label>
                <div class="form-inline">
                  <div class="col-sm-10">
                    <select name="pen" class="form-control">
                    <option value="">---</option>
                    <option>20</option>
                    <option>30</option>
                    <option>40</option>
                    <option>60</option>
                    <option>100</option>
                    </select>
            </div>
          </div>
        </div> -->

        <div class="form-group">
          <label class="control-label col-sm-2">Due Date: </label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="dueDate" value="<?php echo $bdue; ?>" disabled>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Penalty: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pen" value="<?php echo $myPen; ?>" readonly>
            </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
               <p class="text-right"><a href="l-transaction.php" class="btn btn-default">Cancel</a> <input type="submit" class="btn btn-primary" value="Okay"/></p>
          </div>
        </div>

      </form>
  </div>
</div>
<?php
  }
}else{
?>
    <a href="l-transaction.php?transaction=borrow" class="btn btn-primary"><div class="fa fa-plus"></div> Create Transaction</a>

      </div>
      <!-- /.col-lg-12 -->
    </div>

              <br>
              <!-- /.row -->
              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              List of Transactions
                          </div>
                          <!-- /.panel-heading -->
                          <div class="panel-body">
                              <div class="dataTable_wrapper">
                                <div class="table-responsive">
                                  <table id="example" class="display" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>School ID</th>
                                              <th>Name</th>
                                              <th>Grade/Level</th>
                                              <th>Book/Item Borrowed</th>
                                              <th>Date Borrowed</th>
                                              <th>Due Date</th>
                                              <th>Status</th>
                                              <th>Penalty</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                          $libtransact = $db->query("select * from lib_transact order by date desc") or die("Can't complete process. Please contact your Administrator.");
                                          if($libtransact->num_rows!=0)
                                          {
                                            $num = 1;
                                            while($rows=$libtransact->fetch_assoc())
                                            {
                                              $id = $rows['id'];
                                              $school_id = $rows['snum'];
                                              $book_code = $rows['book_code'];
                                              $date = $rows['date'];
                                              $due = $rows['due'];
                                              $pen = $rows['pen'];
                                              $stat = $rows['stat'];

                                              $date = date("M d, Y",strtotime($date));
                                              $due = date("M d, Y",strtotime($due));

                                              switch($stat){
                                                case 1:
                                                $stat = "<a class='btn btn-warning btn-block' href='l-transaction.php?trans_id=$id&book_code=$book_code&transaction=$school_id'>Pending</a>";
                                                $rowcolor = "warning text-warning";
                                                break;
                                                case 0:
                                                $stat = "<a class='btn btn-success btn-block'>Returned</a>";
                                                $rowcolor = "";
                                                break;
                                              }

                                              $studrec = $db->query("select * from student_records where snum='$school_id' ") or die("Can't complete process. Please contact your Administrator.");
                                              $teachrec = $db->query("select * from teacher_records where tnum='$school_id' ") or die("Can't complete process. Please contact your Administrator.");
                                              if($studrec->num_rows!=0)
                                              {
                                                while($rows=$studrec->fetch_assoc())
                                                {
                                                  $fname = $rows['fname'];
                                                  $lname = $rows['lname'];
                                                  $mname = $rows['mname'];
                                                  $section_id = $rows['section'];
                                                }
                                              }else if($teachrec->num_rows!=0)
                                              {
                                                while($rows=$teachrec->fetch_assoc())
                                                {
                                                  $fname = $rows['fname'];
                                                  $lname = $rows['lname'];
                                                  $mname = $rows['mname'];
                                                }
                                                $section_id = "";
                                                $level_id = "";
                                              }else{
                                                $section_id = "";
                                                $level_id = "";
                                              }

                                              $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                                              if($findsect->num_rows!=0)
                                              {
                                                while($rows=$findsect->fetch_assoc()){
                                                  $level_id = $rows['level_id'];
                                                  $section = $rows['section'];
                                                }
                                              }else{
                                                $section = "N/A";
                                              }

                                              $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                                              if($findlvl->num_rows!=0)
                                              {
                                                while($rows=$findlvl->fetch_assoc()){
                                                  $level = $rows['level'];
                                                }
                                              }else{
                                                $level = "N/A";
                                              }
                                              $lib_books = $db->query("select * from lib_books where code='$book_code' ") or die("Can't complete process. Please contact your Administrator.");
                                              if($lib_books->num_rows!=0)
                                              {
                                                while($rows=$lib_books->fetch_assoc())
                                                {
                                                  $b_title = $rows['title'];
                                                }
                                              }

                                              echo "<tr>
                                                  <td>$num</td>
                                                  <td class='text-primary'>$school_id</td>
                                                  <td>$lname, $fname $mname[0].</td>
                                                  <td>$level - $section</td>
                                                  <td>$b_title</td>
                                                  <td>$date</td>
                                                  <td>$due</td>
                                                  <td>$stat</td>
                                                  <td>$pen</td>


                                              </tr>";

                                              $num++;
                                            }
                                          }
                                        ?>
                                      </tbody>
                                  </table>
                              </div>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                          </div>
                        </div>
                      </div>


<?php
}
?>
<!--footer -->
<?php
include("../footer.php");
?>
</div>
</div>

<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>
</body>






</html>
