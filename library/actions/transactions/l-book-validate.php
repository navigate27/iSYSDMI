<?php
include("../../../dmiconnect.php");

  $postCode = $_POST['partCode'];

  $query = $db->query("SELECT * FROM lib_books WHERE code='$postCode'")or die("Unable to connect");
  if($query->num_rows!=0){
    while($rows=$query->fetch_assoc())
    {
      $title = $rows['title'];
      $author = $rows['author'];
      $edition = $rows['edition'];
      $qty = $rows['qty'];
      $stat = $rows['stat'];
    }

      if($qty!=0){
        if($stat==1||$stat==2){
?>
    <div class="form-group">
      <label for="title" class="control-label col-sm-2">Name/Title: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="title" value="<?php echo $title; ?>" readonly>
        </div>
    </div>

    <div class="form-group">
      <label for="author" class="control-label col-sm-2">Author: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="author" value="<?php echo $author; ?>" readonly>
        </div>
    </div>

    <div class="form-group">
      <label for="author" class="control-label col-sm-2">Edition: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="edition" value="<?php echo $edition; ?>" readonly>
        </div>
    </div>
    <div class="form-group">
      <label for="author" class="control-label col-sm-2">Quantity: </label>
        <div class="col-sm-10">
          <input type="text" id="book-qty" class="form-control" name="qty" value="<?php echo $qty; ?>" readonly>
        </div>
    </div>
    <script>
    $("#borrow-stat").val("1");
    </script>
<?php
    }else{

          echo "
          <div class='alert alert-warning'>
              <strong>Book/Item is unavailable.</strong> The book/item you requested is lost/damage.
          </div>
          <script>
            $('#borrow-stat').val('0');
          </script>
          ";

    }
  }else{
?>
        <div class="alert alert-warning">
            <strong>Out of stock.</strong> The book/item you requested has 0 available stock.
        </div>
        <script>
          $("#borrow-stat").val("0");
        </script>
<?php
    }
  }else{
?>

  <div class="alert alert-danger">
      <strong>Invalid Code.</strong> Code doesn't exist.
  </div>
  <script>
  $("#borrow-stat").val("0");
  </script>
<?php
    }
?>
