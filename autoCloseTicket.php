<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("includes/connect.php");

$sqllink = "SELECT `link` FROM `setting`";
$resultlink = mysqli_query($con, $sqllink);
$link = "";
while ($listlink = mysqli_fetch_assoc($resultlink)) {
    $link = $listlink["link"];
}
$sql2 = "Select * FROM `sender`";
$result2 = mysqli_query($con, $sql2);
while ($list = mysqli_fetch_assoc($result2)) {
    $account = $list["email"];
    $accountpass = $list["password"];
}
$datenow = date("Y-m-d");
$dateToday = date('Y-m-d H:i:s', time());
$query = mysqli_query($con, "SELECT * FROM `request` WHERE requestor_approval_date IS NULL AND request_to = 'mis' AND completed_date IS NOT NULL AND `ticket_close_date` IS NULL AND completed_date BETWEEN '2024-05-28' AND '$datenow'");
while ($row = $query->fetch_assoc()) {
    $id = $row['id'];
    $requestor = $row['requestor'];
    $email = $row['email'];
    $completed_date = new DateTime($row['completed_date']);
    $today = new DateTime();
    $today->format('Y-m-d');
    $date1 = new DateTime($row['date_filled']);
    $date = $date1->format('ym');
    $request_type = $row['request_type'];
    $detailsOfRequest = $row['request_details'];
    $r_personnelsName = $row['assignedPersonnelName'];
    $ticket_category = $row['request_category'];
    $datecompleted = $completed_date->format('F d, Y');
    $ticket_filer = $row['ticket_filer'];
    $date_filed = $date1->format('F d, Y');

    if ($request_type === "Technical Support") {
        $completejoid = 'TS-' . $date . '-' . $id;
    } else {
        $completejoid = 'JO-' . $date . '-' . $id;
    }

    // Define holidays array
    $sqlHoli = "SELECT holidaysDate FROM holidays";
    $resultHoli = mysqli_query($con, $sqlHoli);
    $holidays = array();
    while ($row = mysqli_fetch_assoc($resultHoli)) {
        $holidays[] = $row['holidaysDate'];
    }
    $interval = $completed_date->diff($today);
    $days = $interval->days;

    // Loop through the days between the two dates
    for ($i = 0; $i < $days; $i++) {
        // Get the current date
        $currentDate = clone $completed_date;
        $currentDate->add(new DateInterval('P' . $i . 'D'));

        // Check if the current date is a weekend or a holiday
        if ($currentDate->format('N') >= 6 || in_array($currentDate->format('Y-m-d'), $holidays)) {
            // Subtract 1 from the total number of days
            $days--;
        }
    }


    if ($days >= 5) {
        $sql = "UPDATE `request` SET `ticket_close_date` = '$dateToday' WHERE `requestor_approval_date` IS NULL AND `request_to` = 'mis' AND `completed_date` IS NOT NULL AND `id` = '$id' AND `ticket_close_date` IS NULL AND completed_date BETWEEN '2024-05-28' AND '$datenow'";
        $results = mysqli_query($con, $sql);

        if ($results) {
            require 'vendor/autoload.php';
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'mail.glorylocal.com.ph';
                $mail->SMTPAuth = true;
                $mail->Username = $account;
                $mail->Password = $accountpass;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPSecure = 'none';
                $mail->Port = 465;
                $mail->setFrom('helpdesk@glorylocal.com.ph', 'Helpdesk');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Ticket Closed";
                $mail->Body = "Hi $requestor,<br> 
                <br>Your request $completejoid has been automatically closed by the system.  Please check the details below or by signing in into our Helpdesk. <br> Click this $link to sign in. <br>
                <br>Request Type: $request_type
                <br>Request Category: $ticket_category 
                <br>Request Details: $detailsOfRequest 
                <br>Assigned Personnel:  $r_personnelsName 
                <br>Ticket Filer: $ticket_filer 
                <br>Date Filed: $date_filed 
                <br>Date Completed:  $datecompleted 
                <br><br><br>  This is a generated email. Please do not reply. <br><br> Helpdesk";
                $mail->send();
                $_SESSION['message'] = 'Message has been sent';
            } catch (Exception $e) {
                $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        }
    }
}
