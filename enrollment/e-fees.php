<?php
$page = "enrollment";
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

    <title>DMI - Enrollment Portal</title>
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
  <script>
  $(document).ready(function(){

    var sysacc = $('#hid-sys-acc').val();
    if(sysacc==1){
      $('#btn-edit-fees').removeAttr('disabled');
    }else{
      $('#btn-edit-fees').attr('disabled','disabled');
    }

      disField();
    function disField(){
      $("#edit-books").attr("disabled","disabled");
      $("#edit-tfee").attr("disabled","disabled");
      $("#edit-pe").attr("disabled","disabled");
      $("#edit-sc").attr("disabled","disabled");
      $("#edit-misc").attr("disabled","disabled");


      $("#btn-cancel-view").show();
      $("#btn-cancel-edit").hide();
      $("#btn-save-fees").hide();
      $("#btn-edit-fees").show();
    }

    $("#btn-edit-fees").click(function(){

      var sysacc = $('#hid-sys-acc').val();

      if(sysacc==1){
        $("#edit-books").removeAttr("disabled");
        $("#edit-tfee").removeAttr("disabled");
        $("#edit-pe").removeAttr("disabled");
        $("#edit-sc").removeAttr("disabled");
        $("#edit-misc").removeAttr("disabled");


        $("#btn-cancel-view").hide();
        $("#btn-cancel-edit").show();
        $("#btn-save-fees").show();
        $("#btn-edit-fees").hide();
      }else{
        $('#edit-msg').html("<div class='alert alert-warning'><strong>Failed.</strong> Updating Fees is disabled by your admin.</div>");
      }
    });

    $("#btn-cancel-edit").click(function(){
      disField();
    });

    $("#btn-save-fees").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'><strong>Saving... </strong>Please wait..</div>");
      var level = $("#edit-level").val();
      var books = $("#edit-books").val();
      var tfee = $("#edit-tfee").val();
      var pe = $("#edit-pe").val();
      var sc = $("#edit-sc").val();
      var misc = $("#edit-misc").val();

      $.post("actions/fees/e-saveFees.php",{
        postLevel:level,
        postBooks:books,
        postTfee:tfee,
        postPe:pe,
        postSc:sc,
        postMisc:misc
      }
      ,function(editMsg){
        $("#edit-msg").html(editMsg);
      });


    });


  });

  </script>

</head>
<body>

<div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");
      include("/includes/settings.php");

      ?>

      <input type='hidden' id='hid-sys-acc' value='<?php echo $upfees; ?>'>

<div id="page-wrapper">
<?php
if(isset($_GET['level_id'])){
  $level_id = $_GET['level_id'];

    $checkFees = $db->query("select * from fees where level='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$checkFees->fetch_assoc())
      {
        $books = $rows['books'];
        $tfee = $rows['tfee'];
        $pe = $rows['pe'];
        $sc = $rows['sc'];
        $misc = $rows['misc'];
      }

    $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$findlvl->fetch_assoc())
      {
        $level = $rows['level'];
      }

?>
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-money"></i> Enrollment Fees</h1>
      <a href="e-fees.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
  </div>
</div>
<br>
              <!-- /.row -->
      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <div class="panel-title">
                        (<?php echo $level; ?>) Update Fees
                    </div>
                  </div>
                  <div class="panel-body">

                  <form class='form-horizontal'>

                  <div id="edit-msg">
                  </div>

                  <input type="hidden" id="edit-level" value="<?php echo $level_id; ?>">
                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">Books: </label>
                        <div class="col-sm-10">
                          <input type="number" min="0" class="form-control" id="edit-books" value="<?php echo $books; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">Tuition Fee: </label>
                        <div class="col-sm-10">
                          <input type="number" min="0" class="form-control" id="edit-tfee" value="<?php echo $tfee; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">P.E. Uniform: </label>
                        <div class="col-sm-10">
                          <input type="number" min="0" class="form-control" id="edit-pe" value="<?php echo $pe; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">School Uniform: </label>
                        <div class="col-sm-10">
                          <input type="number" min="0" class="form-control" id="edit-sc" value="<?php echo $sc; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">Miscellaneous: </label>
                        <div class="col-sm-10">
                          <input type="number" min="0" class="form-control" id="edit-misc" value="<?php echo $misc; ?>" >
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12">
                           <p class="text-right">
                             <a href="e-fees.php" id="btn-cancel-view" class="btn btn-default">Cancel</a>
                             <a id="btn-cancel-edit" class="btn btn-default">Cancel</a>
                             <a id="btn-edit-fees" class="btn btn-primary">Edit Data</a>
                             <a id="btn-save-fees" class="btn btn-primary">Save Changes</a>
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
        <h1 class="page-header"><i class="fa fa-money"></i> Enrollment fees</h1>
    </div>
  </div>
  <br>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">
                    List of Levels
                </div>
              </div>

              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <div class="table-responsive">
                    <table id="example" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Level</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $num = 1;
                            $slctlevel = $db->query("select * from levels ") or die("Can't complete process. Please contact your Administrator.");
                            if($slctlevel->num_rows!=0)
                            {
                              while($rows=$slctlevel->fetch_assoc())
                              {
                                $level_id = $rows['id'];
                                $level = $rows['level'];

                                echo "<tr>
                                    <td>$num</td>
                                    <td>$level</td>
                                    <td><a href='e-fees.php?level_id=$level_id'>View</a></td>
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
<p class="text-right"><a class="btn btn-success" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});">Export to Excel</a></p>

<?php
}
?>

<!--footer -->
<?php
include("../footer.php");
?>

      </div>
  </div>


<!--footer -->
		<div id="footer-container">
			<div id="copyright">
				<p></p>
			</div>
		</div>


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
    <script type="text/javascript">
    	// For demo to fit into DataTables site builder...
    	$('#example')
    		.removeClass( 'display' )
    		.addClass('table table-striped table-bordered');
    </script>

</body>


</html>
