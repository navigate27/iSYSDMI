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
<?php
  if(isset($_GET['snum'])){
    $snum = $_GET['snum'];

    include("../admin/includes/get_student_info.php");
?>
<h1 class="page-header"><i class="fa fa-heart"></i> Section</h1>

    <h3><a href="gr-section.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a></h3>
<div class="panel panel-primary">
  <div class="panel-heading">
      Computation Sheet
  </div>
  <!-- /.panel-heading -->

  <div class="panel-body">

    <p><label>Name: </label> <?php echo "$fname $mname[0]. $lname"; ?></p>
    <p><label>Level/Section: </label> <?php echo "$level - $section"; ?></p>

      <div class="dataTable_wrapper">
          <table id='comp-sheet' class="table table-bordered">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Subject</th>
                      <th>1st</th>
                      <th>2nd</th>
                      <th>3rd</th>
                      <th>4th</th>
                      <th>General Average</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                  // $findgr = $db->query("select * from student_grades where snum='$snum' and sy='$sy_rec' ") or die("Can't complete process. Please contact your Administrator.");
                  // if($findgr->num_rows!=0)
                  // {
                  //
                  //   $num = 1;
                  //   $temp_fr = 0;
                  //
                  //   while($rows=$findgr->fetch_assoc())
                  //   {
                  //     $fr = $rows['fr'];
                  //     $subj_code = $rows['subj_code'];
                  //
                  //     $cont_fr = $fr+$temp_fr;
                  //
                  //     $findsubj = $db->query("select * from subjects where subj_code='$subj_code' ") or die("Can't complete process. Please contact your Administrator.");
                  //     while($rows=$findsubj->fetch_assoc())
                  //     {
                  //       $subj = $rows['subj'];
                  //       echo "<tr>
                  //           <td>$num</td>
                  //           <td>$subj</td>
                  //           <td></td>
                  //           <td></td>
                  //           <td></td>
                  //           <td></td>
                  //           <td>$fr</td>
                  //       </tr>";
                  //     }
                  //
                  //
                  //
                  //     $num++;
                  //     $temp_fr = $cont_fr;
                  //   }
                  //
                  //   $temp_fr = $temp_fr/$findgr->num_rows;
                  //   $temp_fr = round($temp_fr,2);
                  //   echo "<tr>
                  //       <td></td>
                  //       <td></td>
                  //       <td></td>
                  //       <td></td>
                  //       <td></td>
                  //       <td></td>
                  //       <td><strong>$temp_fr</strong></td>
                  //   </tr>";
                  //
                  // }

                  $findgr = $db->query("select * from student_grades where snum='$snum' and sy='$sy_rec' ") or die("Can't complete process. Please contact your Administrator.");
                  if($findgr->num_rows!=0)
                  {
                      while($rows=$findgr->fetch_assoc())
                      {

                      }
                  }
                ?>
              </tbody>
          </table>
      </div>
      <p class="text-right">
        <a class="btn btn-primary" href="#">Make report card</a>
      </p>
  </div>

</div>

<?php
  }else if(isset($_GET['view'])){
?>




<?php
  }else{

    $findsect = $db->query("select * from sections where tnum='$user' ") or die("Can't complete process. Please contact your Administrator.");

    if($findsect->num_rows!=0)
    {
      while($rows=$findsect->fetch_assoc())
      {
        $section_id = $rows['id'];
        $level_id = $rows['level_id'];
        $section = $rows['section'];
      }
    }

    $findlevel = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
    while($rows=$findlevel->fetch_assoc())
    {
      $level = $rows['level'];
    }
?>


        <h1 class="page-header"><i class="fa fa-heart"></i> Section</h1>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo "$level - $section"; ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">

                    <table id="example" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>1st</th>
                                <th>2nd</th>
                                <th>3rd</th>
                                <th>4th</th>
                                <th>General Average</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            $findstud = $db->query("select * from student_records where section='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                            if($findstud->num_rows!=0)
                            {
                              $num = 1;
                              while($rows=$findstud->fetch_assoc())
                              {
                                $snum = $rows['snum'];
                                $fname = $rows['fname'];
                                $mname = $rows['mname'];
                                $lname = $rows['lname'];

                                $findgr = $db->query("select * from student_grades where snum='$snum' and sy='2015 - 2016'") or die("Can't complete process. Please contact your Administrator.");
                                if($findgr->num_rows!=0){
                                  while($rows=$findgr->fetch_assoc())
                                  {
                                    $a = $rows['a'];
                                    $b = $rows['b'];
                                    $c = $rows['c'];
                                    $d = $rows['d'];
                                    $fr = $rows['fr']; //aka general average
                                  }
                                }else{
                                    $a = "";
                                    $b = "";
                                    $c = "";
                                    $d = "";
                                    $fr = "";
                                }

                                echo "<tr>
                                    <td>$num</td>
                                    <td>$fname $mname[0]. $lname</td>
                                    <td>$a</td>
                                    <td>$b</td>
                                    <td>$c</td>
                                    <td>$d</td>
                                    <td>$fr</td>
                                    <td><a href='gr-section.php?snum=$snum'>View</a></td>
                                </tr>";
                                $num++;
                              }
                            }
                          ?>
                        </tbody>
                    </table>
                </div>
                <p class="text-left">
                  <!-- <a class="btn btn-success" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});">Export to Excel</a> -->
                  <a class="btn btn-warning" href="gr-computation-sheet.php?section=<?php echo $section_id; ?>">Horizontal View</a>
                </p>
            </div>
        </div>

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
