<?php
$timeout = 3600;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set("session.gc_maxlifetime", $timeout);

ini_set("session.cookie_lifetime", $timeout);

$s_name = session_name();

if (isset($_COOKIE[$s_name])) {

    setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
} else

    echo "Session is expired.<br/>";


session_start();

include("../includes/connect.php");
if (isset($_SESSION['connected'])) {


    $level = $_SESSION['level'];
    $leaderof = $_SESSION['leaderof'];
    if ($level == 'user') {
        header("location:../employees");
    } else if ($level == 'fem') {
        header("location:../fem");
    } else if ($level == 'mis') {
        header("location:../mis");
    } else if ($level == 'head') {
        header("location:../department-head");
    } else if ($leaderof == 'mis') {
        header("location:../department-admin");
    }
}
if (!isset($_SESSION['connected'])) {
    header("location: ../logout.php");
}


$sqllink = "SELECT `link` FROM `setting`";
$resultlink = mysqli_query($con, $sqllink);
$link = "";
while ($listlink = mysqli_fetch_assoc($resultlink)) {
    $link = $listlink["link"];
}

$user_dept = $_SESSION['department'];
$user_level = $_SESSION['level'];

$_SESSION['jobOrderNo'] = "";
$_SESSION['status'] = "";
$_SESSION['requestor'] = "";
$_SESSION['pdepartment'] = "";
$_SESSION['dateFiled'] = "";
$_SESSION['requestedSchedule'] = "";
$_SESSION['type'] = "";
$_SESSION['pcNumber'] = "";
$_SESSION['details'] = "";
$_SESSION['headsRemarks'] = "";
$_SESSION['adminsRemarks'] = "";
$_SESSION['assignedPersonnel'] = "";
$_SESSION['section'] = "";
$_SESSION['firstAction'] = "";
$_SESSION['firstDate'] = "";
$_SESSION['secondAction'] = "";
$_SESSION['secondDate'] = "";
$_SESSION['thirdAction'] = "";
$_SESSION['thirdDate'] = "";
$_SESSION['finalAction'] = "";
$_SESSION['recommendation'] = "";
$_SESSION['dateFinished'] = "";
$_SESSION['ratedBy'] = "";
$_SESSION['delivery'] = "";
$_SESSION['quality'] = "";
$_SESSION['totalRating'] = "";
$_SESSION['ratingRemarks'] = "";
$_SESSION['ratedDate'] = "";
$_SESSION['headsDate'] = "";
$_SESSION['adminsDate'] = "";

