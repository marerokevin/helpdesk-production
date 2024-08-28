<?php 
include ("../includes/connect.php");

    $joOrder = $_POST['joOrder'];

    $computername = $_POST['computername'];
    echo $computername;

            
    // if($computername!=""){
      
    // $computername = implode(', ', $computername);
    // }


    $sqlUpdate = "UPDATE `request` SET `computerName`= '$computername' WHERE `id` = '$joOrder'";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);


?>