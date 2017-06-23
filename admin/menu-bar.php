<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Admin Portal</a>
    </div>
<!-- /.navbar-header -->


    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                  <div class="text-muted">
                      <!-- <img src="../img.php" class="img-circle" width="70" height="65"> -->
                      <div class="text-left">
                        <!-- <div class="fa fa-user fa-2x"></div> -->
                        <?php echo "$f_fname $f_mname[0]. $f_lname"; ?>
                        <br>
                        <?php echo $f_tnum; ?>
                      </div>
                      <!-- </img> -->
                  </div>
                </li>
                <li>
                  <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-chevron-circle-right fa-fw"></i> Portal<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                          <a href="../enrollment/">Enrollment</a>
                      </li>
                      <li>
                        <a href="../grading/">Grading</a>
                      </li>
                      <li>
                          <a href="../library/">Library</a>
                      </li>
                      <li>
                          <a href="../election/">Election</a>
                      </li>
                    </ul>
                </li>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks fa-fw"></i> Manage<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                          <a href="a-sections.php">Section</a>
                      </li>
                        <li>
                            <a href="a-subjects.php">Subjects</a>
                        </li>
                        <li>
                            <a href="a-faculty.php">Faculty</a>
                        </li>
                        <li>
                            <a href="a-students.php">Students</a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="e-notes.php"><i class="glyphicon glyphicon-stats"></i> Grade Validation</a>
                </li> -->
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Overview Report<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                          <a href="a-summary-students.php">Students</a>
                        </li>
                        <li>
                            <a href="a-summary-enrollment.php">Enrollment</a>
                        </li>
                        <li>
                        <li>
                            <a href="a-summary-library.php">Library</a>
                        </li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="a-accounts.php"><i class="fa fa-users fa-fw"></i> User Accounts</a>
                </li>
                <li>
                    <a href="a-settings.php"><i class="fa fa-gears fa-fw"></i> Settings</a>
                </li>
                <li>
                    <a href="a-notes.php"><i class="fa fa-edit fa-fw"></i> Notes</a>
                </li>
                <li>
                    <a href="../sign-out.php"><i class="fa fa-sign-out fa-fw"></i> Sign Out</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>
