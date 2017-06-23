<?php
  include("../../dmiconnect.php");
  $settings = $db->query("select * from settings ") or die("Error. Settings.");
    while($rows=$settings->fetch_assoc())
    {
      $upbooks = $rows['upbooks'];
      $delbooks = $rows['delbooks'];
    }

    if(isset($_POST['postShow'])){
      $show = $_POST['postShow'];
      if($show!=""){
        $bquery = "select * from lib_books where stat='$show'";
      }else{
        $bquery = "select * from lib_books";
      }
    }else if(isset($_POST['postSearch'])){
      $search = $_POST['postSearch'];
      $filter = $_POST['postFilter'];

      if($search!=""){

        switch ($filter) {
          case 'All':
            $bquery = "select * from lib_books where title like '%$search%' or author like '%$search%' or descrip like '%$search%' ";
          break;
          case 'Title':
            $bquery = "select * from lib_books where title like '%$search%' ";
          break;
          case 'Author':
            $bquery = "select * from lib_books where author like '%$search%' ";
          break;
          case 'Category':
            $bquery = "select * from lib_books where cat like '%$search%' ";
          break;

        }

      }else{
        $bquery = "select * from lib_books";
      }
    }else{
      $bquery = "select * from lib_books";
    }

?>
<table id="examples" class="table table-bordered" cellspacing="0">
  <thead>
    <tr>
      <th>ID#</th>
      <th>Code</th>
      <th>Name/Title</th>
      <th>Author</th>
      <th>Category</th>
      <th>Qty</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php

    $booksquery = $db->query($bquery) or die("Can't complete process. Please contact your Administrator.");
    if($booksquery->num_rows!=0)
    {
      while($rows=$booksquery->fetch_assoc())
      {
        $id = $rows['id'];
        $code = $rows['code'];
        $title = $rows['title'];
        $author = $rows['author'];
        // $edtn = $rows['edition'];
        // $descrip = $rows['descrip'];
        $cat = $rows['cat'];
        $qty = $rows['qty'];
        $date = $rows['date'];
        $stat = $rows['stat'];

        // if(strlen($descrip)>25){
        //   $condescrip = substr($descrip,0,15);
        //   $condescrip = "<span data-toggle='tooltip' data-placement='top' title='$descrip'>$condescrip...</span>";
        // }else{
        //   $condescrip = $descrip;
        // }
        // if(strlen($edtn)>15){
        //   $conedtn = substr($edtn,0,15);
        //   $conedtn = "<span data-toggle='tooltip' data-placement='top' title='$edtn'>$conedtn...</span>";
        // }else{
        //   $conedtn = $edtn;
        // }

        $availq = $db->query("select * from lib_transact where book_code='$code' and stat=1 "); //Determine how many rows that the code is used in the lib_transact
        $rowUsed = $availq->num_rows;


        echo "<div class='popover-demo'>";
          if($stat==1){
            $statcell = "<a class='btn btn-success btn-block'>Active</a>";
          }else if($stat==2){
            $statcell = "<a data-toggle='popover' title='$qty available' data-placement='left' data-content='$rowUsed borrowed' class='btn btn-warning btn-block'>Out</a>";
          }else if($stat==0){
            $statcell = "<a class='btn btn-danger btn-block'>Disabled</a>";
          }else if($stat==3){
            $statcell = "<a class='btn btn-warning btn-block'>Lost</a>";
          }else if($stat==4){
            $statcell = "<a class='btn btn-warning btn-block'>Damage</a>";
          }
        echo "</div>";
        echo "
        <tr id='$id'>
          <input type='hidden' id='code' value='$code'>
          <td>$id</td>
          <td>$code</td>
          <td>$title</td>
          <td>$author</td>
          <td>$cat</td>
          <td>$qty</td>
          <td>$statcell</td>
          <td class='text-center'>
          <div class='tooltip-demo'>
          <span data-toggle='tooltip' data-placement='top' title='Edit'>
            <button name='btn-edit' id='b' class='btn btn-primary' data-toggle='modal' data-target='#editBook'>
              <div class='fa fa-pencil'>
              </div>
            </button>
          </span>
          <!--<span data-toggle='tooltip' data-placement='top' title='Remove'>
              <button name='btn-del' id='a' class='btn btn-danger' data-toggle='modal' data-target='#delBook$id'>
                <div class='fa fa-trash'>
                </div>
              </button>
            </span>-->
          </div>

          </td>
          </tr>";

        if($stat==2){// 2 = Unavailable
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
            if($delbooks!=1){// 0 = Delete Disabled
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
            }else{ // 1 = Confirm Delete
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
    }else{

      echo "No results found.";

    }
      ?>
    </tbody>
  </table>

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
