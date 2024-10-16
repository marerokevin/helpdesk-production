<?php 
include ("../includes/connect.php");

$rowsListprinter = array();


if(isset($_POST['updateSelectedprinter'])){
$arrayOfSelected =  $_POST['arrayOfSelectedprinter'] ;  
$arrayOfSelected = explode(',', $arrayOfSelected);


foreach ($arrayOfSelected as $element) {
    // echo $element;

    $sql="SELECT * FROM `printer` WHERE `id` = '$element'";
    $result = mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $rowsListprinter[] = $row;
    }
}
$jsonData = json_encode($rowsListprinter);
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