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

  <script>
  $(document).ready(function(){
    $("#btn-save-notes").click(function(){
      var id = $("#edit-id").val();
      var title = $("#edit-title").val();
      var notes = $("#edit-notes").val();

      if(title==""){
        $("#msg").html("<div class='alert alert-danger'><strong>Failed! </strong>Please insert title.</div>");
      }else{
        if(notes==""){
          $("#msg").html("<div class='alert alert-danger'><strong>Failed! </strong>Please insert content.</div>");
        }else{
          $("#msg").html("<div class='alert alert-info'><strong>Saving... </strong>Please wait..</div>");
          $.post("actions/notes/a-action-editNotes.php",{postId:id,postTitle:title,postNotes:notes},function(edit){
            $("#msg").html(edit);
          });
        }
      }

    });

    $("#btn-add-notes").click(function(){
      var title = $("#add-title").val();
      var notes = $("#add-notes").val();

      if(title==""){
        $("#msg").html("<div class='alert alert-danger'><strong>Failed! </strong>Please insert title.</div>");
      }else{
        if(notes==""){
          $("#msg").html("<div class='alert alert-danger'><strong>Failed! </strong>Please insert content.</div>");
        }else{
          $("#msg").html("<div class='alert alert-info'><strong>Saving... </strong>Please wait..</div>");
          $.post("actions/notes/a-action-addNotes.php",{postTitle:title,postNotes:notes},function(add){
            window.location.replace("e-notes.php");
            $("#msg").html(add);
          });
        }
      }

    });

    $("#btn-delete-notes").click(function(){
      var id = $("#edit-id").val();
      $("#msg").html("<div class='alert alert-danger'><strong>Deleting... </strong>Please wait..</div>");
      $.post("actions/notes/a-action-deleteNotes.php",{postId:id},function(del){
        window.location.replace("e-notes.php");
        $("#msg").html(del);
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

      if(isset($_GET['action'])){
          $id = $_GET['id'];

            $mynotes = $db->query("select * from e_notes where id='$id' ") or die("Can't complete process. Please contact your Administrator.");
            if($mynotes->num_rows!=0)
            {
              while($rows=$mynotes->fetch_assoc())
              {
                  $id = $rows['id'];
                  $notes = $rows['notes'];
                  $title = $rows['title'];
              }
            }
      }else{
        $notes = "";
        $title = "";
      }
      ?>

<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-edit"></i> Personal Notes</h1>
      </div>
    </div>

<div id='msg'></div>
            <?php
            if(isset($_GET['action'])){
              ?>

              <form id="form-notes" class="form-horizontal">
                <input type="hidden" id="edit-id" value="<?php echo $id; ?>">
            <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="col-sm-10">
                      <input type="text" placeholder="Title" id="edit-title" class="form-control" name="title" value="<?php echo $title; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-sm-10">
                            <textarea class="form-control" id="edit-notes" rows="10" cols="20" name="pnotes" placeholder="Something here..."  required><?php echo $notes; ?></textarea>
                        </div>
                  </div>

                <div class="form-group">
                    <div class="col-sm-10">
              <?php
              echo "
                    <p class='text-right'>
                    <a href='e-notes.php'  class='btn btn-default'>New</a>
                    <a id='btn-delete-notes' class='btn btn-danger'>Delete</a>
                    <input type='submit' id='btn-save-notes' class='btn btn-primary' value='Save Changes'>
                    <input type='hidden' name='id' value='$id'>
                    </p>
              </div>
              </div>

                    </form>
                    </div>

                    ";

            }else{
            ?>

            <form class="form-horizontal">
          <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text" placeholder="Title" id="add-title" class="form-control" name="title" value="<?php echo $title; ?>">
                  </div>
                </div>
                <div class="form-group">
                      <div class="col-sm-10">
                          <textarea class="form-control" id="add-notes" rows="10" cols="20" name="pnotes" placeholder="Something here..."  required><?php echo $notes; ?></textarea>
                      </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <p class="text-right"><a id='btn-add-notes' class="btn btn-primary" >Save</a></p>
                    </div>
                </div>
            </form>
              </div>
              <?php
              }
              ?>

      <div class="col-lg-6">
          <div class="panel panel-info">
              <div class="panel-heading">
                  <i class="glyphicon  glyphicon-time"></i> My Notes
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <div class="list-group">
                    <?php
                        $mynotes = $db->query("select * from e_notes where stat=1 order by id desc limit 30") or die("Can't complete process. Please contact your Administrator.");
                        if($mynotes->num_rows!=0)
                        {
                          while($rows=$mynotes->fetch_assoc())
                          {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $notes = $rows['notes'];
                            $date = $rows['date'];

                            if(strlen($title)>25){
                                $title = substr($title,0,25);
                                $title = "$title...";
                            }

                            $date = date("M d, Y - h:ia",strtotime($date));

                            echo "<a href='e-notes.php?action=edit&id=$id' class='list-group-item'>
                                $title
                                <span class='pull-right text-muted small'><em>$date</em>
                                </span>
                            </a>";

                          }
                        }
                      ?>

                  </div>
                  <!-- /.list-group -->
                    <!--<a href="#" class="btn btn-default btn-block">View all</a>-->
              </div>
              <!-- /.panel-body -->
          </div>
        </div>
</div>

<!--footer -->
<?php
include("../footer.php");
?>


</div>
</div>

</body>






</html>
