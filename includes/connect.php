<?php
date_default_timezone_set('Asia/Manila');


#$servername = "192.168.5.6";
$servername = "localhost";
#$username = "helpdeskts2";
$username = "root";
#$password = "gpi242$$$";
$password = "Gpi242$$$";
#$dbname = "helpdesk_db_test";
$dbname = "helpdesk_db";
// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con = mysqli_connect($servername, $username, $password, $dbname)) {
    die("Failed to Connect to Database!");
}
