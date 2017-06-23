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

    <title>DMI - Library Portal</title>
  <?php
    include("linksource.php");
  ?>
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
              <h1 class="page-header"><i class="fa fa-upload"></i> Import</h1>
          </div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                      Import Books
                    </div>
                    <div class="panel-body">
                        <div>
                          <form action="actions/books/l-action-import.php" method="post" enctype="multipart/form-data">

                            <?php
                              if(isset($_GET['success'])){
                                $success = $_GET['success'];

                                if($success!=0){
                                  echo "<div class='alert alert-success'><strong>Success!</strong> File has been successfully imported.</div>";
                                }else{
                                  echo "<div class='alert alert-danger'><strong>Cannot import file!</strong> There is something wrong while importing your file. Click <a class=alert-link href='footer/help.html#importingbooks'>here</a> for help.</div>";
                                }
                              }
                            ?>

                            <div class="form-group">
                              Click <strong class="text-primary">Choose File</strong> to choose an excel file(.csv)<br />
                              <input name="csv" type="file" class="form-control" id="csv" required>
                            </div>
                            <div class="form-group">
                              <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Import" />
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type='hidden' id='hid-sys-acc' value='<?php echo $sysacc; ?>'>
        <input type='hidden' id='hid-up-fees' value='<?php echo $upfees; ?>'>
        <input type='hidden' id='hid-up-books' value='<?php echo $upbooks; ?>'>
        <input type='hidden' id='hid-del-books' value='<?php echo $delbooks; ?>'>


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
