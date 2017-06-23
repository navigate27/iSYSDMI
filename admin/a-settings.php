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
  <style>
  .nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
  .tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
  .tab-pane { padding: 15px 0; }
  .tab-content{padding:20px}

  </style>
  <script>
  $(document).ready(function(){

    $("#btn-validate").click(function(){
      var inputpass = $("#auth-pass").val();
      var adminpass = $("#admin-pass").val();

      if(inputpass==""){

        $("#backup-msg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please enter password.</div>");

      }else{

        if(inputpass!=adminpass){
          $("#backup-msg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Failed. </strong>Password incorrect.</div>");
        }else{
          $("#backup-msg").html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success. </strong>Backing up database...</div>");
          window.location.href = "backup/backup.php";
        }

      }


    });

    ini();
    function ini(){
      var set1 =  $('#hid-sys-acc').val();
      var set2 =  $('#hid-up-fees').val();
      var set3 =  $('#hid-up-books').val();
      // var set4 =  $('#hid-del-books').val();
      var set5 =  $('#hid-allow-enroll').val();

      if(set1==1){
        $('#sys-acc-on').removeClass();
        $('#sys-acc-on').addClass('btn btn-primary active');
        $('#sys-acc-off').removeClass();
        $('#sys-acc-off').addClass('btn btn-default');
      }else{
        $('#sys-acc-off').removeClass();
        $('#sys-acc-off').addClass('btn btn-primary active');
        $('#sys-acc-on').removeClass();
        $('#sys-acc-on').addClass('btn btn-default');
      }

      if(set2==1){
        $('#fees-on').removeClass();
        $('#fees-on').addClass('btn btn-primary active');
        $('#fees-off').removeClass();
        $('#fees-off').addClass('btn btn-default');
      }else{
        $('#fees-off').removeClass();
        $('#fees-off').addClass('btn btn-primary active');
        $('#fees-on').removeClass();
        $('#fees-on').addClass('btn btn-default');
      }

      if(set3==1){
        $('#upbooks-on').removeClass();
        $('#upbooks-on').addClass('btn btn-primary active');
        $('#upbooks-off').removeClass();
        $('#upbooks-off').addClass('btn btn-default');
      }else{
        $('#upbooks-off').removeClass();
        $('#upbooks-off').addClass('btn btn-primary active');
        $('#upbooks-on').removeClass();
        $('#upbooks-on').addClass('btn btn-default');
      }

      // if(set4==1){
      //   $('#delbooks-on').removeClass();
      //   $('#delbooks-on').addClass('btn btn-primary active');
      //   $('#delbooks-off').removeClass();
      //   $('#delbooks-off').addClass('btn btn-default');
      // }else{
      //   $('#delbooks-off').removeClass();
      //   $('#delbooks-off').addClass('btn btn-primary active');
      //   $('#delbooks-on').removeClass();
      //   $('#delbooks-on').addClass('btn btn-default');
      // }

      if(set5==1){
        $('#enroll-on').removeClass();
        $('#enroll-on').addClass('btn btn-primary active');
        $('#enroll-off').removeClass();
        $('#enroll-off').addClass('btn btn-default');
      }else{
        $('#enroll-off').removeClass();
        $('#enroll-off').addClass('btn btn-primary active');
        $('#enroll-on').removeClass();
        $('#enroll-on').addClass('btn btn-default');
      }
    }


    function saveSettings(){

      var sysacc = $('#hid-sys-acc').val();
      var upfees = $('#hid-up-fees').val();
      var upbooks = $('#hid-up-books').val();
      //var delbooks = $('#hid-del-books').val();
      var allowenroll =  $('#hid-allow-enroll').val();
      // alert(sysacc);
      $.post("actions/settings/saveSettings.php",{
        postSysAcc:sysacc,
        postUpFees:upfees,
        postUpBooks:upbooks,
        // postDelBooks:delbooks,
        postAllowEnroll:allowenroll
        },
        function(){

      });
    }

    $('#sys-acc-on').click(function(){
      $('#sys-acc-on').removeClass();
      $('#sys-acc-on').addClass('btn btn-primary active');
      $('#sys-acc-off').removeClass();
      $('#sys-acc-off').addClass('btn btn-default');
      $('#hid-sys-acc').val('1');
      saveSettings();
    });
    $('#sys-acc-off').click(function(){
      $('#sys-acc-off').removeClass();
      $('#sys-acc-off').addClass('btn btn-primary active');
      $('#sys-acc-on').removeClass();
      $('#sys-acc-on').addClass('btn btn-default');
      $('#hid-sys-acc').val('0');
      saveSettings();
    });

    $('#fees-on').click(function(){
      $('#fees-on').removeClass();
      $('#fees-on').addClass('btn btn-primary active');
      $('#fees-off').removeClass();
      $('#fees-off').addClass('btn btn-default');
      $('#hid-up-fees').val('1');
      saveSettings();
    });
    $('#fees-off').click(function(){
      $('#fees-off').removeClass();
      $('#fees-off').addClass('btn btn-primary active');
      $('#fees-on').removeClass();
      $('#fees-on').addClass('btn btn-default');
      $('#hid-up-fees').val('0');
      saveSettings();
    });

    $('#upbooks-on').click(function(){
      $('#upbooks-on').removeClass();
      $('#upbooks-on').addClass('btn btn-primary active');
      $('#upbooks-off').removeClass();
      $('#upbooks-off').addClass('btn btn-default');
      $('#hid-up-books').val('1');
      saveSettings();
    });
    $('#upbooks-off').click(function(){
      $('#upbooks-off').removeClass();
      $('#upbooks-off').addClass('btn btn-primary active');
      $('#upbooks-on').removeClass();
      $('#upbooks-on').addClass('btn btn-default');
      $('#hid-up-books').val('0');
      saveSettings();
    });
    //
    // $('#delbooks-on').click(function(){
    //   $('#delbooks-on').removeClass();
    //   $('#delbooks-on').addClass('btn btn-primary active');
    //   $('#delbooks-off').removeClass();
    //   $('#delbooks-off').addClass('btn btn-default');
    //   $('#hid-del-books').val('1');
    //   saveSettings();
    // });
    //
    // $('#delbooks-off').click(function(){
    //   $('#delbooks-off').removeClass();
    //   $('#delbooks-off').addClass('btn btn-primary active');
    //   $('#delbooks-on').removeClass();
    //   $('#delbooks-on').addClass('btn btn-default');
    //   $('#hid-del-books').val('0');
    //   saveSettings();
    // });

    $('#enroll-on').click(function(){
      $('#enroll-on').removeClass();
      $('#enroll-on').addClass('btn btn-primary active');
      $('#enroll-off').removeClass();
      $('#enroll-off').addClass('btn btn-default');
      $('#hid-allow-enroll').val('1');
      saveSettings();
    });

    $('#enroll-off').click(function(){
      $('#enroll-off').removeClass();
      $('#enroll-off').addClass('btn btn-primary active');
      $('#enroll-on').removeClass();
      $('#enroll-on').addClass('btn btn-default');
      $('#hid-allow-enroll').val('0');
      saveSettings();
    });


  });
  </script>

