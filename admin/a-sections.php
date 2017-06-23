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
   //
   //
  //   //DELETE ID SELECTOR
  //   $(document).on( "click", "#a", function(){
  //      trid = $(this).closest('tr').attr('id');
  //      $('#id-selector').val(trid);
  //     //  alert(trid);
  //    });
   //
  //   //DELETE CONFIRM
  //  $('button[name="del_section"]').click(function(){
  //    var id = $("#id-selector").val();
  //    $("#view-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
  //    $.post("actions/sections/a-action-delSection.php",{postId:id},function(viewMsg){
  //      $("#view-msg").html(viewMsg);
  //      window.location.replace("a-sections.php?msg=0");
  //      $("#view-msg").html(viewMsg);
  //    });
   //
  //  //EDIT ID
  //  $(document).on( "click", "#b", function(){
   //
  //     alert("ads");
  //     // $("#edit-msg").html("Loading...");
  //     // $("#section-data").empty();
  //     //
  //     // trid = $(this).closest('tr').attr('id');
  //     // alert(trid);
  //     // $('#id-selector').val(trid);
  //     // $.post("includes/editModalSection.php",{
  //     //   postId: trid
  //     // },function(editData){
  //     //   $("#edit-msg").empty();
  //     //   $("#section-data").html(editData);
  //     // });
   //
  //   });


    $('#btn-add-section').click(function(){
      $("#add-msg").html("");

      var section = $("#new-section").val();
      var level = $("#new-level").val();
      var tnum = $("#new-tnum").val();


      if(section==""){
        $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Section name must specify.</div>");
      }else{
        $("#add-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
        $.post("actions/sections/a-action-addSection.php",{
          postSection:section,
          postLevel:level,
          postTnum:tnum
        }
        ,function(addMsg){
          $("#add-msg").html(addMsg);
        });
    }
    });

    $('#btn-save-section').click(function(){
      $("#edit-msg").html("");

      var id = $("#edit-id").val();
      var section = $("#edit-section").val();
      var level = $("#edit-level").val();
      var tnum = $("#edit-tnum").val();


      if(section==""){
        $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Section name must specify.</div>");
      }else{
        $("#edit-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
        $.post("actions/sections/a-action-saveSection.php",{
          postId:id,
          postSection:section,
          postLevel:level,
          postTnum:tnum
        }
        ,function(editMsg){
          $("#edit-msg").html(editMsg);
        });
    }
    });


    $('#btn-clear-field').click(function(){
      $("#new-section").val("");
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
if(isset($_GET['section_id'])){

  $section_id = $_GET['section_id'];

  $findsect = $db->query("select * from sections where id='$section_id' ")or die("Error. Levels. Please contact your administrator.");
    while($rows=$findsect->fetch_assoc()){
      $section = $rows['section'];
      $tnum = $rows['tnum'];
      $level_id = $rows['level_id'];
    }

?>
  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-heart"></i> Sections</h1>
        <a href="a-sections.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
    </div>
  </div>
  <br>

  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">
                    Update Section
                </div>
              </div>
              <div class="panel-body">

              <form class='form-horizontal'>

              <div id="edit-msg">
              </div>

              <input type="hidden" id="edit-id" value="<?php echo $section_id; ?>">
              <div class='form-group'>
                <label class='control-label col-sm-2'>Section Name: </label>
                  <div class='col-sm-10'>
                    <input type='text' id='edit-section' class='form-control' value="<?php echo $section; ?>" required>
                  </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-sm-2'>Level: </label>
                <div class="form-inline">
                  <div class='col-sm-10'>
                    <select id='edit-level' class='form-control'>
                    <?php
                      $selectlvl = $db->query("select * from levels ")or die("Error. Levels. Please contact your administrator.");
                        while($rows=$selectlvl->fetch_assoc()){
                          $lvl_id = $rows['id'];
                          $level = $rows['level'];

                          echo "<option value='$lvl_id'" ; if($lvl_id==$level_id){ echo "selected"; } echo ">$level</option>";
                        }
                    ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class='form-group'>
                <label class='control-label col-sm-2'>Adviser: </label>
                <div class="form-inline">
                  <div class='col-sm-10'>
                    <select name='cat' id='edit-tnum' class='form-control'>
                      <option value="">---</option>
                      <?php
                      $selectfac = $db->query("select * from teacher_records ") or die("Error. Teacher_Records. Please contact your administrator.");
                        while($rows=$selectfac->fetch_assoc())
                        {
                          $t_tnum = $rows['tnum'];
                          $fname = $rows['fname'];
                          $mname = $rows['mname'];
                          $lname = $rows['lname'];

                          echo "<option value='$t_tnum'" ; if($t_tnum==$tnum){ echo "selected"; } echo ">$fname $mname[0]. $lname</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                     <p class="text-right">
                       <a href="a-sections.php" class="btn btn-default">Cancel</a>
                       <a class="btn btn-primary" id="btn-save-section">Save Changes</a>
                    </p>
                </div>
              </div>

            </form>
      </div>
  </div>
</div>
</div>


<?php
} else if(isset($_GET['section_id_view'])){

  $section_id = $_GET['section_id_view'];
  $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
    while($rows=$findsect->fetch_assoc())
    {
      $section = $rows['section'];
      $level_id = $rows['level_id'];
    }
    $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$findlvl->fetch_assoc())
      {
        $level = $rows['level'];
      }
?>

<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-books"></i> Sections</h1>
      <a href="a-sections.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
  </div>
</div>

<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="panel-title">
                <?php echo "$level - $section"; ?>
              </div>
            </div>

            <div class="panel-body">
              <div class="dataTable_wrapper">
                <div class="table-responsive">
                  <table id="example" class="display" cellspacing="0">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Student No.</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <!-- <th>Level/Section</th> -->
                              <th>Contact</th>
                              <th>Date enrolled</th>
                              <th>Status</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                          $num = 1;
                          $slctstud = $db->query("select * from student_records where section='$section_id' and stat=1") or die("Can't complete process. Please contact your Administrator.");
                          if($slctstud->num_rows!=0)
                          {
                            while($rows=$slctstud->fetch_assoc())
                            {
                              $snum = $rows['snum'];
                              $fname = $rows['fname'];
                              $mname = $rows['mname'];
                              $lname = $rows['lname'];
                              $sex = $rows['sex'];
                              $cnum = $rows['cnum'];
                              $stat = $rows['stat'];
                              $type = $rows['type'];
                              $endate = $rows['endate'];
                              $level_id = $rows['level'];
                              $section_id = $rows['section'];


                              $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                              if($findsect->num_rows!=0){
                                while($rows=$findsect->fetch_assoc())
                                {
                                  $level_id = $rows['level_id'];
                                  $section = $rows['section'];
                                }
                              }else{
                                $section = "N/A";
                              }
                              $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                              if($findlvl->num_rows!=0){
                                while($rows=$findlvl->fetch_assoc())
                                {
                                  $level = $rows['level'];
                                }
                              }else{
                                $level = "N/A";
                              }

                              $endate = date("M d, Y",strtotime($endate));

                              if($stat!=1){
                                $status = "<a class='btn btn-danger btn-block'>Disabled</a>";
                                $t_stat = "Disabled";
                              }else{
                                $status = "<a class='btn btn-success btn-block'>Active</a>";
                                $t_stat = "Active";
                              }

                              echo "<tr>
                                  <td>$num</td>
                                  <td>$snum</td>
                                  <td>$lname, $fname $mname[0].</td>
                                  <td>$sex</td>
                                  <!--<td>$level - $section</td>-->
                                  <td>$cnum</td>
                                  <td>$endate</td>
                                  <td><div class='tooltip-demo'><span data-toggle='tooltip' data-placement='top' title='$t_stat'>$status</span></div></td>
                                  <td class='text-center'><div class='tooltip-demo'><a href='a-students.php?snum=$snum'  class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit'><div class='fa fa-pencil'></div></a> </div></td>
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

          <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="panel-title">
                    Gender
                  </div>
                </div>

                <div class="panel-body">
                    <?php
                      $allmale = $db->query("select * from student_records where sex='Male' and section='$section_id' and stat=1");
                      $allfmale = $db->query("select * from student_records where sex='Female' and section='$section_id' and stat=1");

                      $rowMale = $allmale->num_rows;
                      $rowFmale = $allfmale->num_rows;

                      include("includes/graph-gender.php");
                      echo "
                      <input type='hidden' id='hid-male' value='$rowMale'>
                      <input type='hidden' id='hid-fmale' value='$rowFmale'>
                      ";
                    ?>
                  </div>

            </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title">
                  New Students
                </div>
              </div>

              <div class="panel-body">
                  <?php
                    $allold = $db->query("select * from student_records where type='0' and section='$section_id' and stat=1");
                    $allnew = $db->query("select * from student_records where type='1' and section='$section_id' and stat=1");

                    $rowOld = $allold->num_rows;
                    $rowNew = $allnew->num_rows;

                    include("includes/graph-old-new-sections.php");
                    echo "
                    <input type='hidden' id='hid-old' value='$rowOld'>
                    <input type='hidden' id='hid-new' value='$rowNew'>
                    ";
                  ?>
                </div>

          </div>
      </div>

        </div>
      </div>

<?php
}else{
?>

  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-book"></i> Sections</h1>

        <?php
          include("includes/messages.php");
        ?>
        <input type="hidden" id="hid-view-msg" value="0">

        <p>
          <button data-toggle='modal' data-target='#addSection' class="btn btn-primary"><div class="fa fa-plus"></div> Add New</button>
          <a href="a-sections.php" class="btn btn-outline btn-info"><span class="fa fa-refresh"></span></a>
          <!-- <span class="pull-right">
            <a href="export/a-export-sections.php" class="btn btn-success"><i class="fa fa-download"></i> Export</a>
          </span> -->
          <a class="btn btn-success pull-right" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});"><i class="fa fa-download"></i> Export</a>
        </p>
    </div>
  </div>

  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  List of Books
              </div>
              <div class="panel-body">
                  <div class="dataTable_wrapper">
                    <div class="table-responsive">
                      <table id="example" class="display" cellspacing="0">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>Section</th>
                                <th>Level</th>
                                <th>Adviser</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                            $num = 1;
                            $selectsect = $db->query("select * from sections order by level_id asc") or die("Error. Sections. Please contact your administrator.");
                            if($selectsect->num_rows!=0)
                            {
                              while($rows=$selectsect->fetch_assoc())
                              {
                                $section_id = $rows['id'];
                                $section = $rows['section'];
                                $level_id = $rows['level_id'];
                                $tnum = $rows['tnum'];

                                $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Error. Levels. Please contact your administrator.");
                                  while($rows=$findlvl->fetch_assoc())
                                  {
                                    $level = $rows['level'];
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

                                <tr id='$section_id'>
                                    <td>$num</td>
                                    <td>$section</td>
                                    <td>$level</td>
                                    $putname
                                    <td class='text-left'>
                                    <div class='tooltip-demo'>
                                      <a class='btn btn-primary btn-block' href='a-sections.php?section_id=$section_id'  data-toggle='tooltip' data-placement='top' title='Edit'>
                                        <div class='fa fa-pencil'>
                                        </div>
                                      </a>
                                      <a class='btn btn-success btn-block' href='a-sections.php?section_id_view=$section_id'  data-toggle='tooltip' data-placement='top' title='Students'>
                                        <div class='fa fa-users'>
                                        </div>
                                      </a>
                                    </div>
                                    <!--
                                    <div class='tooltip-demo'>
                                    <span data-toggle='tooltip' data-placement='top' title='Edit'>
                                      <button name='btn-edit' id='b' class='btn btn-primary' data-toggle='modal' data-target='#editSection'>
                                        <div class='fa fa-pencil'>
                                        </div>
                                      </button>
                                    </span>
                                       <span data-toggle='tooltip' data-placement='top' title='Remove'>
                                        <button name='btn-del' id='a' class='btn btn-danger' data-toggle='modal' data-target='#delSection$section_id'>
                                          <div class='fa fa-trash'>
                                          </div>
                                        </button>
                                      </span>
                                    </div>
                                     -->
                                    </td>
                                </tr>";
                                $num++;
                                ?>

                                <div class="modal fade" id="delSection<?php echo $section_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Remove Section</h4>
                                      </div>

                                      <div class="modal-body">
                                        Are you sure you want to remove <strong class="text-primary"><?php echo "$level - $section"; ?></strong>?
                                      </div>

                                      <div class="modal-footer">
                                        <input type='hidden' id='<?php echo $section_id; ?>'>
                                          <button class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button name="del_section" id="btn-del-section" data-dismiss="modal" class="btn btn-primary">Yes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <?php
                              }
                            }
                          ?>
                          </tbody>
                      </table>
                  </div>
                  </div>
                  <!-- /.table-responsive -->

                  <input type="hidden" id="id-selector">

                <!-- Edit Book Modal -->
                <div class="modal fade" id="editSection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Section</h4>
                            </div>

                            <div class="modal-body">
                              <div id='edit-msg'>
                              </div>

                              <div id="section-data">
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="btn-save-book" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-- New Book Modal -->
                <div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Add Section</h4>
                            </div>

                            <div class="modal-body">
                              <div id='add-msg'>
                              </div>

                              <form class='form-horizontal'>
                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Section Name: </label>
                                  <div class='col-sm-10'>
                                    <input type='text' id='new-section' class='form-control' required>
                                  </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Level: </label>
                                <div class="form-inline">
                                  <div class='col-sm-10'>
                                    <select id='new-level' class='form-control'>
                              <?php
                                $selectlvl = $db->query("select * from levels ")or die("Error. Levels. Please contact your administrator.");
                                  while($rows=$selectlvl->fetch_assoc()){
                                    $level_id = $rows['id'];
                                    $level = $rows['level'];

                                    echo "<option value='$level_id'>$level</option>";
                                  }
                              ?>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class='form-group'>
                                <label class='control-label col-sm-2'>Adviser: </label>
                                <div class="form-inline">
                                  <div class='col-sm-10'>
                                    <select name='cat' id='new-tnum' class='form-control'>
                                      <?php
                                      $selectfac = $db->query("select * from teacher_records ") or die("Error. Teacher_Records. Please contact your administrator.");
                                        while($rows=$selectfac->fetch_assoc())
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
                                <button id="btn-add-section" class="btn btn-primary">Add Section</button>
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
