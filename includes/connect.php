<?php
date_default_timezone_set('Asia/Manila');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk_db";
// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con = mysqli_connect($servername, $username, $password, $dbname)) {
    die("Failed to Connect to Database!");
}
