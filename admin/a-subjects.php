<?php
$page = "admin";
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

    <title>DMI - Admin Portal</title>
  <?php
    include("linksource.php");
  ?>

  <link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>

  <script type="text/javascript" src="dataTables/datatables.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#example').DataTable();
      // $('#example').DataTable( {
      //         initComplete: function () {
      //             this.api().columns().every( function () {
      //                 var column = this;
      //                 var select = $('<select><option value=""></option></select>')
      //                     .appendTo( $(column.footer()).empty() )
      //                     .on( 'change', function () {
      //                         var val = $.fn.dataTable.util.escapeRegex(
      //                             $(this).val()
      //                         );
      //
      //                         column
      //                             .search( val ? '^'+val+'$' : '', true, false )
      //                             .draw();
      //                     } );
      //
      //                 column.data().unique().sort().each( function ( d, j ) {
      //                     select.append( '<option value="'+d+'">'+d+'</option>' )
      //                 } );
      //             } );
      //         }
      //     } );
    } );
  </script>

<!-- for exporting to EXCEL-->
  <script type="text/javascript" src="export/tableExport.js"></script>
  <script type="text/javascript" src="export/jquery.base64.js"></script>
  <script type="text/javascript" src="export/html2canvas.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>
  <script type="text/javascript" src="isLoading/jquery.isloading.js"></script>
  <script type="text/javascript" src="myScript/subjectScript.js"></script>

</head>

<body>

<div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");
      ?>


<div id="page-wrapper">

