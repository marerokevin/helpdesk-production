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

if (isset($_SESSION['connected'])) {


    $level = $_SESSION['level'];

    if ($level == 'user') {
        header("location:../employees");
    } else if ($level == 'fem') {
        header("location:../fem");
    } else if ($level == 'head') {
        header("location:../department-head");
    }
}
if (!isset($_SESSION['connected'])) {
    header("location: ../logout.php");
}
include("../includes/connect.php");


$misusername =  $_SESSION['username'];




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
    $_SESSION['assignedPersonnel'] = $_POST['passignedPersonnel'];
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

?>
    <script type="text/javascript">
        window.open('./Job Order Report.php', '_blank');
    </script>
<?php


}


if (!isset($_SESSION['connected'])) {
    header("location: ../index.php");
}


$sqllink = "SELECT `link` FROM `setting`";
$resultlink = mysqli_query($con, $sqllink);
$link = "";
while ($listlink = mysqli_fetch_assoc($resultlink)) {
    $link = $listlink["link"];
}


$user_dept = $_SESSION['department'];
$user_level = $_SESSION['level'];



if (isset($_POST['addAction'])) {
    $requestID = $_POST['joid2'];
    $action = $_POST['action'];
    $date = new DateTime();
    $date = $date->format('F d, Y');
    $sql = "select * from `request` WHERE `id` ='$requestID'";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['action1'] == "") {
            $sql = "UPDATE `request` SET `action1`='$action', `action1Date`='$date' WHERE `id` = '$requestID';";
            $results = mysqli_query($con, $sql);
        } else if ($row['action1'] != "" && $row['action2'] == "") {
            $sql = "UPDATE `request` SET `action2`='$action', `action2Date`='$date' WHERE `id` = '$requestID';";
            $results = mysqli_query($con, $sql);
        } else if ($row['action1'] != "" && $row['action2'] != "" && $row['action3'] == "") {
            $sql = "UPDATE `request` SET `action3`='$action', `action3Date`='$date' WHERE `id` = '$requestID';";
            $results = mysqli_query($con, $sql);
        }
    }
}
if (isset($_POST['approveRequest'])) {
    $requestID = $_POST['joid2'];
    $completejoid = $_POST['completejoid'];

    $action = $_POST['action'];
    $requestor = $_POST['requestor'];
    $requestorEmail = $_POST['requestoremail'];
    $recommendation = $_POST['recommendation'];




    $sql1 = "Select * FROM `request` WHERE `id` = '$requestID'";
    $result = mysqli_query($con, $sql1);
    while ($list = mysqli_fetch_assoc($result)) {
        $requestorUsername = $list["requestorUsername"];
        $email = $list["email"];
        $requestor = $list["requestor"];
    }

    $date = date("Y-m-d");
    $username = $_SESSION['name'];
    $action = str_replace("'", "&apos;", $action);
    $recommendation = str_replace("'", "&apos;", $recommendation);

    $sql = "UPDATE `request` SET `status2`='Done',`actual_finish_date`='$date',`action`='$action', `recommendation`='$recommendation' WHERE `id` = '$requestID';";
    $results = mysqli_query($con, $sql);

    if ($results) {
        $sql2 = "Select * FROM `sender`";
        $result2 = mysqli_query($con, $sql2);
        while ($list = mysqli_fetch_assoc($result2)) {
            $account = $list["email"];
            $accountpass = $list["password"];
        }

        $subject = 'Completed Job Order';
        $message = 'Hi ' . $requestor . ',<br> <br> ICT has completed one of your job order requests. Please check the details by signing in into our Helpdesk <br> Click this ' . $link . ' to signin. <br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';


        require '../vendor/autoload.php';

        $mail = new PHPMailer(true);
        //  email the admin               
        try {
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.glorylocal.com.ph';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $account;     // Your Email/ Server Email
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

            //Send Email
            // $mail->setFrom('Helpdesk'); //eto ang mag front  notificationsys01@gmail.com

            //Recipients
            $mail->setFrom('mis.dev@glory.com.ph', 'Helpdesk');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();


            $_SESSION['message'] = 'Message has been sent';
            echo "<script>alert('Job order completed.') </script>";
            echo "<script> location.href='index.php'; </script>";


            // header("location: form.php");
        } catch (Exception $e) {
            $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            echo "<script>alert('Message could not be sent. Mailer Error.') </script>";
        }
    }


    // end of sending email



}






