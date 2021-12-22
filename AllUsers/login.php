<html>
<head>
<?php
include '../inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   $userLog = $users->userLoginAuthentication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



 ?>

<div class="dropdown">
  <button class="dropbtn">Get Started!</button>
  <div class="dropdown-content">
    <a href="CourseCatalog.php">View Course Catalog</a>
    <a href="../AdminUsers/join.php">Request Registration</a>
    <a href="login.php">Login</a>
    <a href="../../index.html">Home</a>

  </div>

</div>

</head>
<body class = "full-height-grow">

  </br>
</br>
      <h1 class="join-text" style="float:left">
        CU Enroll
        <span class="accent-text" style="color: yellow;">Today!</span>
        </h1>
      <form action="" method = "post" style="margin-left:50%" class="join-form">
      <div class="input-group">
	<label for="email" >User Name:</label>
	<input type="email" name="email" class="" placeholder="Email"
      required>
      </div>
      <div class="input-group ">
	<label for="password">Password</label>
	 <input type="password" name="password" class=" " placeholder="Password"
      required>
      </div>
           <div class="input-group">
         <button type="submit" name="login" class="btn1">Login</button>      </div>
</form>
 
  </body>



<?php
  include '../inc/footer.php';

  ?>
</html>