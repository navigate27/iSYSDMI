<html>

<head>

<?php
  include("db_connect.php");
  include("linksource.php");
?>


<script>
$(document).ready(function(){

  $("#form-reg").submit(function(e){
    e.preventDefault();

    $("#reg-success").val(1);
    $("#btn-submit").val("Processing...");
    $("#btn-submit").attr("disabled","disabled");
    $("#reg-msg").html("<div class='alert alert-info'><b>Loading...</b> Please wait.</div>");

    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var gender = $("#gender").val();
    var user = $("#user").val();
    var pass = $("#pass").val();
    var cpass = $("#cpass").val();

    var success = $("#reg-success").val();


    if(pass==cpass){

      if(success!=0){
        $.post("actions/regAccount.php",{
          postFname: fname,
          postLname: lname,
          postGender: gender,
          postUser: user,
          postPass: pass
        },function(regMsg){
          $("#btn-submit").removeAttr("disabled");
          $("#btn-submit").val("Register");
          $("#reg-msg").html(regMsg);
        });

      }else{

      }

    }else{
      $("#btn-submit").removeAttr("disabled");
      $("#btn-submit").val("Register");
      $("#reg-success").val(0);
      $("#reg-msg").html("<div class='alert alert-danger'><b>Failed.</b> Password did not match.</div>");
    }

  });



});
</script>

</head>

<body>
<div id="wrapper">

  <input type="hidden" id="reg-success" value="0">

  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Create an account</h3>
                  </div>
                  <div class="panel-body">
                      <form role="form" id="form-reg">
                          <fieldset>
                              <div id="reg-msg"></div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="First Name" name="fname" type="text" id="fname" autofocus required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Last Name" name="lname" type="text" id="lname" required>
                              </div>
                              <div class="form-group">
                                  <select class="form-control" id="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Username" name="user" type="text" id="user" required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Password" name="pass" type="password" id="pass" required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Confirm Password" name="cpass" type="password" id="cpass" required>
                              </div>
                              <!-- Change this to a button or input when using this as a form -->
                              <input type="submit" class="btn btn-lg btn-success btn-block" id="btn-submit" value="Register">
                          </fieldset>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>





</div>
</body>
</html>
