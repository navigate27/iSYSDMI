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
  <script type="text/javascript" src="export/tableExport.js"></script>
  <script type="text/javascript" src="export/jquery.base64.js"></script>
  <script type="text/javascript" src="export/html2canvas.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>
  <script>
  $(document).ready(function(){

    $("#disable-account").click(function(){
        $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
        var tnum = $("#edit-tnum").val();
        $.post("actions/accounts/a-action-disableAccount.php",{
          postTnum:tnum
        },function(disMsg){
          $("#edit-msg").html(disMsg)
        });
    });

    $("#active-account").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
        var tnum = $("#edit-tnum").val();
        $.post("actions/accounts/a-action-activeAccount.php",{
          postTnum:tnum
        },function(actMsg){
          $("#edit-msg").html(actMsg)
        });
    });


    $("#btn-save-account").click(function(){
      $("#edit-msg").html("<div class='alert alert-info'>Loading...</div>");
      var editTnum = $("#edit-tnum").val();
      var editUser = $("#edit-user").val();
      var editPass = $("#edit-pass").val();
      var editType = $("#edit-type").val();

      if(editUser==""){
        $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Username must specify.</div>");
      }else{

        if(editPass==""){
          $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Password must specify.</div>");
        }else{

          $.post("actions/accounts/a-action-saveAccount.php",{
            postTnum:editTnum,
            postUser:editUser,
            postPass:editPass,
            postType:editType
          }
          ,function(editMsg){
            $("#edit-msg").html(editMsg);
          });

        }
      }

    });

    $("#show-pass").click(function(){
      var ps = $("#pass-stat").val();
      if(ps==0){
        $("#edit-pass").removeAttr("type");
        $("#edit-pass").attr("type","text");
        $("#eye-stat").removeClass();
        $("#eye-stat").addClass("fa fa-eye-slash");
        $("#pass-stat").val("1");
      }else{
        $("#edit-pass").removeAttr("type");
        $("#edit-pass").attr("type","password");
        $("#eye-stat").removeClass();
        $("#eye-stat").addClass("fa fa-eye");
        $("#pass-stat").val("0");
      }

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

    //THIS IS EDIT
    $checkAccounts = $db->query("select * from accounts where tnum='$tnum' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$checkAccounts->fetch_assoc())
      {
        $user = $rows['user'];
        $pass = $rows['pass'];
        $type = $rows['type'];
        $stat = $rows['stat'];
      }
    $checkTeachers = $db->query("select * from teacher_records where tnum='$tnum' ") or die("Can't complete process. Please contact your Administrator.");
      while($rows=$checkTeachers->fetch_assoc())
      {
        $fname = $rows['fname'];
        $mname = $rows['mname'];
        $lname = $rows['lname'];
      }

?>
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-heart"></i> Accounts</h1>
      <a href="a-accounts.php" class="btn btn-default"><div class="fa fa-arrow-left"></div> Back</a>
  </div>
</div>
<br>
              <!-- /.row -->
      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <div class="panel-title">
                        Update Account
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
                                <a href="a-faculty.php?tnum=<?php echo $tnum; ?>" target="_blank"><i class="fa fa-table fa-fw"></i> View Information</a>
                              </li>
                                <?php
                                  $getacc = $db->query("select * from accounts where tnum='$tnum' ")or die("Error. Accounts.");
                                  if($getacc->num_rows!=0)
                                  {
                                    while($rows=$getacc->fetch_assoc())
                                    {
                                      $f_type = $rows['type'];
                                    }
                                  }
                                if($type!=1){
                                  echo "<li class='divider'></li>";
                                  echo "<li>";
                                  if($stat==1){
                                    echo "<a href='#' id='disable-account'><i class='fa fa-ban fa-fw'></i> Disable</a>";
                                  }else if($stat==0){
                                    echo "<a href='#' id='active-account'><i class='fa fa-check fa-fw'></i> Set to Active</a>";
                                  }
                                  echo "</li>";
                                }
                                ?>
                          </ul>
                        </div>
                    </div>
                  </div>
                  <div class="panel-body">

                  <form class='form-horizontal'>

                  <div id="edit-msg">
                  </div>

                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">Faculty No.: </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="edit-tnum" value="<?php echo $tnum; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">Name: </label>
                        <div class="col-sm-10">
                          <div class="form-inline">
                            <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $fname; ?>" readonly>
                            <input type="text" class="form-control" name="mname" placeholder="Middle Name" value="<?php echo $mname; ?>" readonly>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>" readonly>
                          </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="code" class="control-label col-sm-2">Username: </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="edit-user" value="<?php echo $user; ?>" disabled>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                      <label for="code" class="control-label col-sm-2">Password: </label>
                        <div class="col-sm-10">
                          <div class="form-inline">
                            <div class="input-group">
                              <input type="password" class="form-control" id="edit-pass" value="<?php echo $pass; ?>">
                                <span class="input-group-btn">
                                  <a id="show-pass" class="btn btn-default">
                                      <i id="eye-stat" class="fa fa-eye"></i>
                                  </a>
                                </span>
                              </div>
                          </div>
                        </div>
                    </div>
                    <input type="hidden" id="pass-stat" value="0">

                    <?php
                      if($type!=1){
                    ?>
                    <div class="form-group">
                      <div class="form-inline">
                        <label for="level" class="control-label col-sm-2">Account Type: </label>
                        <div class="col-sm-10">
                          <select  id="edit-type" class="form-control">
                            <option value="0" <?php if($type==0){ echo "selected"; }?>>Faculty</option>
                            <option value="2" <?php if($type==2){ echo "selected"; }?>>Financial Department Head</option>
                            <option value="3" <?php if($type==3){ echo "selected"; }?>>Library Department Head</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                      }else{
                    ?>
                    <input type="hidden" id="edit-type" value="1"> 
                    <div class="form-group">
                      <div class="form-inline">
                        <label for="level" class="control-label col-sm-2">Account Type: </label>
                          <div class="col-sm-10">
                          <select class="form-control">
                            <option value="1" <?php if($type==1){ echo "selected"; }?> disabled>Administrator</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                      }
                    ?>


                    <div class="form-group">
                      <div class="col-sm-12">
                           <p class="text-right">
                             <a href="a-accounts.php" class="btn btn-default">Cancel</a>
                             <a id="btn-save-account" class="btn btn-primary">Save Changes</a>
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
        <h1 class="page-header"><i class="fa fa-users"></i> Accounts</h1>
    </div>
  </div>
  <br>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">
                    List of Accounts
                </div>
              </div>

              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <div class="table-responsive">
                    <table id="example" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Faculty No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $num = 1;
                            $accquery = $db->query("select * from accounts ") or die("Can't complete process. Please contact your Administrator.");
                            if($accquery->num_rows!=0)
                            {
                              while($rows=$accquery->fetch_assoc())
                              {
                                $tnum = $rows['tnum'];
                                $user = $rows['user'];
                                $pass = $rows['pass'];
                                $type = $rows['type'];
                                $stat = $rows['stat'];

                                $checkTeachers = $db->query("select * from teacher_records where tnum='$tnum' ") or die("Can't complete process. Please contact your Administrator.");
                                if($checkTeachers->num_rows!=0){
                                  while($rows=$checkTeachers->fetch_assoc())
                                  {
                                    $fname = $rows['fname'];
                                    $mname = $rows['mname'];
                                    $lname = $rows['lname'];
                                  }
                                }else{
                                  $fname = "";
                                  $mname = "";
                                  $lname = "";
                                }

                                switch($type){
                                  case 0:
                                  $type = "Faculty";
                                  break;
                                  case 1:
                                  $type = "Administrator";
                                  break;
                                  case 2:
                                  $type = "Financial Department Head";
                                  break;
                                  case 3:
                                  $type = "Library Department Head";
                                  break;
                                }

                                if($stat!=1){
                                  $status = "<a class='btn btn-danger btn-block'>Disabled</a>";
                                  $t_stat = "Disabled";
                                }else{
                                  $status = "<a class='btn btn-success btn-block'>Active</a>";
                                  $t_stat = "Active";
                                }

                                echo "<tr>
                                    <td>$num</td>
                                    <td><a href='a-faculty.php?tnum=$tnum'>$tnum</a></td>
                                    <td>$lname, $fname $mname[0].</td>
                                    <td>$user</td>
                                    <td>$type</td>
                                    <td><div class='tooltip-demo'><span data-toggle='tooltip' data-placement='top' title='$t_stat'>$status</span></div></td>
                                    <td class='text-center'>
                                      <div class='tooltip-demo'>
                                        <a class='btn btn-primary' href='a-accounts.php?tnum=$tnum'  data-toggle='tooltip' data-placement='top' title='Edit'>
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
