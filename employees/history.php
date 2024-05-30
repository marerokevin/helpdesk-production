 <!-- session for who is login user    -->
 <?php




    //Set the session timeout for 1 hour

    $timeout = 3600;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //Set the maxlifetime of the session

    ini_set("session.gc_maxlifetime", $timeout);

    //Set the cookie lifetime of the session

    ini_set("session.cookie_lifetime", $timeout);

    // session_start();

    $s_name = session_name();
    $url1 = $_SERVER['REQUEST_URI'];

    //Check the session exists or not

    if (isset($_COOKIE[$s_name])) {

        setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
    } else

        echo "Session is expired.<br/>";


    // end of session timeout>";






    session_start();

    if (!isset($_SESSION['connected'])) {
        header("location: ../index.php");
    }



    // connection php and transfer of session
    include("../includes/connect.php");
    require '../vendor/autoload.php';
    $user_dept = $_SESSION['department'];
    $user_level = $_SESSION['level'];
    $username = $_SESSION['username'];



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
        $_SESSION['approved_reco'] = $_POST['papproved_reco'];
        $_SESSION['icthead_reco_remarks'] = $_POST['picthead_reco_remarks'];


        //    header("location:Job Order Report.php", true, 302);
    ?>
     <script type="text/javascript">
         window.open('./Job Order Report.php', '_blank');
     </script>
 <?php



    }
    $sqllink = "SELECT `link` FROM `setting`";
    $resultlink = mysqli_query($con, $sqllink);
    $link = "";
    while ($listlink = mysqli_fetch_assoc($resultlink)) {
        $link = $listlink["link"];
    }


    if (isset($_POST['updateJO'])) {
        $computername = $_POST['computername'];
        $start = $_POST['start'];
        $finish = $_POST['finish'];
        $telephone = $_POST['telephone'];


        $joid = $_POST['joid2'];
        $message = $_POST['message'];
        $sql = "UPDATE `request` SET `computerName`='$computername',`reqstart_date`='$start',`reqfinish_date`='$finish', `request_details` = '$message' , `telephone`='$telephone' WHERE `id` = '$joid';";
        $results = mysqli_query($con, $sql);
    }

    if (isset($_POST['rateJo'])) {
        $rateScore = $_POST['rateScore'];
        $ratingcomment = $_POST['ratingcomment'];
        $joid = $_POST['joid2'];
        $assigned = $_POST['misPersonnel'];
        $requestor = $_POST['requestor'];

        $sql = "UPDATE `request` SET `status2`='rated',`rating_final`='$rateScore',`requestor_remarks`='$ratingcomment' WHERE `id` = '$joid';";
        $results = mysqli_query($con, $sql);

        if ($results) {





            $sql1 = "Select * FROM `user` WHERE `username` = '$assigned'";
            $result = mysqli_query($con, $sql1);
            while ($list = mysqli_fetch_assoc($result)) {
                $personnelEmail = $list["email"];
                $perseonnelName = $list["name"];
            }


            $sql2 = "Select * FROM `sender`";
            $result2 = mysqli_query($con, $sql2);
            while ($list = mysqli_fetch_assoc($result2)) {
                $account = $list["email"];
                $accountpass = $list["password"];
            }

            $subject = 'Job Order Rating';
            $message = 'Hi ' . $perseonnelName . ',<br> <br> Mr./Ms. ' . $requestor . ' rated your Job Order with ' . $rateScore . '. Please check the details by signing in into our Helpdesk <br> Click this ' . $link . ' to signin. <br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';




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
                $mail->addAddress($personnelEmail);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();

                $_SESSION['message'] = 'Message has been sent';
                echo "<script>alert('Thank you! Your rating is now submitted.') </script>";
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

     <!-- font awesome -->
     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" /> -->
     <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">




     <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
     <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

     <link rel="stylesheet" href="index.css">
     <!-- tailwind play cdn -->
     <!-- <script src="https://cdn.tailwindcss.com"></script> -->
     <script src="../cdn_tailwindcss.js"></script>




     <!-- <link href="/dist/output.css" rel="stylesheet"> -->


     <!-- from flowbite cdn -->
     <!-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" /> -->
     <link rel="stylesheet" href="../node_modules/flowbite/dist/flowbite.min.css" />


     <link rel="shortcut icon" href="../resources/img/helpdesk.png">
     <!-- <link rel="stylesheet" href="css/style.css" /> -->




 </head>

 <body class="static  bg-white dark:bg-gray-700">

     <!-- nav -->
     <?php require_once 'nav.php'; ?>


     <!-- main -->






     <div id="mainContent" class=" ml-72 flex mt-16  left-10 right-5  flex-col  px-14 sm:px-8  pt-6 pb-14 z-50 ">
         <div class="justify-center text-center flex items-start h-auto bg-gradient-to-r from-blue-900 to-teal-500 rounded-xl ">
             <div class="text-center py-2 m-auto lg:text-center w-full">
                 <!-- <h6 class="text-sm  tracking-tight text-gray-200 sm:text-lg">Good Day</h6> -->
                 <!-- <div class="m-auto flex flex-col w-2/4  h-12">
<h2 class="text-xl font-bold tracking-tight text-gray-100 sm:text-xl">Total numbers of pending Job Order</h2>

</div> -->

                 <!--        
<div class="m-auto flex flex-col w-2/4">

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
      <h2 class="font-semibold text-gray-100 dark:text-gray-900">MIS Pending</h2>
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
</div>  -->
                 <?php require_once 'nav.php';
                    $username = $_SESSION['username'] ?>
                 <div class="FrD3PA">
                     <div class="QnQnDA" tabindex="-1">
                         <div role="tablist" style="overflow:inherit" class="_6TVppg sJ9N9w" style="overflow-x: auto;">
                             <div class="uGmi4w">
                                 <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="tabExample" role="tablist">
                                     <li role="presentation">
                                         <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                             <button id="headApprovalTab" onclick="goToFinished()" type="button" role="tab" aria-controls="headApproval" class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA" aria-selected="false">
                                                 <div class="_1cZINw">
                                                     <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                         <span class=" sr-only">Notifications</span>
                                                         <?php

                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE  `requestorUsername` = '$username' and (`status2` = 'rated' or `status2` = 'Done')";
                                                            $result = mysqli_query($con, $sql1);
                                                            while ($count = mysqli_fetch_assoc($result)) {
                                                                if ($count["pending"] > 0) {
                                                            ?>
                                                                 <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-border-white"> <?php
                                                                                                                                                                                                                                                                $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE  `requestorUsername` = '$username' and (`status2` = 'rated' or `status2` = 'Done')";
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
                                                 <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Finished J.O.</p>
                                             </button>
                                         </div>
                                     </li>
                                     <li role="presentation">

                                         <div class="p__uwg" style="width: 113px; margin-left: 16px; margin-right: 0px;">
                                             <button id="adminApprovalTab" onclick="goToCancelled()" class="_1QoxDw o4TrkA CA2Rbg cwOZMg zQlusQ uRvRjQ POMxOg" type="button" tabindex="-1" role="tab" aria-controls="adminApproval" aria-selected="false">
                                                 <div class="_1cZINw">
                                                     <div style="overflow:inherit" class="_qiHHw Ut_ecQ kHy45A">
                                                         <span class=" sr-only">Notifications</span>


                                                         <?php

                                                            $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `requestorUsername` = '$username' and `status2` = 'cancelled'";
                                                            $result = mysqli_query($con, $sql1);
                                                            while ($count = mysqli_fetch_assoc($result)) {
                                                                if ($count["pending"] > 0) {
                                                            ?>
                                                                 <div class=" absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-border-white"> <?php
                                                                                                                                                                                                                                                                $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE `requestorUsername` = '$username' and `status2` = 'cancelled'";
                                                                                                                                                                                                                                                                $result = mysqli_query($con, $sql1);
                                                                                                                                                                                                                                                                while ($count = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                                                                                    echo $count["pending"];
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                ?></div><?php
                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                        ?>
                                                         <img src="../resources/img/disapprove.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                     </div>
                                                 </div>
                                                 <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Cancelled</p>
                                             </button>
                                         </div>
                                     </li>


                                 </ul>
                             </div>
                             <div class="rzHaWQ theme light dark:bg-gray-700" id="diamond" style="transform: translateX(55px) translateY(2px) rotate(135deg);"></div>
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



         <!-- <div class="grid grid-cols-2 m-auto flex flex-col w-full h-20 mt-4">
<div class="flex items-center justify-center h-full bg-teal-500 p-2">
<div class=" flex h-full w-20 overflow-hidden items-center justify-center rounded-full border border-red-100 bg-red-50">
    <img src="../resources/img/list.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    </div>
    <div class="ml-3">
      <h2 class="font-semibold text-4xl text-gray-100 dark:text-gray-900">My Job Order</h2>
    </div>
</div>
<div class="h-full bg-gray-500"></div>


</div> -->
         <div id="myTabContent" class="mt-10">
             <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-200" id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
                 <?php include 'finished.php'; ?>



             </div>
             <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-200" id="adminApproval" role="tabpanel" aria-labelledby="dashboard-tab">
                 <?php include 'cancelled.php'; ?>
             </div>

         </div>




     </div>






     <!-- Main modal -->
     <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
         <div class="relative w-full h-full max-w-2xl md:h-auto">
             <!-- Modal content -->
             <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                 <form action="" method="POST">
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


                     <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                             <span id="reqtype"></span> Details
                         </h3>
                         <button onclick="modalHide()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                             <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                             </svg>
                             <span class="sr-only">Close modal</span>
                         </button>
                     </div>
                     <!-- Modal body -->
                     <div class=" items-center p-6 space-y-2">
                         <div id="cancelledByDiv" class="hidden w-full">
                             <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Cancelled by: </span><span class="dark:text-white" id="cancelledBy"></span></h2>


                         </div>
                         <div id="assignedPersonnelDiv" class=" w-full">
                             <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Assigned Personnel : </span><span class="dark:text-white" id="assignedPersonnel"></span></h2>


                         </div>
                         <input type="text" name="joid2" id="joid2" class="hidden col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                         <div class="w-full grid gap-4 grid-cols-2">
                             <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Request Number : </span><span class="dark:text-white" id="jonumber"></span></h2>
                             <h2 class="pl-10 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Date filed: </span><span class="dark:text-white" id="datefiled"></span></h2>
                         </div>
                         <div class="w-full grid gap-4 grid-cols-2">
                             <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Requested Section: </span><span class="dark:text-white" id="sectionmodal"></span></h2>
                             <h2 class="pl-10 font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Type: </span><span class="dark:text-white" id="category"></span></h2>
                         </div>
                         <div class="w-full grid gap-4 grid-cols-2">
                             <div id="categoryDivParent" class="grid gap-4 grid-cols-2">
                                 <h2 class="float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Computer Name: </span></h2>
                                 <input disabled type="text" name="computername" id="computername" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                             </div>
                             <div class="grid gap-4 grid-cols-2">
                                 <h2 id="telephoneh2" class="pl-10 float-left font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Telephone</span></h2>
                                 <input disabled type="text" name="telephone" id="telephone" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                             </div>
                         </div>

                         <a type="button" name="attachment" id="attachment" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View Attachment</a>

                         <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                         <div>
                             <div class="grid grid-cols-3 hidden">
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
                                         <input disabled id="datefinish" onchange="endDate()" name="finish" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date finish" required>
                                     </div>
                                 </div>
                             </div>

                         </div>
                         <div id="actualDateFinishedDiv" class="w-full grid gap-4 grid-cols-2">
                             <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Actual date finished : </span><span class="dark:text-white" id="actualDateFinished"></span></h2>
                         </div>

                         <div id="ratingstar" class="w-full grid grid-cols-12 hidden">
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
                                 <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Comments: </span><span class="dark:text-white" id="userComments"></span></h2>
                             </div>
                         </div>
                         <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                         <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Request Details</label>
                         <textarea disabled id="message" name="message" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                         <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                         <div id="actionDetailsDiv" class="">
                             <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Details of action</label>
                             <textarea disabled id="actionDetails" name="actionDetails" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>

                         </div>
                         <div id="actionsDiv">
                             <div id="action1div" class="w-full grid gap-4 grid-col-1">
                                 <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 1: </span><span class="dark:text-white" id="action1"></span></h2>
                             </div>
                             <div id="action2div" class="w-full grid gap-4 grid-col-1">
                                 <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 2: </span><span class="dark:text-white" id="action2"></span></h2>
                             </div>
                             <div id="action3div" class="w-full grid gap-4 grid-col-1">
                                 <h2 class="font-semibold text-gray-900 dark:text-gray-900"><span class="text-gray-400">Action 3: </span><span class="dark:text-white" id="action3"></span></h2>
                             </div>
                         </div>

                         <div id="reasonCancelDiv" class="hidden">
                             <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Reason of Cancellation</label>
                             <textarea disabled id="reasonCancel" name="reasonCancel" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>

                         </div>

                     </div>

                     <div id="buttondiv" class=" items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button type="submit" name="print" class="shadow-lg shadow-blue-500/30 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Print</button>

                     </div>
                     <div id="buttonRateDiv" class="hidden items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button type="button" data-modal-target="rateModal" data-modal-toggle="rateModal" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Rate</button>
                     </div>



                     <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                         <div class="relative w-full h-full max-w-2xl md:h-auto">
                             <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                 <button type="button" onclick="exitcancellation()" data-modal-toggle="popup-modal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                     <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                     </svg>
                                     <span class="sr-only">Close modal</span>
                                 </button>

                                 <div class="p-6 text-center">
                                     <br>
                                     <br><br>
                                     <br><br>
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
                                     <button onclick="exitcancellation()" data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Exit</button>
                                     <br>
                                     <br>
                                     <br>
                                     <br>
                                     <br>
                                     <br>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div id="rateModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                         <div class="relative w-full h-full max-w-2xl md:h-auto">
                             <!-- Modal content -->
                             <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                 <!-- Modal header -->
                                 <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                     <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                         Request Details
                                     </h3>
                                     <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="rateModal">
                                         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                         </svg>
                                         <span class="sr-only">Close modal</span>
                                     </button>
                                 </div>
                                 <!-- Modal body -->
                                 <div class=" items-center p-6 space-y-2">
                                     <br>
                                     <br>
                                     <br>
                                     <br>
                                     <br>


                                     <div class="flex justify-center  m-auto">
                                         <input type="text" value="5" id="rateScore" name="rateScore" class="hidden">
                                         <input type="text" id="misPersonnel" name="misPersonnel" class="hidden">
                                         <input type="text" id="requestor" name="requestor" class="hidden">



                                         <svg aria-hidden="true" id="rate1" onclick="rate('rate1')" class="cursor-pointer w-20 h-20 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                             <title>First star</title>
                                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                         </svg>
                                         <svg aria-hidden="true" id="rate2" onclick="rate('rate2')" class="cursor-pointer w-20 h-20 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                             <title>Second star</title>
                                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                         </svg>
                                         <svg aria-hidden="true" id="rate3" onclick="rate('rate3')" class="cursor-pointer w-20 h-20 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                             <title>Third star</title>
                                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                         </svg>
                                         <svg aria-hidden="true" id="rate4" onclick="rate('rate4')" class="cursor-pointer w-20 h-20 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                             <title>Fourth star</title>
                                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                         </svg>
                                         <svg aria-hidden="true" id="rate5" onclick="rate('rate5')" class="cursor-pointer w-20 h-20 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                             <title>Fifth star</title>
                                             <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                         </svg>
                                     </div>
                                     <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                                     <label for="ratingcomment" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">What is your thoughts about the service?</label>
                                     <textarea id="ratingcomment" name="ratingcomment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                 </div>
                                 <div class=" items-center p-4 ">
                                     <button type="submit" name="rateJo" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Submit</button>
                                     <br>

                                     <br>
                                     <br>
                                     <br>
                                     <br>
                                     <br>

                                 </div>
                             </div>
                         </div>


                     </div>
                 </form>

             </div>
         </div>
     </div>






     <!-- flowbite javascript -->

     <!-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> -->

     <script src="../node_modules/flowbite/dist/flowbite.js"></script>
     <script src="../node_modules/jquery/dist/jquery.min.js"></script>

     <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>

     <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
     <script type="text/javascript" src="index.js"></script>

     <script>
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
                 const buttonModal = document.querySelector("#viewdetails");

                 //   console.log(section);
             },
             onToggle: () => {
                 console.log('modal has been toggled');

             }
         };
         const modal = new Modal($targetElModal, optionsModal);

         function modalShow(element) {

             document.getElementById("joid2").value = element.getAttribute("data-joid");
             document.getElementById("jonumber").innerHTML = element.getAttribute("data-joidprint");
             document.getElementById("datefiled").innerHTML = element.getAttribute("data-datefiled");
             document.getElementById("sectionmodal").innerHTML = element.getAttribute("data-section");
             document.getElementById("telephone").value = element.getAttribute("data-telephone");
             document.getElementById("attachment").setAttribute("href", element.getAttribute("data-attachment"));
             document.getElementById("category").innerHTML = element.getAttribute("data-category");
             document.getElementById("computername").value = element.getAttribute("data-comname");
             document.getElementById("datestart").value = element.getAttribute("data-start");
             document.getElementById("datefinish").value = element.getAttribute("data-end");
             document.getElementById("message").value = element.getAttribute("data-details");
             document.getElementById("actionDetails").value = element.getAttribute("data-action");
             document.getElementById("misPersonnel").value = element.getAttribute("data-personnel");
             document.getElementById("requestor").value = element.getAttribute("data-requestor");
             document.getElementById("assignedPersonnel").innerHTML = element.getAttribute("data-assignedpersonnel");
             document.getElementById("cancelledBy").innerHTML = element.getAttribute("data-cancelledby");
             document.getElementById("reasonCancel").innerHTML = element.getAttribute("data-reason");
             document.getElementById("actualDateFinished").innerHTML = element.getAttribute("data-actualdatefinished");
             document.getElementById("finalRatings").innerHTML = element.getAttribute("data-ratings");
             document.getElementById("finalRatingsdel").innerHTML = element.getAttribute("data-delivery");
             document.getElementById("finalRatingsqual").innerHTML = element.getAttribute("data-quality");



             document.getElementById("action1").innerHTML = element.getAttribute("data-action1");
             document.getElementById("action2").innerHTML = element.getAttribute("data-action2");
             document.getElementById("action3").innerHTML = element.getAttribute("data-action3");
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
             document.getElementById("papproved_reco").value = element.getAttribute("data-approved_reco");
             document.getElementById("picthead_reco_remarks").value = element.getAttribute("data-icthead_reco_remarks");


             var action1 = element.getAttribute("data-action1");
             var action2 = element.getAttribute("data-action2");
             var action3 = element.getAttribute("data-action3");

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
         // set the drawer menu element
         const $targetEl = document.getElementById('sidebar');

         // options with default values
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

         /*
          * targetEl: required
          * options: optional
          */
         const drawer = new Drawer($targetEl, options);
         drawer.show();
         var show = true;

         var screenWidth = window.screen.width; // Screen width in pixels
         var screenHeight = window.screen.height; // Screen height in pixels

         console.log("Screen width: " + screenWidth);
         console.log("Screen height: " + screenHeight);
         var sidebar = 0;

         function shows() {
             if (show) {
                 drawer.hide();
                 show = false;
             } else {
                 drawer.show();
                 show = true;
             }

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

         if (screenWidth <= 1132) {
             shows();

         } else {
             drawer.show();
             // sidebar=0;/

         }




         // // Code for tabs
         const tabElements = [{
                 id: 'headApproval1',
                 triggerEl: document.querySelector('#headApprovalTab'),
                 targetEl: document.querySelector('#headApproval')
             },
             {
                 id: 'adminApproval1',
                 triggerEl: document.querySelector('#adminApprovalTab'),
                 targetEl: document.querySelector('#adminApproval')
             }
         ];

         // options with default values
         const taboptions = {
             defaultTabId: 'headApproval1',
             activeClasses: 'text-amber-400 hover:text-amber-400 dark:text-amber-400 dark:hover:text-amber-400 border-amber-600 dark:border-amber-500',
             inactiveClasses: 'text-gray-300 hover:text-amber-500 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
             onShow: () => {
                 console.log('tab is shown');
             }
         };

         /*
          * tabElements: array of tab objects
          * options: optional
          */
         const tabs = new Tabs(tabElements, taboptions);

         // open tab item based on id
         tabs.show('headApproval1');


         // // get the tab object based on ID
         // tabs.getTab('adminApproval1')

         // // get the current active tab object
         // tabs.getActiveTab()


         function goToAdmin() {
             const myElement = document.querySelector('#diamond');

             document.getElementById("telephone").disabled = true;
             document.getElementById("datestart").disabled = true;
             document.getElementById("datefinish").disabled = true;
             document.getElementById("message").disabled = true;
             document.getElementById("computername").disabled = true;

             $("#assignedPersonnelDiv").addClass("hidden");

             $("#buttondiv").addClass("hidden");

             $("#actionDetailsDiv").addClass("hidden");



             // Get the current transform value
             const currentTransform = myElement.style.transform = 'translateX(180px) translateY(2px) rotate(135deg)';


             // transform: translateX(55px) translateY(2px) rotate(135deg);
         }

         function goToMis() {
             document.getElementById("telephone").disabled = true;
             document.getElementById("datestart").disabled = true;
             document.getElementById("datefinish").disabled = true;
             document.getElementById("message").disabled = true;
             document.getElementById("computername").disabled = true;

             $("#assignedPersonnelDiv").removeClass("hidden");
             $("#buttondiv").addClass("hidden");


             $("#actionDetailsDiv").addClass("hidden");

             const myElement = document.querySelector('#diamond');

             // Get the current transform value
             const currentTransform = myElement.style.transform = 'translateX(300px) translateY(2px) rotate(135deg)';


             // transform: translateX(55px) translateY(2px) rotate(135deg);
         }

         function goToRate() {
             document.getElementById("telephone").disabled = true;
             document.getElementById("datestart").disabled = true;
             document.getElementById("datefinish").disabled = true;
             document.getElementById("message").disabled = true;
             document.getElementById("computername").disabled = true;
             $("#assignedPersonnelDiv").removeClass("hidden");


             $("#actionDetailsDiv").removeClass("hidden");

             $("#buttondiv").addClass("hidden");


             const myElement = document.querySelector('#diamond');

             // Get the current transform value
             const currentTransform = myElement.style.transform = 'translateX(420px) translateY(2px) rotate(135deg)';


             // transform: translateX(55px) translateY(2px) rotate(135deg);
         }

         function goToFinished() {
             document.getElementById("telephone").disabled = true;
             document.getElementById("datestart").disabled = true;
             document.getElementById("datefinish").disabled = true;
             document.getElementById("message").disabled = true;
             document.getElementById("computername").disabled = true;
             $("#assignedPersonnelDiv").removeClass("hidden");

             // $("#ratingstar").removeClass("hidden");

             $("#actionDetailsDiv").removeClass("hidden");
             $("#actionsDiv").removeClass("hidden");

             $("#buttondiv").removeClass("hidden");
             $("#reasonCancelDiv").addClass("hidden");
             $("#cancelledByDiv").addClass("hidden");
             $("#actualDateFinishedDiv").removeClass("hidden");
             const myElement = document.querySelector('#diamond');

             // Get the current transform value
             const currentTransform = myElement.style.transform = 'translateX(50px) translateY(2px) rotate(135deg)';


             // transform: translateX(55px) translateY(2px) rotate(135deg);
         }

         function goToCancelled() {
             document.getElementById("telephone").disabled = true;
             document.getElementById("datestart").disabled = true;
             document.getElementById("datefinish").disabled = true;
             document.getElementById("message").disabled = true;
             document.getElementById("computername").disabled = true;
             $("#assignedPersonnelDiv").addClass("hidden");
             $("#reasonCancelDiv").removeClass("hidden");
             $("#cancelledByDiv").removeClass("hidden");
             $("#actualDateFinishedDiv").addClass("hidden");
             $("#ratingstar").addClass("hidden");
             $("#actionsDiv").addClass("hidden");





             $("#actionDetailsDiv").addClass("hidden");

             $("#buttondiv").addClass("hidden");


             const myElement = document.querySelector('#diamond');

             // Get the current transform value
             const currentTransform = myElement.style.transform = 'translateX(180px) translateY(2px) rotate(135deg)';


             // transform: translateX(55px) translateY(2px) rotate(135deg);
         }

         function goToHead() {
             $("#buttondiv").removeClass("hidden");

             $("#actionDetailsDiv").addClass("hidden");
             $("#assignedPersonnelDiv").addClass("hidden");

             document.getElementById("telephone").disabled = false;
             document.getElementById("computername").disabled = false;
             document.getElementById("datestart").disabled = false;
             document.getElementById("datefinish").disabled = false;
             document.getElementById("message").disabled = false;
             const myElement = document.querySelector('#diamond');

             // Get the current transform value
             const currentTransform = myElement.style.transform = 'translateX(50px) translateY(2px) rotate(135deg)';


             // transform: translateX(55px) translateY(2px) rotate(135deg);
         }

         function cancellation() {
             document.getElementById("reasonCancel").required = true;
         }

         function exitcancellation() {
             document.getElementById("reasonCancel").required = false;
         }


         var setdate2;
         var setdate;


         function testDate() {
             var chosendate = document.getElementById("datestart").value;


             console.log(chosendate)
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

         function rate(id) {
             console.log(id);

             if (id == "rate1") {
                 document.getElementById("rateScore").value = '1';
                 $("#rate1").removeClass("text-gray-300");
                 $("#rate2").removeClass("text-gray-300");
                 $("#rate3").removeClass("text-gray-300");
                 $("#rate4").removeClass("text-gray-300");
                 $("#rate5").removeClass("text-gray-300");

                 $("#rate1").removeClass("text-yellow-400");
                 $("#rate2").removeClass("text-yellow-400");
                 $("#rate3").removeClass("text-yellow-400");
                 $("#rate4").removeClass("text-yellow-400");
                 $("#rate5").removeClass("text-yellow-400");

                 $("#rate1").addClass("text-yellow-400");
                 $("#rate2").addClass("text-gray-300");
                 $("#rate3").addClass("text-gray-300");
                 $("#rate4").addClass("text-gray-300");
                 $("#rate5").addClass("text-gray-300");
             } else if (id == "rate2") {
                 document.getElementById("rateScore").value = '2';

                 $("#rate1").removeClass("text-gray-300");
                 $("#rate2").removeClass("text-gray-300");
                 $("#rate3").removeClass("text-gray-300");
                 $("#rate4").removeClass("text-gray-300");
                 $("#rate5").removeClass("text-gray-300");

                 $("#rate1").removeClass("text-yellow-400");
                 $("#rate2").removeClass("text-yellow-400");
                 $("#rate3").removeClass("text-yellow-400");
                 $("#rate4").removeClass("text-yellow-400");
                 $("#rate5").removeClass("text-yellow-400");

                 $("#rate1").addClass("text-yellow-400");
                 $("#rate2").addClass("text-yellow-400");

                 $("#rate3").addClass("text-gray-300");
                 $("#rate4").addClass("text-gray-300");
                 $("#rate5").addClass("text-gray-300");

             } else if (id == "rate3") {
                 document.getElementById("rateScore").value = '3';

                 $("#rate1").removeClass("text-gray-300");
                 $("#rate2").removeClass("text-gray-300");
                 $("#rate3").removeClass("text-gray-300");
                 $("#rate4").removeClass("text-gray-300");
                 $("#rate5").removeClass("text-gray-300");

                 $("#rate1").removeClass("text-yellow-400");
                 $("#rate2").removeClass("text-yellow-400");
                 $("#rate3").removeClass("text-yellow-400");
                 $("#rate4").removeClass("text-yellow-400");
                 $("#rate5").removeClass("text-yellow-400");

                 $("#rate1").addClass("text-yellow-400");
                 $("#rate2").addClass("text-yellow-400");
                 $("#rate3").addClass("text-yellow-400");

                 $("#rate4").addClass("text-gray-300");
                 $("#rate5").addClass("text-gray-300");

             } else if (id == "rate4") {
                 document.getElementById("rateScore").value = '4';

                 $("#rate1").removeClass("text-gray-300");
                 $("#rate2").removeClass("text-gray-300");
                 $("#rate3").removeClass("text-gray-300");
                 $("#rate4").removeClass("text-gray-300");
                 $("#rate5").removeClass("text-gray-300");

                 $("#rate1").removeClass("text-yellow-400");
                 $("#rate2").removeClass("text-yellow-400");
                 $("#rate3").removeClass("text-yellow-400");
                 $("#rate4").removeClass("text-yellow-400");
                 $("#rate5").removeClass("text-yellow-400");

                 $("#rate1").addClass("text-yellow-400");
                 $("#rate2").addClass("text-yellow-400");
                 $("#rate3").addClass("text-yellow-400");
                 $("#rate4").addClass("text-yellow-400");

                 $("#rate5").addClass("text-gray-300");

             } else if (id == "rate5") {
                 document.getElementById("rateScore").value = '5';

                 $("#rate1").removeClass("text-gray-300");
                 $("#rate2").removeClass("text-gray-300");
                 $("#rate3").removeClass("text-gray-300");
                 $("#rate4").removeClass("text-gray-300");
                 $("#rate5").removeClass("text-gray-300");

                 $("#rate1").removeClass("text-yellow-400");
                 $("#rate2").removeClass("text-yellow-400");
                 $("#rate3").removeClass("text-yellow-400");
                 $("#rate4").removeClass("text-yellow-400");
                 $("#rate5").removeClass("text-yellow-400");

                 $("#rate1").addClass("text-yellow-400");
                 $("#rate2").addClass("text-yellow-400");
                 $("#rate3").addClass("text-yellow-400");
                 $("#rate4").addClass("text-yellow-400");
                 $("#rate5").addClass("text-yellow-400");


             }
         }
         $("#sidehome").removeClass("bg-gray-200");
         $("#sidehistory").addClass("bg-gray-200 dark:bg-gradient-to-br from-green-400 to-blue-600");
         $("#sidepms").removeClass("bg-gray-200");
     </script>

 </body>

 </html>