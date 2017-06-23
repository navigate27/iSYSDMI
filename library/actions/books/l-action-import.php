<?php
  include("../../../dmiconnect2.php");
  // $connect = mysql_connect("localhost","root","");
  // mysql_select_db("dmisms",$connect);
if(isset($_POST['submit'])){

//$file = $_FILES[csv][tmp_name];

// if( 'text/csv' == $file['type'] ||  'application/vnd.ms-excel' == $file['type'] ) {

  if ($_FILES[csv][size] > 0) {

    //get the csv file
    $file = $_FILES[csv][tmp_name];
    $handle = fopen($file,"r");
    $success = true;

    do {

      if ($data[0]) {
        $checkCode = mysql_query("SELECT * FROM lib_books WHERE code='".addslashes($data[0])."' ");

          if(mysql_num_rows($checkCode)!=0){
            $success = false;
            break;
          }else{
            $success = true;
          }

        }

      } while ($data = fgetcsv($handle,1000,",","'"));


      if($success){

        //get the csv file
        $file = $_FILES[csv][tmp_name];
        $handle = fopen($file,"r");

        //loop through the csv file and insert into database
        while ($data = fgetcsv($handle,1000,",","'")){
          $query = mysql_query("INSERT INTO lib_books (code,title,author,edition,descrip,cat,qty) VALUES
          (
            '".addslashes($data[0])."',
            '".addslashes($data[1])."',
            '".addslashes($data[2])."',
            '".addslashes($data[3])."',
            '".addslashes($data[4])."',
            '".addslashes($data[5])."',
            '".addslashes($data[6])."'
            )
            ");
        }

        if($query){
          header('Location: ../../l-books.php?msg=1'); die;
        }else{
          header('Location: ../../l-books.php?msg=2'); die;
        }
      }else{
        $code = $data[0];
        $title = $data[1];
        header("Location: ../../l-books.php?msg=4&code=$code&title=$title");

      }



    }

  // }else{
  //
  //   header('Location: ../../l-books.php?msg=3'); die;
  //
  // }
}

?>
