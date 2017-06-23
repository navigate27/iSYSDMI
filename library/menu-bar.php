<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background:#feefed">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color:#7d3333">Library Portal</a>
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
                    <a href="l-transaction.php"><i class="fa fa-steam fa-fw"></i> Transaction</span></a>
                </li>
                <li>
                    <a href="l-books.php"><i class="fa fa-book fa-fw"></i> Books & Items</span></a>
                </li>
                <li>
                    <a href="l-overview.php"><i class="fa fa-bar-chart-o fa-fw"></i> Overview</a>
                </li>
                <li>
                    <a href="l-settings.php"><i class="fa fa-cogs fa-fw"></i> Settings</a>
                </li>
                <?php
                if($f_type!=1){
                ?>
                <li>
                  <a href="l-notes.php"><i class="fa fa-edit fa-fw"></i> Notes</a>
                </li>
                <?php
                }
                ?>
                <!-- <li>
                    <a href="l-import.php"><i class="fa fa-upload fa-fw"></i> Import</a>
                </li> -->
                <li>
                    <a href="../sign-out.php"><i class="fa fa-sign-out fa-fw"></i> Sign Out</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>
