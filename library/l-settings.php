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

    var penalty = $("#hid-penalty").val();
    $("#penalty").val(penalty);


    $("#savePenalty").click(function(){

      $("#msg").html("<div class='alert alert-info'>Loading...</div>");
      var newPenalty = $("#penalty").val();

      $.post("actions/settings/saveSettings.php",{
        postPenalty:newPenalty
      },
      function(data){
        $("#msg").html(data);
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

                        <div id='msg'></div>
                        <div class="lead">
                          Penalty
                        </div>
                        <h4 style="font-size:120%" class="text-muted">Set Penalty</h4>
                        <div class='form-group'>
                          <div class='form-inline'>
                            <input type='number' id='penalty' class='form-control' value=''>
                            <a href='#' id='savePenalty' class='btn btn-primary'>Save<a>
                          </div>
                        </div>
                        <hr>
                        <!-- <a id='btn-backup' class="btn btn-danger btn-lg" data-toggle="modal" data-target="#delBooks"><i class='fa fa-trash'></i> Recycle Bin</a>
                        <a data-container="body" data-toggle="popover" data-placement="right" data-content="All books that are deleted can be view here."><div class='fa fa-question-circle fa-lg'></div></a> -->
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

        $lib_settings = $db->query("select * from lib_settings")or die("Unable to connect");//status is always not equal to 0 to make sure book is not deleted
          while($rows=$lib_settings->fetch_assoc())
          {
            $penalty = $rows['penalty'];
          }

        ?>

        <!-- <input type='hidden' id='hid-sys-acc' value='<?php echo $sysacc; ?>'> -->
        <input type='hidden' id='hid-penalty' value='<?php echo $penalty; ?>'>
        <!-- Modal -->

        <div class="modal fade" id="delBooks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Recycle Bin</h4>
                    </div>
                    <div class="modal-body">

                      <div id="backup-msg"></div>

                      <table class='table'>
                        <th>ID#</th>
                        <th>Code</th>
                        <th>Name/Title</th>
                        <th>Author</th>
                        <th>Edition</th>
                        <th>Category</th>

                      <?php

                      $delBookq = $db->query("select * from lib_books where stat=0")or die("Unable to connect");//status is always not equal to 0 to make sure book is not deleted
                      if($delBookq->num_rows!=0){
                        while($rows=$delBookq->fetch_assoc())
                        {
                          $books_id = $rows['id'];
                          $code = $rows['code'];
                          $title = $rows['title'];
                          $author = $rows['author'];
                          $edition = $rows['edition'];
                          $cat = $rows['cat'];

                          echo "
                          <tr id='$books_id'>
                          <td>$books_id</td>
                          <td>$code</td>
                          <td>$title</td>
                          <td>$author</td>
                          <td>$edition</td>
                          <td>$cat</td>
                          </tr>";
                        }

                      }

                      ?>
                    </table>

                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-validate" class="btn btn-primary">Validate</button>
                    </div> -->
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
