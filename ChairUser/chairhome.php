<?php
  require_once '../inc/header.php';
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "3"
){
  header("location:index.html");
}




?>



<div class="alert" >
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <h1>Hi! : <?= $_SESSION['email']?></h1>
  <h2>Your a  : <?= $_SESSION['roleid']?></h2>
  <p>Your education is important to use! Be ready to Learn!</p>
</div>
<div class="grid-container"> 
  <div><a href="chair.php"><i class="fa fa-fw fa-home"></i> Home</a></div>
  <div><a href="chairviewfaculty.php"><i class="fa fa-fw fa-wrench"></i> Services</a></div>
  <div><a href="chairenrollstudent.php"><i class="fa fa-fw fa-user"></i> Clients</a></div>
  <div><a href="EnrollStudent.php"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></div>

<div><a href="chair.php"><i class="fa fa-fw fa-envelope"></i> Contact</a></div>

</div>
<br>




<?php
  include '../inc/footer.php';

  ?>
