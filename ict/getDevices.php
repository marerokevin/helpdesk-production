<<<<<<< HEAD
<?php 
include ("../includes/connect.php");



    $sql="SELECT `id`, `department`, `type`, `user`, `os`,`computerName`, `password`, `macAddress`, `ipAddress`,`edr`, `kaspersky`, `itnavi`,  `pctag`, `assetTag`, `deactivated`, `proofIp`, `proofInstalled`, `proofUploader` FROM devices WHERE `deactivated` = 0";
    $result = mysqli_query($con,$sql);
    $rowsListDevices = array();
    while($row=mysqli_fetch_assoc($result)){
        $rowsListDevices[] = $row;
    }
// echo $result;
echo json_encode($rowsListDevices);



=======
<?php 
include ("../includes/connect.php");



    $sql="SELECT `id`, `department`, `type`, `user`, `os`,`computerName`, `password`, `macAddress`, `ipAddress`,`edr`, `kaspersky`, `itnavi`,  `pctag`, `assetTag`, `deactivated`, `proofIp`, `proofInstalled`, `proofUploader` FROM devices WHERE `deactivated` = 0";
    $result = mysqli_query($con,$sql);
    $rowsListDevices = array();
    while($row=mysqli_fetch_assoc($result)){
        $rowsListDevices[] = $row;
    }
// echo $result;
echo json_encode($rowsListDevices);



>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>