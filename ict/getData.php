<<<<<<< HEAD
<?php 
include ("../includes/connect.php");

$rowsList = array();


if(isset($_POST['updateSelected'])){
$arrayOfSelected =  $_POST['arrayOfSelected'] ;  
$arrayOfSelected = explode(',', $arrayOfSelected);


foreach ($arrayOfSelected as $element) {
    // echo $element;

    $sql="SELECT * FROM `devices` WHERE `id` = '$element'";
    $result = mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $rowsList[] = $row;
    }
}
$jsonData = json_encode($rowsList);
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

=======
<?php 
include ("../includes/connect.php");

$rowsList = array();


if(isset($_POST['updateSelected'])){
$arrayOfSelected =  $_POST['arrayOfSelected'] ;  
$arrayOfSelected = explode(',', $arrayOfSelected);


foreach ($arrayOfSelected as $element) {
    // echo $element;

    $sql="SELECT * FROM `devices` WHERE `id` = '$element'";
    $result = mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $rowsList[] = $row;
    }
}
$jsonData = json_encode($rowsList);
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

>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>