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

?>