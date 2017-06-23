<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Grading Portal</a>
    </div>
<!-- /.navbar-header -->


    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                  <div class="text-muted">
                      <img src="../img.php" class="img-circle" width="70" height="65">
                        <a href="#">
                          &nbsp<?php echo "$f_fname $f_mname[0]. $f_lname"; ?>
                        </a>
                      </img>
                  </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                </li>
                <li>
                    <a href="gr-subjects.php"><i class="fa fa-heart fa-fw"></i> Subjects</span></a>
                </li>
                <li>
                    <a href="gr-section.php"><i class="fa fa-star-o fa-fw"></i> Section</span></a>
                </li>
                <li>
                    <a href="gr-summary.php"><i class="fa fa-bar-chart-o fa-fw"></i> Overview</a>
                </li>
                <li>
                    <a href="gr-notes.php"><i class="fa fa-edit fa-fw"></i> Notes</a>
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
