$(document).ready(function(){

  loadNewSect();
  function loadNewSect(){
    var level = $("#new-level").val();
    $.post("actions/subjects/a-load-new-section.php",{postLevel:level},function(section){
      $("#section-data").html(section);
    });
  }

  $("#new-level").change(function(){
      loadNewSect();
  });

  loadEditSect();
  function loadEditSect(){
    var level = $("#edit-level").val();
    var section = $("#hid-section").val();
    $.post("actions/subjects/a-load-edit-section.php",{postLevel:level,postSection:section},function(section){
      $("#edit-section-data").html(section);
    });
  }

  $("#edit-level").change(function(){
      loadEditSect();
  });


  $("#btn-save-subj").click(function(){
    $("#edit-msg").html("<div class='alert alert-info'><strong>Saving..</strong> Please wait..</div>");
    var subjcodeVal = $("#edit-subj-code").val();
    var subjVal = $("#edit-subj").val();
    var descripVal = $("#edit-descrip").val();
    var levelVal = $("#edit-level").val();
    var sectionVal = $("#edit-section").val();
    var tnumVal = $("#edit-tnum").val();

    $.post("actions/subjects/a-action-saveSubj.php",{
      postSubjcode:subjcodeVal,
      postSubj:subjVal,
      postDescrip:descripVal,
      postLevel:levelVal,
      postSection:sectionVal,
      postTnum:tnumVal
    }
    ,function(editMsg){
      $("#edit-msg").html(editMsg);
    });

  });

  $('#btn-add-subj').click(function(){
    var newsubjVal = $("#new-subj").val();
    var newdescripVal = $("#new-descrip").val();
    var newlevelVal = $("#new-level").val();
    var newsectionVal = $("#new-section").val();
    var newtnumVal = $("#new-tnum").val();

    if(newsubjVal==""){
      $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Subject name must specify.</div>");
    }else{
      $("#add-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
      $.post("actions/subjects/a-action-addSubj.php",{
        postSubj:newsubjVal,
        postDescrip:newdescripVal,
        postLevel:newlevelVal,
        postSection:newsectionVal,
        postTnum:newtnumVal
      }
      ,function(addMsg){
        $("#add-msg").html(addMsg);
      });
    }


  });

  $('#btn-clear-field').click(function(){
    $("#new-subj").val("");
    $("#new-descrip").val("");
    $('#new-tnum option[value=""]').attr("selected","selected");
  });
});
