<link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="dataTables/datatables.min.js"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>
<?php
include("../../dmiconnect.php");
$settings = $db->query("select * from settings ") or die("Error. Settings.");
  while($rows=$settings->fetch_assoc())
  {
    $upbooks = $rows['upbooks'];
    $delbooks = $rows['delbooks'];
  }
?>
<div class="dataTable_wrapper">
  <div class="table-responsive">
  <table id="example" class="display" cellspacing="0">
    <thead>
      <tr>
        <th>Code</th>
        <th>Name/Title</th>
        <th>Author</th>
        <th>Edition</th>
        <th>Description</th>
        <th>Category</th>
        <th>Qty</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php

      $booksquery = $db->query("select * from lib_books where stat!=0") or die("Can't complete process. Please contact your Administrator.");
      if($booksquery->num_rows!=0)
      {
        while($rows=$booksquery->fetch_assoc())
        {
          $id = $rows['id'];
          $code = $rows['code'];
          $title = $rows['title'];
          $author = $rows['author'];
          $edtn = $rows['edition'];
          $descrip = $rows['descrip'];
          $cat = $rows['cat'];
          $qty = $rows['qty'];
          $date = $rows['date'];
          $stat = $rows['stat'];

          if(strlen($descrip)>15){
            $descrip = substr($descrip,0,15);
            $descrip = "$descrip...";
          }
          if(strlen($edtn)>15){
            $edtn = substr($edtn,0,15);
            $edtn = "$edtn...";
          }
          echo "
          <tr id='$id'>
            <input type='hidden' id='code' value='$code'>
            <td>$code</td>
            <td>$title</a></td>
            <td>$author</td>
            <td>$edtn</td>
            <td>$descrip</td>
            <td>$cat</td>
            <td>$qty</td>
            <td class='text-center'>
            <div class='tooltip-demo'>
              <a class='btn btn-primary' href='l-books.php?book_id=$id' data-toggle='tooltip' data-placement='top' title='Edit'>
                <div class='fa fa-pencil'>
                </div>
              </a>
              <span data-toggle='tooltip' data-placement='top' title='Remove'>
                <button name='btn-del' id='a' class='btn btn-danger' data-toggle='modal' data-target='#delBook$id'>
                  <div class='fa fa-trash'>
                  </div>
                </button>
              </span>
            </div>

            </td>
            </tr>";

          if($stat==2){
            ?>
            <div class="modal fade" id="delBook<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Remove Book/Item</h4>
                  </div>

                  <div class="modal-body">
                    <div class="alert alert-warning"><strong>Sorry. </strong>The book/item you requested is not available.</div>
                  </div>
                  <div class="modal-footer">
                    <input type='hidden' id='<?php echo $id; ?>'>
                      <button class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <?php

          }else{
              if($delbooks!=1){
                  ?>
                  <div class="modal fade" id="delBook<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Remove Book/Item</h4>
                        </div>

                        <div class="modal-body">
                          <div class="alert alert-warning"><strong>Sorry. </strong>Deleting data is disabled by your admin.</div>
                        </div>
                        <div class="modal-footer">
                          <input type='hidden' id='<?php echo $id; ?>'>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
              }else{
                ?>
                <div class="modal fade" id="delBook<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Book/Item</h4>
                      </div>

                      <div class="modal-body">
                        Are you sure you want to remove <strong class="text-primary"><?php echo $title; ?></strong>?
                      </div>
                      <div class="modal-footer">
                        <input type='hidden' id='<?php echo $id; ?>'>
                          <button class="btn btn-default" data-dismiss="modal">No</button>
                          <button name="del_book" id="btn-del-book" data-dismiss="modal" class="btn btn-primary">Yes</button>

                      </div>
                    </div>
                  </div>
                </div>

                <?php
            }
          }
        }
        }
        ?>
      </tbody>
    </table>
  </div>
  </div>