</head>
<body>

<div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");

      include("includes/settings.php");

      ?>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header"><i class="fa fa-gears"></i> Settings</h1>
          </div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div>
                          <!-- <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#gen" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
                                <li role="presentation"><a href="#en" aria-controls="enroll" role="tab" data-toggle="tab">Enrollment</a></li>
                                <li role="presentation"><a href="#lib" aria-controls="library" role="tab" data-toggle="tab">Library</a></li> -->
                                <!-- <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Grading</a></li>
                                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Election</a></li> -->
                            <!-- </ul>


                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="gen">
                                  <h4>System Access: </h4>
                                  <div class="btn-group btn-toggle">
                                    <button id='sys-acc-on' class="btn btn-primary active">Enabled</button>
                                    <button id='sys-acc-off' class="btn btn-default">Disabled</button>
                                  </div>
                                  <a href='#' data-container="body" data-toggle="popover" data-placement="right" data-content="When disabled, no one will able to access the system except the admin."><div class='fa fa-question-circle fa-lg'></div></a>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="en">

                                  <h4>Update Enrollment Fees: </h4>
                                  <div class="btn-group btn-toggle">
                                    <button id='fees-on' class="btn btn-primary active">ON</button>
                                    <button id='fees-off' class="btn btn-default">OFF</button>
                                  </div>
                                  <a href='#' data-container="body" data-toggle="popover" data-placement="right" data-content="When off, updating the enrollment fees will be disabled in the enrollment portal."><div class='fa fa-question-circle fa-lg'></div></a>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="lib">
                                  <h4>Update Books: </h4>
                                  <div class="btn-group btn-toggle">
                                    <button id='upbooks-on' class="btn btn-primary active">ON</button>
                                    <button id='upbooks-off' class="btn btn-default">OFF</button>
                                  </div>
                                  <br>
                                  <h4>Delete Books: </h4>
                                  <div class="btn-group btn-toggle">
                                    <button id='delbooks-on' class="btn btn-primary active">ON</button>
                                    <button id='delbooks-off' class="btn btn-default">OFF</button>
                                  </div>
                                </div> -->

                                <!-- <div role="tabpanel" class="tab-pane" id="settings">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div> -->
                            <!-- </div>
                        </div> -->
