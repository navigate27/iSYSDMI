<?php
$page = "grading";
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

    <title>DMI - Grading Portal</title>
  <?php
    include("linksource.php");
  ?>
</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");

        $mysubj = $db->query("select * from subjects where tnum='$user'");
        $mysubj = $mysubj->num_rows;

        $mysect = $db->query("select * from sections where tnum='$user'");
        if($mysect->num_rows!=0){
          while($rows=$mysect->fetch_assoc())
          {
            $level_id = $rows['level_id'];
          }
          $mystud = $db->query("select * from student_records where level='$level_id'");
          $mystud = $mystud->num_rows;
        }else{
          $mystud = "0";
        }

        $studrec = $db->query("select * from student_records") or die("Can't complete process. Please contact your Administrator.");
        $nostud = $studrec->num_rows;
        $pernote = $db->query("select * from gr_notes where tnum='$user' and stat=1") or die("Can't complete process. Please contact your Administrator.");
        $nonotes = $pernote->num_rows;

      include("menu-bar.php");
      ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
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
                                    <div class="huge"><?php echo $mysubj; ?></div>
                                    <div>My Subjects</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-accounts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Subjects</span>
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
                                    <div class="huge"><?php echo $mystud; ?></div>
                                    <div>My Students</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View students</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nonotes; ?></div>
                                    <div>My Notes</div>
                                </div>
                            </div>
                        </div>
                        <a href="gr-notes.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Notes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow" style="background:red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>Section Overview</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-form.php" target="_blank">
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
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa  fa-tags"></i>List of Honors
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <th>Rank #</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>General Average</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>Silva</td>
                                  <td>Jason</td>
                                  <td>Doug</td>
                                  <td>99.891</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                            <!-- /.list-group -->
                              <!--<a href="#" class="btn btn-default btn-block">View all</a>-->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                  </div>

                </div>

                <!--footer -->
                		<div id="footer-container">
                			<div id="copyright">
                				<p></p>
                			</div>
                		</div>



        </div>
    </div>

</body>

</html>
