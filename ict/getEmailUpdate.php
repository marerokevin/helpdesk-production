<?php 
include ("../includes/connect.php");
$username = $_GET['username'];

$sql="SELECT  `updatedEmail` FROM `user` WHERE `username` = '$username'";
$result = mysqli_query($con,$sql);
$rowsJo = array();
while($row=mysqli_fetch_assoc($result)){

    $updatedEmail = $row['updatedEmail'];

}
echo json_encode($updatedEmail);

?>