<!--
                        <div class="lead">
                          General
                        </div>
                        <h4 class="text-muted">System Access</h4>
                        <div class="btn-group btn-toggle">
                          <button id='sys-acc-on' class="btn btn-primary active">Enabled</button>
                          <button id='sys-acc-off' class="btn btn-default">Disabled</button>
                        </div>
                        <a data-container="body" data-toggle="popover" data-placement="right" data-content="When disabled, no one will able to access the system except the admin."><div class='fa fa-question-circle fa-lg'></div></a>
                        <hr> -->

                        <div class="lead">
                          Enrollment
                        </div>
                        <h4 style="font-size:120%" class="text-muted">Enroll</h4>
                        <div class="btn-group btn-toggle">
                          <button id='enroll-on' class="btn btn-primary active">ON</button>
                          <button id='enroll-off' class="btn btn-default">OFF</button>
                        </div>
                        <!-- <a data-container="body" data-toggle="popover" data-placement="right" data-content="When off, updating the enrollment fees will be disabled in the enrollment portal."><div class='fa fa-question-circle fa-lg'></div></a> -->
                        <h4 style="font-size:120%" class="text-muted">Fees</h4>
                        <div class="btn-group btn-toggle">
                          <button id='fees-on' class="btn btn-primary active">ON</button>
                          <button id='fees-off' class="btn btn-default">OFF</button>
                        </div>
                        <a data-container="body" data-toggle="popover" data-placement="right" data-content="When off, updating the enrollment fees will be disabled in the enrollment portal."><div class='fa fa-question-circle fa-lg'></div></a>
                        <hr>
                        <div class="lead">
                          Library
                        </div>
                        <h4 style="font-size:120%" class="text-muted">Update: </h4>
                        <div class="btn-group btn-toggle">
                          <button id='upbooks-on' class="btn btn-primary active">ON</button>
                          <button id='upbooks-off' class="btn btn-default">OFF</button>
                        </div>
                        <br>
                        <!-- <h4 style="font-size:120%" class="text-muted">Delete: </h4>
                        <div class="btn-group btn-toggle">
                          <button id='delbooks-off' class="btn btn-default">OFF</button>
                          <button id='delbooks-on' class="btn btn-primary active">ON</button>
                        </div> -->
                        <hr>
                        <div class="lead">
                          Backup Database
                        </div>
                        <a id='btn-backup' class="btn btn-danger btn-lg" data-toggle="modal" data-target="#LogAuth">Backup Now</a>
                        <a data-container="body" data-toggle="popover" data-placement="right" data-content="The entire database of the system will be downloaded as SQL file."><div class='fa fa-question-circle fa-lg'></div></a>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <input type='hidden' id='hid-sys-acc' value='<?php echo $sysacc; ?>'>
        <input type='hidden' id='hid-up-fees' value='<?php echo $upfees; ?>'>
        <input type='hidden' id='hid-up-books' value='<?php echo $upbooks; ?>'>
        <input type='hidden' id='hid-del-books' value='<?php echo $delbooks; ?>'>
        <input type='hidden' id='hid-allow-enroll' value='<?php echo $enrollallow; ?>'>
        <input type="hidden" id="admin-pass" value="<?php echo $f_pass; ?>">
        <!-- Modal -->
        <div class="modal fade" id="LogAuth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Backup Database</h4>
                    </div>
                    <div class="modal-body">

                      <div id="backup-msg"></div>

                      <h4>Please enter your password:</h4>
                      <div class="form-group">
                        <input type="password" class="form-control" id="auth-pass">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-validate" class="btn btn-primary">Validate</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


<!--footer -->
<?php
include("../footer.php");
?>


  </div>
</div>

<script>
// popover demo
$("[data-toggle=popover]")
    .popover()
</script>


</body>






</html>
