<?php 
include ("../includes/connect.php");

$sql="SELECT d.deactivated, ip.ipaddress, CONCAT_WS(',', d.id, c.id, p.id) AS all_ids, CONCAT_WS(',', d.type, c.type, p.type) AS all_type, CONCAT_WS(',', d.computerName, c.cameraNo, p.model) AS all_name, CONCAT_WS(',', CASE WHEN d.id IS NOT NULL THEN 'devices' END, CASE WHEN c.id IS NOT NULL THEN 'cctv' END, CASE WHEN p.id IS NOT NULL THEN 'printer' END ) AS tables
FROM ipaddress ip
LEFT JOIN devices d ON ip.ipaddress = d.ipAddress
LEFT JOIN cctv c ON ip.ipaddress = c.ipAddress
LEFT JOIN printer p ON ip.ipaddress = p.ipAddress
WHERE (CONCAT_WS(',', d.id, c.id, p.id) = '' OR d.deactivated = 1)
AND ip.ipaddress NOT IN (
    SELECT ipaddress
    FROM devices
    WHERE deactivated = 0
)";
$result = mysqli_query($con,$sql);
$options = array();
while($row=mysqli_fetch_assoc($result)){

    $options[] = $row;

}
echo json_encode($options);


?>