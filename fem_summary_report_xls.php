<?php
$month = $_GET['month'];
$year = $_GET['year'];
$fem = $_GET['fem'];

include("includes/connect.php");



$ictApprovalDate1 = new DateTime('2024-08-30 10:59:53');
$dateResponded2 = new DateTime('2024-08-31 10:06:25');
$ictApprovalDate1->setTime($ictApprovalDate1->format('H'), 0, 0);
$dateResponded2->setTime($dateResponded2->format('H'), 0, 0);
 
$ictApprovalDate3 =new DateTime('2024-08-30 10:59:53');
$dateResponded4 = new DateTime('2024-08-31 10:06:25');

$ictApprovalDate5 =new DateTime('2024-08-30 10:59:53');
$dateResponded6 = new DateTime('2024-08-31 10:06:25');


 $ictApprovalDate5->setTime(0, 0, 0);
 $dateResponded6->setTime(0, 0, 0);


 $interval6 = $ictApprovalDate5->diff($dateResponded6);
 // $interval2 = $setZero1 ->diff($setZero2);

 $daysDifference = $interval6->days;

// echo "The difference is $daysDifference days. <br>";

// if($daysDifference>=1){
//     $ictApprovalDate1->setTime(0, 0, 0);
//  $dateResponded2->setTime(0, 0, 0);
// }



    // Define holidays array
    $sqlHoli = "SELECT holidaysDate FROM holidays";
    $resultHoli = mysqli_query($con, $sqlHoli);
$holidays = array();
while ($row1 = mysqli_fetch_assoc($resultHoli)) {
    $holidays[] = $row1['holidaysDate'];
}
$ictApprovalDate3->setTime($ictApprovalDate3->format('H'), $ictApprovalDate3->format('i'), 0);
$dateResponded4->setTime($dateResponded4->format('H'), $dateResponded4->format('i'), 0);

    $interval = $ictApprovalDate3->diff($dateResponded4);
    // $interval2 = $setZero1 ->diff($setZero2);


    $hours = $interval->days * 8 + $interval->h;
    // echo "$interval->days * 8 + $interval->h, <br>";
    // echo $hours , "<br>";
    $start = clone $ictApprovalDate1;
    $end = clone $dateResponded2;
    $interval_days = new DateInterval('P1D');
    // echo "<br>" , $end->format('Y-m-d');
    $period = new DatePeriod($start, $interval_days, $end);
    // echo $hours, " ";
    foreach ($period as $day) {
        // echo "<br>" , $day->format('Y-m-d');    
        if ($day->format('N') >= 6 || in_array($day->format('Y-m-d'), $holidays)) {
            // echo $hours, " ";

            // echo "subtract";
            
            $hours -= 8; // Subtract 24 hours for each weekend day or holiday
        }
    }
    //    echo "<br>" , $hours , "<br>";
    $hours1 = $end->format('H');
    // echo "$interval->days * 8 + $interval->h , $hours;";
    // echo $interval->days ;


    
// // Set the time for 11 AM and 12 PM for each date
// $interval1 = new DateInterval('P1D'); // 1 day interval1
// $period1 = new DatePeriod($ictApprovalDate3, $interval, $dateResponded4);

// // Check if there is a 11 AM to 12 PM window in the date range
// $found = false;

// foreach ($period1 as $date) {
//     $elevenAM = clone $date;
//     $elevenAM->setTime(11, 0, 0);
    
//     $twelvePM = clone $date;
//     $twelvePM->setTime(11, 59, 0);
    
//     // Check if this window is within the range
//     if (($elevenAM >= $ictApprovalDate3 && $elevenAM <= $dateResponded4) || 
//         ($twelvePM >= $ictApprovalDate3 && $twelvePM <= $dateResponded4)) {
//         $found = true;
//         break;
//     }
// }

// if ($found) {
//     $hours-=1;
    // echo "asldhasjdh";

// }





//  echo $hours, "<br>";

    $start = clone $ictApprovalDate1;
    $end = clone $dateResponded2;
    $interval_days = new DateInterval('P1D');
    $period = new DatePeriod($start, $interval_days, $end);
    // echo $hours, " ";
    // foreach ($period as $day) {
    //     if ($day->format('N') >= 6 || in_array($day->format('Y-m-d'), $holidays)) {
           
    //         $hours -= 8; // Subtract 24 hours for each weekend day or holiday
            // echo $hours, " ";
    //     }
    // }
    $hours1 = $end->format('H');
    $hoursstart = $start->format('H');

