<?php
  require_once '../inc/header.php';
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "4"
){
  header("location:index.html");
}




?>




<div class="alert" >
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <h1>Hi! : <?= $_SESSION['email']?></h1>
  <h2>Your a  : <?= $_SESSION['roleid']?></h2>
  <p>Thanks For Logging In Staff Member, This Application Shall Simply Your Duties!</p>
  
</div>

<div class="grid-container"> 
 <div> <a href="../AdminUsers/StudentUser.php"><i class="fa fa-fw fa-home"></i> CS Students</a></div>
  <div><a href="Secretary.php"><i class="fa fa-fw fa-wrench"></i> IT Students</a></div>
  <div><a href="secretaryviewfaculty.php"><i class="fa fa-fw fa-user"></i> View Faculty</a></div>
  <div><a href="../AllUsers/webform.php"><i class="fa fa-fw fa-envelope"></i> Contact Faculty & Students</a></div>
<div><a href="../AdminUsers/EnrollStudent.php"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></div>

</div>
<br>
  
<?php
  include '../inc/footer.php';

  ?>
