  $(document).ready(function(){

    function borrowValidate(){
      var bstat = $("#borrow-stat").val();
      if(bstat==0){
        $("#btn-borrow-book").attr("disabled","disabled");
      }else{
        $("#btn-borrow-book").removeAttr("disabled");
      }
    }

      $("#input-snum").keyup(function(){
        $("#stud_data").html("<div class='alert alert-info'><strong>Searching...</strong> Please wait..</div>");
          var value = $("#input-snum").val();
          if(value!=""){
            $.post("actions/transactions/l-student-validate.php",{partSnum:value},function(data){
              $("#stud_data").html(data);
              borrowValidate();
            });
          }else{
            $("#stud_data").html("<div class='alert alert-warning'>Please input school ID.</div>");
          }

      });

      $("#input-code").keyup(function(){
        $("#book_data").html("<div class='alert alert-info'><strong>Searching...</strong> Please wait..</div>");
            var value = $("#input-code").val();
            if(value!=""){
              $.post("actions/transactions/l-book-validate.php",{partCode:value},function(data){
                $("#book_data").html(data);

                var book_qty = $("#book-qty").val();
                if(book_qty==1){
                  $("#book-msg").html("<div class='alert alert-warning'><strong><i class='fa fa-info-circle'></i> Warning!</strong> There is only one available book/item.</div>");
                }else{
                  $("#book-msg").html("");
                }

                borrowValidate();
              });
            }else{
              $("#book_data").html("<div class='alert alert-warning'>Please input code.</div>");
            }

      });


      $("#form-borrow").submit(function(pip){
          pip.preventDefault();
          var snum = $("#input-snum").val();
          var code = $("#input-code").val();
          var bdate = $("#bdate").val();
          // var bdue = $("#bdue").val();
          var bdays = $("#bdays").val();

          if(snum==""){
            $("#save_data").html("<div class='alert alert-warning'>Please input school ID.</div>");
          }else{
            if(code==""){
              $("#save_data").html("<div class='alert alert-warning'>Please input code.</div>");
            }else{
              $("#save_data").html("<div class='alert alert-info'><strong>Loading...</strong> Please wait..</div>");
              $.post("actions/transactions/l-transaction-save.php"
              ,{
                postSnum:snum,
                postCode:code,
                postBdate:bdate,
                // postBdue:bdue
                postBdays:bdays
              }
              ,function(data){
                $("#save_data").html(data);
                var bstat = $("#borrow-stat").val();
                if(bstat==0){
                  $("#btn-borrow-book").attr("disabled","disabled");
                }else{
                  window.location.replace("l-transaction.php");
                }


              });
            }
          }
      });

  });
