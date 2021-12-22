<?php
  require_once '../inc/header.php';
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "1"
){
  header("location:index.html");
}




?>
?>


<div class="alert" >
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
 <h1>Hi! : <?= $_SESSION['email']?></h1>
  <h2>Your a  : <?= $_SESSION['roleid']?></h2>
<p>Your education is important to use! Be ready to Learn!</p>
</div>

<div class="grid-container"> 
  <div><a href="../AllUsers/index.php"><i class="fa fa-fw fa-home"></i> Home</a></div>
  <div><a href="../AllUsers/CourseTest.php"><i class="fa fa-fw fa-wrench"></i> View Classes!</a></div>
  <div><a href="../AllUsers/pdftest.php"><i class="fa fa-fw fa-user"></i> Print Schedule</a></div>
<div><a href="../AllUsers/webform.php"><i class="fa fa-fw fa-envelope"></i> Contact Staff/Faculty OR Request Enrollment/ PIN</a></div>
  <div><a href="../AllUsers/CourseCatalog.php"><i class="fa fa-fw fa-envelope"></i>View Course Rosters & Listings  </a></div>
 <div><a href="Sched2.php?id=<?php echo Session::get("id"); ?>">View My Schedule</a></div>
<div><a href="../StudentUsers/TESTenterPin.php"><i class="fa fa-fw fa-envelope"></i> Enroll Myself </a></div>

</div>

 <a href="student.php">Back</a>

 <a href="logout.php">Logout</a>
<a class="btn btn-success btn-sm
                            " href="profile.php?id=<?php echo Session::get("id")?>">View</a>
<a class="btn btn-success btn-sm
                            " href="Sched2.php?id=<?php echo Session::get("id")?>">View</a>




<?php
  include '../inc/footer.php';

  ?>

  