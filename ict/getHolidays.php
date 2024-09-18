<<<<<<< HEAD
<?php 
include ("../includes/connect.php");

$sql="SELECT holidaysDate FROM holidays";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


=======
<?php 
include ("../includes/connect.php");

$sql="SELECT holidaysDate FROM holidays";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>