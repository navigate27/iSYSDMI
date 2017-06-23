<?php
$page = "admin";
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

    <title>DMI - Admin Portal</title>
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

        $currentDateTime = date("Y-m-d H:i:s");
        $datetime1 = $currentDateTime;
        $datetime2 = $f_lastsignin;

        include("includes/lastTime.php");


      include("menu-bar.php");
      ?>
        <div id="page-wrapper">



            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Dashboard <a href="#"><span class="text-default pull-right"><i class="fa fa-question-circle"></i></span></a></h1>
                </div>
            </div>

              <blockquote style="background:#fff2fe">
                  <h4 class='text-left text-muted'><i class='fa fa-hand-o-right'></i> Welcome</h4>
                  <h2 class='text-center'>Hello <strong><?php echo $f_fname; ?></strong>!</h2>
                  <h5 class='text-right text-muted small'>Signed in <?php echo $timemsg; ?> ago</h5>
              </blockquote>

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
                                    <div class="huge">&nbsp</div>
                                    <div>Enrollment Portal</div>
                                </div>
                            </div>
                        </div>
                        <a href="../enrollment">
                            <div class="panel-footer">
                                <span class="pull-left">View Enrollment</span>
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
                                    <i class="fa fa-list-ol fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>Grading Portal</div>
                                </div>
                            </div>
                        </div>
                        <a href="../grading">
                            <div class="panel-footer">
                                <span class="pull-left">View Grades</span>
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
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>Library Portal</div>
                                </div>
                            </div>
                        </div>
                        <a href="../library">
                            <div class="panel-footer">
                                <span class="pull-left">View Library</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>Election Portal</div>
                                </div>
                            </div>
                        </div>
                        <a href="../election">
                            <div class="panel-footer">
                                <span class="pull-left">View Election</span>
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
                            <i class="glyphicon  glyphicon-user"></i> New Faculty
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                              <?php

                                  $teachrec = $db->query("select * from teacher_records order by id desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                  if($teachrec->num_rows!=0)
                                  {
                                    while($rows=$teachrec->fetch_assoc())
                                    {
                                      $fname = $rows['fname'];
                                      $tnum = $rows['tnum'];
                                      $lname = $rows['lname'];
                                      $mname = $rows['mname'];
                                      $endate = $rows['endate'];

                                      $condate = date("Y-m-d",strtotime($endate));
                                      $currentDate = date("Y-m-d");


                                      $date1 = new DateTime($currentDate);
                                      $date2 = new DateTime($condate);
                                      $newfac = "";

                                      if($date1>$date2){//get if date now is greater than the other date means it x days ago
                                        $diff = $date2->diff($date1)->format("%a");
                                        if($diff<365){//if less than one year means it is new
                                          $newfac = "<span class='label label-success'>New</span>";
                                        }
                                      }

                                      //echo $diff = $date2->diff($date1)->format("%a");


                                      $endate = date("M d, Y",strtotime($endate));

                                      echo "<a href='a-faculty.php?tnum=$tnum' class='list-group-item'>
                                          $fname $mname[0]. $lname $newfac
                                          <span class='pull-right text-muted small'><em>$endate</em>
                                          </span>
                                      </a>";

                                    }
                                  }
                                ?>

                            </div>
                            <!-- /.list-group -->
                              <?php
                                echo "<a href='a-faculty.php' class='btn btn-success btn-block'>View all</a>";
                              ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="panel panel-warning">
                          <div class="panel-heading">
                              <i class="fa fa-bell"></i> System Activities
                          </div>

                          <div class="panel-body">
                              <div class="list-group">
                                <?php
                                include("../dmiconnect.php");
                                    $actvt = $db->query("select * from activities order by id desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                    if($actvt->num_rows!=0)
                                    {
                                      while($rows=$actvt->fetch_assoc())
                                      {
                                        $activity = $rows['activity'];
                                        $datetime = $rows['datetime'];

                                        $currentDateTime = date("Y-m-d H:i:s");

                                        //always remember $datetime1 and $datetime2 are the variable names for 'last time' algorithm
                                        $datetime1 = $currentDateTime;
                                        $datetime2 = $datetime;

                                        include("includes/lastTime.php");


                                        echo "<a class='list-group-item'>
                                            $activity
                                            <span class='pull-right text-muted small'><em>$timemsg ago</em>
                                            </span>
                                        </a>";

                                      }
                                    }
                                  ?>

                              </div>

                              <?php
                                echo "<button data-toggle='modal' data-target='#viewAct' class='btn btn-warning btn-block'> See all activities</button>";
                              ?>
                          </div>

                      </div>
                    </div>

                </div>


                <div class="row">

                      <div class="col-lg-8">
                          <div class="panel panel-info">
                              <div class="panel-heading">
                                  <i class="fa fa-user"></i> Recent Enrollees
                              </div>

                              <div class="panel-body">
                                  <div class="list-group">
                                    <?php
                                    include("../dmiconnect.php");
                                        $studrec = $db->query("select * from student_records order by id desc limit 10 ") or die("Can't complete process. Please contact your Administrator.");
                                        if($studrec->num_rows!=0)
                                        {
                                          while($rows=$studrec->fetch_assoc())
                                          {
                                            $fname = $rows['fname'];
                                            $lname = $rows['lname'];
                                            $mname = $rows['mname'];
                                            $snum = $rows['snum'];
                                            $endate = $rows['endate'];
                                            $type = $rows['type'];

                                            if($type==1){
                                              $newstud = "<span class='label label-success'>New</span>";
                                            }

                                            $endate = date("M d, Y",strtotime($endate));

                                            echo "<a href='a-students.php?snum=$snum' class='list-group-item'>
                                                $fname $mname[0]. $lname $newstud
                                                <span class='pull-right text-muted small'><em>$endate</em>
                                                </span>
                                            </a>";

                                          }
                                        }
                                      ?>

                                  </div>

                                  <?php
                                    echo "<a href='a-students.php' class='btn btn-success btn-block'>View all</a>";
                                  ?>
                              </div>

                          </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <i class="glyphicon  glyphicon-user"></i> New Students
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                      <?php
                                      include("../dmiconnect.php");
                                          $findlvl = $db->query("select * from levels order by id asc ");
                                            while($rows=$findlvl->fetch_assoc())
                                            {
                                              $level_id = $rows['id'];
                                              $level = $rows['level'];
                                              echo "<a class='list-group-item'>$level ";
                                              $temp_rowCount = 0;
                                              $findsect = $db->query("select * from sections where level_id='$level_id' ");
                                                while($rows=$findsect->fetch_assoc())
                                                {
                                                  $section_id = $rows['id'];
                                                  $stud_count = $db->query("select * from student_records where section='$section_id' ");
                                                  $rowCount = $stud_count->num_rows;
                                                  $temp_rowCount = $rowCount + $temp_rowCount;
                                                }

                                              if($temp_rowCount==0){
                                                $temp_rowCount = "";
                                              }
                                              echo "<em class='pull-right'><i class='fa fa-users text-primary'></i> <span class='label label-success'>$temp_rowCount</span></em>";
                                              echo "</a>";
                                            }
                                        ?>

                                    </div>

                                    <?php
                                    if($studrec->num_rows>10){
                                      echo "<a href='a-students.php' class='btn btn-success btn-block'>View all</a>";
                                    }
                                    ?>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                          </div>

                    </div>

                    <!-- Modal All Activities-->
                    <div class="modal fade" id="viewAct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title" id="myModalLabel"><span class="text-warning">All <strong>Activities</strong></strong></h3>
                                </div>
                                <div class="modal-body" style="height:500px;overflow-y:auto">
                                  <?php
                                  include("../dmiconnect.php");
                                      $actvt = $db->query("select * from activities order by datetime desc") or die("Can't complete process. Please contact your Administrator.");
                                      if($actvt->num_rows!=0)
                                      {
                                        while($rows=$actvt->fetch_assoc())
                                        {
                                          $activity = $rows['activity'];
                                          $datetime = $rows['datetime'];

                                          $currentDateTime = date("Y-m-d H:i:s");

                                          //always remember $datetime1 and $datetime2 are the variable names for 'last time' algorithm
                                          $datetime1 = $currentDateTime;
                                          $datetime2 = $datetime;

                                          include("includes/lastTime.php");


                                          echo "<a class='list-group-item'>
                                              $activity
                                              <span class='pull-right text-muted small'><em>$timemsg ago</em>
                                              </span>
                                          </a>";

                                        }
                                      }
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                <!--footer -->
                <?php
                include("../footer.php");
                ?>

        </div>
    </div>
</body>

</html>
