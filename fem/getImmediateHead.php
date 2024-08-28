<?php 
include ("../includes/connect.php");
$dept = $_GET['department'];

$sql="SELECT * FROM `user` WHERE `level` = 'head' and `department` = '$dept'";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


?>