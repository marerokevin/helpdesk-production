<?php

session_start();
// include ("includes/connect.php");

if (isset($_SESSION['connected'])) {


  $level = $_SESSION['level'];
  $leaderof = $_SESSION['leaderof'];
  if ($level == 'user') {
    header("location:employees");
  } else if ($level == 'mis') {
    header("location:mis");
  } else if ($level == 'fem') {
    header("location:fem");
  } else if ($level == 'head') {
    header("location:department-head");
  } else if ($level == 'admin' && $leaderof == 'mis') {
    header("location:department-admin");
  } else if ($level == 'admin' && $leaderof == 'fem') {
    header("location:fem-admin");
  }
} else {
  header("location:logout.php");
}
