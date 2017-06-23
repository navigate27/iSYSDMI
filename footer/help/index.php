<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DMI - Help Portal</title>
  <?php
    include("linksource.php");
  ?>
  <script src='js/Chart.min.js'></script>
</head>
<body>

    <div id="wrapper">
      <?php
      // include("../../dmiconnect.php");
      include("menu-bar.php");
      ?>


<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class="fa fa-question-circle"></i> HELP </h1>
      </div>
    </div>

    <!-- GENERAL -->
    <div id="ht-open-isys?">
      <div class="panel panel-default" width="50%">
          <div class="panel-heading">
            <h4>How to open iSYS?</h4>
          </div>

          <div class="panel-body">
            <p>First from your desktop, there are 2 ways to open the iSYS</p>
            <p>1. Double click the shortcut icon named iSYS at the desktop. </p>
            <p><img class="img-responsive" src="../help_img/1.0.png"/></p>
            <p>2. Open an internet browser then type the following: 192.168.1.103/isys.</p>
            <p><img class="img-responsive" src="../help_img/1.1.png"/></p>
            <p>After accessing the iSYS through one of the steps on opening it, you may log in the system using your Account Username and Password.</p>

            <div class="alert alert-info">
              <strong>
                <span class="fa fa-info-circle"></span> Note:
              </strong>
              You can get your Account Username and Password through the Administrator of the system
            </div>
          </div>

        </div>
    </div>

    <!-- ADMIN -->
    <div id="w-i-see">
      <div class="panel panel-primary" width="50%">
          <div class="panel-heading">
            <h4>Admin Portal</h4>
          </div>

          <div class="panel-body">

            <p><h3>What I See?</h3></p>
            <p><img class="img-responsive" src="../help_img/2.0.png"/></p>
            <p>This is the dashboard. You can view certain reports from the other systems as well as visit those systems as admin to manage. To view the help for the other system, please refer to the manual found in the pages within the other modules of the system. </p>

            <div class="alert alert-info">
              <strong>
                <span class="fa fa-info-circle"></span> Tip:
              </strong>
              You can always get back at the Home Page by clicking the words “Admin Portal” at the upper left of the page.
            </div>

            <div id="wt-pick">
              <p><h3>What to pick?</h3></p>
              <p><img class="img-responsive" src="../help_img/2.1.png"/></p>
              <p>This is the dashboard. You can view certain reports from the other systems as well as visit those systems as admin to manage. To view the help for the other system, please refer to the manual found in the pages within the other modules of the system. </p>
              <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#manage">Manage</a>
                  <ul>
                    <li><a href="#sections">Sections</a></li>
                    <li><a href="#subjects">Subjects</a></li>
                    <li><a href="#faculty">Faculty</a></li>
                    <li><a href="#student">Student</a></li>
                  </ul>
                </li>
                <li><a href="#ov-report">Overview reports</a>
                  <ul>
                    <li><a href="#s-ov">Student</a></li>
                    <li><a href="#e-ov">Enrollment</a></li>
                    <li><a href="#l-ov">Library</a></li>
                  </ul>
                </li>
                <li><a href="#acc">User Accounts</a></li>
                <li><a href="#setting">Settings</a></li>
                <li><a href="#notes">Notes</a></li>
                <li><a href="#sign-out">Sign Out</a></li>
              </ul>
            </div>

            <div id="dashboard">
              <p><h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3></p>
              <p>This is the way back to the homepage of your portal.  </p>
            </div>



            <!--  MANAGE -->
            <div id="manage">

              <h3 class="page-header"><i class="fa fa-tasks"></i> Manage</h3>
              <!-- Section -->
              <div id="sect">
                <dl>
                  <dt><h4>Section<h4></dt>
                    <dd>
                      Here you can view your sections as well as Adding and Editing information about the selected section.
                      You can have the MS excel format of the information on the table by clicking the “Export to Excel” or the green button.
                    </dd>
                  </dl>
              <div class="row">
                <div class="col-md-4">
                  woroworoworoworoworoworowo
                </div>

                <div class="col-md-8">

                <!-- How can I add sections?  -->
                <div id="h-c-i-add-sect">
                  <dl>
                    <dt><h4>How can I add sections?<h4></dt>
                    <dd>
                      By clicking the +Add New Button, you can add a section. You can name se section assign a grade level and an adviser.
                      To save your input, press the blue button, to redo your work, press the yellow button and if you don’t want to add a section press the white button.
                    </dd>
                  </dl>
                </div>

                <!-- How can I edit sections?  -->
                <div id="h-c-i-edit-sect">
                  <dl>
                    <dt><h4>How can I edit sections?<h4></dt>
                    <dd>
                      By clicking the pen button at the end of the table you can get to edit a section.
                      This will be the same instructions as adding a section.
                    </dd>
                  </dl>
                </div>
                </div>
              </div>
              </div>

              <div id="manage1">
                <dl>
                  <dt><h4>Subject<h4></dt>
                    <dd>
                      Here you can manage your subjects as well as Adding and Editing information about the selected subject.
                      You can have the MS excel format of the information on the table by clicking the “Export to Excel” or the green button.
                    </dd>
                  </dl>

              <div class="row">
                <div class="col-md-4">
                  woroworoworoworoworoworowo
                  <!-- Picture here -->
                </div>

                <div class="col-md-8">

                <!-- How can I add sections?  -->
                <div id="h-c-i-add-subj">
                  <dl>
                    <dt><h4>How can I add subjects?<h4></dt>
                    <dd>
                      By clicking the +Add New Button, you can add a subject. You need to type the needed information as stated before the textbox.
                      To save your input, press the blue button, to redo your work, press the yellow button and if you don’t want to add a subject press the white button.
                    </dd>
                  </dl>
                </div>

                <!-- How can I edit sections?  -->
                <div id="h-c-i-edit-subj">
                  <dl>
                    <dt><h4>How can I edit subjects?<h4></dt>
                    <dd>
                      By clicking the pen button at the end of the table you can get to edit a subject.
                      This will be the same instructions as adding a subject.
                    </dd>
                  </dl>
                </div>

                </div>
              </div>
              </div>

              <div id="faculty">
                <dl>
                  <dt><h4>Faculty<h4></dt>
                    <dd>
                      Here you can manage your faculty as well as Adding and Editing information about the selected faculty personnel.
                      You can have the MS excel format of the information on the table by clicking the “Export to Excel” or the green button.
                    </dd>
                  </dl>

              <div class="row">
                <div class="col-md-4">
                  <!-- Picture here -->
                  woroworoworoworoworoworowo
                </div>

                <div class="col-md-8">

                <!-- How can I add faculty?  -->
                <div id="h-c-i-add-subj">
                  <dl>
                    <dt><h4>How can I add faculty?<h4></dt>
                    <dd>
                      By clicking the +Add New Button, you can add a faculty. You need to type the needed information as stated before the textbox.
                      To save your input, press the blue button, to redo your work, press the yellow button and if you don’t want to add faculty personnel, press the white button.
                    </dd>
                  </dl>
                </div>

                <!-- How can I edit sections?  -->
                <div id="h-c-i-edit-faculty">
                  <dl>
                    <dt><h4>How can I edit faculty?<h4></dt>
                    <dd>
                      By clicking the pen button at the end of the table you can get to edit faculty information.
                      This will be the same instructions as adding a faculty.
                    </dd>
                  </dl>
                </div>
                </div>
              </div>
            </div>
            </div>
            <!-- END MANAGE -->



              <div class="alert alert-info">
                <strong>
                  <span class="fa fa-info-circle"></span> Note:
                </strong>
                <br>For the TABLE:
                <ul>
                  <li>You can <b>search</b> for your queries by using our search box.</li>
                  <li>To show your preferred number of items displayed on the table, change the "<b>show (number) entries</b>" at the upper left corner of the table.</li>
                  <li>You can also <b>sort</b> the table entries in <b>descending</b> or <b>ascending</b> order by clicking the arrows at the table names.</li>
                  <li>Navigate through our buttons by clicking the <b>next</b> or <b>previous</b> pages. Click the <b>numbers</b> to go to specific page table.</li>
                </ul>
              </div>



            <!-- OVERVIEW REPORT -->
            <div id="ov-report">
              <p><h3 class="page-header"><i class="fa fa-bar-chart-o"></i> Overview Report</h3></p>
              <p>Here you can view the reports of every part of the system.</p>

              <br>
              <div id="s-ov">
                <dl>
                  <dt><h4>Student Overview<h4></dt>
                    <dd>
                      The student overview shows the student summary of the school. A drop-down box can be used to toggle if
                      you want to view the monthly summary, the yearly summary and the bar graph of the yearly summary.
                    </dd>
                  </dl>
              </div>

              <div id="e-ov">
                <dl>
                  <dt><h4>Enrollment Overview<h4></dt>
                  <dd>
                    The enrollment overview shows the payment summary of the school. A drop-down box can be used to toggle if
                    you want to view the monthly summary, the yearly summary and the bar graph of the yearly summary.
                  </dd>
                </dl>
              </div>

              <div id="l-ov">
                <dl>
                  <dt><h4>Library Overview<h4></dt>
                  <dd>
                    The library overview shows the payment summary of the school. A drop-down box can be used to toggle if
                    you want to view the monthly summary, the yearly summary and the bar graph of the yearly summary.
                  </dd>
                </dl>
              </div>
            </div>
            <!-- END OVERVIEW REPORT -->


            <!--  Accounts -->
              <div id="acc">
                <p><h3 class="page-header"><i class="fa fa-users"></i> Accounts</h3></p>
                <p>In this place you, the admin can change information on the one who logs in and out of the software.
                  Here you can change their account information such as password and account type.
                   When clicking the Faculty number you can directly change information of the faculty personnel.</p>



                   <p>What button this do?</p>
                   <p>By clicking that you can change their account information such as their username, password and account type.</p>

                   <P><h4>Tip:</h4></P>
                   <p>The password looks like a bunch of dots to have privacy, to reveal the password click the show symbol (eye).
                    Account type stands for the things that an account can do in the software. By setting it in different option you can change what a person can do to his account.</p>
                    Note that an admin can visit all of the pages and tweak with all the settings.

              </div>
            <!--  END Accounts -->

            <!--  Settings -->
              <div id="setting">
                <p><h3 class="page-header"><i class="fa fa-gears"></i> Settings</h3></p>
                <p> The library over view shows the frequency of books borrowed from the library.</p>

                <p><h4>Tip:</h4></p>
                <p>You can reach the settings of the other parts of the system by clicking the tabs at the upper part.
                   This would go to the General, Enrollment or Library Settings</p>

                   <p>Additional information would appear if you click the question mark button (?).</p>
              </div>
            <!--  END Settings -->

            <!--  Notes -->
            <div id="notes">
              <p><h3><i class="fa fa-edit"></i> Notes</h3></p>
              <p>Here you can save your notes for personal use. On the right side toy can create a personal note and remember to give it a title.
                 At the right side you can view all of the notes you have created. Choose one by picking the title of your note.
                 By choosing a note you can delete or edit your note.  Note are an added feature to ease up your work.</p>

                 <div class="alert alert-info">
                   <strong>
                     <span class="fa fa-info-circle"></span> Tip:
                   </strong>
                   You can enlarge the text box for writing notes by dragging the lower right part of the text box to a desired length and width.
                 </div>

            </div>
            <!-- End Notes -->

            <!--   Sign out -->
            <div id="sign-out">
              <p><h3><i class="fa fa-sign-out"></i> Sign out</h3></p>
              <p>Signs out your account.</p>
            </div>
            <!-- End Sign out -->


          </div>
          <!-- END PANEL BODY -->
        </div>
    </div>

    <!-- LIBRARY -->
    <div id="library">
      <div class="panel panel-danger" width="50%">
          <div class="panel-heading">
            <h4>Library Portal</h4>
          </div>
          <div class="panel-body">
            <div id="lib-w-i-see">
              <p><h3>What I see?</h3></p>

              <p>This is the library dashboard. You can see the various shortcuts at your home or pick at the side menu.</p>

            </div>

            <div id="lib-w-t-pick">
              <p></p>
              <p><h3>What to pick?</h3></p>

              <p>As Library Department Head you are privileged to manage the books and materials inside the library.
                 As well as the borrowing and returning transactions that happens inside.</p>

                <ul>
                  <li><a href="#dashboard1">Dashboard</a></li>
                  <li><a href="#transact">Transaction</a>
                  <li><a href="#book-item">Books and Items</a>
                  <li><a href="#l-ov">Overview</a>
                  <li><a href="#-notes">Notes</a>
                  <li><a href="#l-sign-out">Sign Out</a>
                </ul>
            </div>

            <div id="dashboard1">
                  <p><h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3></p>
                  <p>This is the way back to the homepage of your portal.</p>
            </div>

            <div id="transact">
              <p><h3 class="page-header"><i class="fa fa-steam"></i> Transaction</h3></p>
              <p>Here you can manage transactions that take place in the library.
              You can view the transactions that happened at the library, add more transactions and return pending books.</p>

              <br>
              <div class="row">
                <div class="col-md-4">
                  woroworoworoworoworoworowo
                  <!-- IMAGE HERE-->
                </div>

                <div class="col-md-8">

                <!-- CREATE TRANSACTION -->
                <div id="ht-create-transact">
                  <dl>
                    <dt><h4>How to create a transaction?<h4></dt>
                    <dd>
                      First click the +Create Transaction then fill up the needed information.
                    </dd>
                  </dl>
                </div>
                <!-- END CREATE TRANSACTION -->


                <dl>
                  <dd>
                    After that, click the blue button and to cancel click the white button.
                  </dd>
                </dl>
                </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-4">
                  <div id="ht-validate-ret-bookt">
                    <dl>
                      <dt><h4>How to validate a returning of a book?<h4></dt>
                      <dd>
                        <p class="text-justify">Click the pending button, this will direct you to a page that shows the student and book information.
                        You can set the penalty amount. Then you can click done.</p>
                      </dd>
                    </dl>
                  </div>
                </div>

                <div class="col-md-8">
                  woroworoworoworoworoworowo
                  <!-- IMAGE HERE-->
                </div>
              </div>
            </div>

            <div class="alert alert-info">
              <strong>
                <span class="fa fa-info-circle"></span> Note:
              </strong>
              <br>For the TABLE:
              <ul>
                <li>You can <b>search</b> for your queries by using our search box.</li>
                <li>To show your preferred number of items displayed on the table, change the "<b>show (number) entries</b>" at the upper left corner of the table.</li>
                <li>You can also <b>sort</b> the table entries in <b>descending</b> or <b>ascending</b> order by clicking the arrows at the table names.</li>
                <li>Navigate through our buttons by clicking the <b>next</b> or <b>previous</b> pages. Click the <b>numbers</b> to go to specific page table.</li>
              </ul>
            </div>
            <!-- END TRANSACT-->

            <div id="book-item">
              <p><h3 class="page-header"><i class="fa fa-book"></i> Books and Items</h3></p>
              <p>In this place you can view, add, and edit books and items from the inventory of your library</p>

            </div>

            <div class="row">
              <div class="col-md-4">
                woroworoworoworoworoworowo
                <!-- IMAGE HERE-->
              </div>

              <div class="col-md-8">
                <div id="ht-add-book-item">
                  <dl>
                    <dt><h4>How to add a book or items?<h4></dt>
                      <dd>
                        <p class="text-justify">
                          First click the +Add New then fill up the needed information.
                          After that, click the blue button and to cancel click the white button.</p>
                      </dd>
                  </dl>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div id="h-ci-edit-info-book">
                  <dl>
                    <dt><h4>How can I edit the information about the books?<h4></dt>
                      <dd>
                        <p class="text-justify">
                          From the Books and Items page, you can click the Edit button (Blue Pencil button) to show the popup edit page.
                          If you are done, click the blue button, and to cancel click the white button.
                        </p>
                      </dd>
                  </dl>
                </div>
              </div>

              <div class="col-md-8">
                  woroworoworoworoworoworowo
                  <!-- IMAGE HERE-->
              </div>
            </div>

            <div class="alert alert-info">
              <strong>
                <span class="fa fa-info-circle"></span> Tip:
              </strong>
              You can enlarge the text box for writing notes by dragging the lower right part of the text box to a desired length and width.
            </div>

            <div id="l-ov">
              <p><h3 class="page-header"><i class="fa fa-bar-chart-o"></i>Library Overview</h3></p>
              <p>The library overview shows the frequency of books borrowed from the library.</p>
            </div>

            <div id="l-notes">
              <p><h3 class="page-header"><i class="fa fa-edit"></i> Notes</h3></p>
              <p>Here you can save your notes for personal use. </p>

              <div class="row">
                <div class="col-md-4">
                  woroworoworoworoworoworowo
                  <!-- IMAGE HERE-->
                </div>

                <div class="col-md-8">
                  <dl>
                    <dd>
                      <p class="text-justify">
                        On the left side toy can create a personal note and remember to give it a title.
                      </p>
                    </dd>
                  </dl>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  woroworoworoworoworoworowo
                  <!-- IMAGE HERE-->
                </div>

                <div class="col-md-8">
                  <dl>
                    <dd>
                      <p class="text-justify">
                        At the right side you can view all of the notes you have created.
                        Choose one by picking the title of your note.
                      </p>
                    </dd>
                  </dl>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  woroworoworoworoworoworowo
                  <!-- IMAGE HERE-->
                </div>

                <div class="col-md-8">
                  <dl>
                    <dd>
                      <p class="text-justify">
                        By choosing a note you can delete or edit your note.
                        Notes are an added feature to ease up your work.
                      </p>
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
            <!-- END NOTES -->

            <div id="l-sign-out">
              <p><h3 class="page-header"><i class="fa fa-sign-out"></i>Sign-out</h3></p>
              <p>Signs out your account.</p>
            </div>


          </div>
          <!-- END PANEL BODY -->
        </div>
    </div>
    <!-- END LIBRARY -->


    <!-- ENROLLMENT -->
    <div id="enrollment">
      <div class="panel panel-primary" width="50%">
          <div class="panel-heading">
            <h4>Enrollment Portal</h4>
          </div>

          <div class="panel-body">
            <div id="e-w-ci-see">
                  <p><h3 class="page-header">What can I see?</h3></p>
                  <p>This is the enrollment dashboard. You can see the various shortcuts at your home or pick at the side menu.</p>

            </div>

            <div id="e-w-to-pick">
              <p><h3>What to pick?</h3></p>

              <p>As Financial Department Head, you are tasked to ensure the information of the previous and upcoming students in the school.
                As well as the financial bits of your organization.</p>

                <ul>
                  <li><a href="#dashboard1">Dashboard</a></li>
                  <li><a href="#f-acc">Financial Accounts</a></li>
                  <li><a href="#enroll">Enroll</a>
                    <ul>
                      <li><a href="#new-enroll">New Student</a></li>
                      <li><a href="#old-enroll">Old Student</a></li>
                    </ul>
                  </li>
                  <li><a href="#e-ov">Overview</a></li>
                  <li><a href="#e-fees">Enrollment Fees</a></li>
                  <li><a href="#-notes">Notes</a></li>
                  <li><a href="#l-sign-out">Sign Out</a></li>
                </ul>
              </div>

              <div id="e-dashboard">
                <p><h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3></p>
                <p>This is the way back to the homepage of your portal.</p>
              </div>

              <div id="f-acc">
                <p><h3 class="page-header"><i class="fa fa-table"></i> Financial Accounts</h3></p>
                <p>Here you can view the financial accounts of every enrolled student.</p>

                <div class="row">
                  <div class="col-md-4">
                    woroworoworoworoworoworowo
                    <!-- IMAGE HERE-->
                  </div>

                  <div class="col-md-8">
                    <div id="h-ci-make-pay">
                      <dl>
                        <dt><h4>How can I make a payment?</h4></dt>
                        <dd>
                          <p class="text-justify">
                            You can click the transaction button to the right most corner of the table or if you click the student number, you can go to the student’s account to go to the payment page.
                            In this page, you can also print a billing statement.
                          </p>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <div class="alert alert-info">
                  <strong>
                    <span class="fa fa-info-circle"></span> Tip:
                  </strong>
                  Inside the individual information of a student account you can print a student’s billing statement.
                  To print a student’s billing statement press the print button on a previous transactions made then press CTRL+P.
                </div>

                <dl>
                  <dt><h4>Directions on How to Use the Payment Form</h4></dt>
                  <dd>
                    <p class="text-justify">
                      <ol>
                        <li>Make sure that the school year selected is correct.</li>
                        <li>Choose a payment type if "cash" or "check". If payment type is "check", make sure that you input the "check number".</li>
                        <li>Input the amount that was paid to the appropriate type of items.</li>
                        <li>Click done.</li>
                      </ol>
                    </p>
                  </dd>
                </dl>

                <div class="alert alert-info">
                  <strong>
                    <span class="fa fa-info-circle"></span> Note:
                  </strong>
                  <ul class="text-justify">
                    <li>You can increase the amount by one by using the arrows up and down on the keyboard or the on screen controls found on the right side of the textbox.</li>
                    <li>The change at the amounts of the total and the balance left are changed real-time so you can view the total as you input the numbers.</li>
                    <li>You can view back accounts if you change the school year. Check the balance.</li>
                  </ul>
                </div>
              </div>

              <div id="enroll">
                <p><h3 class="page-header"><i class="fa fa-graduation-cap"></i>Enroll</h3></p>
                <p>Here you can enroll new and old students.</p>
              </div>

                <div class="row">
                  <div class="col-md-4">
                    woroworoworoworoworoworowo
                    <!-- IMAGE HERE-->
                  </div>

                  <div class="col-md-8">
                    <div id="h-ci-enroll-old-stud">
                    <dl>
                      <dt><h4>How can I enroll old students?</h4></dt>
                      <dd>
                        <p class="text-justify">
                          From the side menu pick Enroll. Under Enroll choose Old Student. Input the student number then this will auto-fill most of the information.
                          Then change the information with the discolored dropdown boxes with the requirements, discounts and QE. . This will lead you to a payment form.
                          Please refer to Directions on How to Use the Payment Form for the directions on how to use the payment form.
                        </p>
                      </dd>
                    </dl>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    woroworoworoworoworoworowo
                    <!-- IMAGE HERE-->
                  </div>

                  <div class="col-md-8">
                    <div id="h-ci-enroll-new-stud">
                    <dl>
                      <dt><h4>How can I enroll new students?</h4></dt>
                      <dd>
                        <p class="text-justify">
                          From the side menu pick Enroll. Under Enroll choose New Student. Then fill up the needed information. This will lead you to a payment form.
                          Please refer to Directions on How to Use the Payment Form for the directions on how to use the payment form.
                        </p>
                      </dd>
                    </dl>
                    </div>
                  </div>
                </div>


                <div id="e-ov">
                  <p><h3 class="page-header"><i class="fa fa-bar-chart-o"></i> Enrollment Overview</h3></p>
                  <p>The enrollment overview shows the payment summary of the school.  A drop-down box can be used to toggle if you want to view the monthly summary,
                    the yearly summary and the bar graph of the yearly summary</p>
                </div>

                <div id="e-fees">
                  <p><h3 class="page-header"><i class="fa fa-list-alt"></i> Enrollment Fees</h3></p>
                  <p>You can view or edit the amount of the enrollment fees per year level.</p>
                  <div class="row">
                    <div class="col-md-4">
                      woroworoworoworoworoworowo
                      <!-- IMAGE HERE-->
                    </div>

                    <div class="col-md-8">
                      <div id="h-ci-view-edit-e-fees">
                        <dl>
                          <dt><h4>How can I view or edit enrollment fees?</h4></dt>
                          <dd>
                            <p class="text-justify">
                              To view the enrollment fees, press view at the right end of the table. Inside this is where you can edit, click the Edit Data button.
                              Just make sure you were allowed to edit the enrollment fees by the admin.
                            </p>
                          </dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>


                <div id="e-notes">
                  <p><h3 class="page-header"><i class="fa fa-edit"></i> Notes</h3></p>
                  <p>Here you can save your notes for personal use. On the right side toy can create a personal note and remember to give it a title. At the right side you can view all of the notes you have created. Choose one by picking the title of your note. By choosing a note you can delete or edit your note.
                    Note are an added feature to ease up your work.</p>
                </div>

                <div id="e-sign-out">
                  <p><h3 class="page-header"><i class="fa fa-sign-out"></i>Sign Out</h3></p>
                  <p>Signs out your account.</p>
                </div>

          </div>
          <!-- END PANEL BODY -->
        </div>
    </div>


























                    <!-- End Enrollment -->








  </div>
</div>





<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>

</body>






</html>
