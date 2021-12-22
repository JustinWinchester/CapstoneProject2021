<?php
//requirements
require_once '../inc/header.php';
Session::CheckSession();
// if not an admin send to landing page
if (
    !isset($_SESSION['email']) || $_SESSION['roleid'] != "5"
) {
    header("location:index.html");
}

?>
<!-- body of admin home page -->

<body class="full-height-grow">

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <h1>Hi! : <?= $_SESSION['email'] ?></h1>
        <h2>You are : <?= $_SESSION['roleid'] ?> Which Indicates You are an <br> Administrator.</h2>
        <p>Your
        <h3>C.R.U.D</h3> Station Is Ready To GO!!</p>

    </div>
    <div class="grid-container">
        <div><a href="AddStudent.php"><i class="fa fa-fw fa-home"></i>Student Management</a></div>
        <div><a href="adminfaculty.php"><i class="fa fa-fw fa-wrench"></i>Faculty Management </a></div>
        <div><a href="adminUser.php"><i class="fa fa-fw fa-user"></i> Semester Management</a></div>
        <div><a href="adminstudent.php"><i class="fa fa-fw fa-envelope"></i> Mangage Request</a></div>
        <div><a href="../AllUsers/login.php"><i class="fa fa-fw fa-envelope"></i>Admin Portal </a></div>
        <div><a href="../AllUsers/webform.php"><i class="fa fa-fw fa-envelope"></i> Contact Faculty & Students</a></div>
        <div><a href="AddRoom.php"><i class="fa fa-fw fa-envelope"></i> Room Location Management</a></div>
        <div><a href="AddTime.php"><i class="fa fa-fw fa-envelope"></i> Time Slot Management</a></div>
        <div><a href="EnrollStudent.php"><i class="fa fa-fw fa-envelope"></i> Enroll Student</a></div>

        <div><a href="Rooms.php"><i class="fa fa-fw fa-envelope"></i> View Rooms</a></div>
        <div><a href="../AllUsers/webform.php"><i class="fa fa-fw fa-envelope"></i> Contact Faculty & Students</a></div>
    </div>

    <?php
    include '../inc/footer.php';

    ?>