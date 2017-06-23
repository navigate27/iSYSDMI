<?php




if(isset($_POST['postId'])){
  include("../../dmiconnect.php");
  $settings = $db->query("select * from settings ") or die("Error. Settings.");
    while($rows=$settings->fetch_assoc())
    {
      $upbooks = $rows['upbooks'];
      $delbooks = $rows['delbooks'];
    }

  $bid = $_POST['postId'];

  $findbook = $db->query("select * from lib_books where id='$bid' ") or die("Error. Lib_Books.");
    while($rows=$findbook->fetch_assoc())
    {
      $code = $rows['code'];
      $title = $rows['title'];
      $author = $rows['author'];
      $edtn = $rows['edition'];
      $descrip = $rows['descrip'];
      $cat = $rows['cat'];
      $qty = $rows['qty'];
      $stat = $rows['stat'];
    }


}
?>
<form class='form-horizontal'>
  <input type='hidden' id='edit-id' value='<?php echo $bid; ?>'>
  <div class='form-group'>
    <label class='control-label col-sm-2'>Code: </label>
      <div class='col-sm-10'>
        <input type='text' id='edit-code' class='form-control' value='<?php echo $code; ?>'>
      </div>
  </div>
  <div class='form-group'>
    <label class='control-label col-sm-2'>Name/Title: </label>
      <div class='col-sm-10'>
        <input type='text' id='edit-title' class='form-control' value='<?php echo $title; ?>' >
      </div>
  </div>
  <div class='form-group'>
    <label class='control-label col-sm-2'>Author: </label>
      <div class='col-sm-10'>
        <input type='text' id='edit-author' class='form-control' value='<?php echo $author; ?>' >
      </div>
  </div>
  <div class='form-group'>
    <label class='control-label col-sm-2'>Edition: </label>
      <div class='col-sm-10'>
        <textarea id='edit-edition' class='form-control' ><?php echo $edtn; ?></textarea>
      </div>
  </div>
  <div class='form-group'>
    <label class='control-label col-sm-2'>Description: </label>
      <div class='col-sm-10'>
        <textarea id='edit-descrip' class='form-control' ><?php echo $descrip; ?></textarea>
      </div>
  </div>
  <div class='form-group'>
    <label class='control-label col-sm-2'>Category: </label>
    <div class="form-inline">
      <div class='col-sm-10'>
        <select name='cat' id='edit-cat' class='form-control'>
          <?php
          $findcat = $db->query("select * from lib_books_cat ") or die("Error. Lib_Books_Cat.");
            while($rows=$findcat->fetch_assoc())
            {
              $category = $rows['category'];

              echo "<option "; if($cat==$category){ echo "selected";} echo ">$category</option>";
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
        <input type='number' id='edit-qty' class='form-control' value='<?php echo $qty; ?>' >
      </div>
    </div>
  </div>
  <div class='form-group'>

<?php
if($stat!=2){
?>
  <label class='control-label col-sm-2'>Status: </label>
  <div class="form-inline">
    <div class='col-sm-10'>
      <select name='cat' id='edit-stat' class='form-control'>
        <option value='1' <?php if($stat==1){ echo "selected"; } ?> >Active</option>
        <option value='0' <?php if($stat==0){ echo "selected"; } ?> >Disabled</option>
        <option value='3' <?php if($stat==3){ echo "selected"; } ?> >Lost</option>
        <option value='4' <?php if($stat==4){ echo "selected"; } ?> >Damaged</option>
      </select>
    </div>
  </div>
<?php
}else{

  echo "<div class='alert alert-warning text-center'>Unable to update status because the book/item is borrowed.</div>";
  echo "<input type='hidden' id='edit-stat' value='2'>";
}
?>
  </div>

</form>
