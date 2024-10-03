<?php 
include ("../includes/connect.php");
$pcTag = $_GET['pcTag'];



$type = $_GET['type'];



if($type=="joborder"){
    $sql="SELECT * FROM `request` WHERE `computerName` LIKE '%" . $pcTag . "%' AND `computerName` !='' AND `request_category`= 'Computer'  AND (`status2` = 'rated' OR `status2` = 'Done') ORDER BY id DESC";
    $result = mysqli_query($con,$sql);
    $rowsJo = array();
    while($row=mysqli_fetch_assoc($result)){
    
        $rowsJo[] = $row;
    
    }
    echo json_encode($rowsJo);
    
}
else if($type=="pms"){
    $pchost = $_GET['pchost'];
    if($pchost !="" && $pcTag!=""){
        $sql="SELECT * FROM `pmsaction` WHERE `deviceName` LIKE '%" . $pchost . "%' || `deviceName` LIKE '%" . $pcTag . "%'  ORDER BY id DESC";
        $result = mysqli_query($con,$sql);
        $rowsJo = array();
        while($row=mysqli_fetch_assoc($result)){
        
            $rowsJo[] = $row;
        
        }
        echo json_encode($rowsJo);
    }
    else if($pchost =="" && $pcTag!=""){
        $sql="SELECT * FROM `pmsaction` WHERE  `deviceName` LIKE '%" . $pcTag . "%'  ORDER BY id DESC";
        $result = mysqli_query($con,$sql);
        $rowsJo = array();
        while($row=mysqli_fetch_assoc($result)){
        
            $rowsJo[] = $row;
        
        }
        echo json_encode($rowsJo);
    }
    else if($pchost !="" && $pcTag==""){
        $sql="SELECT * FROM `pmsaction` WHERE `deviceName` LIKE '%" . $pchost . "%'   ORDER BY id DESC";
        $result = mysqli_query($con,$sql);
        $rowsJo = array();
        while($row=mysqli_fetch_assoc($result)){
        
            $rowsJo[] = $row;
        
        }
        echo json_encode($rowsJo);
    }
   
}
else if($type=="edit"){
    $deviceid = $_GET['deviceid'];
    $sql="SELECT * FROM `devicehistory` WHERE `deviceId`='".$deviceid."' AND type = '' ORDER BY id DESC";
    $result = mysqli_query($con,$sql);
    $rowsJo = array();
    while($row=mysqli_fetch_assoc($result)){
    
        $rowsJo[] = $row;
    
    }
    echo json_encode($rowsJo);
    
}

?>