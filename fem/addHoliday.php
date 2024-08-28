<?php 
include ("../includes/connect.php");

    $date = $_POST['date'];



    $checkQuery = "SELECT * FROM holidays WHERE holidaysDate = '$date'";
    $checkResult = mysqli_query($con, $checkQuery);

    // Check if any rows were returned (date already exists)
    if (mysqli_num_rows($checkResult) > 0) {
        // echo "Date already exists in the database.";
        $sqlUpdate = "DELETE FROM `holidays` WHERE `holidaysDate` = '$date'";
        $resultsUpdate = mysqli_query($con, $sqlUpdate);
        if ($resultsUpdate) {
            $response = array('message' => 'Date removed to the database successfully');
    
        }
    } else {
        // Insert the date into the 'holidays' table
        $sqlUpdate = "INSERT INTO holidays (holidaysDate) VALUES ('$date')";
        $resultsUpdate = mysqli_query($con, $sqlUpdate);

        if ($resultsUpdate) {
            $response = array('message' => 'Date added to the database successfully');
        
            // echo "Date added to the database successfully.";
            
        } else {
            // echo "Error inserting date into the database.";
            $response = array('message' => 'Error inserting date into the database.');

        }
    }

    echo json_encode($response);

?>