<?php
  require_once '../inc/header.php';
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "2"
){
  header("location:index.html");
}




?>



<div class="alert" >
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <h1>Hi! : <?= $_SESSION['email']?></h1>
  <h2>Your a  : <?= $_SESSION['roleid']?></h2>
  <p>Welcome valued and Respected Instructor!!! You MAKE THIS ALL POSSIBLE! THANK YOU!</p>
</div>
<div class="grid-container"> 
  <div><a href="#teacher.php"><i class="fa fa-fw fa-home"></i> View Advisees</a></div>
  <div><a href="../AdminUsers/EnrollStudent.php"><i class="fa fa-fw fa-wrench"></i> Enroll Student In A Course</a></div>
  <div><a href="FacultySchedule.php"><i class="fa fa-fw fa-user"></i> View Teaching Schedule</a></div>
  <div><a href="#EnrollStudent.php"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></div>
<div><a href="../AllUsers/webform.php"><i class="fa fa-fw fa-envelope"></i> Request Override</a></div>
 </div>





 <?php
  include '../inc/footer.php';

  ?>
