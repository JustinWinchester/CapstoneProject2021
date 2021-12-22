<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../../lib/Session.php";
Session::init();



spl_autoload_register(function ($classes) {

  include '../../classes/' . $classes . ".php";
});


$users = new Users();

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Enrollment Web Application CU ENROLL ME</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="..\..\css\oop.css" rel="stylesheet">
  <!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js">
-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../assets/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/dataTables.bootstrap4.min.css">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="..\..\css\join.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>



</head>

<body>
  <?php


  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    //\\ Session::set('logout', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    // <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    // <strong>Success !</strong> You are Logged Out Successfully !</div>');
    Session::destroy();
  }



  ?>



  <?php $www = $_SERVER['REQUEST_URI']; ?>
  <?php if ($www  != '/~team1/UserFeatures/AllUsers/login.php') : ?>
    <div class="dropdown">
      <button class="dropbtn">CU ENROLL!</button>

      <div class="dropdown-content">

        <?php if (Session::get('id') == TRUE) { ?>
          <a href="../AllUsers/index.php"></i>Home</a>
          <a href="../AllUsers/profile.php?id=<?php echo Session::get("id"); ?>"></i>Profile </a>
          <a href="?action=logout">Logout</a>


        <?php } else { ?>

          <?php

          $path = $_SERVER['SCRIPT_FILENAME'];
          $current = basename($path, '.php');
          if ($current == 'join') {
            echo " ";
          }

          ?>
          <a href="join.php">APPLY FOR REGISTRATION</a>


          <?php

          $path = $_SERVER['SCRIPT_FILENAME'];
          $current = basename($path, '.php');
          if ($current == 'login') {
            echo "  ";
          }

          ?>
          <a href="../AllUsers/login.php">ALUMNI LOGIN</a>

          <a href="../../index.html">HOME</a>




        <?php } ?>

      </div>

    </div>
  <?php endif; ?>


  <?php

  if (isset($_POST['closeButton'])) {
    echo "<script>window.close();</script>";
  }
  ?>

  <?php if (($www  != '/~team1/UserFeatures/AllUsers/index.php') && ($www  != '/~team1/UserFeatures/AllUsers/login.php')) : ?>
    <form method="post">

      <input type="submit" name="closeButton" value="CLOSE WINDOW" />
    </form>

  <?php endif; ?>