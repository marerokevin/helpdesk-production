<?php 
include ("../includes/connect.php");

$rowsListcctv = array();


if(isset($_POST['updateSelectedcctv'])){
$arrayOfSelected =  $_POST['arrayOfSelectedcctv'] ;  
$arrayOfSelected = explode(',', $arrayOfSelected);


foreach ($arrayOfSelected as $element) {
    // echo $element;

    $sql="SELECT * FROM `cctv` WHERE `id` = '$element'";
    $result = mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $rowsListcctv[] = $row;
    }
}
$jsonData = json_encode($rowsListcctv);
echo $jsonData;

}
// $rowsList = array();

// $sql = "SELECT * FROM `devices` LIMIT 3";
// $result = mysqli_query($con, $sql);

// while ($row = mysqli_fetch_assoc($result)) {
//     $rowsList[] = $row;
// }

// $jsonData = json_encode($rowsList);
// echo $jsonData;

?>