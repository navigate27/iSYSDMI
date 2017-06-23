<?php
$page = "enrollment";
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

    <title>DMI - Enrollment Portal</title>
  <?php
    include("linksource.php");
  ?>
</head>
<body>

    <div id="wrapper">
      <?php
      include("../dmiconnect.php");

        $studrec = $db->query("select * from student_records") or die("Can't complete process. Please contact your Administrator.");
        $nostud = $studrec->num_rows;
        $pernote = $db->query("select * from e_notes where stat=1") or die("Can't complete process. Please contact your Administrator.");
        $nonotes = $pernote->num_rows;
        date_default_timezone_set('Asia/Taipei');
        $month =  date("n");
      include("menu-bar.php");
      ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enrollment Dashboard</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-table fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nostud; ?></div>
                                    <div>Financial Accounts</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-accounts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Accounts</span>
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
                                    <i class="fa fa-bar-chart-o fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $month; ?></div>
                                    <div>Summary of Payment</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-summary.php?show=Monthly">
                            <div class="panel-footer">
                                <span class="pull-left">View Summary</span>
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
                                    <div class="huge">10</div>
                                    <div>Enrollment Fees</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-fees.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Fees</span>
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
                    <div class="panel panel-yellow" style="background:red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>Enroll A New Student</div>
                                </div>
                            </div>
                        </div>
                        <a href="e-form-new.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Form</span>
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

                                  $studfin = $db->query("select * from student_finance order by date desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                  if($studfin->num_rows!=0)
                                  {
                                    while($rows=$studfin->fetch_assoc())
                                    {
                                      $snum = $rows['snum'];
                                      $date = $rows['date'];

                                      $studrec = $db->query("select * from student_records where snum='$snum' ") or die("Can't complete process. Please contact your Administrator.");
                                        while($rows=$studrec->fetch_assoc())
                                        {
                                          $fname = $rows['fname'];
                                          $mname = $rows['mname'];
                                          $lname = $rows['lname'];
                                        }

                                        $date = date("M d, Y / h:ia",strtotime($date));

                                      echo "<a href='e-accounts.php?snum=$snum' class='list-group-item'>
                                          $lname, $fname $mname[0].
                                          <span class='pull-right text-muted small'><em>$date</em>
                                          </span>
                                      </a>";

                                    }
                                  }
                                ?>

                            </div>
                            <?php
                              if($studfin->num_rows>10){
                                echo "<a href='e-accounts.php?snum=$snum#payment-history' class='btn btn-success btn-block'>View all</a>";
                              }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="panel panel-info">
                          <div class="panel-heading">
                              <i class="fa fa-user"></i> New Students
                          </div>
                          <!-- /.panel-heading -->
                          <div class="panel-body">
                              <div class="list-group">
                                <?php
                                include("../dmiconnect.php");

                                    $studrec = $db->query("select * from student_records order by endate desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                    if($studrec->num_rows!=0)
                                    {
                                      while($rows=$studrec->fetch_assoc())
                                      {
                                        $snum = $rows['snum'];
                                        $fname = $rows['fname'];
                                        $lname = $rows['lname'];
                                        $mname = $rows['mname'];
                                        $endate = $rows['endate'];
                                        $endate = date("M d, Y",strtotime($endate));
                                        echo "<a href='e-accounts.php?snum=$snum' class='list-group-item'>
                                            $fname $mname[0]. $lname
                                            <span class='pull-right text-muted small'><em>$endate</em>
                                            </span>
                                        </a>";

                                      }
                                    }
                                  ?>

                              </div>
                              <?php
                                if($studrec->num_rows>10){
                                  echo "<a href='e-accounts' class='btn btn-success btn-block'>View all</a>";
                                }
                              ?>
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