if (isset($_POST['cancelJO'])) {
    $joid = $_POST['joid2'];
    $reasonCancel = $_POST['reasonCancel'];
    $requestorEmail = $_POST['requestoremail'];
    $requestor = $_POST['requestor'];
    $completejoid = $_POST['completejoid'];
    $sql = "UPDATE `request` SET `status2`='cancelled', `reasonOfCancellation`='$reasonCancel' WHERE `id` = '$joid';";
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

            $subject2 = 'Cancelled Job Order';
            $message2 = 'Hi ' . $requestor . ',<br> <br>  Your Job Order with JO number of ' . $completejoid . ' is CANCELLED by the administrator. Please check the details by signing in into our Helpdesk <br> Click this ' . $link . ' to signin. <br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';

            // email this requestor

            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.glorylocal.com.ph';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $account;     // Your Email/ Server Email
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
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk</title>
    <link rel="shortcut icon" href="../resources/img/helpdesk.png">

    <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">

    <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">

    <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

    <link rel="stylesheet" href="index.css">

    <script src="../cdn_tailwindcss.js"></script>

    <link rel="stylesheet" href="../node_modules/flowbite/dist/flowbite.min.css" />

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
            <div class="text-center py-2 m-auto lg:text-center w-full ">

                <div class="m-auto flex flex-col w-2/4  h-12 hidden">
                    <h2 class="text-xl font-bold tracking-tight text-gray-100 sm:text-xl">Total numbers of pending Job Order
                    </h2>

                </div>


                <div class="m-auto flex flex-col w-10/12">

                    <div class="mt-0 grid grid-cols-1 gap-4 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 hidden">

                        <div class="flex items-start rounded-xl bg-teal-700 dark:bg-white p-4 shadow-lg ">
                            <div class="flex h-12 w-12 overflow-hidden items-center justify-center rounded-full border border-red-100 bg-red-50">
                                <img src="../resources/img/Engineer.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            </div>

                            <div class="ml-3 ">
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
                        <div class="flex items-start rounded-xl bg-sky-900 dark:bg-white p-4 shadow-lg">
                            <div class="flex h-12 w-12 items-center overflow-hidden  justify-center rounded-full ">
                                <img src="../resources/img/star.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            </div>

                            <div class="ml-3">
                                <h2 class="font-semibold text-gray-100 dark:text-gray-900">Your Rating</h2>
                                <?php
                                $sql1 = "SELECT ROUND((SELECT SUM(`rating_final`) AS totalrating FROM `request` WHERE `assignedPersonnel` = '$misusername' and `status2` = 'rated') / Count(id), 1) AS totalrating FROM `request` WHERE `assignedPersonnel` = '$misusername' and `status2` = 'rated'";
                                $result = mysqli_query($con, $sql1);
                                while ($row = mysqli_fetch_assoc($result)) {




                                ?>
                                    <h2 class="mt-2 text-xl text-left">
                                        <span class="flex">
                                            <?php for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $row['totalrating']) {

                                                    $b = $i + 1;


                                            ?>
                                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Second star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <?php
                                                    if ($row['totalrating'] > $i && $row['totalrating'] < $b) {
                                                    ?>
                                                        <svg class="w-5 h-5 " viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <defs>
                                                                <linearGradient id="grad">
                                                                    <stop offset="50%" stop-color=" rgb(250 204 21 )" />
                                                                    <stop offset="50%" stop-color="rgb(209 213 219)" />
                                                                </linearGradient>
                                                            </defs>
                                                            <path fill="url(#grad)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>

                                                    <?php
                                                        $i++;
                                                    }
                                                } else {
                                                    ?>
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Fifth star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                            <?php
                                                }
                                            } ?>


                                            <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo  $row['totalrating']; ?> </span>
                                            <!-- <?php echo ' ' . $row['totalrating'];
                                                } ?>   -->
                                        </span>
                                    </h2>

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
                                            <button id="headApprovalTab" onclick="goToHead()" type="button" role="tab" aria-controls="headApproval" class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php


                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE  `status2` ='inprogress' and `assignedPersonnel` = '$misusername'";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"> <?php
                                                                                                                                                                                                                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' and `assignedPersonnel` = '$misusername'";
                                                                                                                                                                                                                                                        $result = mysqli_query($con, $sql1);
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
                                                <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">My Job Order</p>
                                            </button>
                                        </div>
                                    </li>
                                    <li role="presentation">
                                        <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                            <button id="overallTab" onclick="goToOverall()" type="button" role="tab" aria-controls="overall" class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php
                                                        if ($_SESSION['leaderof'] == "fem") {
                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' and `request_to` = 'fem'";
                                                            $result = mysqli_query($con, $sql1);
                                                        } else  if ($_SESSION['leaderof'] == "mis") {
                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' and `request_to` = 'mis'";
                                                            $result = mysqli_query($con, $sql1);
                                                        }


                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"> <?php
                                                                                                                                                                                                                                                        if ($_SESSION['leaderof'] == "fem") {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' and `request_to` = 'fem'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        } else  if ($_SESSION['leaderof'] == "mis") {
                                                                                                                                                                                                                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `status2` ='inprogress' and `request_to` = 'mis'";
                                                                                                                                                                                                                                                            $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        }
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
                                        <div class="p__uwg" style="width: 96px; margin-left: 16px; margin-right: 0px;">
                                            <button id="toRateTab" onclick="goToRate()" class="_1QoxDw o4TrkA CA2Rbg cwOZMg zQlusQ uRvRjQ POMxOg" tabindex="-1" type="button" role="tab" aria-controls="toRate" aria-selected="false">
                                                <div class="_1cZINw">
                                                    <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                        <span class=" sr-only">Notifications</span>
                                                        <?php
                                                        $date1 = new DateTime();
                                                        $dateMonth = $date1->format('M');
                                                        $dateYear = $date1->format('Y');

                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE   `status2` = 'Done'  and `assignedPersonnel` = '$misusername' ";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($count = mysqli_fetch_assoc($result)) {

                                                            if ($count["pending"] > 0) {
                                                        ?>
                                                                <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900"> <?php
                                                                                                                                                                                                                                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE  `status2` = 'Done'  and `assignedPersonnel` = '$misusername' ";
                                                                                                                                                                                                                                                        $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                        while ($count = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                                                                            echo $count["pending"];
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        ?></div><?php
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                ?>
                                                        <img src="../resources/img/adminapprove.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                    </div>
                                                </div>
                                                <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Finished</p>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="rzHaWQ theme light" id="diamond" style="transform: translateX(55px) translateY(2px) rotate(135deg);"></div>
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
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
                <section class="mt-10">
                    <table id="employeeTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Requestor</th>
                                <th>Date Approved</th>
                                <th>Category</th>
                                <th>Assigned to</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;

                            $sql = "select * from `request` WHERE `status2` ='inprogress' and `assignedPersonnel` = '$misusername' order by id asc  ";
                            $result = mysqli_query($con, $sql);

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
                                <tr>
                                    <td>
                                        <?php echo $joid; ?>

                                    <td>
                                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                                        <button type="button" id="viewdetails" onclick="modalShow(this)" data-reqtype="<?php echo $reqtype; ?>" data-action1="<?php echo $row['action1'] ?>" data-action2="<?php echo $row['action2'] ?>" data-action3="<?php echo $row['action3'] ?>" data-action1date="<?php echo $row['action1Date'] ?>" data-action2date="<?php echo $row['action2Date'] ?>" data-action3date="<?php echo $row['action3Date'] ?>" data-telephone="<?php echo $row['telephone']; ?>" data-attachment="<?php echo $row['attachment']; ?>" data-action="<?php echo $row['action']; ?>" data-joidprint="<?php echo $joid; ?>" data-headremarks="<?php echo $row['head_remarks']; ?>" data-adminremarks="<?php echo $row['admin_remarks']; ?>" data-headdate="<?php echo $row['head_approval_date']; ?>" data-admindate="<?php echo $row['admin_approved_date']; ?>" data-joid="<?php echo $row['id']; ?>" data-requestoremail="<?php echo $row['email']; ?>" data-department="<?php echo $row['department'] ?>" data-requestor="<?php echo $row['requestor']; ?>" data-status="<?php echo $row['status2'] ?>" data-assignedpersonnel="<?php echo $row['assignedPersonnelName'] ?> " data-datefiled="<?php $date = new DateTime($row['date_filled']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $date; ?>" data-section="<?php if ($row['request_to'] == "fem") {
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
                                        $date = new DateTime($row['admin_approved_date']);
                                        $date = $date->format('F d, Y');
                                        echo $date; ?>

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
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="overall" role="tabpanel" aria-labelledby="profile-tab">
                <section class="mt-10">
                    <table id="overAllTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Requestor</th>
                                <th>Date Approved</th>
                                <th>Category</th>
                                <th>Assigned to</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            if ($_SESSION['leaderof'] == "fem") {
                                $sql = "select * from `request` WHERE `status2` ='inprogress' and `request_to` = 'fem' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            } else  if ($_SESSION['leaderof'] == "mis") {
                                $sql = "select * from `request` WHERE `status2` ='inprogress' and `request_to` = 'mis' order by id asc  ";
                                $result = mysqli_query($con, $sql);
                            } else {
                                $sql = "select * from `request` WHERE `status2` ='inprogress'  order by id asc  ";
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

                                    <td>
                                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                                        <button type="button" id="viewdetails" onclick="modalShow(this)" data-reqtype="<?php echo $reqtype; ?>" data-action1="<?php echo $row['action1'] ?>" data-action2="<?php echo $row['action2'] ?>" data-action3="<?php echo $row['action3'] ?>" data-action1date="<?php echo $row['action1Date'] ?>" data-action2date="<?php echo $row['action2Date'] ?>" data-action3date="<?php echo $row['action3Date'] ?>" data-telephone="<?php echo $row['telephone']; ?>" data-attachment="<?php echo $row['attachment']; ?>" data-action="<?php echo $row['action']; ?>" data-joidprint="<?php echo $joid; ?>" data-headremarks="<?php echo $row['head_remarks']; ?>" data-adminremarks="<?php echo $row['admin_remarks']; ?>" data-headdate="<?php echo $row['head_approval_date']; ?>" data-admindate="<?php echo $row['admin_approved_date']; ?>" data-joid="<?php echo $row['id']; ?>" data-requestoremail="<?php echo $row['email']; ?>" data-department="<?php echo $row['department'] ?>" data-requestor="<?php echo $row['requestor']; ?>" data-status="<?php echo $row['status2'] ?>" data-assignedpersonnel="<?php echo $row['assignedPersonnelName'] ?> " data-datefiled="<?php $date = new DateTime($row['date_filled']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $date; ?>" data-section="<?php if ($row['request_to'] == "fem") {
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
                                        $date = new DateTime($row['admin_approved_date']);
                                        $date = $date->format('F d, Y');
                                        echo $date; ?>

                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['request_category']; ?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate" style="max-width: 10px;">

                                        <?php echo $row['assignedPersonnelName'];
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
                                <th>Date Finished</th>
                                <th>Comments</th>
                                <!-- <th>Ratings</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            $date1 = new DateTime();
                            $dateMonth = $date1->format('M');
                            $dateYear = $date1->format('Y');
                            $sql = "select * from `request` WHERE (`status2` ='rated' OR `status2` = 'Done')  and `assignedPersonnel` = '$misusername' AND `month`='$dateMonth' AND `year`='$dateYear' order by id asc  ";
                            $result = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count == 0) {
                                $sql = "select * from `request` WHERE `status2` = 'Done' and `assignedPersonnel` = '$misusername' order by id asc  ";
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

                                    <td>
                                        <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                                        <button type="button" id="viewdetails" onclick="modalShow(this)" data-reqtype="<?php echo $reqtype; ?>" data-recommendation="<?php echo $row['recommendation'] ?>" data-requestorremarks="<?php echo $row['requestor_remarks'] ?>" data-quality="<?php echo $row['rating_quality'] ?>" data-delivery="<?php echo $row['rating_delivery'] ?>" data-ratedby="<?php echo $row['ratedBy'] ?>" data-daterate="<?php echo $row['rateDate'] ?>" data-action1date="<?php echo $row['action1Date'] ?>" data-action2date="<?php echo $row['action2Date'] ?>" data-action3date="<?php echo $row['action3Date'] ?>" data-headremarks="<?php echo $row['head_remarks']; ?>" data-adminremarks="<?php echo $row['admin_remarks']; ?>" data-headdate="<?php echo $row['head_approval_date']; ?>" data-admindate="<?php echo $row['admin_approved_date']; ?>" data-department="<?php echo $row['department'] ?>" data-requestoremail="<?php echo $row['email']; ?>" data-status="<?php echo $row['status2'] ?>" data-action1="<?php echo $row['action1'] ?>" data-action2="<?php echo $row['action2'] ?>" data-action3="<?php echo $row['action3'] ?>" data-ratings="<?php echo $row['rating_final']; ?>" data-actualdatefinished="<?php $date = new DateTime($row['actual_finish_date']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo $date; ?>" data-assignedpersonnel="<?php echo $row['assignedPersonnelName'] ?> " data-requestor="<?php echo $row['requestor'] ?>" data-personnel="<?php echo $row['assignedPersonnel'] ?>" data-action="<?php echo $dataAction = str_replace('"', '', $row['action']); ?>" data-joidprint="<?php echo $joid; ?>" data-joid="<?php echo $row['id']; ?>" data-datefiled="<?php $date = new DateTime($row['date_filled']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo $date; ?>" data-section="<?php if ($row['request_to'] === "fem") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "FEM";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else if ($row['request_to'] === "mis") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "ICT";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?> " data-category="<?php echo $row['request_category']; ?>" data-telephone="<?php echo $row['telephone']; ?>" data-attachment="<?php echo $row['attachment']; ?>" data-comname="<?php echo $row['computerName']; ?>" data-start="<?php echo $row['reqstart_date']; ?>" data-end="<?php echo $row['reqfinish_date']; ?>" data-details="<?php echo $row['request_details']; ?>" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            View more
                                        </button>
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
                                        $date = new DateTime($row['actual_finish_date']);
                                        $date = $date->format('F d, Y');
                                        echo $date; ?>

                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate " style="max-width: 40px;">
                                        <?php echo $row['requestor_remarks']; ?>
                                    </td>
                                    <!-- <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <h2>
                <span class="flex justify-center items-center">
                <?php for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $row['rating_final']) {

                                        $b = $i + 1;


                ?>
                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <?php
                                        if ($row['rating_final'] > $i && $row['rating_final'] < $b) {
                        ?>
                                <svg  class="w-5 h-5 "  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
      <linearGradient id="grad">
        <stop offset="50%" stop-color=" rgb(250 204 21 )"/>
        <stop offset="50%" stop-color="rgb(209 213 219)"/>
      </linearGradient>
    </defs>
                        <path fill="url(#grad)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>

                               <?php
                                            $i++;
                                        }
                                    } else {
                                ?>
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <?php
                                    }
                                } ?>   
                       
         
                <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo  $row['rating_final']; ?> </span> 
              <?php echo ' ' . $row['rating_final'] ?>  
                </span></h2>
              </td> -->








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

                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            <span id="reqtype"></span> Details
                        </h3>
                        <div class="ml-auto">
                            <button type="submit" onclick="printreport()" name="print" class="  text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 ">
                                <svg class="w-4 h-4 mr-2 -ml-1 " fill="none" focusable="false" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"></path>
                                </svg> Print
                            </button>

                            <button onclick="modalHide()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5  inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
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
                            <h2 class="pl-10 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Type: </span><span id="category"></span></h2>
                        </div>
                        <div class="w-full grid gap-4 grid-cols-2 hidden">
                            <div id="categoryDivParent" class="grid gap-4 grid-cols-2">
                                <h2 class="float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Computer Name: </span></h2>
                                <input disabled type="text" name="computername" id="computername" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </div>
                            <div class="grid gap-4 grid-cols-2 ">
                                <h2 id="telephoneh2" class="pl-10 float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Telephone</span></h2>
                                <input disabled type="text" name="telephone" id="telephone" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </div>
                        </div>
                        <a type="button" name="attachment" id="attachment" target="_blank" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View Attachment</a>

                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
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
                                        <input disabled id="datestart" onchange="testDate()" name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date start" required="">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input disabled id="datefinish" onchange="endDate()" name="finish" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date finish" required="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">


                        <div id="headRemarksDiv" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Head Remarks: </span><span id="headremarks"></span></h2>
                        </div>
                        <div id="adminRemarksDiv" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Admin Remarks: </span><span id="adminremarks"></span></h2>
                        </div>
                        <hr id="remarkshr" class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                        <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Request Details</label>
                        <textarea disabled id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                        <div id="action1div" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 1: </span><span id="action1"></span></h2>
                        </div>
                        <div id="action2div" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 2: </span><span id="action2"></span></h2>
                        </div>
                        <div id="action3div" class="w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 3: </span><span id="action3"></span></h2>
                        </div>
                        <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Action</label>
                        <textarea required id="action" name="action" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="State your action..."> </textarea>
                        <div id="recommendationDiv" class="hidden w-full grid gap-4 grid-col-1">
                            <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Recommendation: </span><span id="recommendation"></span></h2>
                        </div>


                        <div id="ratingstar" class="hidden w-full grid grid-cols-12 hidden">
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
                            <div id="comments" class="grid col-span-10">
                                <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Comments: </span><span id="userComments"></span></h2>
                            </div>
                        </div>
                    </div>
                    <div id="buttonDiv" class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" id="addAction" data-modal-target="popup-modal-addaction" data-modal-toggle="popup-modal-addaction" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add Action</button>
                        <button type="button" data-modal-target="popup-modal-approve" data-modal-toggle="popup-modal-approve" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Done</button>
                        <button type="button" onclick="cancellation()" data-modal-target="popup-modal-cancel" data-modal-toggle="popup-modal-cancel" class="shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-pink-800/80  w-full text-white bg-gradient-to-br from-red-400 to-pink-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancel Request</button>

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
                                    <br>
                                    <br>
                                    <br>
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
                                    <br> <br>
                                    <br>
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
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">If you have a recommendation, please fill-out in this box.</h3>
                                    <textarea id="recommendation" name="recommendation" rows="4" class="mb-10 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a recommendation..."></textarea>
                                    <button type="submit" name="approveRequest" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Proceed
                                    </button>
                                    <button data-modal-toggle="popup-modal-approve" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="popup-modal-addaction" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                        <div class="relative w-full h-full max-w-md md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" data-modal-toggle="popup-modal-addaction" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to add this action?</h3>
                                    <button type="submit" name="addAction" class="text-white bg-gradient-to-br  from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button data-modal-toggle="popup-modal-addaction" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="index.js"></script>

    <script>
        function printreport() {
            document.getElementById("action").required = false;
        }

        function cancellation() {
            document.getElementById("reasonCancel").required = true;
            document.getElementById("action").required = false;


        }

        function exitcancellation() {
            document.getElementById("reasonCancel").required = false;
            document.getElementById("action").required = true;

        }
        // set the modal menu element
        const $targetElModal = document.getElementById('defaultModal');

        // options with default values
        const optionsModal = {
            placement: 'center-center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {
                console.log('modal is hidden');
            },
            onShow: () => {
                console.log('modal is shown');

                //   console.log(section);
            },
            onToggle: () => {
                console.log('modal has been toggled');

            }
        };
        const modal = new Modal($targetElModal, optionsModal);



        function modalShow(element) {

            $headRemarksVar = element.getAttribute("data-headremarks");
            $adminRemarksVar = element.getAttribute("data-adminremarks");

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
            document.getElementById("jonumber").innerHTML = element.getAttribute("data-joidprint");
            document.getElementById("completejoid").value = element.getAttribute("data-joidprint");
            document.getElementById("headremarks").innerHTML = element.getAttribute("data-headremarks");
            document.getElementById("adminremarks").innerHTML = element.getAttribute("data-adminremarks");
            document.getElementById("telephone").value = element.getAttribute("data-telephone");
            document.getElementById("attachment").setAttribute("href", element.getAttribute("data-attachment"));
            document.getElementById("requestor").innerHTML = element.getAttribute("data-requestor");
            document.getElementById("requestorEmail").innerHTML = element.getAttribute("data-requestoremail");

            document.getElementById("finalRatings").innerHTML = element.getAttribute("data-ratings");
            document.getElementById("finalRatingsdel").innerHTML = element.getAttribute("data-delivery");
            document.getElementById("finalRatingsqual").innerHTML = element.getAttribute("data-quality");

            document.getElementById("requestorinput").value = element.getAttribute("data-requestor");
            document.getElementById("requestoremailinput").value = element.getAttribute("data-requestoremail");
            document.getElementById("action").value = element.getAttribute("data-action");
            document.getElementById("action1").innerHTML = element.getAttribute("data-action1");
            document.getElementById("action2").innerHTML = element.getAttribute("data-action2");
            document.getElementById("action3").innerHTML = element.getAttribute("data-action3");
            document.getElementById("recommendation").innerHTML = element.getAttribute("data-recommendation");
            document.getElementById("reqtype").innerHTML = element.getAttribute("data-reqtype");

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

            document.getElementById("prequestedSchedule").value = formattedDateStart + " to " + formattedDateEnd;
            document.getElementById("ptype").value = element.getAttribute("data-category");
            document.getElementById("ppcNumber").value = element.getAttribute("data-comname");
            document.getElementById("pdetails").value = element.getAttribute("data-details");
            document.getElementById("pheadsRemarks").value = element.getAttribute("data-headremarks");
            document.getElementById("padminsRemarks").value = element.getAttribute("data-adminremarks");

            document.getElementById("pheadsDate").value = element.getAttribute("data-headdate");
            document.getElementById("padminsDate").value = element.getAttribute("data-admindate");

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

            document.getElementById("userComments").innerHTML = element.getAttribute("data-requestorremarks");

            document.getElementById("pratedDate").value = element.getAttribute("data-daterate");

            var action1 = element.getAttribute("data-action1");
            var action2 = element.getAttribute("data-action2");
            var action3 = element.getAttribute("data-action3");

            var recommendation = element.getAttribute("data-recommendation");

            if (recommendation == "") {
                $("#recommendationDiv").addClass("hidden");

            } else {
                $("#recommendationDiv").removeClass("hidden");

            }


            $("#addAction").addClass("hidden");
            $("#addAction").removeClass("hidden");

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




            document.getElementById("datefiled").innerHTML = element.getAttribute("data-datefiled");
            document.getElementById("sectionmodal").innerHTML = element.getAttribute("data-section");
            document.getElementById("category").innerHTML = element.getAttribute("data-category");
            document.getElementById("computername").value = element.getAttribute("data-comname");
            document.getElementById("datestart").value = element.getAttribute("data-start");
            document.getElementById("datefinish").value = element.getAttribute("data-end");
            document.getElementById("message").value = element.getAttribute("data-details");


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
                console.log('drawer is hidden');
            },
            onShow: () => {
                console.log('drawer is shown');
            },
            onToggle: () => {
                console.log('drawer has been toggled');
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
                id: 'headApproval1',
                triggerEl: document.querySelector('#headApprovalTab'),
                targetEl: document.querySelector('#headApproval')
            },
            {
                id: 'overall',
                triggerEl: document.querySelector('#overallTab'),
                targetEl: document.querySelector('#overall')
            },
            {
                id: 'forRating',
                triggerEl: document.querySelector('#toRateTab'),
                targetEl: document.querySelector('#forRating')
            },
        ];


        const taboptions = {
            defaultTabId: 'headApproval1',
            activeClasses: 'text-white hover:text-amber-400 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
            inactiveClasses: 'text-gray-300 hover:text-amber-500 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
            onShow: () => {
                console.log('tab is shown');
            }
        };


        const tabs = new Tabs(tabElements, taboptions);

        tabs.show('headApproval1');



        function goToOverall() {
            const myElement = document.querySelector('#diamond');
            $("#buttonDiv").addClass("hidden");
            document.getElementById("action").disabled = true;
            $("#ratingstar").addClass("hidden");
            const currentTransform = myElement.style.transform = 'translateX(160px) translateY(2px) rotate(135deg)';

            $("#recommendationDiv").addClass("hidden");

        }

        function goToMis() {
            const myElement = document.querySelector('#diamond');
            $("#ratingstar").addClass("hidden");

            const currentTransform = myElement.style.transform = 'translateX(300px) translateY(2px) rotate(135deg)';
            $("#recommendationDiv").addClass("hidden");



        }

        function goToRate() {
            const myElement = document.querySelector('#diamond');
            $("#buttonDiv").addClass("hidden");
            document.getElementById("action").disabled = true;
            // $("#ratingstar").removeClass("hidden");
            $("#recommendationDiv").removeClass("hidden");

            const currentTransform = myElement.style.transform = 'translateX(280px) translateY(2px) rotate(135deg)';



        }

        function goToHead() {
            const myElement = document.querySelector('#diamond');
            document.getElementById("action").disabled = false;
            $("#ratingstar").addClass("hidden");

            $("#buttonDiv").removeClass("hidden");
            const currentTransform = myElement.style.transform = 'translateX(50px) translateY(2px) rotate(135deg)';
            $("#recommendationDiv").addClass("hidden");



        }



        var setdate2;

        function testDate() {
            var chosendate = document.getElementById("datestart").value;



            const x = new Date();
            const y = new Date(chosendate);

            if (x < y) {
                console.log("Valid");
                var monthNumber = new Date().getMonth() + 1;
                const asf = new Date(chosendate);
                asf.setDate(asf.getDate() + 1);
                var setdate = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
                document.getElementById("datefinish").value = setdate;

                setdate2 = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
                console.log(setdate)

            } else {
                alert("Sorry your request date is not accepted!")

                const z = new Date();
                var monthNumber = new Date().getMonth() + 1
                z.setDate(z.getDate() + 1);
                console.log(z);
                var setdate = z.getFullYear() + "-" + monthNumber + "-" + z.getDate();
                document.getElementById("datestart").value = setdate;
                console.log(setdate)

                const asf2 = new Date(setdate);
                asf2.setDate(asf2.getDate() + 2);
                setdate2 = asf2.getFullYear() + "-" + monthNumber + "-" + asf2.getDate();
                document.getElementById("datefinish").value = setdate2;

            }
        }

        function endDate() {
            console.log(setdate2);


            var chosendate3 = document.getElementById("datefinish").value;
            console.log(chosendate3);

            const x = new Date(setdate2);
            const y = new Date(chosendate3);

            if (x < y) {

            } else {
                alert("Sorry your request date is not accepted!")
                document.getElementById("datefinish").value = setdate2;

            }
        }




        $("#sidehome").removeClass("bg-gray-200");
        $("#sidehistory").removeClass("bg-gray-200");
        $("#sideMyRequest").removeClass("bg-gray-200");
        $("#sidepms").removeClass("bg-gray-200");
        $("#sideMyJo").addClass("bg-gray-200");
    </script>

</body>

</html>