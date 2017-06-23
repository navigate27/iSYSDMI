<?php
$page = "login";
session_start();
if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
  include("dmiconnect.php");
  $findfac = $db->query("select * from teacher_records where tnum='$user' ")or die("Error. Teacher_Records.");
  if($findfac->num_rows!=0){
    while($rows=$findfac->fetch_assoc())
    {
      $f_fname = $rows['fname'];
      $f_mname = $rows['mname'];
      $f_lname = $rows['lname'];
      $f_bio = $rows['bio'];
      $f_alias = $rows['alias'];
    }
  }

  $findacc = $db->query("select * from accounts where tnum='$user' ")or die("Error. Accounts.");
  if($findacc->num_rows!=0)
  {
    while($rows=$findacc->fetch_assoc())
    {
      $f_stat = $rows['stat'];
      $f_type = $rows['type'];
    }
  }

  if($f_type!=1){
    switch($f_type){
      case 0:
      $pageauth = "grading";
      break;
      case 2:
      $pageauth = "enrollment";
      break;
      case 3:
      $pageauth = "library";
      break;
    }

    if($pageauth!=$page){
      header("location: $pageauth/");
    }

  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>iSYS - DMI School Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
    background-color: white;
}

#loginbox {
    margin-top: 30px;
}

#loginbox > div:first-child {
    padding-bottom: 10px;
}

.iconmelon {
    display: block;
    margin: auto;
}

#form > div {
    margin-bottom: 25px;
}

#form > div:last-child {
    margin-top: 10px;
    margin-bottom: 10px;
}

.panel {
    background-color: transparent;
}

.panel-body {
    padding-top: 30px;
    background-color: rgba(2555,255,255,.3);
}

#particles {
    width: 100%;
    height: 100%;
    overflow: hidden;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    z-index: -2;
}

.iconmelon,
.im {
  position: relative;
  width: 150px;
  height: 150px;
  display: block;
  fill: #525151;
}

.iconmelon:after,
.im:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
    </style>
    <?php include("linksource.php"); ?>

    <script>
    $(document).ready(function(){
      $("#btn-sign-in").click(function(log){


        $("#login-msg").html("<div class='alert alert-info'>Loading...<img src='loading/reload.svg'></div>");

        log.preventDefault();

        var user = $("#user").val();
        var pass = $("#pass").val();
        if(user==""||pass==""){
          $("#login-msg").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Login Failed.</strong> Username or Password cannot be empty.</div>");
        }else{

          var btn = $(this);
          btn.button('loading');
          $.post("login-validate.php",{postUser:user,postPass:pass},function(loginMsg){
            $("#login-msg").html(loginMsg);
            var log_type = $("#login-type").val();

            switch(log_type){
              case '0':
                window.location.replace("grading/index.php");
              break;
              case '1':
                window.location.replace("admin/index.php");
              break;
              case '2':
                window.location.replace("enrollment/index.php");
              break;
              case '3':
                window.location.replace("library/index.php");
              break;
            }

          });
        }

          setTimeout(function () {
          btn.button('reset');
        }, 1000);
      });

    });
    </script>

</head>

<body>
  <div class="container">

    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

        <div class="row">
            <div class="iconmelon">

              <svg viewBox="0 10 550 32">
                <g filter="">
                    <!-- <use xlink:href=""><img \ src="images/zothers/logo.png"/></use> -->
                </g>
              </svg>
            </div>
        </div>

        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title text-center">Daughters of Mary Immaculate School</div>
            </div>

            <div class="panel-body" >

                <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data">
                  <div id="login-msg">
                  </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user" type="text" class="form-control" name="user" value="" autocomplete="off" placeholder="User">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="pass" type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" href="#" id="btn-sign-in" data-loading-text="Signing in..." class="btn btn-primary pull-right"> Sign in</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

</body>

</html>
