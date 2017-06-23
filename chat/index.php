<html>

<head>

<?php
  include("db_connect.php");
  include("linksource.php");
?>


<script>
$(document).ready(function(){

  $("#form-log").submit(function(e){
    e.preventDefault();

    $("#btn-submit").val("Logging in...");
    $("#btn-submit").attr("disabled","disabled");
    $("#log-msg").html("<div class='alert alert-info'><b>Loading...</b> Please wait.</div>");

    var user = $("#user").val();
    var pass = $("#pass").val();

    $.post("actions/logAccount.php",{
      postUser: user,
      postPass: pass
    },function(logMsg){
      $("#btn-submit").removeAttr("disabled");
      $("#btn-submit").val("Login");
      $("#log-msg").html(logMsg);
    });

  });


});
</script>

</head>

<body>
<div id="wrapper">


  <div class="container">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <div class="login-panel panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Please Sign In</h3>
                      </div>
                      <div class="panel-body">
                          <form role="form" id="form-log">
                              <fieldset>
                                <div id="log-msg"></div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" id="user" name="user" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="pass" name="pass" type="password" required>
                                </div>
                                  <input type="submit" class="btn btn-lg btn-success btn-block" id="btn-submit" value="Login">
                              </fieldset>
                          </form>
                                  <a href="register.php" class="btn btn-lg btn-danger btn-block">Don't Have An Account?</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>





</div>
</body>
</html>
