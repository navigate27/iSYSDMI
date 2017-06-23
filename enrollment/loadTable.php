<!-- <link rel="stylesheet" type="text/css" href="dataTables/datatables.min.css"/>
<script type="text/javascript" src="dataTables/datatables.min.js"></script> -->
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-table"></i> Student Accounts</h1>
  </div>
</div>
<div class="panel panel-primary" width="50%">
  <div class="panel-heading">
      Account Table
  </div>
          <div class="panel-body">
            <div class="dataTable_wrapper">
              <div class="table-responsive">
              <table id="example" class="display" cellspacing="0">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Student No.</th>
                      <th>Name</th>
                      <th>Grade/Level</th>
                      <th>Balance</th>
                      <th>Last Payment</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                      include("../dmiconnect.php");
                  $q = $db->query("select * from student_records order by endate desc");
                  $num = 1;
                    while($rows=$q->fetch_assoc())
                    {
                      $snum = $rows['snum'];
                      $fname = $rows['fname'];
                      $mname = $rows['mname'];
                      $lname = $rows['lname'];
                      $age = $rows['age'];
                      $section_id = $rows['section'];


                      $findsect = $db->query("select * from sections where id='$section_id' ") or die("Can't complete process. Please contact your Administrator.");
                        while($rows=$findsect->fetch_assoc())
                        {
                          $section = $rows['section'];
                          $level_id = $rows['level_id'];
                        }

                        $findlvl = $db->query("select * from levels where id='$level_id' ") or die("Can't complete process. Please contact your Administrator.");
                        while($rows=$findlvl->fetch_assoc())
                        {
                          $level = $rows['level'];
                        }
                          $studfin = $db->query("select * from student_finance where snum='$snum' order by date desc limit 1") or die("Can't complete process. Please contact your Administrator.");
                          while($rows=$studfin->fetch_assoc())
                          {
                            $bbooks = $rows['bbooks'];
                            $btfee = $rows['btfee'];
                            $bpe = $rows['bpe'];
                            $bsc = $rows['bsc'];
                            $bmisc = $rows['bmisc'];
                            $or = $rows['or'];
                            $date = $rows['date'];
                          }
                          $bal = $bbooks+$btfee+$bpe+$bsc+$bmisc;
                          $bal = number_format($bal);

                          $condate = date("M d, Y - h:ia",strtotime($date));

                        echo "
                        <tr>
                            <td>$num</td>
                            <td><a href='e-accounts.php?snum=$snum'>$snum</a></td>
                            <td>$lname, $fname $mname[0].</td>
                            <td>$level - $section</td>
                            <td class='center'>$bal</td>
                            <td class='center'>$condate</td>
                            <td><a href='e-form-pay.php?snum=$snum' class='btn btn-success' title='Pay'>
                              <div class='fa fa-steam'></div></a>
                            </td>
                        </tr>";

                      $num++;
                  }
                ?>

                </tbody>
              </table>
            </div>
            </div>
          </div>
      </div>
<p class="text-right"><a class="btn btn-success" href="#" onClick ="$('#example').tableExport({type:'excel',escape:'false'});">Export to Excel</a></p>
