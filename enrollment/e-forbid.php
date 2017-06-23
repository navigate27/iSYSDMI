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
          <h1 class="page-header text-center"><i class="fa fa-hand-o-up"></i> Stop right there!</h1>
          <div class="jumbotron">
            <h1 class="text-center">Enrollment is not allowed by your admin.</h1>
            <p class="text-center">Please inform your administrator if you want to enable enrollment.</p>
            <p class="text-center"><a href='../footer/help'>Click here for more details</a></p>
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
