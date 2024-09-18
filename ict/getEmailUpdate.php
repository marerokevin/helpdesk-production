<<<<<<< HEAD
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

=======
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

>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>