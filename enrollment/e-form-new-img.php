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

  <script type="text/javascript" src="myScript/upImgScript.js"></script>

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
          <h1 class="page-header"><i class="fa fa-table"></i> Enroll (New)</h1>
      </div>
    </div>

    <div id="msg">
    </div>

          <form id="form-validate" class="form-horizontal" enctype="multipart/form-data">

          <div>
        </div>

      <div class="row">
        <div class="col-md-10">

          <div class="form-group">
            <div class="col-md-offset-1">
                <label for="rnum">Student's Photo</label>
                  <input type="file" class="form-control" name="img" id="form-img">
            </div>
          </div>

              <hr>
              <div class="form-group">
                <div class="col-sm-12">
    					       <p class="text-right"><button type="submit" id="btn-enroll" class="btn btn-primary btn-lg">Enroll Now</button></p>
                </div>
              </div>
        </div>
      </div>
    </form>


    <!--footer -->
    <?php
    include("../footer.php");
    ?>



</div>
</div>


</body>






</html>