//  echo $hoursstart;
//  echo "<br>";
//  echo $hours1;

    if($daysDifference >=1 && $hoursstart >11 && $hours1 <=11 ){
    
        // echo "<br> $hours - 15;";
    $finalHours = $hours - 15;
    // echo $hours;
 
   
    }
    else if($daysDifference >=1 && $hoursstart <=11 && $hours1 <=11 ){
    
        $finalHours = $hours - 15;
        // echo "asfdasd";
 
   
    }
    
    else if($daysDifference ==0 && $hoursstart <=11 && $hours1 <=11 ){
        $finalHours = $hours;
    }
    else if($daysDifference >1 && $hours1 ==12 ){
        // echo "haha: $hours";
    $finalHours = $hours ;
 
    // echo $hours;
    }
    else if($daysDifference ==1 && $hours1 ==12 ){
        // echo "hahaha: $hours";
    $finalHours = $hours ;
 
    // echo $hours;
    }
    else if($daysDifference ==0 && $hours1 ==12 ){
        // echo "hahaha: $hours";
    $finalHours = $hours ;
 
    // echo $hours;
    }

    else if($hours1 >12 ){
    $finalHours = $hours;
    $minutes1 = $ictApprovalDate3->format('i');
    $minutes1_decimal = $minutes1 / 60;
 
    $minutes2 = $dateResponded4->format('i');
    $minutes2_decimal = $minutes2/ 60;
 
 
    // echo $finalHours;
 
    // echo $minutes1_decimal;
 
    // echo $minutes2_decimal;
 
    // echo "($finalHours -$minutes1_decimal)+$minutes2_decimal , <br>";
 
    $finalHours = ($finalHours -$minutes1_decimal)+$minutes2_decimal;
    }
 
 
    // echo "<br> $finalHours ASD";



// $date = new DateTime();
// $date->setDate(2022, $month, 1); // Set the date to the first day of the specified month
// $monthName = $date->format('F');
$monthNumber = date('m', strtotime($month));
// Create DateTime object
$currentDate = DateTime::createFromFormat('m-d-Y', $monthNumber . '-01-' . $year);
$lastMonth = $currentDate->modify('-1 month');

// Get the year and month of the last month
$lastMonthYear = $lastMonth->format('Y');
$lastMonthMonth = $lastMonth->format('m');

$currentDate = $currentDate->format('m-d-y');

$monthNumber = date('m', strtotime($month));
// Calculate the previous month
if ($monthNumber == 1) {
    // If the current month is January (1), set the previous month to December (12) of the previous year
    $previousMonthNumber = 12;
    $previousYear = date('Y') - 1;
} else {
    // For all other months, subtract 1 from the current month to get the previous month
    $previousMonthNumber = $monthNumber - 1;
    $previousYear = date('Y');
}
$previousMonthName = date('F', mktime(0, 0, 0, $previousMonthNumber, 1));
$previousMonthNumber = str_pad($previousMonthNumber, 2, '0', STR_PAD_LEFT);
$lastDateOfMonth = date('d', strtotime("last day of $year-$month"));

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Summary Report for the Month of " . $month . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);


$con->next_result();
// if ($fem == "ALL") {
//     $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req 
//     LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
//     WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') )
//     AND req.request_to = 'fem' ORDER BY req.admin_approved_date ASC");
// } else {

$query = "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName,req.assistanNames, req.hourAndTimeSeen, req.ict_approval_date, req.hourAndTimeSeen, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type 
FROM `request` req 
LEFT JOIN `femcategories` cat ON cat.c_name = req.request_category 
WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'fem'  AND req.assignedPersonnel = '$fem' OR req.assistantsId like '%$fem%' ORDER BY req.admin_approved_date ASC";
$sql = mysqli_query($con, $query);

// echo $query;

