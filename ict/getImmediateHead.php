<<<<<<< HEAD
<?php 
include ("../includes/connect.php");
$dept = $_GET['department'];

$sql="SELECT * FROM `user` WHERE (`level` = 'head' OR `level` = 'admin') and `department` = '$dept'";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


=======
<?php 
include ("../includes/connect.php");
$dept = $_GET['department'];

$sql="SELECT * FROM `user` WHERE (`level` = 'head' OR `level` = 'admin') and `department` = '$dept'";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>