<?php
date_default_timezone_set('Asia/Manila');


$servername = "192.168.5.6";
$username = "helpdeskts3";
$password = "gpi242$$$";
$dbname = "helpdesk_db_test";
// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con = mysqli_connect($servername, $username, $password, $dbname)) {
    die("Failed to Connect to Database!");
}
