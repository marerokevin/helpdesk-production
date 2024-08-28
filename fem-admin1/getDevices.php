<?php 
include ("../includes/connect.php");



    $sql="SELECT * FROM `devices`;";
    $result = mysqli_query($con,$sql);
    $rowsListDevices = array();
    while($row=mysqli_fetch_assoc($result)){
        $rowsListDevices[] = $row;
    }

echo json_encode($rowsListDevices);



?>