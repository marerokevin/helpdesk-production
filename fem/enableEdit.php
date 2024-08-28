<?php 
include ("../includes/connect.php");

    $joOrder = $_POST['joOrder'];
    $stat = $_POST['stat'];
    $sqlUpdate = "UPDATE `request` SET `edit`= '$stat' WHERE `id` = '$joOrder'";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);


?>