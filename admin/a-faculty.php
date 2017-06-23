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
  <script>
  $(document).ready(function(){

    $("#disable-faculty").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
        var tnum = $("#edit-tnum").val();
        $.post("actions/faculty/a-action-disableFaculty.php",{
          postTnum:tnum
        },function(disMsg){
          $("#edit-msg").html(disMsg)
        });
    });

    $("#active-faculty").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
        var tnum = $("#edit-tnum").val();
        $.post("actions/faculty/a-action-activeFaculty.php",{
          postTnum:tnum
        },function(actMsg){
          $("#edit-msg").html(actMsg)
        });
    });


    $("#btn-save-faculty").click(function(){
      $('#edit-msg').html("");

      var editTnum = $("#edit-tnum").val();
      var editFname = $("#edit-fname").val().trim();
      var editMname = $("#edit-mname").val().trim();
      var editLname = $("#edit-lname").val().trim();
      var editBio = $("#edit-bio").val().trim();
      var editSection = $("#edit-section").val();
      var editEndate = $("#edit-endate").val();

      if(editMname==""){
        $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Middle name must specify.</div>");
      }else{

        if(editBio==""){
          $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Biometric number must specify.</div>");
        }else{
          $("#edit-msg").html("<div class='alert alert-info'><strong>Saving..</strong> Please wait..</div>");
          $.post("actions/faculty/a-action-saveFaculty.php",{
            postTnum:editTnum,
            postFname:editFname,
            postMname:editMname,
            postLname:editLname,
            postBio:editBio,
            postEndate:editEndate,
            postSection:editSection
          }
          ,function(editMsg){
            $("#edit-msg").html(editMsg);

          });

      }
    }

    });

    $('#btn-add-faculty').click(function(){
      $("#add-msg").html("");

      var newfnameVal = $("#new-fname").val().trim();
      var newmnameVal = $("#new-mname").val().trim();
      var newlnameVal = $("#new-lname").val().trim();
      var newbioVal = $("#new-bio").val().trim();
      var newendateVal = $("#new-endate").val();
      var newsectionVal = $("#new-section").val();

      if(newmnameVal==""){
        $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Middle name must specify.</div>");
      }else{
        if(newbioVal==""){
          $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Biometric number must specify.</div>");
        }else{
          $("#add-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
        $.post("actions/faculty/a-action-addFaculty.php",{
          postFname:newfnameVal,
          postMname:newmnameVal,
          postLname:newlnameVal,
          postBio:newbioVal,
          postEndate:newendateVal,
          postSection:newsectionVal
        }
        ,function(addMsg){
          $("#add-msg").html(addMsg);
        });
      }

    }


    });

    $('#btn-clear-field').click(function(){
      $("#new-fname").val("");
      $("#new-mname").val("");
      $("#new-lname").val("");
      $("#new-bio").val("");
      $("#new-endate").val("");
      $('#new-section option[value=""]').attr("selected","selected");
    });

  });

  </script>




</head>

<body>

<div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");
      ?>


<div id="page-wrapper">