if (isset($_POST['transferJo'])) {
    $joidtransfer =  $_POST['joidtransfer'];
    $assigned = $_POST['transferUser'];



    $sql1 = "Select * FROM `user` WHERE `username` = '$assigned'";
    $result = mysqli_query($con, $sql1);
    while ($list = mysqli_fetch_assoc($result)) {
        $personnelEmail = $list["email"];
        $personnelName = $list["name"];
    }
    $sql = "UPDATE `request` SET `assignedPersonnel`='$assigned',`assignedPersonnelName`='$personnelName' WHERE `id` = '$joidtransfer';";
    $results = mysqli_query($con, $sql);
    if ($results) {
        echo "<script>alert('Successfuly transfered request.')</script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

if (isset($_POST['changeSchedJo'])) {
    $joidtransfer =  $_POST['joidtransfer'];
    // $targetDate = $_POST['changeScheddate']; 
    $targetDate = $_POST['expectedfinishdate'];

    $sql = "UPDATE `request` SET `expectedFinishDate`='$targetDate' WHERE `id` = '$joidtransfer';";
    $results = mysqli_query($con, $sql);
    if ($results) {
        echo "<script>alert('Successfuly changed target finish date.' )</script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

if (isset($_POST['print'])) {
    $_SESSION['jobOrderNo'] = $_POST['pjobOrderNo'];
    $_SESSION['status'] = $_POST['pstatus'];
    $_SESSION['requestor'] = $_POST['prequestor'];
    $_SESSION['pdepartment'] = $_POST['pdepartment'];
    $_SESSION['dateFiled'] = $_POST['pdateFiled'];
    $_SESSION['requestedSchedule'] = $_POST['prequestedSchedule'];
    $_SESSION['type'] = $_POST['ptype'];
    $_SESSION['pcNumber'] = $_POST['ppcNumber'];
    $_SESSION['details'] = $_POST['pdetails'];
    $_SESSION['headsRemarks'] = $_POST['pheadsRemarks'];
    $_SESSION['adminsRemarks'] = $_POST['padminsRemarks'];
    $_SESSION['headsDate'] = $_POST['pheadsDate'];
    $_SESSION['adminsDate'] = $_POST['padminsDate'];
    // $_SESSION['assignedPersonnel'] = $_POST['passignedPersonnel'];
    $_SESSION['section'] = $_POST['psection'];
    $_SESSION['firstAction'] = $_POST['pfirstAction'];
    $_SESSION['firstDate'] = $_POST['pfirstDate'];
    $_SESSION['secondAction'] = $_POST['psecondAction'];
    $_SESSION['secondDate'] = $_POST['psecondDate'];
    $_SESSION['thirdAction'] = $_POST['pthirdAction'];
    $_SESSION['thirdDate'] = $_POST['pthirdDate'];
    $_SESSION['finalAction'] = $_POST['pfinalAction'];
    $_SESSION['recommendation'] = $_POST['precommendation'];
    $_SESSION['dateFinished'] = $_POST['pdateFinished'];
    $_SESSION['ratedBy'] = $_POST['pratedBy'];
    $_SESSION['delivery'] = $_POST['pdelivery'];
    $_SESSION['quality'] = $_POST['pquality'];
    $_SESSION['totalRating'] = $_POST['ptotalRating'];
    $_SESSION['ratingRemarks'] = $_POST['pratingRemarks'];
    $_SESSION['ratedDate'] = $_POST['pratedDate'];
    $_SESSION['approved_reco'] = $_POST['papproved_reco'];
    $_SESSION['icthead_reco_remarks'] = $_POST['picthead_reco_remarks'];

    if (isset($_POST['assigned'])) {
        $assigned = $_POST['assigned'];
        $sql1 = "Select * FROM `user` WHERE `username` = '$assigned'";
        $result = mysqli_query($con, $sql1);
        while ($list = mysqli_fetch_assoc($result)) {
            $personnelEmail = $list["email"];
            $personnelName = $list["name"];
        }
        $_SESSION['assignedPersonnel'] =  $personnelName;
    } else {

        $sql1 = "Select * FROM `user` WHERE `username` = '$assigned'";
        $result = mysqli_query($con, $sql1);
        while ($list = mysqli_fetch_assoc($result)) {
            $personnelEmail = $list["email"];
            $personnelName = $list["name"];
        }


        // $personnelName = $_POST['passignedPersonnel'];
        $_SESSION['assignedPersonnel'] = $_POST['passignedPersonnel'];
    }

?>
    <script type="text/javascript">
        window.open('./Job Order Report.php', '_blank');
    </script>
<?php

}
function addWeekdays($startDate, $daysToAdd)
{
    $currentDate = strtotime($startDate);

    while ($daysToAdd > 0) {
        $currentDayOfWeek = date('N', $currentDate);

        // Skip Saturday (6) and Sunday (7)
        if ($currentDayOfWeek >= 6) {
            $currentDate = strtotime('+1 day', $currentDate);
            continue;
        }

        $currentDate = strtotime('+1 day', $currentDate);
        $daysToAdd--;
    }

    return date('Y-m-d', $currentDate);
}

if (isset($_POST['approveRequest'])) {


    $_SESSION['jobOrderNo'] = $_POST['pjobOrderNo'];
    $_SESSION['requestor'] = $_POST['prequestor'];
    $_SESSION['pdepartment'] = $_POST['pdepartment'];
    $_SESSION['dateFiled'] = $_POST['pdateFiled'];
    $_SESSION['requestedSchedule'] = $_POST['prequestedSchedule'];
    $_SESSION['type'] = $_POST['ptype'];
    $_SESSION['pcNumber'] = $_POST['ppcNumber'];
    $_SESSION['details'] = $_POST['pdetails'];
    $_SESSION['section'] = $_POST['psection'];
    $_SESSION['firstAction'] = $_POST['pfirstAction'];
    $_SESSION['firstDate'] = $_POST['pfirstDate'];
    $_SESSION['secondAction'] = $_POST['psecondAction'];
    $_SESSION['secondDate'] = $_POST['psecondDate'];
    $_SESSION['thirdAction'] = $_POST['pthirdAction'];
    $_SESSION['thirdDate'] = $_POST['pthirdDate'];
    $_SESSION['finalAction'] = $_POST['pfinalAction'];
    $_SESSION['recommendation'] = $_POST['precommendation'];
    $_SESSION['dateFinished'] = $_POST['pdateFinished'];
    $_SESSION['ratedBy'] = $_POST['pratedBy'];
    $_SESSION['delivery'] = $_POST['pdelivery'];
    $_SESSION['quality'] = $_POST['pquality'];
    $_SESSION['totalRating'] = $_POST['ptotalRating'];
    $_SESSION['ratingRemarks'] = $_POST['pratingRemarks'];
    $_SESSION['ratedDate'] = $_POST['pratedDate'];
    $_SESSION['approved_reco'] = $_POST['papproved_reco'];
    $_SESSION['icthead_reco_remarks'] = $_POST['picthead_reco_remarks'];
    $_SESSION['requestType'] = $_POST['prequestType'];
    $_SESSION['expectedfinishdate'] = $_POST['expectedfinishdate'];


    if ($_POST['pheadsDate'] != NULL) {

        $_SESSION['headsRemarks'] = $_POST['pheadsRemarks'];
        $_SESSION['headsDate'] = $_POST['pheadsDate'];
    } else if ($_POST['padminsRemarks'] != NULL) {

        $_SESSION['adminsRemarks'] = $_POST['padminsRemarks'];
        $_SESSION['adminsDate'] = $_POST['padminsDate'];
    } else if ($_POST['pheadsDate'] == NULL && $_POST['padminsRemarks'] == NULL) {

        $_SESSION['headsRemarks'] = $_POST['remarks'];
        $_SESSION['headsDate'] = date("Y-m-d");
    } else if ($_POST['padminsRemarks'] == NULL && $_POST['pheadsDate'] != NULL) {

        $_SESSION['adminsRemarks'] = $_POST['remarks'];
        $_SESSION['adminsDate'] = date("Y-m-d");
    }

    $request_type =   $_POST['prequestType'];
    $requestID = $_POST['joid2'];
    $completejoid = $_POST['completejoid'];
    $section = $_POST['psection'];
    $remarks = $_POST['remarks'];
    $requestor = $_POST['requestor'];
    $requestorEmail = $_POST['requestoremail'];

    if (isset($_POST['assigned'])) {
        $assigned = $_POST['assigned'];
        $sql1 = "Select * FROM `user` WHERE `username` = '$assigned'";
        $result = mysqli_query($con, $sql1);
        while ($list = mysqli_fetch_assoc($result)) {
            $personnelEmail = $list["email"];
            $personnelName = $list["name"];
        }
        $_SESSION['assignedPersonnel'] =  $personnelName;
    } else {
        $personnelName = $_POST['passignedPersonnel'];
        $_SESSION['assignedPersonnel'] = $_POST['passignedPersonnel'];
    }



            
    $r_assistantsName = $_POST['r_assistantsName'];

    if (isset($_POST['assistants']))

    {
        $r_assistants = $_POST['assistants'];


        if ($r_assistants != "") {
      
          $r_assistants = implode(', ', $r_assistants);
        }

    }
    else{
        $r_assistants = "";
    }



    $cat_lvl;
    $sql1 = "Select * FROM `request` WHERE `id` = '$requestID'";
    $result = mysqli_query($con, $sql1);
    while ($list = mysqli_fetch_assoc($result)) {
        $request_type = $list['request_type'];
        $request_category = $list["request_category"];
        $detailsOfRequest = $list["request_details"];
        // $r_personnelsName=$list["assignedPersonnelName"];
        $ticket_category = $list["ticket_category"];
        $user_name = $list["ticket_filer"];
        $cat_lvl = $list['category_level'];
    }
    $_SESSION['ticket_category'] =  $ticket_category;

    $start = $_POST['start'];
    $finish = $_POST['finish'];

    // echo "<script> console.log('" $requestID; "') </script>";
    $dateToday = date('Y-m-d H:i:s', time());
    $newDate = $_POST['expectedfinishdate'];

    $username = $_SESSION['name'];
    if ($section  === "ICT" || $section === "mis") {
        $_SESSION['status'] = 'inprogress';
        $sql = "UPDATE `request` SET `status2`='inprogress',`reqstart_date` = '$start',`reqfinish_date` = '$finish',`admin_approved_date`='$dateToday',`expectedFinishDate` = '$newDate',`admin_remarks`='$remarks',`assignedPersonnel`='$assigned',`assignedPersonnelName`='$personnelName', `ict_approval_date`= '$dateToday' WHERE `id` = '$requestID';";
    } elseif ($section === "FEM" || $section === "fem") {
        $_SESSION['status'] = 'inprogress';
        $sql = "UPDATE `request` SET `status2`='inprogress',`reqstart_date` = '$start',`reqfinish_date` = '$finish',`admin_approved_date`='$dateToday',`expectedFinishDate` = '$newDate',`admin_remarks`='$remarks',`assignedPersonnel`='$assigned',`assignedPersonnelName`='$personnelName', `assistantsId` = '$r_assistants',`assistanNames`='$r_assistantsName', `ict_approval_date`= '$dateToday' WHERE `id` = '$requestID';";
//    echo $sql;
    }
    $results = mysqli_query($con, $sql);


    if ($results) {
        $sql2 = "Select * FROM `sender`";
        $result2 = mysqli_query($con, $sql2);
        while ($list = mysqli_fetch_assoc($result2)) {
            $account = $list["email"];
            $accountpass = $list["password"];
        }

        require '../vendor/autoload.php';

        if ($section === "FEM" || $section === "fem") {

            if ($request_type === "Technical Support") {
                $subject = 'New Ticket Request';
                $message = 'Hi ' . $personnelName . ',<br> <br>   You have a new ticket request with TS number ' . $completejoid . ' from ' . $requestor . '. Please check the details below or by signing in into our Helpdesk. <br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br> Ticket Category: ' . $ticket_category . '<br> Request Details: ' . $detailsOfRequest . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';

                $subject2 = 'Approved Ticket Request';
                $message2 = 'Hi ' . $requestor . ',<br> <br>  Your ticket request with TS number ' . $completejoid . ' is now approved by the administrator. It is now in progress. Please check the details below or by signing in into our Helpdesk. <br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br> Ticket Category: ' . $ticket_category . '<br>Request Details: ' . $detailsOfRequest . '<br> Assigned Personnel: ' . $personnelName . '<br> Ticket Filer: ' . $user_name . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';
            } else {
                $request_type = "Job Order";
                $subject = 'Job Order Request';
                $message = 'Hi ' . $personnelName . ',<br> <br>   You have a new job order with JO number ' . $completejoid . ' from ' . $requestor . '. Please check the details below or by signing in into our Helpdesk. <br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br> Request Category: ' . $request_category . '<br>Request Details: ' . $detailsOfRequest . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';

                $subject2 = 'Approved Job Order';
                $message2 = 'Hi ' . $requestor . ',<br> <br>  Your Job Order with JO number ' . $completejoid . ' is now approved by the administrator. It is now in progress. Please check the details below or by signing in into our Helpdesk. <br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br> Request Category: ' . $request_category . '<br>Request Details: ' . $detailsOfRequest . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';
            }
        } elseif ($section === "ICT" || $section === "mis") {
            $sql1 = "Select * FROM `user` WHERE `level` = 'admin' AND `leader` = 'mis' ";
            $result = mysqli_query($con, $sql1);
            while ($list = mysqli_fetch_assoc($result)) {
                $personnelEmail = $list["email"];
                $leaderName = $list["name"];
            }
            $subject = 'Job Order Request';
            $message = 'Hi ' . $leaderName . ',<br> <br>   Mr/Ms. ' . $requestor . ' filed a job order with JO number ' . $completejoid . ' . Please check the details below or by signing in into our Helpdesk.  <br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br> Request Category: ' . $request_category . '<br>Request Details: ' . $detailsOfRequest . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';

            $subject2 = 'Approved Job Order';
            $message2 = 'Hi ' . $requestor . ',<br> <br>  Your Job Order with JO number ' . $completejoid . ' is now approved by your head. It is now sent to your administrator. Please check the details below or by signing in into our Helpdesk.<br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br> Request Category: ' . $request_category . '<br>Request Details: ' . $detailsOfRequest . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';
        }
        require '../vendor/autoload.php';
        require '../dompdf/vendor/autoload.php';
        ob_start();
        require 'Job Order Report copy.php';
        $html = ob_get_clean();
        $mail = new PHPMailer(true);
        $mail2 = new PHPMailer(true);


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

            //Email Requestor
            //Server settings
            $mail2->isSMTP();                                     // Set mailer to use SMTP
            $mail2->Host = 'mail.glorylocal.com.ph';              // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                              // Enable SMTP authentication
            $mail2->Username = $account;                          // Your Email/ Server Email
            $mail2->Password = $accountpass;                      // Your Password
            $mail2->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail2->SMTPSecure = 'none';
            $mail2->Port = 465;


            //Recipients
            $mail2->setFrom('helpdesk@glorylocal.com.ph', 'Helpdesk');
            $mail2->addAddress($requestorEmail);
            $mail2->isHTML(true);
            // Generate PDF content using Dompdf
            $dompdf = new Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A5', 'portrait'); // Set paper size and orientation
            $dompdf->render();
            $pdfContent = $dompdf->output();

            // Attach PDF to the email
            $mail2->addStringAttachment($pdfContent, 'Helpdesk Report.pdf', 'base64', 'application/pdf');
            $mail2->Subject = $subject2;
            $mail2->Body    = $message2;

            $mail2->send();
            $_SESSION['message'] = 'Message has been sent';
            echo "<script>alert('Thank you for approving.') </script>";
            echo "<script> location.href='index.php'; </script>";



            // header("location: form.php");
        } catch (Exception $e) {
            $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            echo "<script>alert('Message could not be sent. Mailer Error.') </script>";
        }
    } // end of sending email



}

if (isset($_POST['cancelJO'])) {
    $joid = $_POST['joid2'];
    $reasonCancel = $_POST['reasonCancel'];
    $requestorEmail = $_POST['requestoremail'];
    $requestor = $_POST['requestor'];
    $completejoid = $_POST['completejoid'];
    $request_type = $_POST['ptype'];
    $detailsOfRequest = $_POST['pdetails'];
    $dateOfCancellation = date("Y-m-d");
    $cancelledBy =  $_SESSION['name'];

    $sql = "UPDATE `request` SET `status2`='cancelled', `reasonOfCancellation`='$reasonCancel', `dateOfCancellation` = '$dateOfCancellation', `cancelledBy` = '$cancelledBy' WHERE `id` = '$joid';";
    $results = mysqli_query($con, $sql);
    if ($results) {
        $sql2 = "Select * FROM `sender`";
        $result2 = mysqli_query($con, $sql2);
        while ($list = mysqli_fetch_assoc($result2)) {
            $account = $list["email"];
            $accountpass = $list["password"];
        }

        require '../vendor/autoload.php';

        $mail = new PHPMailer(true);
        //  email the admin               
        try {
            //Server settings

            $subject2 = 'Cancelled Request';
            $message2 = 'Hi ' . $requestor . ',<br> <br>  Your request with request number of ' . $completejoid . ' is CANCELLED by the administrator. Please check the details by signing in into our Helpdesk <br> Click this ' . $link . ' to sign in. <br><br>Request to: FEM <br>Request Type: ' . $request_type . '<br> Request Details: ' . $detailsOfRequest . '<br> Reason for Cancellation: ' . $reasonCancel . '<br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';

            // email this requestor

            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.glorylocal.com.ph';               // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $account;                           // Your Email/ Server Email
            $mail->Password = $accountpass;                       // Your Password
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->SMTPSecure = 'none';
            $mail->Port = 465;

            //Send Email
            // $mail->setFrom('Helpdesk'); //eto ang mag front  notificationsys01@gmail.com

            //Recipients
            $mail->setFrom('mis.dev@glory.com.ph', 'Helpdesk');
            $mail->addAddress($requestorEmail);
            $mail->isHTML(true);
            $mail->Subject = $subject2;
            $mail->Body    = $message2;

            $mail->send();
            $_SESSION['message'] = 'Message has been sent';
            echo "<script>alert('The request was successfully cancelled.') </script>";
            echo "<script> location.href='index.php'; </script>";

            // header("location: form.php");
        } catch (Exception $e) {
            $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            echo "<script>alert('Message could not be sent. Mailer Error.') </script>";
        }
    }
}

if (isset($_POST["approveReco"])) {
    $requestID = $_POST['joid2'];
    $remarks = $_POST['ictheadrecoremarks'];

    $sql = "UPDATE `request` SET `approved_reco`= 1 ,`icthead_reco_remarks` = '$remarks' WHERE `id` = '$requestID';";
    $results = mysqli_query($con, $sql);
}

// Function to add weekdays, excluding weekends and holidays
$sqlHoli = "SELECT holidaysDate FROM holidays";
$resultHoli = mysqli_query($con, $sqlHoli);
$holidays = array();
while ($row = mysqli_fetch_assoc($resultHoli)) {
    $holidays[] = $row['holidaysDate'];
}

// Function to add weekdays, excluding weekends and holidays
function addWeekdays2($startDate, $daysToAdd, $holidays)
{
    $currentDate = strtotime($startDate); // ict approval date
    $weekdaysAdded = 0;

    while ($weekdaysAdded < $daysToAdd) {
        $currentDayOfWeek = date('N', $currentDate);

        // Exclude weekends (Saturday and Sunday)
        if ($currentDayOfWeek < 6) {
            $isHoliday = in_array(date('Y-m-d', $currentDate), $holidays);

            // Exclude holidays
            if (!$isHoliday) {
                $weekdaysAdded++;
            }
        }

        // Move to the next day
        $currentDate = strtotime('+1 day', $currentDate);
    }

    return date('Y-m-d', $currentDate);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk</title>

    <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">

    <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

    <link rel="stylesheet" href="index.css">
    <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../cdn_tailwindcss.js"></script>

    <link rel="stylesheet" href="../node_modules/flowbite/dist/flowbite.min.css">
    <link rel="shortcut icon" href="../resources/img/helpdesk.png">


</head>

<body class="static  bg-white dark:bg-gray-900">
    <?php require_once 'nav.php'; ?>
    <div id="loading-message">
        <div role="status" class="self-center flex">
            <svg aria-hidden="true" class="inline w-10 h-10 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
            <span class="">Loading...</span>
            <!-- <p class="inset-y-1/2 absolute">Loading...</p> -->
        </div>

    </div>
    <div id="mainContent" class=" ml-72 flex mt-16  left-10 right-5  flex-col  px-14 sm:px-8  pt-6 pb-14 z-50 ">

        <div class="justify-center text-center flex items-start h-auto bg-gradient-to-r from-blue-900 to-teal-500 rounded-xl ">
            <div class="text-center py-2 m-auto lg:text-center w-full">

                <div class="m-auto flex flex-col w-2/4  h-12 hidden">
                    <h2 class="text-xl font-bold tracking-tight text-gray-100 sm:text-xl">Total numbers of pending Job Order
                    </h2>

                </div>


                <div class="m-auto flex flex-col w-2/4 hidden">

                    <div class="mt-0 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 ">

                        <div class="flex items-start rounded-xl bg-teal-700 dark:bg-white p-4 shadow-lg">
                            <div class="flex h-12 w-12 overflow-hidden items-center justify-center rounded-full border border-red-100 bg-red-50">
                                <img src="../resources/img/Engineer.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            </div>

                            <div class="ml-3">
                                <h2 class="font-semibold text-gray-100 dark:text-gray-900">FEM Pending</h2>
                                <p class="mt-2 text-xl text-left text-gray-100"><?php
                                                                                $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE request_to = 'fem' AND status2 = 'inprogress'";
                                                                                $result = mysqli_query($con, $sql1);
                                                                                while ($count = mysqli_fetch_assoc($result)) {
                                                                                    echo $count["pending"];
                                                                                }
                                                                                ?></p>
                            </div>
                        </div>
                        <div class="flex items-start rounded-xl bg-sky-900 dark:bg-white p-4 shadow-lg">
                            <div class="flex h-12 w-12 items-center overflow-hidden  justify-center rounded-full border border-indigo-100 bg-indigo-50">
                                <img src="../resources/img/itboy.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            </div>

                            <div class="ml-3">
                                <h2 class="font-semibold text-gray-100 dark:text-gray-900">ICT Pending</h2>
                                <p class="mt-2 text-xl text-left text-gray-100"><?php
                                                                                $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE request_to = 'mis' AND status2 = 'inprogress'";
                                                                                $result = mysqli_query($con, $sql1);
                                                                                while ($count = mysqli_fetch_assoc($result)) {
                                                                                    echo $count["pending"];
                                                                                }
                                                                                ?></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="FrD3PA">
                    <div class="QnQnDA" tabindex="-1">
                        <div role="tablist" style="overflow:inherit" class="_6TVppg sJ9N9w">
                            <div class="uGmi4w">
                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="tabExample" role="tablist">
                                    <li role="presentation">
                                        <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                            <button id="overallTab" onclick="goToOverall()" type="button" role="tab" aria-controls="overAll" class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php
                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `request_to` = 'fem'";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"> <?php
                                                                                                                                                                                                                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `request_to` = 'fem'";
                                                                                                                                                                                                                                                        $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        while ($count = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                                                                            echo $count["pending"];
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        ?></div><?php
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                ?>
                                                        <span class="gkK1Zg"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                                                <path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24s10.7 24 24 24 24-10.7 24-24S37.3 0 24 0zM11.9 15.2c.1-.1.2-.1.2-.1 1.6-.5 2.5-1.4 3-3 0 0 0-.1.1-.2l.1-.1c.1 0 .2-.1.3-.1.4 0 .5.3.5.3.5 1.6 1.4 2.5 3 3 0 0 .1 0 .2.1s.1.2.1.3c0 .4-.3.5-.3.5-1.6.5-2.5 1.4-3 3 0 0-.1.3-.4.3-.6.1-.7-.2-.7-.2-.5-1.6-1.4-2.5-3-3 0 0-.4-.1-.4-.5l.3-.3zm24.2 18.6c-.5.2-.9.6-1.3 1s-.7.8-1 1.3c0 0 0 .1-.1.2-.1 0-.1.1-.3.1-.3-.1-.4-.4-.4-.4-.2-.5-.6-.9-1-1.3s-.8-.7-1.3-1c0 0-.1 0-.1-.1-.1-.1-.1-.2-.1-.3 0-.3.2-.4.2-.4.5-.2.9-.6 1.3-1s.7-.8 1-1.3c0 0 .1-.2.4-.2.3 0 .4.2.4.2.2.5.6.9 1 1.3s.8.7 1.3 1c0 0 .2.1.2.4 0 .4-.2.5-.2.5zm-.7-8.7s-4.6 1.5-5.7 2.4c-1 .6-1.9 1.5-2.4 2.5-.9 1.5-2.2 5.4-2.2 5.4-.1.5-.5.9-1 .9v-.1.1c-.5 0-.9-.4-1.1-.9 0 0-1.5-4.6-2.4-5.7-.6-1-1.5-1.9-2.5-2.4-1.5-.9-5.4-2.2-5.4-2.2-.5-.1-.9-.5-.9-1h.1-.1c0-.5.4-.9.9-1.1 0 0 4.6-1.5 5.7-2.4 1-.6 1.9-1.5 2.4-2.5.9-1.5 2.2-5.4 2.2-5.4.1-.5.5-.9 1-.9s.9.4 1 .9c0 0 1.5 4.6 2.4 5.7.6 1 1.5 1.9 2.5 2.4 1.5.9 5.4 2.2 5.4 2.2.5.1.9.5.9 1h-.1.1c.1.5-.2.9-.8 1.1z"></path>
                                                            </svg></span>

                                                    </div>
                                                </div>
                                                <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Overall</p>
                                            </button>
                                        </div>
                                    </li>

                                    <li role="presentation">
                                        <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                            <button id="headApprovalTab" onclick="goToHead()" type="button" role="tab" aria-controls="headApproval" class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php

                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='admin' AND `request_to` ='fem'";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"> <?php
                                                                                                                                                                                                                                                        if ($_SESSION['leaderof'] == "fem") {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='admin' AND `request_to` ='fem'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        } else if ($_SESSION['leaderof'] == "mis") {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='admin' AND `request_to` ='mis'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='admin'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        }


                                                                                                                                                                                                                                                        while ($count = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                                                                            echo $count["pending"];
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        ?></div><?php
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                ?>
                                                        <img src="../resources/img/list.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                    </div>
                                                </div>
                                                <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Final approval</p>
                                            </button>
                                        </div>
                                    </li>
                                    <li role="presentation">
                                        <div class="p__uwg" style="width: 96px; margin-left: 16px; margin-right: 0px;">
                                            <button id="inProgressTab" onclick="goToMis()" class="_1QoxDw o4TrkA CA2Rbg cwOZMg zQlusQ uRvRjQ POMxOg" tabindex="-1" type="button" role="tab" aria-controls="inProgress" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php
                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE  `status2` ='inprogress'";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"> <?php

                                                                                                                                                                                                                                                        if ($_SESSION['leaderof'] == "fem") {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' AND `request_to` ='fem'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        } else if ($_SESSION['leaderof'] == "mis") {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' AND `request_to` ='mis'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                        while ($count = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                                                                            echo $count["pending"];
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        ?></div><?php
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                ?>
                                                        <img src="../resources/img/progress.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                    </div>
                                                </div>
                                                <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">In Progress</p>
                                            </button>
                                        </div>
                                    </li>
                                    <li role="presentation">
                                        <div class="p__uwg" style="width: 96px; margin-left: 16px; margin-right: 0px;">
                                            <button id="toRateTab" onclick="goToRate()" class="_1QoxDw o4TrkA CA2Rbg cwOZMg zQlusQ uRvRjQ POMxOg" tabindex="-1" type="button" role="tab" aria-controls="forRating" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php



                                                        $section = $_SESSION['leaderof'];
                                                        $date1 = new DateTime();
                                                        $dateMonth = $date1->format('M');
                                                        $dateYear = $date1->format('Y');

                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE   (`status2` = 'Done' OR `status2`='late')  and  `request_to` = 'fem' ";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-border-white"> <?php
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE (`status2` = 'Done' OR `status2`='late')  and  `request_to` =  'fem' ";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                            while ($count = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                                                                                echo $count["pending"];
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                            ?></div><?php
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                    ?>
                                                        <img src="../resources/img/adminapprove.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                        <!-- <img src="../resources/img/star.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> -->

                                                    </div>
                                                </div>
                                                <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Finished</p>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="rzHaWQ theme light" id="diamond" style="transform: translateX(160px) translateY(2px) rotate(135deg);"></div>
                        </div>
                    </div>
                </div>
                <div class="hidden">
                    <ul class="uGmi4w  mb-1 m-4 flex text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow  dark:divide-gray-700 dark:text-gray-400">
                        <li class="w-full relative">
                            <a href="#" class="inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">For Approval</a>
                            <div class="rzHaWQ theme light" style="transform: translateX(198px) translateY(2px) rotate(135deg);"></div>

                        </li>
                        <li class="w-full">
                            <a href="#" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Dashboard</a>
                        </li>
                        <li class="w-full">
                            <a href="#" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Settings</a>
                        </li>
                        <li class="w-full">
                            <a href="#" class="inline-block w-full p-4 bg-white rounded-r-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Invoice</a>
                        </li>

                    </ul>

                </div>

            </div>
        </div>



        <div id="myTabContent">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="overAll" role="tabpanel" aria-labelledby="profile-tab">
                <section class="mt-10">
                    <table id="overAllTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Details</th>
                                <th>Requestor</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Assigned Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $a = 1;

                            $sql = "select * from `request` where request_to = 'fem' order by id asc  ";
                            $result = mysqli_query($con, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr class="">
                                    <td class="">
                                        <?php
                                        $date = new DateTime($row['head_approval_date']);
                                        $date = $date->format('ym');
                                        if ($row['ticket_category'] != NULL) {
                                            echo 'TS-' . $date . '-' . $row['id'];
                                        } else {
                                            echo 'JO-' . $date . '-' . $row['id'];
                                        }

                                        ?>
                                    </td>


                                    <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['request_details']; ?>
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['requestor']; ?>
                                    </td>
                                    <!-- to view pdf -->
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['status2']; ?>
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['request_category']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        <?php if ($row['request_to'] == "fem") {
                                            echo "FEM";
                                        } else if ($row['request_to'] == "mis") {
                                            echo "ICT";
                                        }
                                        ?>
                                    </td>








                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>

                </section>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
                <section class="mt-10">
                <!-- <select id="mySelect" multiple>
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
  <option value="3">Option 3</option>
  <option value="4">Option 4</option>
</select> -->
                    <table id="employeeTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Requestor</th>
                                <th>Date Approved</th>
                                <th>Approving Head</th>
                                <th>Category</th>
                                <th>Assigned Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            if ($_SESSION['leaderof'] == "fem") {
                                $sql = "select * from `request` WHERE `status2` ='admin' AND `request_to` = 'fem' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            } else if ($_SESSION['leaderof'] == "mis") {
                                $sql = "select * from `request` WHERE `status2` ='admin' AND `request_to` = 'mis' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            } else {
                                $sql = "select * from `request` WHERE `status2` ='admin' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            }


                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['request_type'] == "Technical Support") {
                                    $reqtype = "Ticket Request";
                                } else {
                                    $reqtype = "Job Order";
                                }

                                $date = new DateTime($row['date_filled']);
                                $date = $date->format('ym');
                                if ($row['ticket_category'] != NULL) {
                                    $joid = 'TS-' . $date . '-' . $row['id'];
                                } else {
                                    $joid =  'JO-' . $date . '-' . $row['id'];
                                }

                                $cat = $row['request_category'];
                                $query = mysqli_query($con, "Select * FROM `femcategories` WHERE `c_name` = '$cat'");
                                while ($cat = mysqli_fetch_assoc($query)) {
                                    $completion_days = $cat['days'];
                                }
                                $startDate = date("Y-m-d");
                                $daysToAdd =  $completion_days;
                                if ($row['expectedFinishDate'] == "") {
                                    $targetFinishDate = addWeekdays2($startDate, $daysToAdd, $holidays);
                                } else {
                                    $targetFinishDate =  $row['expectedFinishDate'];
                                }


                            ?>
                                <tr class="">
                                    <td class="">
                                        <?php echo $joid; ?>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->

                                        <button type="button" id="viewdetails" onclick="modalShow(this)" data-reqtype="<?php echo $reqtype; ?>" data-requestype="<?php echo $row['request_type']; ?>" data-recommendation="<?php echo $row['recommendation'] ?>" data-requestorremarks="<?php echo $row['requestor_remarks'] ?>" data-quality="<?php echo $row['rating_quality'] ?>" data-delivery="<?php echo $row['rating_delivery'] ?>" data-ratedby="<?php echo $row['ratedBy'] ?>" data-daterate="<?php echo $row['rateDate'] ?>" data-action1date="<?php echo $row['action1Date'] ?>" data-action2date="<?php echo $row['action2Date'] ?>" data-action3date="<?php echo $row['action3Date'] ?>" data-headremarks="<?php echo $row['head_remarks']; ?>" data-adminremarks="<?php echo $row['admin_remarks']; ?>" data-headdate="<?php echo $row['head_approval_date']; ?>" data-admindate="<?php echo $row['admin_approved_date']; ?>" data-department="<?php echo $row['department'] ?>" data-status="<?php echo $row['status2'] ?>" data-action1="<?php echo $row['action1'] ?>" data-action2="<?php echo $row['action2'] ?>" data-action3="<?php echo $row['action3'] ?>" data-ratings="<?php echo $row['rating_final']; ?>" data-actualdatefinished="" data-assignedpersonnel="<?php echo $row['assignedPersonnelName'] ?> " data-requestor="<?php echo $row['requestor'] ?>" data-personnel="<?php echo $row['assignedPersonnel'] ?>" data-assistant="<?php echo $row['assistantsId'] ?>" data-assistantName="<?php echo $row['assistanNames'] ?>" data-action="<?php echo $dataAction = str_replace('"', '', $row['action']); ?>" data-telephone="<?php echo $row['telephone']; ?>" data-attachment="<?php echo $row['attachment']; ?>" data-joidprint="<?php echo $joid; ?>" data-headremarks="<?php echo $row['head_remarks']; ?>" data-adminremarks="<?php echo $row['admin_remarks']; ?>" data-joid="<?php echo $row['id']; ?>" data-requestoremail="<?php echo $row['email']; ?>" data-requestor="<?php echo $row['requestor']; ?>" data-datefiled="<?php $date = new DateTime($row['date_filled']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo $date; ?>" data-expectedfinishdate="<?php echo $targetFinishDate ?>"


                                            data-section="<?php if ($row['request_to'] == "fem") {
                                                                echo "FEM";
                                                            } else if ($row['request_to'] == "mis") {
                                                                echo "ICT";
                                                            } ?>" data-category="<?php echo $row['request_category']; ?>" data-comname="<?php echo $row['computerName']; ?>" data-start="<?php echo $row['reqstart_date']; ?>" data-end="<?php echo $row['reqfinish_date']; ?>" data-details="<?php echo $row['request_details']; ?>" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            View more
                                        </button>
                                    </td>

                                    <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['request_details']; ?>
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['requestor']; ?>
                                    </td>
                                    <!-- to view pdf -->
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $date = new DateTime($row['head_approval_date']);
                                        $date = $date->format('F d, Y');
                                        if ($row['head_approval_date'] == "") {
                                            $date = "";
                                        }
                                        echo $date; ?>

                                    </td>
                                    <td class="">
                                        <?php
                                        echo $row['approving_head'];
                                        ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['request_category']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        <?php if ($row['request_to'] == "fem") {
                                            echo "FEM";
                                        } else if ($row['request_to'] == "mis") {
                                            echo "ICT";
                                        }
                                        ?>
                                    </td>







                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>

                </section>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="inProgress" role="tabpanel" aria-labelledby="profile-tab">
                <section class="mt-10">
                    <table id="inProgressTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Requestor</th>
                                <th>Approving Head</th>
                                <th>Date Approved</th>
                                <th>Category</th>
                                <th>Assigned to</th>
                                <th>Assigned Section</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            if ($_SESSION['leaderof'] == "fem") {
                                $sql = "select * from `request` WHERE `status2` ='inprogress' AND `request_to`='fem' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            } else if ($_SESSION['leaderof'] == "mis") {
                                $sql = "select * from `request` WHERE `status2` ='inprogress' AND `request_to`='mis' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            } else {
                                $sql = "select * from `request` WHERE `status2` ='inprogress' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            }

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['request_type'] == "Technical Support") {
                                    $reqtype = "Ticket Request";
                                } else {
                                    $reqtype = "Job Order";
                                }

                                $date = new DateTime($row['date_filled']);
                                $date = $date->format('ym');
                                if ($row['ticket_category'] != NULL) {
                                    $joid = 'TS-' . $date . '-' . $row['id'];
                                } else {
                                    $joid =  'JO-' . $date . '-' . $row['id'];
                                }
                            ?>
                                <tr class="">
                                    <td class="">
                                        <?php echo $joid; ?>
                                    </td>
                                    <td>
                                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                                        <button type="button" id="viewdetails" onclick="modalShow(this)" data-reqtype="<?php echo $reqtype; ?>" data-recommendation="<?php echo $row['recommendation'] ?>" data-requestorremarks="<?php echo $row['requestor_remarks'] ?>" data-quality="<?php echo $row['rating_quality'] ?>" data-delivery="<?php echo $row['rating_delivery'] ?>" data-ratedby="<?php echo $row['ratedBy'] ?>" data-daterate="<?php echo $row['rateDate'] ?>" data-action1date="<?php echo $row['action1Date'] ?>" data-action2date="<?php echo $row['action2Date'] ?>" data-action3date="<?php echo $row['action3Date'] ?>" data-headremarks="<?php echo $row['head_remarks']; ?>" data-adminremarks="<?php echo $row['admin_remarks']; ?>" data-headdate="<?php echo $row['head_approval_date']; ?>" data-admindate="<?php echo $row['admin_approved_date']; ?>" data-department="<?php echo $row['department'] ?>" data-status="<?php echo $row['status2'] ?>" data-action1="<?php echo $row['action1'] ?>" data-action2="<?php echo $row['action2'] ?>" data-action3="<?php echo $row['action3'] ?>" data-ratings="<?php echo $row['rating_final']; ?>" data-actualdatefinished="" data-assignedpersonnel="<?php echo $row['assignedPersonnelName'] ?>" data-assistant="<?php echo $row['assistantsId'] ?>" data-assistantName="<?php echo $row['assistanNames'] ?>"  data-requestoremail="<?php echo $row['email']; ?>" data-requestor="<?php echo $row['requestor'] ?>" data-personnel="<?php echo $row['assignedPersonnel'] ?>" data-action="<?php echo $dataAction = str_replace('"', '', $row['action']); ?>" data-joidprint="<?php echo $joid; ?>" data-joid="<?php echo $row['id']; ?>" data-datefiled="<?php $date = new DateTime($row['date_filled']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo $date; ?>" data-expectedfinishdate="<?php echo $row['expectedFinishDate']; ?>" data-section="<?php if ($row['request_to'] === "fem") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "FEM";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else if ($row['request_to'] === "mis") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "ICT";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>" data-category="<?php echo $row['request_category']; ?>" data-telephone="<?php echo $row['telephone']; ?>" data-attachment="<?php echo $row['attachment']; ?>" data-comname="<?php echo $row['computerName']; ?>" data-start="<?php echo $row['reqstart_date']; ?>" data-end="<?php echo $row['reqfinish_date']; ?>" data-details="<?php echo $row['request_details']; ?>" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            View more
                                        </button>
                                    </td>

                                    <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['request_details']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['requestor']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php
                                        echo $row['approving_head'];
                                        ?>
                                    </td>
                                    <!-- to view pdf -->
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $date = new DateTime($row['admin_approved_date']);
                                        $date = $date->format('F d, Y');
                                        echo $date; ?>

                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['request_category']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        <?php echo $row['assignedPersonnelName'];
                                        ?>
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        <?php if ($row['request_to'] == "fem") {
                                            echo "FEM";
                                        } else if ($row['request_to'] == "mis") {
                                            echo "ICT";
                                        }
                                        ?>
                                    </td>








                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>

                </section>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="forRating" role="tabpanel" aria-labelledby="profile-tab">
                <section class="mt-10">
                    <table id="forRatingTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Requestor</th>

                                <th>Date Filed</th>
                                <th>Comments</th>
                                <th>Assigned to</th>
                                <th>Assigned Section</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            $date1 = new DateTime();
                            $dateMonth = $date1->format('M');
                            $dateYear = $date1->format('Y');

                            if ($_SESSION['leaderof'] == "fem") {

                                $sql = "select * from `request` WHERE  `request_to`='fem' AND ( `status2` = 'Done'  OR `status2` = 'rated' OR `status2` = 'late' AND `month`='$dateMonth' AND `year`='$dateYear' )order by id asc ";
                                $result = mysqli_query($con, $sql);
                            } else if ($_SESSION['leaderof'] == "mis") {
                                $sql = "select * from `request` WHERE  `request_to`='mis' AND ( `status2` = 'Done'  OR `status2` = 'rated' OR `status2` = 'late'  AND `month`='$dateMonth' AND `year`='$dateYear' )order by id asc ";
                                $result = mysqli_query($con, $sql);
                            } else {
                                $sql = "select * from `request` WHERE  ( `status2` = 'Done'  OR `status2` = 'rated' OR `status2` = 'late'  AND `month`='$dateMonth' AND `year`='$dateYear' )order by id asc ";
                                $result = mysqli_query($con, $sql);
                            }





                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['request_type'] == "Technical Support") {
                                    $reqtype = "Ticket Request";
                                } else {
                                    $reqtype = "Job Order";
                                }


                                $date = new DateTime($row['date_filled']);
                                $date = $date->format('ym');

                                if ($row['ticket_category'] != NULL) {
                                    $joid = 'TS-' . $date . '-' . $row['id'];
                                } else {
                                    $joid =  'JO-' . $date . '-' . $row['id'];
                                }

                                if ($row['request_to'] === "fem") {
                                    $section_ = "FEM";
                                } else if ($row['request_to'] === "mis") {
                                    $section_ = "ICT";
                                }

                            ?>
                                <tr class="">
                                    <td class="">
                                        <?php echo $joid; ?>
                                    </td>
                                    <td>
                                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                                        <?php if (($row['recommendation'] != "" || $row['recommendation'] != NULL) && $row['approved_reco'] == 0) {

                                            echo "<button id='viewdetails' onclick='modalShow(this)'  data-reqtype='" . $reqtype . "' 
                        data-reco='1' 
                        data-recommendation='" . $row['recommendation'] . "' 
                        data-approved_reco='" . $row['approved_reco'] . "' 
                        data-icthead_reco_remarks='" . $row['icthead_reco_remarks'] . "' 
                        data-requestorremarks='" . $row['requestor_remarks'] . "' 
                        data-quality='" . $row['rating_quality'] . "' 
                        data-delivery='" . $row['rating_delivery'] . "' 
                        data-ratedby='" . $row['ratedBy'] . "' 
                        data-daterate='" . $row['rateDate'] . "' 
                        data-action1date='" . $row['action1Date'] . "' 
                        data-action2date='" . $row['action2Date'] . "' 
                        data-action3date='" . $row['action3Date'] . "' 
                        data-headremarks='" . $row['head_remarks'] . "' 
                        data-adminremarks='" . $row['admin_remarks'] . "' 
                        data-headdate='" . $row['head_approval_date'] . "' 
                        data-admindate='" . $row['admin_approved_date'] . "' 
                        data-department='" . $row['department'] . "'  
                        data-status='" . $row['status2'] . "'   
                        data-action1='" . $row['action1'] . "'   
                        data-action2='" . $row['action2'] . "' 
                        data-action3='" . $row['action3'] . "'   
                        data-ratings = '" . $row['rating_final'] . "' 
                        data-actualdatefinished='' 
                        data-assignedpersonnel='" . $row['assignedPersonnelName'] . "'
                        data-requestor='" . $row['requestor'] . "' 
                        data-personnel='" . $row['assignedPersonnel'] . "' 
                        data-action='" . $dataAction = str_replace('"', '', $row['action']) . "' 
                        data-requestoremail='" . $row['email'] . "'    
                        data-joid='" . $row['id'] . "' 
                        data-category='" . $row['request_category'] . "' 
                        data-telephone='" . $row['telephone'] . "'
                        data-attachment='" . $row['attachment'] . "'  
                        data-comname='" . $row['computerName'] . "' 
                        data-start='" . $row['reqstart_date'] . "'
                        data-end='" . $row['reqfinish_date'] . "'
                        data-details='" . $row['request_details'] . "' 
                        data-joidprint='" . $joid . "' 
                        data-section= '" . $section_ . "' 
                        data-datefiled='" . $row['date_filled'] . "'
                        data-expectedfinishdate='" . $row['expectedFinishDate'] . "'>

                        <span class= 'inline-block px-6 py-2.5 bg-gradient-to-r from-purple-400 to-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-800 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out' 
                        >VIEW RECO</span></button>";
                                        } else {
                                            echo "<span id='viewdetails' onclick='modalShow(this)' data-reqtype='" . $reqtype . "'
                    data-reco='0' 
                    data-recommendation='" . $row['recommendation'] . "' 
                    data-approved_reco='" . $row['approved_reco'] . "' 
                    data-icthead_reco_remarks='" . $row['icthead_reco_remarks'] . "' 
                    data-requestorremarks='" . $row['requestor_remarks'] . "' 
                    data-quality='" . $row['rating_quality'] . "' 
                    data-delivery='" . $row['rating_delivery'] . "' 
                    data-ratedby='" . $row['ratedBy'] . "' 
                    data-daterate='" . $row['rateDate'] . "' 
                    data-action1date='" . $row['action1Date'] . "' 
                    data-action2date='" . $row['action2Date'] . "' 
                    data-action3date='" . $row['action3Date'] . "' 
                    data-headremarks='" . $row['head_remarks'] . "' 
                    data-adminremarks='" . $row['admin_remarks'] . "' 
                    data-headdate='" . $row['head_approval_date'] . "' 
                    data-admindate='" . $row['admin_approved_date'] . "' 
                    data-department='" . $row['department'] . "'  
                    data-status='" . $row['status2'] . "'   
                    data-action1='" . $row['action1'] . "'   
                    data-action2='" . $row['action2'] . "' 
                    data-action3='" . $row['action3'] . "'   
                    data-ratings = '" . $row['rating_final'] . "' 
                    data-actualdatefinished='' 
                    data-assignedpersonnel='" . $row['assignedPersonnelName'] . "'
                    data-requestor='" . $row['requestor'] . "' 
                    data-personnel='" . $row['assignedPersonnel'] . "' 
                    data-action='" . $dataAction = str_replace('"', '', $row['action']) . "' 
                    data-requestoremail='" . $row['email'] . "'    
                    data-joid='" . $row['id'] . "' 
                    data-category='" . $row['request_category'] . "' 
                    data-telephone='" . $row['telephone'] . "'
                    data-attachment='" . $row['attachment'] . "'  
                    data-comname='" . $row['computerName'] . "' 
                    data-start='" . $row['reqstart_date'] . "'
                    data-end='" . $row['reqfinish_date'] . "'
                    data-details='" . $row['request_details'] . "' 
                    data-joidprint='" . $joid . "' 
                    data-section= '" . $section_ . "' 
                    data-datefiled='" . $row['date_filled'] . "'
                    
                    data-expectedfinishdate='" . $row['expectedFinishDate'] . "'>
                        
                        <span class='inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out'>VIEW MORE</span></span>";
                                        }
                                        ?>
                                    </td>

                                    <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['request_details']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate " style="max-width: 40px;">
                                        <?php echo $row['requestor']; ?>
                                    </td>

                                    <!-- to view pdf -->
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $date = new DateTime($row['date_filled']);
                                        $date = $date->format('F d, Y');
                                        echo $date; ?>

                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate " style="max-width: 40px;">
                                        <?php echo $row['requestor_remarks']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate" style="max-width: 10px;">

                                        <?php echo $row['assignedPersonnelName'];
                                        ?>
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                        <?php if ($row['request_to'] == "fem") {
                                            echo "FEM";
                                        } else if ($row['request_to'] == "mis") {
                                            echo "ICT";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>

                </section>
            </div>
        </div>




    </div>





    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form action="" method="POST" onsubmit="$('#loading-message').css('display', 'flex'); $('#loading-message').show();">
                    <!-- Modal header -->

                    <input type="text" id="pjobOrderNo" name="pjobOrderNo" class="hidden">
                    <input type="text" id="joidtransfer" name="joidtransfer" class="hidden">

                    <input type="text" id="pstatus" name="pstatus" class="hidden">
                    <input type="text" id="prequestor" name="prequestor" class="hidden">
                    <input type="text" id="pdepartment" name="pdepartment" class="hidden">
                    <input type="text" id="pdateFiled" name="pdateFiled" class="hidden">
                    <input type="text" id="prequestedSchedule" name="prequestedSchedule" class="hidden">
                    <input type="text" id="ptype" name="ptype" class="hidden">
                    <input type="text" id="ppcNumber" name="ppcNumber" class="hidden">
                    <input type="text" id="pdetails" name="pdetails" class="hidden">
                    <input type="text" id="pheadsRemarks" name="pheadsRemarks" class="hidden">
                    <input type="text" id="padminsRemarks" name="padminsRemarks" class="hidden">
                    <input type="text" id="pheadsDate" name="pheadsDate" class="hidden">
                    <input type="text" id="padminsDate" name="padminsDate" class="hidden">
                    <input type="text" id="passignedPersonnel2" name="passignedPersonnel" class="hidden">
                    <input type="text" id="psection" name="psection" class="hidden">
                    <input type="text" id="pfirstAction" name="pfirstAction" class="hidden">
                    <input type="text" id="pfirstDate" name="pfirstDate" class="hidden">
                    <input type="text" id="psecondAction" name="psecondAction" class="hidden">
                    <input type="text" id="psecondDate" name="psecondDate" class="hidden">
                    <input type="text" id="pthirdAction" name="pthirdAction" class="hidden">
                    <input type="text" id="pthirdDate" name="pthirdDate" class="hidden">
                    <input type="text" id="pfinalAction" name="pfinalAction" class="hidden">
                    <input type="text" id="precommendation" name="precommendation" class="hidden">
                    <input type="text" id="pdateFinished" name="pdateFinished" class="hidden">
                    <input type="text" id="pratedBy" name="pratedBy" class="hidden">
                    <input type="text" id="pdelivery" name="pdelivery" class="hidden">
                    <input type="text" id="pquality" name="pquality" class="hidden">
                    <input type="text" id="ptotalRating" name="ptotalRating" class="hidden">
                    <input type="text" id="pratingRemarks" name="pratingRemarks" class="hidden">
                    <input type="text" id="pratedDate" name="pratedDate" class="hidden">
                    <input type="text" id="papproved_reco" name="papproved_reco" class="hidden">
                    <input type="text" id="picthead_reco_remarks" name="picthead_reco_remarks" class="hidden">
                    <input type="text" id="prequestType" name="prequestType" class="hidden">

                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            <span id="reqtype"></span> Details 
                        </h3>
                        <div class="ml-auto">
                            <button onclick="requireSelect()" id="transferButton" type="button" data-modal-target="transfer" data-modal-toggle="transfer" class=" hidden text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 ">
                                <svg class="w-4 h-4 mr-2 -ml-1 " fill="none" focusable="false" stroke="currentCoAlor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3"></path>
                                </svg> Transfer
                            </button>
                            <!-- <button onclick="changeSched()" id="changeSchedButton" type="button" data-modal-target="changeSched" data-modal-toggle="changeSched" class="hidden text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55">
                                <svg class="w-4 h-4 mr-2 -ml-1 " fill="none" focusable="false" stroke="currentCoAlor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3"></path>
                                </svg> Reschedule
                            </button> -->

                            <button onclick="modalHide()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class=" items-center p-6 space-y-2">
                        <input type="text" name="requestor" id="requestorinput" class="hidden col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <input type="text" name="requestoremail" id="requestoremailinput" class="hidden col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <input type="text" name="completejoid" id="completejoid" class="hidden col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <input type="text" name="joid2" id="joid2" class="hidden col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div id="assignedPersonnelDiv" class="hidden w-full">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Assigned Personnel : </span><span id="assignedPersonnel"></span></h2>
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Assistant/s : </span><span id="assignedAssistants"></span></h2>


                        </div>
                        <div id="chooseAssignedDiv" class="w-full block gap-4 ">

                            <h2 class="float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Assigned Personnel</span></h2>
                            <select required id="assigned" name="assigned" class="bg-gray-50 col-span-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled value="">Choose</option>
                                <?php
                                $sql = "SELECT u.*, 
                                (SELECT COUNT(id) FROM request 
                                    WHERE `status2` = 'inprogress' 
                                    AND `assignedPersonnel` = u.username) AS 'pending'
                                    FROM `user` u";
                                $result = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // $date = new DateTime($row['date_filled']);
                                ?>
                                    <option data-sectionassign="<?php echo $row['level']; ?>" data-pending="<?php echo $row['pending'] ?>" value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?> (<?php
                                    
                                    $useridofssistant = $row['username'];
                                    $sqlcount = "SELECT COUNT(id) as 'numberAssisting'
                                     FROM request 
                                        WHERE `status2` = 'inprogress' 
                                        AND `assistantsId` LIKE '%$useridofssistant%';";
                                    $resultCount = mysqli_query($con, $sqlcount);
                                    while ($rowCount = mysqli_fetch_assoc($resultCount)) {
                                            $countAssistant = $rowCount['numberAssisting'];
                                    }
                                    echo $row['pending'] + $countAssistant ?>)</option>;
                                <?php

                                }

                                ?>

                            </select>
                            
<h2 class="float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Assistant/s</span></h2>
<select required id="assistants" name="assistants[]" multiple="multiple" class=" js-assistant bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <?php
    $sql = "SELECT u.*, 
    (SELECT COUNT(id) FROM request 
        WHERE `status2` = 'inprogress' 
        AND `assignedPersonnel` = u.username) AS 'pending'
        FROM `user` u WHERE u.level = 'fem' or (u.level = 'admin' AND u.leader = 'fem')";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        // $date = new DateTime($row['date_filled']);
    ?>
        <option data-sectionassign="<?php echo $row['level']; ?>" data-pending="<?php echo $row['pending'] ?>" data-personnelsname="<?php echo $row['name'] ?>" value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?> (<?php
        
        $useridofssistant = $row['username'];
        $sqlcount = "SELECT COUNT(id) as 'numberAssisting'
         FROM request 
            WHERE `status2` = 'inprogress' 
            AND `assistantsId` LIKE '%$useridofssistant%';";
        $resultCount = mysqli_query($con, $sqlcount);
        while ($rowCount = mysqli_fetch_assoc($resultCount)) {
                $countAssistant = $rowCount['numberAssisting'];
        }
        echo $row['pending'] + $countAssistant ?>)</option>;
    <?php

    }

    ?>

</select>
<input class="hidden" type="text" id="r_assistantsName" name="r_assistantsName" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                        </div>



                        <!-- <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700"> -->

                        <div class="w-full grid gap-4 grid-cols-2">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Requestor : </span><span id="requestor"></span></h2>
                            <h2 class="pl-10 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Email: </span><span id="requestorEmail"></span></h2>

                        </div>
                        <div class="w-full grid gap-4 grid-cols-2">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Request Number : </span><span id="jonumber"></span></h2>
                            <h2 class="pl-10 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Date filed: </span><span id="datefiled"></span></h2>
                        </div>
                        <div class="w-full grid gap-4 grid-cols-2">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Requested Section: </span><span id="sectionmodal"></span></h2>
                            <h2 class="pl-10 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Category: </span><span id="category"></span></h2>
                        </div>
                        <!-- <div class="w-full grid gap-4 grid-cols-2">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Target Finish Date: </span><span id="expectedfinishdate"></span></h2>

                        </div> -->
                        <div class="grid grid-cols-3">
                            <h2 class=" py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400"><span class="inline-block align-middle">Target Finish Date: </span></h2>
                            <div class="col-span-2 flex items-center">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">

                                    </div>
                                    <input id="expectedfinishdate" name="expectedfinishdate" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <button type="submit" name="changeSchedJo" id="changeSchedButton" class="hidden text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55">
                                    Reschedule
                                </button>
                            </div>
                        </div>

                        <div class="hidden w-full grid gap-4 grid-cols-2">
                            <div id="categoryDivParent" class="hidden grid gap-4 grid-cols-2">
                                <h2 class="float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Computer Name: </span></h2>
                                <input disabled type="text" name="computername" id="computername" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </div>
                            <div class="grid gap-4 grid-cols-2 hidden">
                                <h2 id="telephoneh2" class="pl-10 float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Telephone</span></h2>
                                <input disabled type="text" name="telephone" id="telephone" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </div>

                        </div>
                        <a type="button" name="attachment" id="attachment" target="_blank" class="shadow-lg shadow-purple-500/10 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View Attachment</a>

                        <hr class="hidden h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                        <div class="hidden">
                            <div class="grid grid-cols-3">
                                <h2 class=" py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400"><span class="inline-block align-middle">Requested Schedule: </span></h2>
                                <div class="col-span-2 flex items-center">
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="datestart" name="start" type="date" class="bg-gray-50 border border
                                        -gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date start">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="datefinish" name="finish" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date finish">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="hidden h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                        <div id="headRemarksDiv" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Head Remarks: </span><span id="headremarks"></span></h2>
                        </div>
                        <div id="adminRemarksDiv" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Admin Remarks: </span><span id="adminremarks"></span></h2>
                        </div>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                        <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Request Details</label>
                        <textarea disabled id="message" name="message" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>
                        <div id="action1div" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 1: </span><span id="action1"></span></h2>
                        </div>
                        <div id="action2div" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 2: </span><span id="action2"></span></h2>
                        </div>
                        <div id="action3div" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 3: </span><span id="action3"></span></h2>
                        </div>
                        <hr class="h-px  bg-gray-200 border-0 dark:bg-gray-700">
                        <div id="actionDetailsDiv" class="hidden">
                            <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Details of action</label>
                            <textarea disabled id="actionDetails" name="actionDetails" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>

                        </div>
                        <div id="recommendationDiv" class="hidden w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Recommendation: </span><span id="recommendation"></span></h2>
                        </div>

                        <div id="remarksDiv">
                            <hr class="h-px  bg-gray-200 border-0 dark:bg-gray-700">
                            <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Remarks</label>
                            <textarea id="remarks" name="remarks" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave  remarks..."></textarea>
                        </div>
                        <div id="ictheadRecoRemarksDiv" class="hidden">
                            <hr class="h-px  bg-gray-200 border-0 dark:bg-gray-700">
                            <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">FEM Head Remarks</label>
                            <textarea id="ictheadrecoremarks" name="ictheadrecoremarks" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave  remarks..."></textarea>
                        </div>
                        <div id="ratingstar" class="hidden w-full grid grid-cols-12">
                            <h2 class="col-span-2 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Delivery: </span> </h2>
                            <div id="starsdel" class="grid col-span-10">
                                <div class="flex items-center">
                                    <div id="stardivdel" class="flex items-center"></div>
                                    <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><span id="finalRatingsdel"></span> out of 5</p>
                                </div>
                            </div>
                            <h2 class="col-span-2 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Quality: </span> </h2>
                            <div id="starsqual" class="grid col-span-10">
                                <div class="flex items-center">
                                    <div id="stardivqual" class="flex items-center"></div>
                                    <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><span id="finalRatingsqual"></span> out of 5</p>
                                </div>
                            </div>
                            <h2 class="col-span-2 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">TOTAL : </span> </h2>
                            <div id="stars" class="grid col-span-10">
                                <div class="flex items-center">
                                    <div id="stardiv" class="flex items-center"></div>
                                    <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><span id="finalRatings"></span> out of 5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="buttonDiv" class=" items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" data-modal-target="popup-modal-approve" data-modal-toggle="popup-modal-approve" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Approve</button>
                        <button type="button" onclick="cancellation()" data-modal-target="popup-modal-cancel" data-modal-toggle="popup-modal-cancel" class="shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-pink-800/80  w-full text-white bg-gradient-to-br from-red-400 to-pink-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancel Request</button>

                    </div>
                    <div id="buttonPrintDiv" class="items-center px-4 rounded-b dark:border-gray-600">
                        <button type="submit" name="print" class="shadow-lg shadow-blue-500/30 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Print</button>
                    </div>


                    <div id="buttonApproveRecoDiv" class="hidden items-center px-4 rounded-b dark:border-gray-600">
                        <button type="button" data-modal-target="popup-modal-approvereco" data-modal-toggle="popup-modal-approvereco" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Approve Recommendation</button>
                    </div>


                    <div id="popup-modal-cancel" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" onclick="exitcancellation()" data-modal-toggle="popup-modal-cancel" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <div class="p-6 text-center">
                                    <br>
                                    <br><br>
                                    <br><br>
                                    <br> <br>
                                    <br><br>

                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">If you're sure about canceling, please give a reason.</h3>
                                    <textarea id="reasonCancel" name="reasonCancel" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a reason..."></textarea>
                                    <br>
                                    <br>

                                    <button type="submit" name="cancelJO" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Submit
                                    </button>
                                    <button onclick="exitcancellation()" data-modal-toggle="popup-modal-cancel" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Exit</button>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br><br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="popup-modal-approve" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                        <div class="relative w-full h-full max-w-md md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" data-modal-toggle="popup-modal-approve" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to approve this request?</h3>
                                    <button type="submit" name="approveRequest" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button data-modal-toggle="popup-modal-approve" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="popup-modal-approvereco" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                        <div class="relative w-full h-full max-w-md md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" data-modal-toggle="popup-modal-approvereco" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to approve this recommendation?</h3>
                                    <button type="submit" name="approveReco" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button data-modal-toggle="popup-modal-approvereco" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="transfer" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button onclick="unrequireSelect()" type="button" data-modal-toggle="transfer" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Choose Personnel</h3>

                                    <div>
                                        <label for="section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personnel</label>

                                        <select id="transferUser" name="transferUser" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected disabled value="">Choose</option>
                                            <?php
                                            $sql = "SELECT u.*, 
                                            (SELECT COUNT(id) FROM request 
                                                WHERE `status2` = 'inprogress' 
                                                AND `assignedPersonnel` = u.username) AS 'pending'
                                            FROM `user` u";
                                            // $sql = "SELECT u.*, 
                                            //             (SELECT COUNT(id) FROM request 
                                            //             WHERE  `status2` = 'inprogress' 
                                            //             AND `assignedPersonnel` = u.username) AS 'pending'
                                            //             FROM `user` u WHERE u.department = 'ICT'";
                                            $result = mysqli_query($con, $sql);

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // $date = new DateTime($row['date_filled']);
                                            ?>
                                                <option data-transfer="<?php echo $row['level']; ?>" data-pending="<?php echo $row['pending'] ?>" value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?>(<?php echo $row['pending'] ?>)</option>;
                                            <?php

                                            }

                                            ?>


                                        </select>

                                        <button type="submit" name="transferJo" class="mt-10 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Transfer
                                        </button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="changeSched" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button onclick="unchangeSched()" type="button" data-modal-toggle="changeSched" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Change Target Finish Date</h3>

                                    <div>
                                        <label for="changeScheddate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>

                                        <input type="date" id="changeScheddate" name="changeScheddate" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


                                        <button type="submit" name="changeSchedJo" class="mt-10 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Change
                                        </button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="../node_modules/flowbite/dist/flowbite.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/select2/dist/js/select2.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="index.js"></script>

    <script>

// $(document).ready(function() {
//     // Set the values for the multiple select
//     $('#mySelect').val(['1', '3', '4']);
// });

        
$(".js-assistant").select2({
  tags: true
});

var selectedPersonnels = [];
    $("#assistants").find('option:selected').each(function() {
        selectedPersonnels.push($("#assistants").data('personnelsname'));
    });
    $('#r_assistantsName').val(selectedPersonnels.join(', '));

$('#assistants').change(function() {
    var selectedPersonnels = [];
    $(this).find('option:selected').each(function() {
        selectedPersonnels.push($(this).data('personnelsname'));
    });
    $('#r_assistantsName').val(selectedPersonnels.join(', '));
});

        // parent element wrapping the speed dial
        // const $parentEld = document.getElementById('dialParent')

        // the trigger element that can be clicked or hovered
        // const $triggerEld = document.getElementById('dialButton');

        // the content wrapping element of menu items or buttons
        // const $targetEld = document.getElementById('dialContent');

        // options with default values
        // const optionsd = {
        //   triggerType: 'click',
        //   onHide: () => {
        //       console.log('speed dial is shown');
        //   },
        //   onShow: () => {
        //       console.log('speed dial is hidden');
        //   },
        //   onToggle: () => {
        //     console.log('speed dial is toggled')
        //   }
        // };
        // const dial = new Dial($parentEld, $triggerEld, $targetEld, optionsd);
        // // show the speed dial
        // dial.show();

        // // hide the speed dial
        // dial.hide();

        // // toggle the visibility of the speed dial
        // dial.toggle();


        function cancellation() {
            document.getElementById("reasonCancel").required = true;
            document.getElementById("assigned").required = false;


        }

        function exitcancellation() {
            document.getElementById("reasonCancel").required = false;
            document.getElementById("assigned").required = true;

        }

        // set the modal menu element
        const $targetElModal = document.getElementById('defaultModal');

        // options with default values
        const optionsModal = {
            placement: 'center-center',
            backdrop: 'static',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {
                //console.log('modal is hidden');
            },
            onShow: () => {
                //console.log('modal is shown');

                //   //console.log(section);
            },
            onToggle: () => {
                //console.log('modal has been toggled');

            }
        };
        const modal = new Modal($targetElModal, optionsModal);

        function modalShow(element) {


            $headRemarksVar = element.getAttribute("data-headremarks");
            $adminRemarksVar = element.getAttribute("data-adminremarks");
            $approved_reco = element.getAttribute("data-approved_reco");
            $recommendation = element.getAttribute("data-recommendation");

            if (element.getAttribute("data-reco") == 1) {
                $("#buttonPrintDiv").addClass("hidden");
            }
            // else {
            //     $("#buttonPrintDiv").removeClass("hidden");
            // }

            if ($recommendation != "" && $approved_reco == 0) {
                // $("#buttonPrintDiv").addClass("hidden");
                $("#buttonApproveRecoDiv").removeClass("hidden");
                $("#ictheadRecoRemarksDiv").removeClass("hidden");
            } else {
                // $("#buttonPrintDiv").removeClass("hidden");
                $("#buttonApproveRecoDiv").addClass("hidden");
            }

            if ($headRemarksVar == "") {
                $("#headRemarksDiv").addClass("hidden");
            } else {
                $("#headRemarksDiv").removeClass("hidden");

            }
            if ($adminRemarksVar == "") {
                $("#adminRemarksDiv").addClass("hidden");

            } else {
                $("#adminRemarksDiv").removeClass("hidden");

            }
            if ($adminRemarksVar == "" && $headRemarksVar == "") {
                $("#remarkshr").addClass("hidden");

            } else {
                $("#remarkshr").removeClass("hidden");
            }


            document.getElementById("joid2").value = element.getAttribute("data-joid");
            document.getElementById("joidtransfer").value = element.getAttribute("data-joid");

            document.getElementById("jonumber").innerHTML = element.getAttribute("data-joidprint");
            document.getElementById("headremarks").innerHTML = element.getAttribute("data-headremarks");
            document.getElementById("adminremarks").innerHTML = element.getAttribute("data-adminremarks");

            document.getElementById("telephone").value = element.getAttribute("data-telephone");
            document.getElementById("attachment").setAttribute("href", element.getAttribute("data-attachment"));

            // document.getElementById("expectedfinishdate").value = element.getAttribute("data-target_finish_date");

            document.getElementById("completejoid").value = element.getAttribute("data-joidprint");

            document.getElementById("requestor").innerHTML = element.getAttribute("data-requestor");
            document.getElementById("requestorEmail").innerHTML = element.getAttribute("data-requestoremail");

            document.getElementById("requestorinput").value = element.getAttribute("data-requestor");
            document.getElementById("requestoremailinput").value = element.getAttribute("data-requestoremail");
            document.getElementById("assignedPersonnel").innerHTML = element.getAttribute("data-assignedpersonnel");
            document.getElementById("assignedAssistants").innerHTML = element.getAttribute("data-assistantName");

            document.getElementById("prequestType").value = element.getAttribute("data-requestype");
            document.getElementById("reqtype").innerHTML = element.getAttribute("data-reqtype");


            document.getElementById("actionDetails").value = element.getAttribute("data-action");

            document.getElementById("datefiled").innerHTML = element.getAttribute("data-datefiled");
            document.getElementById("expectedfinishdate").value = element.getAttribute("data-expectedfinishdate");
            document.getElementById("sectionmodal").innerHTML = element.getAttribute("data-section");
            document.getElementById("category").innerHTML = element.getAttribute("data-category");
            document.getElementById("computername").value = element.getAttribute("data-comname");
            document.getElementById("datestart").value = element.getAttribute("data-start");
            document.getElementById("datefinish").value = element.getAttribute("data-end");
            document.getElementById("message").value = element.getAttribute("data-details");
            document.getElementById("finalRatings").innerHTML = element.getAttribute("data-ratings");
            document.getElementById("finalRatingsdel").innerHTML = element.getAttribute("data-delivery");
            document.getElementById("finalRatingsqual").innerHTML = element.getAttribute("data-quality");





            document.getElementById("action1").innerHTML = element.getAttribute("data-action1");
            document.getElementById("action2").innerHTML = element.getAttribute("data-action2");
            document.getElementById("action3").innerHTML = element.getAttribute("data-action3");
            document.getElementById("recommendation").innerHTML = element.getAttribute("data-recommendation");

            document.getElementById("pjobOrderNo").value = element.getAttribute("data-joidprint");
            document.getElementById("pstatus").value = element.getAttribute("data-status");
            document.getElementById("prequestor").value = element.getAttribute("data-requestor");
            document.getElementById("pdepartment").value = element.getAttribute("data-department");
            document.getElementById("pdateFiled").value = element.getAttribute("data-datefiled");

            const dateStart = new Date(element.getAttribute("data-start")); // Get the current date
            const optionsStart = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }; // Specify the format options
            const formattedDateStart = dateStart.toLocaleDateString('en-US', optionsStart); // Format the date

            const dateEnd = new Date(element.getAttribute("data-end")); // Get the current date
            const optionsEnd = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }; // Specify the format options
            const formattedDateEnd = dateEnd.toLocaleDateString('en-US', optionsEnd); // Format the date

            document.getElementById("pheadsDate").value = element.getAttribute("data-headdate");
            document.getElementById("padminsDate").value = element.getAttribute("data-admindate");
            document.getElementById("prequestedSchedule").value = formattedDateStart + " to " + formattedDateEnd;
            document.getElementById("ptype").value = element.getAttribute("data-category");
            document.getElementById("ppcNumber").value = element.getAttribute("data-comname");
            document.getElementById("pdetails").value = element.getAttribute("data-details");
            document.getElementById("pheadsRemarks").value = element.getAttribute("data-headremarks");
            document.getElementById("padminsRemarks").value = element.getAttribute("data-adminremarks");
            document.getElementById("passignedPersonnel2").value = element.getAttribute("data-assignedpersonnel");
            document.getElementById("psection").value = element.getAttribute("data-section");
            document.getElementById("pfirstAction").value = element.getAttribute("data-action1");
            document.getElementById("pfirstDate").value = element.getAttribute("data-action1date");
            document.getElementById("psecondAction").value = element.getAttribute("data-action2");
            document.getElementById("psecondDate").value = element.getAttribute("data-action2date");
            document.getElementById("pthirdAction").value = element.getAttribute("data-action3");
            document.getElementById("pthirdDate").value = element.getAttribute("data-action3date");
            document.getElementById("pfinalAction").value = element.getAttribute("data-action");
            document.getElementById("precommendation").value = element.getAttribute("data-recommendation");
            document.getElementById("pdateFinished").value = element.getAttribute("data-actualdatefinished");
            document.getElementById("pratedBy").value = element.getAttribute("data-ratedby");
            document.getElementById("pdelivery").value = element.getAttribute("data-delivery");
            document.getElementById("pquality").value = element.getAttribute("data-quality");
            document.getElementById("ptotalRating").value = element.getAttribute("data-ratings");
            document.getElementById("pratingRemarks").value = element.getAttribute("data-requestorremarks");
            document.getElementById("pratedDate").value = element.getAttribute("data-daterate");
            document.getElementById("papproved_reco").value = element.getAttribute("data-approved_reco");
            document.getElementById("picthead_reco_remarks").value = element.getAttribute("data-icthead_reco_remarks");

            var action1 = element.getAttribute("data-action1");
            var action2 = element.getAttribute("data-action2");
            var action3 = element.getAttribute("data-action3");

            // Change the value of the select element to "option2"
            $("#assigned").val(element.getAttribute("data-personnel"));
            console.log(element.getAttribute("data-assignedpersonnel"));


            var recommendation = element.getAttribute("data-recommendation");

            if (recommendation == "") {
                $("#recommendationDiv").addClass("hidden");

            } else {
                $("#recommendationDiv").removeClass("hidden");

            }
            $("#action1div").addClass("hidden");
            $("#action1div").removeClass("hidden");

            $("#action2div").addClass("hidden");
            $("#action2div").removeClass("hidden");

            $("#action3div").addClass("hidden");
            $("#action3div").removeClass("hidden");

            if (action1 == "") {
                $("#action1div").addClass("hidden");

            }
            if (action2 == "") {
                $("#action2div").addClass("hidden");
            }
            if (action3 == "") {
                $("#action3div").addClass("hidden");
            } else if (action3 != "") {
                $("#addAction").addClass("hidden");

            }



            var section = element.getAttribute("data-section");

            var sectionFEMorMIS;
            if (section == "ICT") {
                sectionFEMorMIS = 'mis';
            } else if (section == "FEM") {
                sectionFEMorMIS = "fem";
            }
            //console.log("dfg"+section+"asd");

            //console.log("asd"+sectionFEMorMIS);
            $("#assigned option").each(function() {
                var assignedSection = $(this).attr("data-sectionassign");
                var pending = $(this).attr("data-pending");
                var pending = $(this).attr("data-pending");


                //console.log(assignedSection);
                //console.log(section);


                if (assignedSection != sectionFEMorMIS && assignedSection != "admin") {
                    $(this).hide();
                } else {
                    $(this).show();
                    if (section == "ICT") {
                        if (pending >= 5) {
                            $(this).prop("disabled", true);
                        }
                    }

                }
            })

            // $('#assistants').val(['GP-', '3', '4']);
            let arrayAssist = [element.getAttribute("data-assistant")];

// Split the string by comma and trim each element
let transformedArrayAssist = arrayAssist[0].split(',').map(item => item.trim());


            $("#assistants").val(transformedArrayAssist).trigger('change');;
// console.log(transformedArrayAssist)


            
          

            $("#transferUser option").each(function() {
                var assignedSection1 = $(this).attr("data-transfer");
                //console.log(assignedSection);
                //console.log(section);
                var pending = $(this).attr("data-pending");

                if (assignedSection1 != sectionFEMorMIS && assignedSection1 != "admin") {
                    $(this).hide();
                } else {
                    $(this).show();
                    if (pending >= 5) {
                        $(this).prop("disabled", true);
                    }
                }
            })


            var parentElement = document.getElementById("stardiv");

            // Loop through all child elements and remove them one by one
            while (parentElement.firstChild) {
                parentElement.removeChild(parentElement.firstChild);
            }
            var finalRatings = element.getAttribute("data-ratings");
            var DivProdContainer = document.getElementById("stardiv");

            for (var i = 1; i <= 5; i++) {

                if (i <= finalRatings) {
                    var b = i + 1;
                    console.log(b)
                    const newDiv = document.createElement("div");

                    var svg = '<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                    newDiv.innerHTML = svg;
                    DivProdContainer.appendChild(newDiv);

                    if (finalRatings > i && finalRatings < b) {
                        console.log("true")
                        const newDiv = document.createElement("div");

                        var svg = '<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                        newDiv.innerHTML = svg;
                        DivProdContainer.appendChild(newDiv);
                        var svg = '<svg  class="w-5 h-5 "  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <defs>  <linearGradient id="grad"> <stop offset="50%" stop-color=" rgb(250 204 21 )"/> <stop offset="50%" stop-color="rgb(209 213 219)"/>  </linearGradient> </defs> <path fill="url(#grad)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                        newDiv.innerHTML = svg;
                        DivProdContainer.appendChild(newDiv);
                        console.log("halfstar")

                        i++;
                    }

                } else {
                    const newDiv = document.createElement("div");
                    var svg1 = '<svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                    newDiv.innerHTML = svg1;
                    DivProdContainer.appendChild(newDiv);

                }
            }








            var parentElementdel = document.getElementById("stardivdel");

            // Loop through all child elements and remove them one by one
            while (parentElementdel.firstChild) {
                parentElementdel.removeChild(parentElementdel.firstChild);
            }
            var finalRatingsdel = element.getAttribute("data-delivery");
            var DivProdContainerdel = document.getElementById("stardivdel");

            for (var i = 1; i <= 5; i++) {

                if (i <= finalRatingsdel) {
                    var b = i + 1;
                    console.log(b)
                    const newDiv = document.createElement("div");

                    var svg = '<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                    newDiv.innerHTML = svg;
                    DivProdContainerdel.appendChild(newDiv);

                    if (finalRatingsdel > i && finalRatingsdel < b) {
                        console.log("true")
                        const newDiv = document.createElement("div");

                        var svg = '<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                        newDiv.innerHTML = svg;
                        DivProdContainerdel.appendChild(newDiv);
                        var svg = '<svg  class="w-5 h-5 "  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <defs>  <linearGradient id="grad"> <stop offset="50%" stop-color=" rgb(250 204 21 )"/> <stop offset="50%" stop-color="rgb(209 213 219)"/>  </linearGradient> </defs> <path fill="url(#grad)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                        newDiv.innerHTML = svg;
                        DivProdContainerdel.appendChild(newDiv);
                        console.log("halfstar")

                        i++;
                    }

                } else {
                    const newDiv = document.createElement("div");
                    var svg1 = '<svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                    newDiv.innerHTML = svg1;
                    DivProdContainerdel.appendChild(newDiv);

                }
            }




            var parentElementqual = document.getElementById("stardivqual");

            // Loop through all child elements and remove them one by one
            while (parentElementqual.firstChild) {
                parentElementqual.removeChild(parentElementqual.firstChild);
            }
            var finalRatingsqual = element.getAttribute("data-quality");
            var DivProdContainerqual = document.getElementById("stardivqual");

            for (var i = 1; i <= 5; i++) {

                if (i <= finalRatingsqual) {
                    var b = i + 1;
                    console.log(b)
                    const newDiv = document.createElement("div");

                    var svg = '<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                    newDiv.innerHTML = svg;
                    DivProdContainerqual.appendChild(newDiv);

                    if (finalRatingsqual > i && finalRatingsqual < b) {
                        console.log("true")
                        const newDiv = document.createElement("div");

                        var svg = '<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                        newDiv.innerHTML = svg;
                        DivProdContainerqual.appendChild(newDiv);
                        var svg = '<svg  class="w-5 h-5 "  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <defs>  <linearGradient id="grad"> <stop offset="50%" stop-color=" rgb(250 204 21 )"/> <stop offset="50%" stop-color="rgb(209 213 219)"/>  </linearGradient> </defs> <path fill="url(#grad)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                        newDiv.innerHTML = svg;
                        DivProdContainerqual.appendChild(newDiv);
                        console.log("halfstar")

                        i++;
                    }

                } else {
                    const newDiv = document.createElement("div");
                    var svg1 = '<svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                    newDiv.innerHTML = svg1;
                    DivProdContainerqual.appendChild(newDiv);

                }
            }





            var category = element.getAttribute("data-category");
            var attachment = element.getAttribute("data-attachment");

            if (attachment == "") {
                $("#attachment").addClass("hidden");

            } else {
                $("#attachment").removeClass("hidden");
            }
            if (category != "Computer") {
                // $("#categoryDivParent").removeClass("grid-cols-2").addClass("grid-col-1");
                $("#categoryDivParent").addClass("hidden");
                $("#telephoneh2").removeClass("pl-10");

            } else {

                $("#categoryDivParent").removeClass("hidden");
                $("#telephoneh2").addClass("pl-10");

            }

            // $('#assigned option:eq(0)').prop('selected', true)

            modal.toggle();
        }

        function modalHide() {
            modal.toggle();

        }


        const $targetEl = document.getElementById('sidebar');

        const options = {
            placement: 'left',
            backdrop: false,
            bodyScrolling: true,
            edge: false,
            edgeOffset: '',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',
            onHide: () => {
                //console.log('drawer is hidden');
            },
            onShow: () => {
                //console.log('drawer is shown');
            },
            onToggle: () => {
                //console.log('drawer has been toggled');
            }
        };

        const drawer = new Drawer($targetEl, options);
        drawer.show();
        var show = true;
        var sidebar = 0;

        function shows() {
            if (show) {
                drawer.hide();
                show = false;
            } else {
                drawer.show();
                show = true;
            }
            // var sidebar=0;
            if (sidebar == 0) {
                document.getElementById("mainContent").style.width = "100%";
                document.getElementById("mainContent").style.marginLeft = "0px";
                // document.getElementById("sidebar").style.opacity= ""; 
                // document.getElementById("sidebar").style.transition = "all .1s";

                document.getElementById("mainContent").style.transition = "all .3s";






                sidebar = 1;
            } else {
                document.getElementById("mainContent").style.width = "calc(100% - 288px)";
                document.getElementById("mainContent").style.marginLeft = "288px";

                sidebar = 0;
            }


        }


        const tabElements = [{
                id: 'overall',
                triggerEl: document.querySelector('#overallTab'),
                targetEl: document.querySelector('#overAll')
            },
            {
                id: 'headApproval1',
                triggerEl: document.querySelector('#headApprovalTab'),
                targetEl: document.querySelector('#headApproval')
            },
            {
                id: 'inProgress',
                triggerEl: document.querySelector('#inProgressTab'),
                targetEl: document.querySelector('#inProgress')
            },
            {
                id: 'forRating',
                triggerEl: document.querySelector('#toRateTab'),
                targetEl: document.querySelector('#forRating')
            }
        ];


        const taboptions = {
            defaultTabId: 'headApproval1',
            activeClasses: 'text-white hover:text-amber-400 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
            inactiveClasses: 'text-gray-300 hover:text-amber-500 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
            onShow: () => {
                // console.log('tab is shown');
            }
        };


        const tabs = new Tabs(tabElements, taboptions);

        tabs.show('headApproval1');
        document.getElementById("transferUser").required = false;

        function requireSelect() {
            document.getElementById("transferUser").required = true;

        }

        function unrequireSelect() {
            document.getElementById("transferUser").required = false;

        }


        function changeSched() {
            document.getElementById("changeScheddate").required = true;

        }

        function unchangeSched() {
            document.getElementById("changeScheddate").required = false;

        }

        function goToOverall() {
            const myElement = document.querySelector('#diamond');
            document.getElementById("datestart").disabled = true;
            document.getElementById("datefinish").disabled = true;


            const currentTransform = myElement.style.transform = 'translateX(50px) translateY(2px) rotate(135deg)';

            $("#buttonPrintDiv").addClass("hidden");
            $("#recommendationDiv").addClass("hidden");
            $("#transferButton").addClass("hidden");


        }


        function goToHead() {
            const myElement = document.querySelector('#diamond');
            $("#adminremarksDiv").addClass("hidden");
            $("#remarksDiv").removeClass("hidden");
            $("#buttonDiv").removeClass("hidden");
            $("#assignedPersonnelDiv").addClass("hidden");
            $("#chooseAssignedDiv").removeClass("hidden");
            $("#buttonPrintDiv").removeClass("hidden");
            $("#actionDetailsDiv").addClass("hidden");
            $("#ratingstar").addClass("hidden");
            const currentTransform = myElement.style.transform = 'translateX(160px) translateY(2px) rotate(135deg)';
            document.getElementById("reasonCancel").required = false;
            document.getElementById("telephone").disabled = true;
            document.getElementById("assigned").required = true;
            document.getElementById("telephone").disabled = true;
            document.getElementById("datestart").disabled = false;
            document.getElementById("datefinish").disabled = false;
            $("#changeSchedButton").addClass("hidden");
            $("#recommendationDiv").addClass("hidden");
            $("#transferButton").addClass("hidden");


        }


        function goToMis() {
            const myElement = document.querySelector('#diamond');
            $("#ratingstar").addClass("hidden");
            $("#adminremarksDiv").removeClass("hidden");
            $("#remarksDiv").addClass("hidden");
            $("#buttonDiv").addClass("hidden");
            $("#assignedPersonnelDiv").removeClass("hidden");
            $("#chooseAssignedDiv").addClass("hidden");
            $("#buttonPrintDiv").removeClass("hidden");
            $("#actionDetailsDiv").addClass("hidden");
            document.getElementById("reasonCancel").required = false;
            document.getElementById("assigned").required = false;
            $("#recommendationDiv").addClass("hidden");

            $("#transferButton").removeClass("hidden");
            $("#changeSchedButton").removeClass("hidden");
            document.getElementById("datestart").disabled = true;
            document.getElementById("datefinish").disabled = true;
            // const currentTransform = myElement.style.transform = 'translateX(385px) translateY(2px) rotate(135deg)';

            const currentTransform = myElement.style.transform = 'translateX(270px) translateY(2px) rotate(135deg)';



        }

        function goToRate() {
            const myElement = document.querySelector('#diamond');
            $("#adminremarksDiv").removeClass("hidden");
            $("#remarksDiv").addClass("hidden");
            $("#assignedPersonnelDiv").removeClass("hidden");
            $("#chooseAssignedDiv").addClass("hidden");
            $("#buttonDiv").addClass("hidden");
            $("#actionDetailsDiv").removeClass("hidden");
            $("#buttonPrintDiv").removeClass("hidden");
            $("#changeSchedButton").addClass("hidden");
            const currentTransform = myElement.style.transform = 'translateX(380px) translateY(2px) rotate(135deg)';
            $("#recommendationDiv").removeClass("hidden");

            document.getElementById("reasonCancel").required = false;
            document.getElementById("assigned").required = false;
            document.getElementById("datestart").disabled = true;
            document.getElementById("datefinish").disabled = true;
            document.getElementById("changeSchedButton").disabled = true;
            $("#transferButton").addClass("hidden");


        }



        var setdate2;

        function testDate() {
            var chosendate = document.getElementById("datestart").value;



            const x = new Date();
            const y = new Date(chosendate);

            if (x < y) {
                //console.log("Valid");
                var monthNumber = new Date().getMonth() + 1;
                const asf = new Date(chosendate);
                asf.setDate(asf.getDate() + 1);
                var setdate = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
                document.getElementById("datefinish").value = setdate;

                setdate2 = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
                //console.log(setdate)

            } else {
                alert("Sorry your request date is not accepted!")

                const z = new Date();
                var monthNumber = new Date().getMonth() + 1
                z.setDate(z.getDate() + 1);
                //console.log(z);
                var setdate = z.getFullYear() + "-" + monthNumber + "-" + z.getDate();
                document.getElementById("datestart").value = setdate;
                //console.log(setdate)

                const asf2 = new Date(setdate);
                asf2.setDate(asf2.getDate() + 2);
                setdate2 = asf2.getFullYear() + "-" + monthNumber + "-" + asf2.getDate();
                document.getElementById("datefinish").value = setdate2;

            }
        }

        function endDate() {
            //console.log(setdate2);


            var chosendate3 = document.getElementById("datefinish").value;
            //console.log(chosendate3);

            const x = new Date(setdate2);
            const y = new Date(chosendate3);

            if (x < y) {

            } else {
                alert("Sorry your request date is not accepted!")
                document.getElementById("datefinish").value = setdate2;

            }
        }




        $("#sidehome").addClass("text-white bg-gradient-to-r from-blue-900 to-teal-500");
        $("#sideMyJo").addClass("text-white bg-gradient-to-r from-pink-500 to-orange-400");

        $("#sidehistory").removeClass("bg-gray-200");
        $("#sidepms").removeClass("bg-gray-200");


        $(document).ready(function() {
            $('#forRatingTable').DataTable({
                "order": [
                    [1, "desc"]
                ],
                responsive: true,
                destroy: true,
                lengthMenu: [
                    [10, 15, 20, 50],
                    [10, 15, 20, 50]
                ],
                pageLength: 10

            });
        });
    </script>

</body>

</html>