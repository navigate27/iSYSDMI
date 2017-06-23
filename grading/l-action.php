<?php

if(isset($_GET['action']))
{
  $action = $_GET['action'];
  switch($action){
  case 'add':
  add();
  break;
  case 'edit':
  edit();
  break;
  case 'save':
  save();
  break;
  }
}

function add(){

  $do = $_GET['do'];
  switch($do){
  case 'books':
  addBooks();
  break;
  }

}
function edit(){

  $do = $_GET['do'];
  switch($do){
  case 'books':
  editBooks();
  break;
  }

}


function addBooks(){
include("../dmiconnect.php");
$code = $_POST['code'];
$title = $_POST['title'];
$author = $_POST['author'];
$descrip = $_POST['descrip'];
$cat = $_POST['cat'];
$qty = $_POST['qty'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$date = "$month/$day/$year";

$title = mysql_real_escape_string($title);
$author =  mysql_real_escape_string($author);
$descrip = mysql_real_escape_string($descrip);

$query = $db->query("insert into lib_books (code,title,author,descrip,cat,qty,date) values('$code','$title','$author','$descrip','$cat','$qty','$date')") or die("Can't complete process. Please contact your Administrator.");

header("location: l-books.php");

}
function editBooks(){
include("../dmiconnect.php");
$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$descrip = $_POST['descrip'];
$cat = $_POST['cat'];
$qty = $_POST['qty'];

$title = mysql_real_escape_string($title);
$author =  mysql_real_escape_string($author);
$descrip = mysql_real_escape_string($descrip);

$query = $db->query("update lib_books set title='$title',author='$author',descrip='$descrip',cat='$cat',qty='$qty' where id='$id' ") or die("Can't complete process. Please contact your Administrator.");

header("location: l-books.php");

}

function save(){

  $do = $_GET['do'];

  switch($do){
    case 'notes':
    saveNotes();
    break;


  }

}


function saveNotes(){
  include("../dmiconnect.php");
  echo $pnotes = $_POST['pnotes'];
  $date =  date("m/d/Y - h:i:sa");
  $query = $db->query("insert into e_notes(notes,date) values('".$pnotes."','$date')") or die("Can't complete process. Please contact your Administrator.");

 header("location:e-notes.php");


}
?>
