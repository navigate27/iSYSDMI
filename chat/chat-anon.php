<html>

<head>

<?php
  include("db_connect.php");
  include("linksource.php");
?>


<script>
$(document).ready(function(){


  $('#msg-content').bind('keypress', function(e) {
  	if(e.keyCode==13){
      alert("You pressed enter!");
  	}
  });


  ini();

  function ini(){

    var user = $("#user").val();

    if(user!=""){

        iniLoad();

        chatLoad();
    }else{

      $("#form-login").modal('show');
    }
  }

  function chatLoad(){
    setInterval(function() {
      $("#msg-body").load("includes/loadContent.php");
    }, 1000);
    $('#msg-container').animate({
      scrollTop: $('#msg-container')[0].scrollHeight});
  }

  $("#btn-login").click(function(){
    var loguser = $("#login-user").val();
    $("#user").val(loguser);
    $("#form-login").modal('hide');
    iniLoad();
  });

  function iniLoad(){
    $.post("includes/loadContent.php",function(loadMsg){
      $("#msg-body").html(loadMsg);

      $('#msg-container').animate({
        scrollTop: $('#msg-container')[0].scrollHeight});
      });

      user = $("#user").val();
      //alert(user);
      chatLoad();
  }

  $("#btn-send").click(function(){

    var user = $("#user").val();
    var msg = $("#msg-content").val();

    // var temp_msg = "<li class='right clearfix'><span class='chat-img pull-right'></span><div class='chat-body clearfix'><div class='header'><small class='text-muted'><i class='fa fa-clock-o fa-fw'></i> 1 second ago</small><strong class='pull-right primary-font'>Bhaumik Patel</strong></div><p>"+ msg +"</p></div></li>";
    //
    // $("#msg-body").append(temp_msg);
    //
    // $('#msg-container').animate({
    //   scrollTop: $('#msg-container')[0].scrollHeight});
    //
    $("#msg-content").val("");
    $.post("actions/saveMsg.php",{
      postUser:user,
      postMsg:msg
    },function(allMsg){
      $("#msg-body").html(allMsg);
      $('#msg-container').animate({
            scrollTop: $('#msg-container')[0].scrollHeight});
    });

  });

});
</script>

</head>
<div id="wrapper">

<body>
  <div class="row">
    <div class="col-md-5">
      <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Chat
                            <!-- <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id='msg-container' style="height:500px">
                          <div class="extra">
                            <ul class="chat">

                                <div id="msg-body"></div>

                                <div id="bottom-chat"></div>
                            </ul>
                          </div>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input type="hidden" id="user">
                                <textarea style="resize:none" id="msg-content" rows="1" col="10" type="text" class="form-control input-sm" placeholder="Type your message here..." ></textarea>
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-send">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>

                    <div class="modal fade" id="form-login" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                            <h4 class="modal-title" id="myModalLabel">Set your username:</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                              <input type="text" class="form-control" id="login-user" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                            <button type="button" id='btn-login' class="btn btn-primary">Enter Channel</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                      </div>


    </div>
  </div>


</div>
</body>
</html>
