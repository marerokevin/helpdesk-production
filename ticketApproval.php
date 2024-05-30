<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("includes/connect.php");
if (isset($_GET['id']) && isset($_GET['head'])) {

    $sqllink = "SELECT `link` FROM `setting`";
    $resultlink = mysqli_query($con, $sqllink);
    $link = "";
    while ($listlink = mysqli_fetch_assoc($resultlink)) {
        $link = $listlink["link"];
    }

    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM `request` WHERE `id`='" . $id . "'");
    $row = mysqli_fetch_assoc($query);
    $approval_date = $row['ict_approval_date'];
    $personnelName =  $row['assignedPersonnelName'];
    $date = new DateTime($row['date_filled']);
    $date = $date->format('ym');
    $completejoid = $date . '-' . $id;
    $requestor = $row['requestor'];
    $request_type = $row['request_type'];
    $ticket_category = $row['ticket_category'];
    $cat_lvl = $row['category_level'];
    $detailsOfRequest = $row['request_details'];
    $assigned = $row['assignedPersonnel'];
    $requestorEmail = $row['email'];
    $requestorDepartment = $row['department'];
    $ticketNumber = 'TS-' . $completejoid;
    $onsthespot = $row['onthespot_ticket'];

    $_SESSION['ticket_number'] =  $ticketNumber;
    $_SESSION['requestor'] = $requestor;
    $_SESSION['pdepartment'] = $requestorDepartment;
    $_SESSION['dateFiled'] = $row['date_filled'];
    $_SESSION['type'] = $request_type;
    $_SESSION['details'] = $detailsOfRequest;
    $_SESSION['assignedPersonnel'] = $personnelName;
    $_SESSION['requestType'] = $request_type;
    $_SESSION['ticket_category'] = $ticket_category;
    $_SESSION['adminsDate'] = $approval_date;
    $_SESSION['onthespot_ticket'] = $onsthespot;

    $_SESSION['adminsRemarks']  = $row['admin_remarks'];
    $_SESSION['firstAction'] =  $row['action1'];
    $_SESSION['firstDate'] =  $row['action1Date'];
    $_SESSION['secondAction'] =  $row['action2'];
    $_SESSION['secondDate'] = $row['action2Date'];
    $_SESSION['thirdAction'] =  $row['action3'];
    $_SESSION['thirdDate'] =  $row['action3Date'];
    $_SESSION['finalAction'] =  $row['action'];
    $_SESSION['recommendation'] =  $row['recommendation'];
    $_SESSION['dateFinished'] =  $row['confirm_finish_date'];
    $_SESSION['approved_reco'] =  $row['approved_reco'];
    $_SESSION['icthead_reco_remarks'] =  $row['icthead_reco_remarks'];





    $sql1 = "Select * FROM `user` WHERE `username` = '$assigned'";
    $result = mysqli_query($con, $sql1);
    while ($list = mysqli_fetch_assoc($result)) {
        $personnelEmail = $list["email"];
    }


    if ($approval_date != NULL) {
        echo "<script>alert('Request already approved! Date of approval: $approval_date');</script>";
        echo "<script>location.href= '$link/login.php';</script>";
    } else {
        $datenow = date("Y-m-d");
        $dateToday = date('Y-m-d H:i:s', time());
        $sql = "UPDATE `request` SET `status2` = 'inprogress', `admin_approved_date`='$datenow', `ict_approval_date`='$dateToday' WHERE `id` = '$id';";
        $results = mysqli_query($con, $sql);
        if ($results) {
            $sql2 = "Select * FROM `sender`";
            $result2 = mysqli_query($con, $sql2);
            while ($list = mysqli_fetch_assoc($result2)) {
                $account = $list["email"];
                $accountpass = $list["password"];
            }
            $subject = 'New Ticket Request';
            $message = 'Hi ' . $personnelName . ',<br> <br>   You have a new ticket request with TS number TS-' . $completejoid . ' from ' . $requestor . '. Please check the details below or by signing in into our Helpdesk. <br> Click this ' . $link . ' to sign in. <br><br>Ticket No.: ' . $ticketNumber . '<br> Requestor: ' . $requestor . '<br> Requestor Email: ' . $requestorEmail . '<br> Requestor Department: ' . $requestorDepartment . '<br>Request Type: ' . $request_type . '<br> Ticket Category: ' . $ticket_category . '<br>Category Level: ' . $cat_lvl . '<br> Request Details: ' . $detailsOfRequest . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';


            require 'vendor/autoload.php';
            require 'dompdf/vendor/autoload.php';
            ob_start();
            require 'Job Order Report copy.php';
            $html = ob_get_clean();
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                     // Set mailer to use SMTP
                $mail->Host = 'mail.glorylocal.com.ph';              // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                             // Enable SMTP authentication
                $mail->Username = $account;                         // Your Email/ Server Email
                $mail->Password = $accountpass;                     // Your Password
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPSecure = 'none';
                $mail->Port = 465;

                //Email ICT personnel / FEM admin
                //Recipients
                $mail->setFrom('helpdesk@glorylocal.com.ph', 'Helpdesk');
                $mail->addAddress($personnelEmail);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                // Generate PDF content using Dompdf
                $dompdf = new Dompdf\Dompdf();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A5', 'portrait'); // Set paper size and orientation
                $dompdf->render();
                $pdfContent = $dompdf->output();

                // Attach PDF to the email
                $mail->addStringAttachment($pdfContent, 'Helpdesk Report.pdf', 'base64', 'application/pdf');
                $mail->Body = $message;
                $mail->send();

                $_SESSION['message'] = 'Message has been sent';
                echo "<script>alert('Thank you for approving.') </script>";
                echo "<script> location.href='index.php'; </script>";

                // header("location: form.php");
            } catch (Exception $e) {
                $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                echo "<script>alert('Message could not be sent. Mailer Error.') </script>";
            }
            // echo "<script>alert('Request has been approved successfully!');</script>";
            // echo "<script>location.href='$link/login.php';</script>";
        } else {
            echo "<script>alert('There is a problem with filing. Please contact your administrator.');</script>";
        }
    }
}

// if (isset($_GET['id']) && isset($_GET['requestor'])) {
//     $sqllink = "SELECT `link` FROM `setting`";
//     $resultlink = mysqli_query($con, $sqllink);
//     $link = "";
//     while ($listlink = mysqli_fetch_assoc($resultlink)) {
//         $link = $listlink["link"];
//     }

//     $id = $_GET['id'];
//     $query = mysqli_query($con, "SELECT * FROM `request` WHERE `id`='" . $id . "'");
//     $row = mysqli_fetch_assoc($query);
//     $approval_date = $row['requestor_approval_date'];

//     if ($approval_date != NULL) {
//         echo "<script>alert('Request already approved! Date of approval: $approval_date');</script>";
//         echo "<script>location.href='$link/login.php';</script>";
//     } else {
//         $dateToday = date('Y-m-d H:i:s', time());
//         $sql = "UPDATE `request` SET `requestor_approval_date`='$dateToday' WHERE `id` = '$id';";
//         $results = mysqli_query($con, $sql);
//         if ($results) {
//             echo "<script>alert('Request has been approved successfully!');</script>";
//             echo "<script>location.href='$link/login.php';</script>";
//         } else {
//             echo "<script>alert('There is a problem with filing. Please contact your administrator.');</script>";
//         }
//     }
// }
