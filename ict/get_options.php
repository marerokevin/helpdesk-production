<<<<<<< HEAD
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
=======
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
>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
?>