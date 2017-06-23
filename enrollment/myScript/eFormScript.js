$(document).ready(function(){

  // setSnum();
  // function setSnum(){
  //   var getId = $('#form-id').val();
  //   var sy = $('#form-sy').val();
  //   var year = sy.substr(0,4);
  //   var genSnum = "S"+year+""+128+""+getId;
  //   $('#form-snum').val(genSnum);
  // }
  //
  // $('#form-sy').change(function(){
  //   setSnum();
  // });
  //

  $("#form-bdate").change(function(){
    var bdate = $('#form-bdate').val();
    $.post("actions/enroll/computeAge.php",{
      postBdate:bdate
    },function(myAge){
      $("#form-age").val(myAge);
      // $("#hid-age").val(myAge);
      // var age = $("#hid-age").val();
      // alert(age);
    });
  });

  $('#check-pts').click(function(){
    if($(this).is(":checked")){
        $('#form-pts').removeAttr("disabled");
        $('#form-pts option[value=""]').removeAttr("selected");
    }else{
        $('#form-pts option[value=""]').attr("selected","selected");
        $('#form-pts').attr("disabled","disabled");
    }
  });

  $('#parentOpt').click(function(){
    $('#fatherIn').removeAttr("disabled");
    $('#motherIn').removeAttr("disabled");
    $('#guardianIn').attr("disabled","disabled");
    $('#guardianIn').val("");
  });

  $('#guardianOpt').click(function(){
    $('#guardianIn').removeAttr("disabled");
    $('#fatherIn').attr("disabled","disabled");
    $('#motherIn').attr("disabled","disabled");
    $('#fatherIn').val("");
    $('#motherIn').val("");
  });



  $('#form-pic').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-pic').val("1");
    }else{
        var pic = $('#form-pic').val("");
    }
  });

  $('#form-birth').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-birth').val("1");
    }else{
        var pic = $('#form-birth').val("");
    }
  });

  $('#form-f137').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-f137').val("1");
    }else{
        var pic = $('#form-f137').val("");
    }
  });

  $('#form-good').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-good').val("1");
    }else{
        var pic = $('#form-good').val("");
    }
  });

  $('#form-report').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-report').val("1");
    }else{
        var pic = $('#form-report').val("");
    }
  });

  $('#form-grad').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-grad').val("1");
    }else{
        var pic = $('#form-grad').val("");
    }
  });

  $('#form-choir').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-choir').val("1");
    }else{
        var pic = $('#form-choir').val("");
    }
  });

  $('#form-early').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-early').val("1");
    }else{
        var pic = $('#form-early').val("");
    }
  });

  $('#form-friend').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-friend').val("1");
    }else{
        var pic = $('#form-friend').val("");
    }
  });

  $('#form-loyal').click(function(){
    if($(this).is(":checked")){
        var pic = $('#form-loyal').val("1");
    }else{
        var pic = $('#form-loyal').val("");
    }
  });

  //validate
  $("#form-validate").submit(function(sub){

    $("#btn-enroll").attr("disabled","disabled");

    var rnumVal = $('#form-rnum').val();
    var snumVal = $('#form-snum').val();
    var fnameVal = $('#form-fname').val();
    var mnameVal = $('#form-mname').val();
    var lnameVal = $('#form-lname').val();
    var sectionVal = $('#form-section').val();
    var syVal = $('#form-sy').val();
    var endateVal = $('#form-endate').val();
    var ptsVal = $('#form-pts').val();
    var ageVal = $('#form-age').val();
    var genderVal = $('#form-gender').val();
    var bdateVal = $('#form-bdate').val();
    var bplaceVal = $('#form-bplace').val();
    var addressVal = $('#form-address').val();

    var fatherVal = $('#fatherIn').val();
    var motherVal = $('#motherIn').val();
    var guardianVal = $('#guardianIn').val();
    var cnumVal = $('#form-cnum').val();

    //student requirements
    var picVal = $('#form-pic').val();
    var birthVal = $('#form-birth').val();
    var f137Val = $('#form-f137').val();
    var goodVal = $('#form-good').val();
    var reportVal = $('#form-report').val();

    //student discount
    var acadVal = $('#form-acad:checked').val();
    var gradVal = $('#form-grad').val();
    var choirVal = $('#form-choir').val();
    var earlyVal = $('#form-early').val();
    var friendVal = $('#form-friend').val();
    var loyalVal = $('#form-loyal').val();
    var qeVal = $('#form-qe').val();
      sub.preventDefault();

      $.post("actions/enroll/e-form-new-save.php",{
        postRnum:rnumVal,
        postSnum:snumVal,
        postFname:fnameVal,
        postMname:mnameVal,
        postLname:lnameVal,
        postSection:sectionVal,
        postSy:syVal,
        postEndate:endateVal,
        postPts:ptsVal,
        postAge:ageVal,
        postGender:genderVal,
        postBdate:bdateVal,
        postBplace:bplaceVal,
        postAddress:addressVal,
        postFather:fatherVal,
        postMother:motherVal,
        postGuardian:guardianVal,
        postCnum:cnumVal,
        postPic:picVal,
        postBirth:birthVal,
        postF137:f137Val,
        postGood:goodVal,
        postReport:reportVal,
        postAcad:acadVal,
        postGrad:gradVal,
        postChoir:choirVal,
        postEarly:earlyVal,
        postFriend:friendVal,
        postLoyal:loyalVal,
        postQe:qeVal
      },function(suck){
        $("#msg").html(suck);
        var success = $("#enroll-success").val();
        if(success==1){

          var snum = $('#mySnum').val();
          window.location.replace("e-form-pay.php?snum="+snum);
        }
      });

  });

});
