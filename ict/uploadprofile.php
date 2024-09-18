<<<<<<< HEAD
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
=======
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
>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
