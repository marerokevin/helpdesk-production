<<<<<<< HEAD
<?php 
include ("../includes/connect.php");

    $joOrder = $_POST['joOrder'];
    $stat = $_POST['stat'];
    $sqlUpdate = "UPDATE `request` SET `edit`= '$stat' WHERE `id` = '$joOrder'";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);


=======
<?php 
include ("../includes/connect.php");

    $joOrder = $_POST['joOrder'];
    $stat = $_POST['stat'];
    $sqlUpdate = "UPDATE `request` SET `edit`= '$stat' WHERE `id` = '$joOrder'";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);


>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>