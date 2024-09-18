<?php
include ("../includes/connect.php");

if (isset($_GET['department'])) {
  $department = $_GET['department'];
  error_log("Department received: " . $department);
  // Assuming you have a database connection established
  $sqlpc = "SELECT DISTINCT pctag FROM devices WHERE department = '$department' AND pctag != ''";
  $resultpc = mysqli_query($con, $sqlpc);

  $options = array();
  while ($row = mysqli_fetch_assoc($resultpc)) {
    $options[] = $row['pctag'];
  }

  echo json_encode($options);
} else {
  echo json_encode(array()); // Return an empty array if no department provided
}
?>