<?php
if(isset($_GET['subj_code'])){

  $subj_code = $_GET['subj_code'];

  $findsubj = $db->query("select * from subjects where subj_code='$subj_code' ") or die("Error. Subjects. Please contact your administrator.");
    while($rows=$findsubj->fetch_assoc())
    {
      $id = $rows['id'];
      $subj_code = $rows['subj_code'];
      $subj = $rows['subj'];
      $descrip = $rows['descrip'];
      $level_id = $rows['level'];
      $section_id = $rows['section'];
      $tnum = $rows['tnum'];
    }

?>



  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-book"></i> Subjects</h1>
        <a href="a-subjects.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
    </div>
  </div>
  <br>

  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">
                    Update Subject
                </div>
              </div>
              <div class="panel-body">

              <form class='form-horizontal'>

              <div id="edit-msg">
              </div>

                <input type="hidden" id="edit-subj-code" value="<?php echo $subj_code; ?>">
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Subject: </label>
                    <div class='col-sm-10'>
                      <input type='text' id='edit-subj' class='form-control' value="<?php echo $subj; ?>" required>
                    </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Decription: </label>
                    <div class='col-sm-10'>
                      <textarea id='edit-descrip' class='form-control' required><?php echo $descrip; ?></textarea>
                    </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Level: </label>
                  <div class="form-inline">
                    <div class='col-sm-10'>
                      <select id='edit-level' class='form-control'>
                        <?php
                        $selectlvl = $db->query("select * from levels ") or die("Error. Levels. Please contact your administrator.");
                          while($rows=$selectlvl->fetch_assoc())
                          {
                            $level = $rows['level'];
                            $lvl_id = $rows['id'];

                            echo "<option value='$lvl_id' "; if($level_id==$lvl_id){ echo "selected"; } echo ">$level</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <input type="hidden" id="hid-section" value="<?php echo $section_id; ?>">
                <div id="edit-section-data">
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Handler: </label>
                  <div class="form-inline">
                    <div class='col-sm-10'>
                      <select id='edit-tnum' class='form-control'>
                          <option value="">---</option>
                        <?php
                        $selectTnum = $db->query("select * from teacher_records ") or die("Error. Teacher_Records. Please contact your administrator.");
                          while($rows=$selectTnum->fetch_assoc())
                          {
                            $fac_num = $rows['tnum'];
                            $fname = $rows['fname'];
                            $mname = $rows['mname'];
                            $lname = $rows['lname'];

                            echo "<option value='$fac_num'";
                              if($tnum==$fac_num){
                                 echo "selected";
                               }
                            echo ">$fname $mname[0]. $lname</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                       <p class="text-right">
                         <a href="a-subjects.php" class="btn btn-default">Cancel</a>
                         <a href="#" class="btn btn-primary" id="btn-save-subj">Save Changes</a>
                      </p>
                  </div>
                </div>


              </form>

        </div>
    </div>
  </div>
</div>

<?php
  }else{
?>

    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-book"></i> Subjects</h1>
          <p>
            <button data-toggle='modal' data-target='#addSubj' class="btn btn-primary"><div class="fa fa-plus"></div> Add New</button>
            <a href="a-subjects.php" class="btn btn-outline btn-info"><span class="fa fa-refresh"></span></a>
            <!-- <span class="pull-right">
              <a href="export/a-export-subjects.php" class="btn btn-success"><i class="fa fa-download"></i> Export</a>
            </span> -->
            <a class="btn btn-success pull-right" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});"><i class="fa fa-download"></i> Export</a>
          </p>
      </div>
    </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  List of Subjects
              </div>
              <div class="panel-body">
                  <div class="dataTable_wrapper">
                    <div class="table-responsive">
                      <table id="example" class="display" cellspacing="0">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Section</th>
                                <th>Handler</th>
                                <th></th>
                              </tr>
                          </thead>
                          <!-- <tfoot>
                              <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Handler</th>
                                <th></th>
                              </tr>
                          </tfoot> -->
                          <tbody>
                          <?php
                            $num = 1;
                            $selectsubj = $db->query("select * from subjects order by level asc") or die("Error. Subjects. Please contact your administrator.");
                            if($selectsubj->num_rows!=0)
                            {
                              while($rows=$selectsubj->fetch_assoc())
                              {
                                $id = $rows['id'];
                                $subj_code = $rows['subj_code'];
                                $subj = $rows['subj'];
                                $descrip = $rows['descrip'];
                                $level_id = $rows['level'];
                                $section_id = $rows['section'];
                                $tnum = $rows['tnum'];

                                $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Error. Levels. Please contact your administrator.");
                                  while($rows=$findlvl->fetch_assoc())
                                  {
                                    $level = $rows['level'];
                                  }

                                $findsect = $db->query("select * from sections where id='$section_id' ") or die("Error. Sections. Please contact your administrator.");
                                if($findsect->num_rows!=0)
                                {
                                  while($rows=$findsect->fetch_assoc())
                                  {
                                    $section = $rows['section'];
                                  }
                                }else{
                                  $section = "N/A";
                                }

                                  $findtnum = $db->query("select * from teacher_records where tnum='$tnum' ") or die("Error. Teacher_Records. Please contact your administrator.");
                                  if($findtnum->num_rows!=0)
                                  {
                                    while($rows=$findtnum->fetch_assoc())
                                    {
                                      $fname = $rows['fname'];
                                      $mname = $rows['mname'];
                                      $lname = $rows['lname'];
                                    }

                                    $putname = "<td>$fname $mname[0]. $lname</td>";

                                  }else{
                                    $putname = "<td>N/A</td>";
                                  }


                                echo "
                                <tr id='$subj_code'>
                                    <td>$num</td>
                                    <td>$subj</td>
                                    <td>$descrip</td>
                                    <td>$level</td>
                                    <td>$section</td>
                                    $putname
                                    <td class='text-center'>
                                    <div class='tooltip-demo'>
                                      <a class='btn btn-primary' href='a-subjects.php?subj_code=$subj_code'  data-toggle='tooltip' data-placement='top' title='Edit'>
                                        <div class='fa fa-pencil'>
                                        </div>
                                      </a>
                                    </div>
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
                  <!-- /.table-responsive -->

                <!-- Edit Subject Modal -->

                <!-- /.modal -->

                <!-- New Subject Modal -->
                <div class="modal fade" id="addSubj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">New Subject</h4>
                            </div>

                            <div class="modal-body">
                              <div id='add-msg'>
                              </div>

                              <form class='form-horizontal'>
                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Subject: </label>
                                  <div class='col-sm-10'>
                                    <input type='text' id='new-subj' class='form-control' required>
                                  </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Decription: </label>
                                  <div class='col-sm-10'>
                                    <textarea id='new-descrip' class='form-control' required></textarea>
                                  </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Level: </label>
                                <div class="form-inline">
                                  <div class='col-sm-10'>
                                    <select id='new-level' class='form-control'>
                                      <?php
                                      $selectlvl = $db->query("select * from levels ") or die("Error. Levels. Please contact your administrator.");
                                        while($rows=$selectlvl->fetch_assoc())
                                        {
                                          $level = $rows['level'];
                                          $level_id = $rows['id'];

                                          echo "<option value='$level_id'>$level</option>";
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div id="section-data">
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Handler: </label>
                                <div class="form-inline">
                                  <div class='col-sm-10'>
                                    <select id='new-tnum' class='form-control'>
                                        <option value="">---</option>
                                      <?php
                                      $selectTnum = $db->query("select * from teacher_records ") or die("Error. Teacher_Records. Please contact your administrator.");
                                        while($rows=$selectTnum->fetch_assoc())
                                        {
                                          $tnum = $rows['tnum'];
                                          $fname = $rows['fname'];
                                          $mname = $rows['mname'];
                                          $lname = $rows['lname'];

                                          echo "<option value='$tnum'>$fname $mname[0]. $lname</option>";
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                                <button class="btn btn-warning" id='btn-clear-field'>Clear Field</button>
                                <button id="btn-add-subj" class="btn btn-primary">Add Subject</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


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
<script>
// tooltip demo
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})

// popover demo
$("[data-toggle=popover]")
    .popover()
</script>
</body>






</html>
