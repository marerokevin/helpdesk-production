<<<<<<< HEAD
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


=======
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


>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>