// }
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="font-family: Arial, sans-serif;">
    <center>
        <b>
            <font style="font-family: Arial, sans-serif;">GLORY (PHILIPPINES), INC.</font>
        </b>
        <br>
        <b>FEM Helpdesk </b>
        <br>
        <!-- <b>Date: </b>
    <br> -->
        <center>
            <h2> <b> Summary Report for the Month of <?php echo $month ?></b></h2>

            <br>
        </center>
        <br>

        <div id="table-scroll">
            <table width="100%" border="1" align="left">

                <thead>
                    <tr>
                        <th rowspan="2">Request No.</th>
                        <th rowspan="2">Requestor</th>
                        <th rowspan="2">Department</th>
                        <th rowspan="2">Request Type (Category)</th>
                        <th rowspan="2">Request Details</th>
                        <th rowspan="2">In-charge</th>
                        <th rowspan="2">Assistant/s</th>
                        <th colspan="3">Requirements</th>
                        <th rowspan="2">FEM Date Approval</th>
                        <th rowspan="2">Job Seen</th>
                        <th rowspan="2">Date Responded</th>
                        <th rowspan="2">Response Rate (Hours)</th>
                        <th rowspan="2">Remarks</th>
                        <th rowspan="2">Date Finished</th>
                        <th rowspan="2">Accomplishment Rate (Days)</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Closed by</th>
                        <th rowspan="2">Action Taken</th>
                        <th rowspan="2">Recommendation</th>
                    </tr>
                    <tr>
                        <th>Priority Level</th>
                        <th>Hours</th>
                        <th>Days</th>
                    </tr>
                    <?php

                    ?>

                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_array($sql)) {
                        $action_taken = $row['action1'];
                        $final_action = $row['action'];
                        $dateFilled = new DateTime($row['date_filled']);
                        $year = $dateFilled->format('y');
                        $month = $dateFilled->format('m');

                        if ($row['request_type'] === "Technical Support") {
                            $request_no = "TS-" . $year . $month . "-" . $row['id'];
                            $request_category = "Ticket (" . $row['request_category'] . ")";
                        } else {
                            $request_no = "JO-" . $year . $month . "-" . $row['id'];
                            $request_category =  "Job Order (" . $row['request_category'] . ")";
                        }


                        $requestor = $row['requestor'];
                        $department = $row['department'];



                        $in_charge = $row['assignedPersonnelName'];
                        $assistants = $row['assistanNames'];

                        $piority_level = $row['level'];
                        $required_response_time = $row['hours'];
                        $required_completion_days = $row['days'];
                        $date_finished = $row['completed_date'];
                        $date_finished1 = new DateTime($row['completed_date']);
                        $status  = $row['status2'];
                        $recommendation = $row['recommendation'];
                        $ticket_close_date =  $row['ticket_close_date'];
                        $requestor_approval_date = $row['requestor_approval_date'];
                        $onthespot_ticket = $row['onthespot_ticket'];
                        $details = $row['request_details'];
                        $rateDate = $row['rateDate'];
                        $jobSeen  = $row['hourAndTimeSeen'];


                        if ($ticket_close_date != NULL && $date_finished != NULL) {
                            $closedBy = 'System';
                        } elseif (($requestor_approval_date != NULL || $rateDate != NULL) && $date_finished != NULL) {
                            $closedBy = 'Requestor';
                        } else {
                            $closedBy = '';
                        }

                        $ict_approval_date = $row['hourAndTimeSeen'];
                    $approvalDate = new DateTime($row['hourAndTimeSeen']);
                    $approvalDate = $approvalDate->format('F d, Y H:i:s');
                    $time_responded = $row['first_responded_date'];


                    $ictApprovalDate1 = new DateTime($row['hourAndTimeSeen']);
                    $dateResponded2 = new DateTime($row['first_responded_date']);
                    $ictApprovalDate1->setTime($ictApprovalDate1->format('H'), 0, 0);
                    $dateResponded2->setTime($dateResponded2->format('H'), 0, 0);

                    $ictApprovalDate3 = new DateTime($row['hourAndTimeSeen']);
                    $dateResponded4 = new DateTime($row['first_responded_date']);


                                            
                        $ictApprovalDate5 =new DateTime($row['hourAndTimeSeen']);
                        $dateResponded6 = new DateTime($row['first_responded_date']);


                        $ictApprovalDate5->setTime(0, 0, 0);
                        $dateResponded6->setTime(0, 0, 0);


                        $interval6 = $ictApprovalDate5->diff($dateResponded6);
                        // $interval2 = $setZero1 ->diff($setZero2);

                        $daysDifference = $interval6->days;

                        // echo "The difference is $daysDifference days.";
                        // if($daysDifference>=1){
                        //     $ictApprovalDate1->setTime(0, 0, 0);
                        // $dateResponded2->setTime(0, 0, 0);
                        // }



                    // Define holidays array
                    $sqlHoli = "SELECT holidaysDate FROM holidays";
                    $resultHoli = mysqli_query($con, $sqlHoli);
                    $holidays = array();
                    while ($row1 = mysqli_fetch_assoc($resultHoli)) {
                        $holidays[] = $row1['holidaysDate'];
                    }
                    $ictApprovalDate3->setTime($ictApprovalDate3->format('H'), $ictApprovalDate3->format('i'), 0);
                    $dateResponded4->setTime($dateResponded4->format('H'), $dateResponded4->format('i'), 0);


                    $interval = $ictApprovalDate3->diff($dateResponded4);
                    $hours = $interval->days * 8 + $interval->h;
                   
                    $start = clone $ictApprovalDate1;
                    $end = clone $dateResponded2;
                    $interval_days = new DateInterval('P1D');
                    $period = new DatePeriod($start, $interval_days, $end);
                    // echo $hours, " ";
                    foreach ($period as $day) {
                        if ($day->format('N') >= 6 || in_array($day->format('Y-m-d'), $holidays)) {

                            $hours -= 8; // Subtract 24 hours for each weekend day or holiday
                            // echo $hours, " ";
                        }
                    }
                    $hours1 = $end->format('H');
                    $hoursstart = $start->format('H');
                    if($daysDifference >=1 && $hoursstart >11 && $hours1 <=11 ){
    
                        // echo "<br> $hours - 15;";
                        
                    $finalHours = $hours - 15;
                    // echo $hours;
                   
                    }
                    else if($daysDifference >=1 && $hoursstart <=11 && $hours1 <=11 ){
    
                        $finalHours = $hours - 15;
                 
                   
                    }
                    else if($daysDifference ==0 && $hoursstart <=11 && $hours1 <=11 ){
                        $finalHours = $hours;
                    }
                    else if($daysDifference >1 && $hours1 ==12 ){
                    $finalHours = $hours;
                 
                   
                    // echo $hours;
                    }
                    else if($daysDifference ==1 && $hours1 ==12 ){
                        
                    $finalHours = $hours ;
                 
                    // echo $hours;
                    }
                    else if($daysDifference ==0 && $hours1 ==12 ){
                   
                    $finalHours = $hours ;
                
                    // echo $hours;
                    }
                    else if($hours1 >12 ){
                    $finalHours = $hours;
                    $minutes1 = $ictApprovalDate3->format('i');
                    $minutes1_decimal = $minutes1 / 60;
                 
                    $minutes2 = $dateResponded4->format('i');
                    $minutes2_decimal = $minutes2/ 60;
                 
                 
                    // echo $finalHours;
                 
                    // echo $minutes1_decimal;
                 
                    // echo $minutes2_decimal;
                 
                    // echo "($finalHours -$minutes1_decimal)+$minutes2_decimal , <br>";
                 
                    $finalHours = ($finalHours -$minutes1_decimal)+$minutes2_decimal;
                    }


                        // $finalHours = $hours;
                        $minutes1 = $ictApprovalDate3->format('i');
                        $minutes1_decimal = $minutes1 / 60;

                        if ($time_responded != "" || $time_responded != null) {
                            $minutes2 = $dateResponded4->format('i');
                            $minutes2_decimal = $minutes2 / 60;

                            // echo $time_responded;
                            $timeResponded = new DateTime($row['first_responded_date']);
                            $timeResponded = $timeResponded->format('F d, Y H:i:s');
                        } else {
                            $dateResponded4 = new DateTime();
                            $minutes2 = $dateResponded4->format('i');
                            $minutes2_decimal = $minutes2 / 60;

                            $timeResponded = "";
                        }



                        $finalHours = ($finalHours - $minutes1_decimal) + $minutes2_decimal;
                        $response_rate = number_format($finalHours, 2, '.', ',');
                        if ($response_rate <0){
                            $response_rate = $response_rate * -1;
                        }
                        if ($onthespot_ticket == 1) {
                            $response_remarks = "On the spot";
                            $class = "style='color:green;'";
                        } elseif (($response_rate <= $required_response_time) && ($time_responded != "" || $time_responded != null)) {
                            $response_remarks = "On Time";
                            $class = "style='color:green;'";
                        } elseif (($response_rate > $required_response_time) && ($time_responded != "" || $time_responded != null)) {
                            $response_remarks = "Late";
                            $class = "style='color:red;'";
                        } elseif (($response_rate <= $required_response_time) && ($time_responded == "" || $time_responded == null)) {
                            $response_rate = "";
                            $response_remarks = "On Going";
                            $class = "style='color:black;'";
                        } elseif (($response_rate > $required_response_time) && ($time_responded == "" || $time_responded == null)) {
                            $response_rate = "";
                            $response_remarks = "Late";
                            $class = "style='color:red;'";
                        }



                        // Calculate the difference between the two dates in days

                        if ($date_finished != "" || $date_finished != null) {
                            $interval = $ictApprovalDate1->diff($date_finished1);

                            $dateFinished = new DateTime($date_finished);
                            $dateFinished = $dateFinished->format('F d, Y H:i:s');
                        } else {
                            $date_finished1 = new DateTime();
                            $interval = $ictApprovalDate1->diff($date_finished1);

                            $dateFinished = "";
                        }

                        $days = $interval->days;

                        // Loop through the days between the two dates
                        for ($i = 0; $i < $days; $i++) {
                            // Get the current date
                            $currentDate = clone $ictApprovalDate1;
                            $currentDate->add(new DateInterval('P' . $i . 'D'));

                            // Check if the current date is a weekend or a holiday
                            if ($currentDate->format('N') >= 6 || in_array($currentDate->format('Y-m-d'), $holidays)) {
                                // Subtract 1 from the total number of days
                                $days--;
                            }
                        }

                        $accomplishment_rate = $days;

                        if ($onthespot_ticket == 1) {
                            $accomplishment_remarks = "On the spot";
                            $class1 = "style='color:green;'";
                        } elseif (($accomplishment_rate <= $required_completion_days) && ($date_finished != "" || $date_finished != null)) {
                            $accomplishment_remarks = "On Time";
                            $class1 = "style='color:green;'";
                        } elseif (($accomplishment_rate > $required_completion_days) && ($date_finished != "" || $date_finished != null)) {
                            $accomplishment_remarks = "Late";
                            $class1 = "style='color:red;'";
                        } elseif (($accomplishment_rate <= $required_completion_days) && ($date_finished == "" || $date_finished == null)) {
                            $accomplishment_rate = "";
                            $accomplishment_remarks = "On Going";
                            $class1 = "style='color:black;'";
                        } elseif (($accomplishment_rate > $required_completion_days) && ($date_finished == "" || $date_finished == null)) {
                            $accomplishment_rate = "";
                            $accomplishment_remarks = "Late";
                            $class1 = "style='color:red;'";
                        }

                        if (($time_responded != "" || $time_responded != null) && ($date_finished == "" || $date_finished == null)) {
                            $action = $action_taken;
                        } else {
                            $action = $final_action;
                        }

                        echo "<tr>    
                                    <td>$request_no</td>
                                    <td>$requestor</td>
                                    <td>$department</td>
                                    <td>$request_category</td>
                                    <td>$details</td>
                                    <td>$in_charge</td>
                                    <td>$assistants</td>
                                    <td>$piority_level</td>
                                    <td>$required_response_time</td>
                                    <td>$required_completion_days</td>
                                    <td>$approvalDate</td>
                                    <td>$jobSeen</td>
                                    <td>$time_responded </td>
                                    <td>$response_rate</td>
                                    <td $class>$response_remarks </td>
                                    <td>$date_finished</td>
                                    <td>$accomplishment_rate</td>
                                    <td $class1>$accomplishment_remarks</td>
                                    <td>$closedBy</td>
                                    <td>$action</td>
                                    <td>$recommendation</td>
                                    </tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>