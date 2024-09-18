<<<<<<< HEAD
<?php 
include ("../includes/connect.php");
$pcTag = $_GET['pcTag'];

$sql="SELECT `id` FROM `devices` WHERE `computerName` = '$pcTag'  OR `pctag` =  '$pcTag' ";
$result = mysqli_query($con,$sql);
$rowsJo = array();
while($row=mysqli_fetch_assoc($result)){

    $pcid = $row['id'];

}
echo json_encode($pcid);

=======
<?php 
include ("../includes/connect.php");
$pcTag = $_GET['pcTag'];

$sql="SELECT `id` FROM `devices` WHERE `computerName` = '$pcTag'  OR `pctag` =  '$pcTag' ";
$result = mysqli_query($con,$sql);
$rowsJo = array();
while($row=mysqli_fetch_assoc($result)){

    $pcid = $row['id'];

}
echo json_encode($pcid);

>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>