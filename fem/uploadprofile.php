<?php
 // Replace with your actual username
$username = $_POST['username'];

$uploadDir = '../src/Photo/';
$uploadFile = $uploadDir . $username . '.png';

$response = array();

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
    $response['success'] = true;
    $response['success'] = 'File move operation failed: ' . $_FILES['file']['tmp_name'];
} else {
    $response['success'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
