<?php
include '../inc/header.php';

Session::CheckSession();





$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


?>
<div class="card ">
  <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <h3><i class="fas fa-users mr-2"></i>CU ENROLL ME <span class="float-right"> Welcome! <strong>
          <span class="badge badge-lg badge-secondary text-white">
            <?php
            $firstname = Session::get('firstname');
            if (isset($firstname)) {
              echo $firstname;
            }
            ?></span>

        </strong></span></h3>
  </div>
  <br>
  <div>

    <!--
                      <div class="slideshow-container">

                      <div class="mySlides fade">
                        <div class="numbertext">1 / 4</div>
                        <img src="../../images/Campus2.jpg" style="width:100%">
                        <div class="text">Balance Courses & Recreational Activites !</div>
                      </div>

                      <div class="mySlides fade">
                        <div class="numbertext">2 / 4</div>
                        <img src="../../images/campus3.jpg" style="width:100%">
                        <div class="text">Great Atmosphere!</div>
                      </div>

                      <div class="mySlides fade">
                        <div class="numbertext">3 / 4</div>
                        <img src="../../images/campus4.jpg" style="width:100%">
                        <div class="text">Learn with dedicated Professors!</div>
                      </div>
                      <div class="mySlides fade">
                        <div class="numbertext">4 / 4</div>
                        <img src="../../images/campus5.jpg" style="width:100%">
                        <div class="text">Clean & Inviting Campus !</div>
                      </div>

                      </div>

                      <br>

                      <div style="text-align:center">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                      <span class="dot"></span>

                      </div>-->

    <!-- if admin -->
    <?php if (Session::get("roleid")  == '5') : ?>
      <div class="col-3 col-s-3 menu">
        <ul>
          <li><a href="../AdminUsers/addStudentUser.php" onclick=" window.open('../AdminUsers/addStudentUser.php','twelve','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i>Add Student</a></li>
		  <li><a href="../AdminUsers/addUser.php" onclick=" window.open('../AdminUsers/addUser.php','twelve','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i>Add Faculty</a></li>
          <li><a href="../AdminUsers/StudentUser.php" onclick=" window.open('../AdminUsers/StudentUser.php','one','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-home"></i>Student Management</a></li>
          <li><a href="../AllUsers/FacultyUser.php" onclick=" window.open('../AllUsers/FacultyUser.php','two','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-wrench"></i>Faculty Management </a></li>
          <li><a href="../AdminUsers/adminUser.php" onclick=" window.open('../AdminUsers/adminUser.php','three','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i> Semester Management</a></li>
        <!--  <li><a href="../AllUsers/webform.php" onclick=" window.open('../AllUsers/webform.php','six','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Contact Faculty & Students</a></li> -->
          <li><a href="../AdminUsers/AddRoom.php" onclick=" window.open('../AdminUsers/AddRoom.php','seven','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Room Location Management</a></li>
          <li><a href="../AdminUsers/AddTime.php" onclick=" window.open('../AdminUsers/AddTime.php','eight','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Time Slot Management</a></li>
          <li><a href="../AllUsers/CUENROLL.php" onclick=" window.open('../AllUsers/CUENROLL.php','nine','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></li>
          <li><a href="../AdminUsers/Rooms.php" onclick=" window.open('../AdminUsers/Rooms.php','ten','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> View Rooms</a></li>
          <li><a href="../AllUsers/webform.php" onclick=" window.open('../AllUsers/webform.php','eleven','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Contact Users</a></li>
          <li><a href="../AllUsers/SecForm2.php" onclick=" window.open('../AllUsers/SecForm2.php','thrtn','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i>Assign Student Advisor</a></li>
          <li><a href="CourseCatalog.php" onclick=" window.open('CourseCatalog.php','frtn','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i>View Course Information</a></li>
          <li><a href="../AdminUsers/AddNewSectionAdmin.php" onclick=" window.open('../AdminUsers/AddNewSectionAdmin.php','sxtn','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-wrench"></i>Add New Section</a></li>
          <li><a href="../AdminUsers/AddCourseAdmin.php" onclick=" window.open('../AdminUsers/AddCourseAdmin.php','sevtn','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-wrench"></i>Add New Course</a></li>
          <li><a href="../AllUsers/ViewApplicantsAdmin.php" onclick=" window.open('../AllUsers/ViewApplicantsAdmin.php','eighteen','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i>Manage New Applicants</a></li>

        </ul>
      </div>
    <?php elseif (Session::get("roleid")  == '4') : ?>

      <div class="col-3 col-s-3 menu">
        <ul>
          <li><a href="ViewCS.php" onclick=" window.open('ViewCS.php','one','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-home"></i> CS Students</a></li>
          <li><a href="ViewIT.php" onclick=" window.open('ViewIT.php','two','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-wrench"></i> IT Students</a></li>
          <li><a href="../AllUsers/webform.php" onclick=" window.open('../AllUsers/webform.php','four','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
          <li><a href="../AllUsers/CUENROLL.php" onclick=" window.open('../AllUsers/CUENROLL.php','five','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></li>
          <li><a href="../AllUsers/SecForm2.php" onclick=" window.open('../AllUsers/SecForm2.php','six','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">Assign Student Adviser</a></li>
          <li><a href="CourseCatalog.php" onclick=" window.open('CourseCatalog.php','ten','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">View Class Catalog</a></li>
          <li><a href="../AllUsers/ViewAdvisers.php" onclick=" window.open('../AllUsers/ViewAdvisers.php','eleven','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> View Professor Advisers</a></li>



        </ul>
      </div>
    <?php elseif (Session::get("roleid")  == '3') : ?>
      <div class="col-3 col-s-3 menu">
        <ul>

          <li><a href="../AllUsers/CUENROLL.php" onclick=" window.open('../AllUsers/CUENROLL.php','four','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></li>
          <li><a href="../AllUsers/webform.php" onclick=" window.open('webform.php','five','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
       <!--   <li><a href="../AllUsers/FacultyUser.php" onclick=" window.open('../AllUsers/FacultyUser.php','six','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> View Faculty</a></li> -->
          <li><a href="ViewCS.php" onclick=" window.open('ViewCS.php','seven','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">View Computer Science Student</a></li>
          <li><a href="ViewIT.php" onclick=" window.open('ViewIT.php','eight','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">View Information Technology Student</a></li>
          <li><a href="SecForm2.php" onclick=" window.open('SecForm2.php','nine','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">Assign Student Adviser</a></li>
          <li><a href="CourseCatalog.php" onclick=" window.open('CourseCatalog.php','ten','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">View Class Catalog</a></li>
          <li><a href="FacultyUser.php" onclick=" window.open('FacultyUser.php','eleven','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">View Faculty Teaching Schedules</a></li>
          <li><a href="../AllUsers/ViewAdvisers.php" onclick=" window.open('../AllUsers/ViewAdvisers.php','twelve','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> View Professor Advisers</a></li>


        </ul>
      </div>
    <?php elseif (Session::get("roleid")  == '2') : ?>
      <div class="col-3 col-s-3 menu">
        <ul>
          <!-- <li><a href="../ProfessorUsers/ViewAdvisees.php"><i class="fa fa-fw fa-home" onclick=" window.open('../ProfessorUsers/ViewAdvisees.php','one','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"></i> View Advisees</a></li> -->
          <li><a href="../AdminUsers/CUENROLL.php" onclick=" window.open('../AllUsers/CUENROLL.php','two','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-wrench"></i> Enroll Student In A Course</a></li>
          <li><a href="../ProfessorUsers/FacultySchedule.php?id=<?php echo Session::get("id"); ?>" onclick=" window.open('../ProfessorUsers/FacultySchedule.php?id=<?php echo Session::get("id"); ?>','three','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i> View Teaching Schedule</a></li>
          <li><a href="../AllUsers/webform.php" onclick=" window.open('../AllUsers/webform.php','five','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
          <li><a href="../AllUsers/CourseCatalog.php" onclick=" window.open('../AllUsers/CourseCatalog.php','six','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i>View Class Catalog</a></li>
          <li><a href="../ProfessorUsers/ViewAdvisees.php?id=<?php echo Session::get("id"); ?>" onclick=" window.open('../ProfessorUsers/ViewAdvisees.php?id=<?php echo Session::get("id"); ?>','seven','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i> View Advisees</a></li>
          <li><a href="../ProfessorUsers/ViewClassRoster.php?id=<?php echo Session::get("id"); ?>" onclick=" window.open('../ProfessorUsers/ViewClassRoster.php?id=<?php echo Session::get("id"); ?>','eight','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i> View Course Rosters</a></li>

        </ul>
      </div>
    <?php elseif (Session::get("roleid")  == '1') : ?>
      <div class="col-3 col-s-3 menu">
        <ul>
          <li><a href='../AllUsers/PrintMySchedule.php?id=<?php echo Session::get("id");?>' onclick=" window.open('../AllUsers/PrintMySchedule.php?id=<?php echo $student_id?>','three','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-user"></i> Print Schedule</a></li>
          <li><a href="../AllUsers/webform.php" onclick=" window.open('webform.php','four','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Contact Staff/Faculty OR Request Enrollment/ PIN</a></li>
          <li><a href="CourseCatalog.php" onclick=" window.open('CourseCatalog.php','five','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i>View Course Rosters & Listings </a></li>
          <li><a href="../StudentUsers/Sched2.php?id=<?php echo Session::get("id"); ?>" onclick=" window.open('../StudentUsers/Sched2.php?id=<?php echo Session::get("id"); ?>','six','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;">View My Schedule</a></li>
          <li><a href="../StudentUsers/TESTenterPin.php" onclick=" window.open('../StudentUsers/TESTenterPin.php','seven','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'); return false;"><i class="fa fa-fw fa-envelope"></i> Enroll Myself </a></li>

        </ul>
      </div>
    <?php endif; ?>

    <div class="row">

      <div class="col-6 col-s-9">
        <?php if (Session::get("roleid")  == '5') : ?>
          <h1>Welcome To Your Admin Portal !</h1>
        <?php elseif (Session::get("roleid")  == '4') : ?>
          <h1>Welcome To Your Secretary Portal !</h1>
        <?php elseif (Session::get("roleid")  == '3') : ?>
          <h1>Welcome To Your Chair Portal !</h1>
        <?php elseif (Session::get("roleid")  == '2') : ?>
          <h1>Welcome To Your Faculty Portal !</h1>

        <?php elseif (Session::get("roleid")  == '1') : ?>
          <h1>Welcome To Your Student Portal!</h1>

          <h1>Nature Background</h1>
        <?php endif; ?>
        <h3>User Summary:</h3>






        <div class="card-body pr-2 pl-2">

          <table id="example" class="display">
            <thead>
              <tr>
                <th class="text-center">SL</th>
                <th class="text-center">First Name</th>
                <th class="text-center">Last name</th>
                <th class="text-center">Email address</th>
                <th class="text-center">Mobile</th>
                <th class="text-center">Status</th>
              
              </tr>
            </thead>
            <tbody>



              <tr class="text-center">

                <td><?php echo Session::get("id"); ?></td>
                <td><?php echo Session::get("firstname"); ?></td>
                <td><?php echo Session::get("lastname"); ?> <br>
                  <?php if (Session::get("roleid")  == '5') {
                    echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                  } elseif (Session::get("roleid") == '4') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Secretary</span>";
                  } elseif (Session::get("roleid") == '3') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Chair</span>";
                  } elseif (Session::get("roleid") == '2') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Faculty</span>";
                  } elseif (Session::get("roleid") == '1') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Student</span>";
                  } ?></td>
                <td><?php echo Session::get("email"); ?></td>

                <td><span class="badge badge-lg badge-secondary text-white"><?php echo Session::get("mobile"); ?></span></td>
                <td>
                  <?php if (Session::get("isActive") == '0') { ?>
                    <span class="badge badge-lg badge-info text-white">Active</span>
                  <?php } else { ?>
                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                  <?php } ?>

                </td>

              </tr>







            </tbody>

          </table>











          <br>


        </div>
      </div>

      <!--  <div class="col-3 col-s-12">
    	<div class="aside">
     		 <h2>What?</h2>
     		 <p>The word nature is borrowed from the Old French nature and is derived from the Latin word natura, or "essential qualities, innate disposition", and in ancient times, literally meant "birth"</p>
     			 <h2>More Info</h2>
     		 <p>In ancient philosophy, natura is mostly used as the Latin translation of the Greek word physis (φύσις), which originally related to the intrinsic characteristics that plants, animals, and other features of the world develop of their own accord.</p>
     		 <h2>How You Can Help?</h2>
     		 <p>You can do you best to keep your personal environment clean and to learn what scientist,
		    agree as best current methods check out more information here. <br>  <a href="https://    response.restoration.noaa.gov/about/media/8-ways-keep-earth-clean.html/">Nature     Preservation Methods</a></p>
   	     </div>
        </div>-->
    </div>
  </div>
