$(document).ready(function(){

  // ini();
  // function ini(){
  //     var hidViewMsg = $("#hid-view-msg").val();
  //
  //     $.post("actions/books/view-msg.php",{
  //       postView:hidViewMsg
  //     },
  //     function(viewMsg){
  //       $("#view-msg").html(viewMsg);
  //     });
  // }
  ini();
  function ini(){
    $("#form-import").hide();
      var show = $("#show").val();
      $.post("includes/tbl-data.php",{
        postShow:show
      },function(booktable){ $("#book-table").html(booktable); });
  }
  $("#btn-cancel-import").click(function(){
    $("#form-import").hide();
  });

  $("#btn-import").click(function(){
      $("#form-import").fadeToggle("fast","swing");
  });


  //DROPDOWN SELECT STATUS
  $("#show").change(function(){
    $("#book-table").html("Loading...");
    var show = $("#show").val();
    //alert(show);
    $.post("includes/tbl-data.php",{
        postShow:show
      },function(booktable){
        //alert(show);
        $("#book-table").html(booktable);
    });
  });


  //SEARCH BAR
  $("#search").keyup(function(){
    searchNow();
  });

  function searchNow(){
    $("#book-table").html("Loading...");
    var search = $("#search").val();
    var filter = $("#hid-show-filter").val();
    $.post("includes/tbl-data.php",{
        postSearch:search,
        postFilter:filter
      },function(booktable){
        $("#book-table").html(booktable);
    });
  }
  function showFilter(){
    var setFilter = $("#hid-show-filter").val();
    $("#show-filter").html(setFilter);

    var search = $("#search").val();
    if(search!=""){
      searchNow();
    }

  }

  $("#filter1").click(function(){
    $("#hid-show-filter").val("All");
    showFilter();
  });
  $("#filter2").click(function(){
    $("#hid-show-filter").val("Title");
    showFilter();
  });
  $("#filter3").click(function(){
    $("#hid-show-filter").val("Author");
    showFilter();
  });
  $("#filter4").click(function(){
    $("#hid-show-filter").val("Category");
    showFilter();
  });


  //UPDATE
  $("#btn-save-book").click(function(){

    var upbooks = $("#up-books").val();

    if(upbooks!=1){
      $("#edit-msg").html("<div class='alert alert-warning'><strong>Failed.</strong>  Updating Data is disabled by your admin.</div>");
      $('#btn-save-book').attr("disabled","disabled");
    }else{
      $('#btn-save-book').removeAttr("disabled");

      var id = $("#edit-id").val();
      var code = $("#edit-code").val();
      var title = $("#edit-title").val();
      var author = $("#edit-author").val();
      var descrip = $("#edit-descrip").val();
      var edition = $("#edit-edition").val();
      var cat = $("#edit-cat").val();
      var qty = $("#edit-qty").val();
      var stat = $("#edit-stat").val();


      if(title==""){
        $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Name/Title must specify.</div>");
      }else{
        if(qty==""){
          $("#edit-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Quantity must specify.</div>");
        }else{
          $("#edit-msg").html("<div class='alert alert-info'><strong>Saving..</strong> Please wait..</div>");
          $.post("actions/books/l-action-saveBook.php",{
            postId:id,
            postCode:code,
            postTitle:title,
            postAuthor:author,
            postDescrip:descrip,
            postEdi:edition,
            postCat:cat,
            postQty:qty,
            postStat:stat
          }
          ,function(editMsg){
            ini();
            $("#edit-msg").html(editMsg);
          });
        }
      }
    }

  });

  $('#btn-add-book').click(function(){
    var code = $("#new-code").val();
    var title = $("#new-title").val();
    var author = $("#new-author").val();
    var edition = $("#new-edition").val();
    var descrip = $("#new-descrip").val();
    var cat = $("#new-cat").val();
    var qty = $("#new-qty").val();

    if(code==""){
      $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong> Code must specify.</div>");
    }else{
      if(title==""){
        $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Name/Title must specify.</div>");
      }else{
        if(qty==""){
          $("#add-msg").html("<div class='alert alert-danger'><strong>Failed!</strong>  Quantity must specify.</div>");
        }else{
          $("#add-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
          $.post("actions/books/l-action-addBook.php",{
            postCode:code,
            postTitle:title,
            postAuthor:author,
            postEdi:edition,
            postDescrip:descrip,
            postCat:cat,
            postQty:qty
          }
          ,function(addMsg){
            $("#add-msg").html(addMsg);
          });
        }
      }
    }


  });

  $('#btn-clear-field').click(function(){
    $("#new-code").val("");
    $("#new-title").val("");
    $("#new-author").val("");
    $("#new-edition").val("");
    $("#new-qty").val("");
    $("#add-msg").html("");
  });

  //function for DELETE
  $(document).on( "click", "#a", function(){
     trid = $(this).closest('tr').attr('id');
     $('#id-selector').val(trid);
   });

   //function for EDIT
   $(document).on( "click", "#b", function(){
      $("#edit-msg").html("Loading...");
      $("#book-data").empty();

      trid = $(this).closest('tr').attr('id');
      $('#id-selector').val(trid);
      $.post("includes/editModalData.php",{
        postId: trid
      },function(editData){
        $("#edit-msg").empty();
        $("#book-data").html(editData);
      });

    });


  $('button[name="del_book"]').click(function(){
    var id = $("#id-selector").val();
    $("#view-msg").html("<div class='alert alert-info'><strong>Loading..</strong> Please wait..</div>");
    $.post("actions/books/l-action-delBook.php",{postId:id},function(viewMsg){
      $("#view-msg").html(viewMsg);
      window.location.replace("l-books.php?msg=0");
      $("#view-msg").html(viewMsg);
    });

  });




});
