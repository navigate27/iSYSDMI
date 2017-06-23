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
</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");

        $lib_books = $db->query("select * from lib_books") or die("Can't complete process. Please contact your Administrator.");
        $nobooks = $lib_books->num_rows;
        $pernote = $db->query("select * from lib_notes where stat=1") or die("Can't complete process. Please contact your Administrator.");
        $nonotes = $pernote->num_rows;
        $libtrans = $db->query("select * from lib_transact") or die("Can't complete process. Please contact your Administrator.");
        $notrans = $libtrans->num_rows;
        $actvlibtrans = $db->query("select * from lib_transact where stat=1") or die("Can't complete process. Please contact your Administrator.");
        $actvnotrans = $actvlibtrans->num_rows;

      include("menu-bar.php");
      ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Library Dashboard</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bookmark fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $actvnotrans; ?></div>
                                    <div>Borrow</div>
                                </div>
                            </div>
                        </div>
                        <a href="l-transaction.php?transaction=borrow">
                            <div class="panel-footer">
                                <span class="pull-left">Borrow A Book</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nobooks; ?></div>
                                    <div>Books</div>
                                </div>
                            </div>
                        </div>
                        <a href="l-books.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Books</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <?php
                if($f_type!=1){
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nonotes; ?></div>
                                    <div>Personal Notes</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-notes.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Notes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                }else{
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $notrans; ?></div>
                                    <div>Transaction Logs</div>
                                </div>
                            </div>
                        </div>
                        <a href="l-transaction.php">
                            <div class="panel-footer">
                                <span class="pull-left">View logs</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>Month Overview</div>
                                </div>
                            </div>
                        </div>
                        <a href="l-overview.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Overview</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="glyphicon  glyphicon-transfer"></i> Transaction History
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                              <?php
                                  $lib_trans = $db->query("select * from lib_transact order by date desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                    if($lib_trans->num_rows!=0)
                                    {
                                      while($rows=$lib_trans->fetch_assoc())
                                      {
                                        $school_id = $rows['snum'];
                                        $id = $rows['id'];
                                        $date = $rows['date'];
                                        $book_code = $rows['book_code'];
                                        $date = date("M d, Y",strtotime($date));
                                          $teach_rec = $db->query("select * from teacher_records where tnum='$school_id' ") or die("Can't complete process. Please contact your Administrator.");
                                          $stud_rec = $db->query("select * from student_records where snum='$school_id' ") or die("Can't complete process. Please contact your Administrator.");
                                          if($stud_rec->num_rows){
                                            while($rows=$stud_rec->fetch_assoc())
                                             {
                                               $fname = $rows['fname'];
                                               $lname = $rows['lname'];
                                               $mname = $rows['mname'];
                                             }
                                          }else if($teach_rec->num_rows){
                                              while($rows=$teach_rec->fetch_assoc())
                                               {
                                                 $fname = $rows['fname'];
                                                 $lname = $rows['lname'];
                                                 $mname = $rows['mname'];
                                               }
                                          }

                                            echo "
                                            <a class='list-group-item'>
                                                $fname $mname[0]. $lname
                                                <span class='pull-right text-muted small'><em>$date</em>
                                                </span>
                                            </a>
                                            ";
                                      }
                                    }else{
                                      echo "<h4><p class='text-danger text-center'>No book borrowers.<i class='fa fa-frown-o'></i></p></h4>";
                                    }
                                ?>

                            </div>
                            <a href='l-transaction.php' class='btn btn-success btn-block'>View all</a>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="panel panel-info">
                          <div class="panel-heading">
                              <i class="glyphicon  glyphicon-time"></i> Books
                          </div>
                          <!-- /.panel-heading -->
                          <div class="panel-body">
                              <div class="list-group">
                                <?php
                                include("../dmiconnect.php");

                                    $libbooks = $db->query("select * from lib_books where stat=1 order by id desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                    if($libbooks->num_rows!=0)
                                    {
                                      while($rows=$libbooks->fetch_assoc())
                                      {
                                        $id = $rows['id'];
                                        $title = $rows['title'];
                                        $author = $rows['author'];

                                        echo "<a class='list-group-item'>
                                            $title
                                            <span class='pull-right text-muted small'><em>$author</em>
                                            </span>
                                        </a>";

                                      }
                                    }
                                  ?>

                              </div>
                              <!-- /.list-group -->
                                <a href="l-books.php" class="btn btn-info btn-block">View all</a>
                          </div>
                          <!-- /.panel-body -->
                      </div>
                    </div>
                </div>

                <!--footer -->
                <?php
                include("../footer.php");
                ?>


        </div>
    </div>

</body>

</html>
