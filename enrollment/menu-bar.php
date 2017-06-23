<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background:#edf7fc">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color:#184fa9">Enrollment Portal</a>
    </div>
<!-- /.navbar-header -->


    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <?php
                if($f_type==1){
              ?>
                <li>
                    <a href="../admin/index.php"><i class="fa fa-arrow-left fa-fw"></i> Back to Admin</a>
                </li>
              <?php
              }
              ?>
                <li class="sidebar-search">
                  <div class="text-muted">
                      <!-- <img src="../img.php" class="img-circle" width="70" height="65"> -->

                        <div class="text-left">
                          <!-- <div class="fa fa-user fa-2x"></div> -->
                          <?php echo "$f_fname $f_mname[0]. $f_lname"; ?>
                          <br>
                          <?php echo $user; ?>
                        </div>

                      <!-- </img> -->
                  </div>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                </li>
                <li>
                <li>
                    <a href="e-accounts.php"><i class="fa fa-table fa-fw"></i> Financial Accounts</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Enroll<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="e-form-old.php">Old Student</a>
                        </li>
                        <li>
                            <a href="e-form-new.php">New Student</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="e-summary.php"><i class="fa fa-bar-chart-o fa-fw"></i> Overview</a>
                </li>
                <li>
                  <a href="e-fees.php"><i class="fa fa-list-alt fa-fw"></i> Enrollment Fees</a>
                </li>
                <?php
                if($f_type!=1){
                ?>
                <li>
                  <a href="e-notes.php"><i class="fa fa-edit fa-fw"></i> Notes</a>
                </li>
                <?php
                }
                ?>
                <li>
                    <a href="../sign-out.php"><i class="fa fa-sign-out fa-fw"></i> Sign Out</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>