</div>






<div style="overflow-x:auto;">


  <?php if (Session::get("roleid") == '5') { ?>

    <div class="card-body pr-2 pl-2">

      <table id="datatableid" class="display" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">SL</th>
            <th class="text-center">First Name</th>
            <th class="text-center">Last name</th>
            <th class="text-center">Email address</th>
            <th class="text-center">Mobile</th>
            <th class="text-center">Status</th>
            <th width='25%' class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>


          <?php
          $allUser = $users->selectAllUserData();


          if ($allUser) {
            $i = 0;
            foreach ($allUser as  $value) {
              $i++;
          ?>


              <tr class="text-center" <?php if (Session::get("id") == $value->id) {
                                        echo "style='background:#d9edf7' ";
                                      } ?>>

                <td><?php echo $i; ?></td>
                <td><?php echo $value->firstname; ?></td>
                <td><?php echo $value->lastname; ?> <br>
                  <?php if ($value->roleid  == '5') {
                    echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                  } elseif ($value->roleid == '4') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Secretary</span>";
                  } elseif ($value->roleid == '3') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Chair</span>";
                  } elseif ($value->roleid == '2') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Faculty</span>";
                  } elseif ($value->roleid == '1') {
                    echo "<span class='badge badge-lg badge-dark text-white'>Student</span>";
                  } ?></td>
                <td><?php echo $value->email; ?></td>

                <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
                <td>
                  <?php if ($value->isActive == '0') { ?>
                    <span class="badge badge-lg badge-info text-white">Active</span>
                  <?php } else { ?>
                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                  <?php } ?>

                </td>
                <td>
                  <?php if (Session::get("roleid") == '5') { ?>
                    <a class="btn btn-success btn-sm
                            " href="profile.php?id=<?php echo $value->id; ?>">View</a>
                    <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
                    <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->id; ?>">Remove</a>

                    <?php if ($value->isActive == '0') {  ?>
                      <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                       <?php if (Session::get("id") == $value->id) {
                          echo "disabled";
                        } ?>
                                btn-sm " href="?deactive=<?php echo $value->id; ?>">Disable</a>
                    <?php } elseif ($value->isActive == '1') { ?>
                      <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                       <?php if (Session::get("id") == $value->id) {
                          echo "disabled";
                        } ?>
                                btn-sm " href="?active=<?php echo $value->id; ?>">Active</a>
                    <?php } ?>




                  <?php  } elseif (Session::get("id") == $value->id  && Session::get("roleid") == '2' || '3' || '4') { ?>
                    <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id; ?>">View</a>
                    <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
                  <?php  } elseif (Session::get("roleid") == '2') { ?>
                    <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id; ?>">View</a>
                    <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
                  <?php } elseif (Session::get("id") == $value->id  && Session::get("roleid") == '1') { ?>
                    <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id; ?>">View</a>
                    <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
                  <?php } else { ?>
                    <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id; ?>">View</a>
                  <?php } ?>


                </td>
              </tr>


            <?php }
          } else { ?>

            <tr class="text-center">

              <td><?php echo Session::get("id"); ?></td>
              <td><?php echo Session::get("firstname"); ?></td>
              <td><?php echo Session::get("lastname"); ?> <br>
                <?php if (Session::get("roleid")  == '5') {
                  echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                } elseif (Session::get("roleid") == '4') {
                  echo "<span class='badge badge-lg badge-dark text-white'>Secretary</span>";
                } elseif (Session::get("roleid") == '3') {
                  echo "<span class='badge badge-lg badge-dark text-white'>Chair</span>";
                } elseif (Session::get("roleid") == '2') {
                  echo "<span class='badge badge-lg badge-dark text-white'>Faculty</span>";
                } elseif (Session::get("roleid") == '1') {
                  echo "<span class='badge badge-lg badge-dark text-white'>Student</span>";
                } ?></td>
              <td><?php echo Session::get("email"); ?></td>

              <td><span class="badge badge-lg badge-secondary text-white"><?php echo Session::get("mobile"); ?></span></td>
              <td>
                <?php if (Session::get("isActive") == '0') { ?>
                  <span class="badge badge-lg badge-info text-white">Active</span>
                <?php } else { ?>
                  <span class="badge badge-lg badge-danger text-white">Deactive</span>
                <?php } ?>

              </td>

            </tr>
          <?php } ?>






        </tbody>

      </table>











    </div>
</div>

<script type="text/javascript">
  // Popup window code
  function newPopup(url, name) {
    popupWindow = window.open(url, name, 'height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
  }
</script>

<?php
    include '../inc/footer.php';
  } ?>
