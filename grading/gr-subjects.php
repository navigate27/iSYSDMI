<?php
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

    <title>DMI - Grading Portal</title>
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
          <h1 class="page-header"><i class="fa fa-heart"></i> Subjects</h1>

  <?php
  if(isset($_GET['subj_code'])){

    $subj_code = $_GET['subj_code'];

    $subjnameq = $db->query("select * from subjects where subj_code='$subj_code' ") or die("Can't complete process. Please contact your Administrator.");
      $num = 1;
      while($rows=$subjnameq->fetch_assoc())
      {
        $subj = $rows['subj'];
        $level_id = $rows['level'];
        $section_id = $rows['section'];
      }

      $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$findlvl->fetch_assoc())
      {
        $level = $rows['level'];
      }

      $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
      if($findsect->num_rows!=0){
        while($rows=$findsect->fetch_assoc())
        {
          $section = $rows['section'];
        }
      }else{
        $section = "N/A";
      }
  ?>
  <h3><a href="gr-subjects.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a></h3>
              <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="panel-title">
                    <?php echo "$level - $section ($subj)"; ?>
                  </div>
                </div>
                          <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <div class="table-responsive">
                        <table id="example" class="display" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student No.</th>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Section</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $subjquery = $db->query("select * from student_records where section='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                                if($subjquery->num_rows!=0)
                                {
                                  $num = 1;
                                  while($rows=$subjquery->fetch_assoc())
                                  {
                                    $snum = $rows['snum'];
                                    $fname = $rows['fname'];
                                    $mname = $rows['mname'];
                                    $lname = $rows['lname'];
                                    $level_id = $rows['level'];
                                    $section_id = $rows['section'];

                                    $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                                    while($rows=$findlvl->fetch_assoc())
                                    {
                                      $level = $rows['level'];
                                    }

                                    $findsection = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                                    if($findsection->num_rows!=0)
                                    {
                                      while($rows=$findsection->fetch_assoc())
                                      {
                                        $section = $rows['section'];
                                      }
                                    }else{
                                      $section = "N/A";
                                    }

                                    echo "<tr>
                                        <td>$num</td>
                                        <td>$snum</td>
                                        <td>$lname, $fname $mname[0]</td>
                                        <td>$level</td>
                                        <td>$section</td>
                                        <td class='text-right'>
                                          <a class='btn btn-block btn-primary' href='gr-grades.php?snum=$snum&subj_code=$subj_code'>
                                            <div class='fa fa-check'></div>
                                            Check Grades
                                          </a>
                                        </td>
                                    </tr>";
                                    $num++;
                                  }
                                }
                              ?>
                            </tbody>
                        </table>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                              <!-- /.table-responsive -->
<?php
}else{
?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                List of Subjects
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                  <div class="table-responsive">
                    <table id="example" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Section</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $subjquery = $db->query("select * from subjects where tnum='$user' ") or die("Can't complete process. Please contact your Administrator.");
                            if($subjquery->num_rows!=0)
                            {
                              while($rows=$subjquery->fetch_assoc())
                              {
                                $subj_code = $rows['subj_code'];
                                $subj = $rows['subj'];
                                $descrip = $rows['descrip'];
                                $level_id = $rows['level'];
                                $section_id = $rows['section'];

                                $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                                while($rows=$findlvl->fetch_assoc())
                                {
                                  $level = $rows['level'];
                                }

                                $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                                if($findsect->num_rows!=0){
                                  while($rows=$findsect->fetch_assoc())
                                  {
                                    $section = $rows['section'];
                                  }
                                }else{
                                  $section = "N/A";
                                }
                                echo "
                                <tr>
                                    <td>$subj_code</td>
                                    <td>$subj</td>
                                    <td>$descrip</td>
                                    <td>$level</td>
                                    <td>$section</td>
                                    <td class='text-right'>
                                      <a class='btn btn-block btn-primary' href='gr-subjects.php?subj_code=$subj_code'>
                                        <div class='fa fa-group'></div>
                                        View Students
                                      </a>
                                    </td>
                                </tr>";
                              }
                            }
                          ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
<p class="text-right"><a class="btn btn-success" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});">Export to Excel</a></p>
<?php
}
?>

          </div>
        </div>
      </div>
  </div>


<!--footer -->
		<div id="footer-container">
			<div id="copyright">
				<p></p>
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
