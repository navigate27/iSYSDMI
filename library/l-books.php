<?php
$page = "library";
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

    <title>DMI - Library Portal</title>
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

<!-- for exporting to EXCEL-->
  <script type="text/javascript" src="export/tableExport.js"></script>
  <script type="text/javascript" src="export/jquery.base64.js"></script>
  <script type="text/javascript" src="export/html2canvas.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
  <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>
    <script type="text/javascript" src="isLoading/jquery.isloading.js"></script>
  <script type="text/javascript" src="myScript/libScript.js"></script>


<!-- not working -->
<script src="myScript/bookScript.js"></script>


</head>

<body>

<div id="wrapper">
      <?php
      include("../dmiconnect.php");
      include("menu-bar.php");

      $settings = $db->query("select * from settings ") or die("Error. Settings.");
        while($rows=$settings->fetch_assoc())
        {
          $upbooks = $rows['upbooks'];
          $delbooks = $rows['delbooks'];
        }
      ?>

<div id="page-wrapper">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-book"></i> Books & Items</h1>

      <?php
        include("includes/messages.php");
      ?>
      <input type="hidden" id="hid-view-msg" value="0">

      <p>
        <button data-toggle='modal' data-target='#addBook' class="btn btn-primary"><div class="fa fa-plus"></div> Add New</button>
        <a href="l-books.php" class="btn btn-outline btn-info"><span class="fa fa-refresh"></span></a>
        <span class="pull-right">
          <a class="btn btn-info" id="btn-import" href="#"><i class="fa fa-upload"></i> Import</a>
          <a href="export/l-export-books.php" class="btn btn-success"><i class="fa fa-download"></i> Export</a>
        </span>
      </p>

        <form action="actions/books/l-action-import.php" method="post" id="form-import" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Click <strong class="text-primary">Choose File</strong> to choose an excel file(.csv)<br />
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <input name="csv" type="file" class="form-control" id="csv" required>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-info" value="Import" />
                    <a id="btn-cancel-import" class="btn btn-default">Cancel</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

<hr>

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <div class="form-inline">
                  <label>Status: </label>
                  <select id='show' class="form-control">
                    <option value=''>All</option>
                    <option value='1'>Active</option>
                    <option value='2'>Borrowed</option>
                    <option value='3'>Lost</option>
                    <option value='4'>Damage</option>
                    <option value='0'>Disabled</option>
                  </select>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter <span class="caret"></span></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="#" id="filter1">None</a></li>
                      <li><a href="#" id="filter2">Title</a></li>
                      <li><a href="#" id="filter3">Author</a></li>
                      <!--<li class="divider"></li>-->
                      <li><a href="#" id="filter4">Category</a></li>
                  </ul>
              </div>

                 <span class="input-group-addon" id="show-filter">All</span>
                <input type="text" id="search" class="form-control">

              <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </div>
        </div>

        <input type="hidden" id="hid-show-filter" value="All">

    </div>
  </div>


  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          List of Books/Items
        </div>
        <div class="panel-body">

          <div class="dataTable_wrapper">
            <div class="table-responsive">
              <div id='book-table'>
              </div>
            </div>
            </div>

            <input type='hidden' id='id-selector'>
            <!-- /.table-responsive -->

            <div id="confirm-del">
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Book</h4>
                  </div>

                  <div class="modal-body">


                      <div id="edit-msg">
                      </div>

                    <div id="book-data">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn-save-book" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!-- New Book Modal -->
            <div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add Book/Item</h4>
                  </div>

                  <div class="modal-body">
                    <div id='add-msg'>
                    </div>

                    <form class='form-horizontal'>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Code: </label>
                        <div class='col-sm-10'>
                          <input type='text' id='new-code' class='form-control'>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Name/Title: </label>
                        <div class='col-sm-10'>
                          <input type='text' id='new-title' class='form-control' >
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Author: </label>
                        <div class='col-sm-10'>
                          <input type='text' id='new-author' class='form-control' >
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Edition: </label>
                        <div class='col-sm-10'>
                          <textarea id='new-edition' class='form-control' ></textarea>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Description: </label>
                        <div class='col-sm-10'>
                          <textarea id='new-descrip' class='form-control' ></textarea>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Category: </label>
                        <div class="form-inline">
                          <div class='col-sm-10'>
                            <select name='cat' id='new-cat' class='form-control'>
                              <?php
                              $findcat = $db->query("select * from lib_books_cat ") or die("Error. Lib_Books_Cat.");
                              while($rows=$findcat->fetch_assoc())
                              {
                                $category = $rows['category'];

                                echo "<option>$category</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2'>Quantity: </label>
                        <div class="form-inline">
                          <div class='col-sm-10'>
                            <input type='number' id='new-qty' class='form-control' >
                          </div>
                        </div>
                      </div>
                    </form>

                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-warning" id='btn-clear-field'>Clear Field</button>
                    <button id="btn-add-book" class="btn btn-primary">Add Data</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


          </div>
        </div>
      </div>
    </div>
    <p class="text-right">

    </p>


            <input type='hidden' id='up-books' value="<?php echo $upbooks; ?>">
            <input type='hidden' id='del-books' value="<?php echo $delbooks; ?>">
<!--footer -->
<?php
include("../footer.php");
?>

</div>
</div>




<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>
<script>
// tooltip demo
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})

// popover demo
$("[data-toggle=popover]")
    .popover()
</script>

</body>






</html>