<?php
if(isset($_GET['tnum'])){

  $tnum = $_GET['tnum'];

  $findtnum = $db->query("select * from teacher_records where tnum='$tnum' ") or die("Error. Subjects. Please contact your administrator.");
    while($rows=$findtnum->fetch_assoc())
    {
      $t_id = $rows['id'];
      $t_fname = $rows['fname'];
      $t_mname = $rows['mname'];
      $t_lname = $rows['lname'];
      $alias = $rows['alias'];
      $bio = $rows['bio'];
      $endate = $rows['endate'];
      $stat = $rows['stat'];
    }

    $findsect = $db->query("select * from sections where tnum='$tnum' ") or die("Error. Subjects. Please contact your administrator.");
    if($findsect->num_rows!=0){
      while($rows=$findsect->fetch_assoc())
      {
        $section = $rows['section'];
        $section_id = $rows['id'];
      }
    }else{
      $section_id = "";
    }


?>



  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-heart"></i> Faculty</h1>
        <a href="a-faculty.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
    </div>
  </div>
  <br>

  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">
                    Update Faculty
                    <?php
                      if($stat==1){
                        echo "(Active)";
                      }else if($stat==0){
                        echo "(Disabled)";
                      }
                    ?>
                    <div class="dropdown pull-right">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i style="color:#fff" class="fa fa-chevron-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-user">
                          <li>
                            <a href="a-accounts.php?tnum=<?php echo $tnum; ?>" target="_blank"><i class="fa fa-table fa-fw"></i> View Account</a>
                          </li>
                          <li class='divider'></li>
                          <li>
                            <?php
                              if($stat==1){
                                  echo "<a href='#' id='disable-faculty'><i class='fa fa-ban fa-fw'></i> Disable</a>";
                              }else if($stat==0){
                                  echo "<a href='#' id='active-faculty'><i class='fa fa-check fa-fw'></i> Set to Active</a>";
                              }
                            ?>
                          </li>
                      </ul>
                    </div>
                </div>
              </div>
              <div class="panel-body">

              <form class='form-horizontal'>

              <div id="edit-msg">
              </div>

                <input type="hidden" id="edit-tid" value="<?php echo $t_id; ?>">
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Faculty No.: </label>
                    <div class='col-sm-10'>
                      <input type='text' id='edit-tnum' class='form-control' value="<?php echo $tnum; ?>" disabled>
                    </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>First name: </label>
                    <div class='col-sm-10'>
                      <input type='text' id='edit-fname' class='form-control' value="<?php echo $t_fname; ?>" required>
                    </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Middle name: </label>
                    <div class='col-sm-10'>
                      <input type='text' id='edit-mname' class='form-control' value="<?php echo $t_mname; ?>" required>
                    </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Last name: </label>
                    <div class='col-sm-10'>
                      <input type='text' id='edit-lname' class='form-control' value="<?php echo $t_lname; ?>" required>
                    </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Date of Entry: </label>
                    <div class='col-sm-10'>
                      <input type='date' id='edit-endate' class='form-control' value="<?php echo $endate; ?>" required>
                    </div>
                </div>
                <div class='form-group'>
                  <div class="form-inline">
                    <label class='control-label col-sm-2'>Bio: </label>
                      <div class='col-sm-10'>
                        <input type='text' id='edit-bio' class='form-control' value="<?php echo $bio; ?>" required>
                      </div>
                  </div>
                </div>
                <div class='form-group'>
                  <div class="form-inline">
                    <label class='control-label col-sm-2'>Section: </label>
                      <div class="form-inline">
                        <div class='col-sm-10'>
                          <select id="edit-section" class="form-control">
                            <option value="" <?php if($section_id==""){ echo "selected"; } ?>>---</option>
                            <?php
                              $selectlevel = $db->query("select * from levels ") or die("Error. Levels. Please contact your administrator.");
                                while($rows=$selectlevel->fetch_assoc())
                                {
                                  $level = $rows['level'];
                                  $level_id = $rows['id'];
                                  echo "<optgroup class='form-control' label='$level'></optgroup>";
                                  $findsect = $db->query("select * from sections where level_id='$level_id' ") or die("Error. Sections. Please contact your administrator.");
                                    while($rows=$findsect->fetch_assoc())
                                    {
                                      $section = $rows['section'];
                                      $sect_id = $rows['id'];

                                      echo "<option value='$sect_id' ";
                                      if($section_id==$sect_id){
                                        echo "selected";
                                      }
                                      echo ">$section</option>";
                                    }

                                }
                            ?>
                          </select>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                       <p class="text-right">
                         <a href="a-faculty.php" class="btn btn-default">Cancel</a>
                         <a class="btn btn-primary" id="btn-save-faculty">Save Changes</a>
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
          <h1 class="page-header"><i class="fa fa-book"></i> Faculty</h1>
          <p>
            <button data-toggle='modal' data-target='#addFaculty' class="btn btn-primary"><div class="fa fa-plus"></div> Join New</button>
            <a href="a-faculty.php" class="btn btn-outline btn-info"><span class="fa fa-refresh"></span></a>
            <span class="pull-right">
              <a href="export/a-export-faculty.php" class="btn btn-success"><i class="fa fa-download"></i> Export</a>
            </span>
          </p>
      </div>
    </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  List of Faculty Members
              </div>
              <div class="panel-body">
                  <div class="dataTable_wrapper">
                    <div class="table-responsive">
                      <table id="example" class="display" cellspacing="0">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Bio</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                            $num = 1;
                            $selectfac = $db->query("select * from teacher_records") or die("Error. Teacher_Recoreds. Please contact your administrator.");
                            if($selectfac->num_rows!=0)
                            {
                              while($rows=$selectfac->fetch_assoc())
                              {
                                $t_id = $rows['id'];
                                $tnum = $rows['tnum'];
                                $t_fname = $rows['fname'];
                                $t_mname = $rows['mname'];
                                $t_lname = $rows['lname'];
                                $alias = $rows['alias'];
                                $bio = $rows['bio'];
                                $stat = $rows['stat'];

                                $findsect = $db->query("select * from sections where tnum='$tnum' ") or die("Error. Teacher_Recoreds. Please contact your administrator.");
                                if($findsect->num_rows!=0)
                                {
                                  while($rows=$findsect->fetch_assoc())
                                  {
                                    $section = $rows['section'];
                                    $level_id = $rows['level_id'];
                                  }

                                  $findlvl = $db->query("select * from levels where id='$level_id'");
                                  if($findlvl->num_rows!=0)
                                  {
                                    while($rows=$findlvl->fetch_assoc())
                                    {
                                      $level = $rows['level'];
                                    }
                                    $level = "$level -";
                                  }else{
                                    $level = "N/A -";
                                  }
                                }else{
                                  $level = "N/A";
                                  $section = "";
                                }

                                if($stat!=1){
                                  $status = "<a class='btn btn-danger btn-block'>Disabled</a>";
                                  $t_stat = "Disabled";
                                }else{
                                  $status = "<a class='btn btn-success btn-block'>Active</a>";
                                  $t_stat = "Active";
                                }

                                echo "
                                <tr>
                                    <td>$num</td>
                                    <td>$t_fname $t_mname[0]. $t_lname</td>
                                    <td>$bio</td>
                                    <td>$level $section</td>
                                    <td><div class='tooltip-demo'><span data-toggle='tooltip' data-placement='top' title='$t_stat'>$status</span></div></td>
                                    <td class='text-center'>
                                      <div class='tooltip-demo'>
                                        <a class='btn btn-primary' href='a-faculty.php?tnum=$tnum'  data-toggle='tooltip' data-placement='top' title='Edit'>
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

                <!-- New Faculty Modal -->
                <div class="modal fade" id="addFaculty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">New Faculty</h4>
                            </div>

                            <div class="modal-body">
                              <div id='add-msg'>
                              </div>

                              <form class='form-horizontal'>
                                <div class='form-group'>
                                  <label class='control-label col-sm-2'>First name: </label>
                                    <div class='col-sm-10'>
                                      <input type='text' id='new-fname' class='form-control'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                  <label class='control-label col-sm-2'>Middle name: </label>
                                    <div class='col-sm-10'>
                                      <input type='text' id='new-mname' class='form-control'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                  <label class='control-label col-sm-2'>Last name: </label>
                                    <div class='col-sm-10'>
                                      <input type='text' id='new-lname' class='form-control'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                  <div class="form-inline">
                                    <label class='control-label col-sm-2'>Bio: </label>
                                      <div class='col-sm-10'>
                                        <input type='text' id='new-bio' class='form-control'>
                                      </div>
                                  </div>
                                </div>
                                <div class='form-group'>
                                  <div class="form-inline">
                                    <label class='control-label col-sm-2'>Date of Entry: </label>
                                      <div class='col-sm-10'>
                                        <input type='date' id='new-endate' class='form-control'>
                                      </div>
                                  </div>
                                </div>


                                <div class='form-group'>
                                  <div class="form-inline">
                                    <label class='control-label col-sm-2'>Section: </label>
                                      <div class="form-inline">
                                        <div class='col-sm-10'>
                                          <select id="new-section" class="form-control">
                                            <option value="">---</option>
                                            <?php
                                              $selectlevel = $db->query("select * from levels ") or die("Error. Levels. Please contact your administrator.");
                                                while($rows=$selectlevel->fetch_assoc())
                                                {
                                                  $level = $rows['level'];
                                                  $level_id = $rows['id'];
                                                  echo "<optgroup class='form-control' label='$level'></optgroup>";
                                                  $findsect = $db->query("select * from sections where level_id='$level_id' ") or die("Error. Sections. Please contact your administrator.");
                                                    while($rows=$findsect->fetch_assoc())
                                                    {
                                                      $section = $rows['section'];
                                                      $sect_id = $rows['id'];

                                                      echo "<option value='$sect_id'>$section</option>";
                                                    }

                                                }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                                </div>

                              </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                                <button class="btn btn-warning" id='btn-clear-field'>Clear Field</button>
                                <button id="btn-add-faculty" class="btn btn-primary">Join Faculty</button>
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
