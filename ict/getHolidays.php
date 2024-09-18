<?php 
include ("../includes/connect.php");

$sql="SELECT holidaysDate FROM holidays";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


?>