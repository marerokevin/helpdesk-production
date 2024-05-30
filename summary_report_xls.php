<?php
$request_type = $_GET['request_type'];
$month = $_GET['month'];
$year = $_GET['year'];
$reqtype = $_GET['request_type'];

$date = new DateTime();
$date->setDate(2022, $month, 1); // Set the date to the first day of the specified month
$monthName = $date->format('F');

// Create DateTime object
$currentDate = DateTime::createFromFormat('m-d-Y', $month . '-01-' . $year);
$lastMonth = $currentDate->modify('-1 month');

// Get the year and month of the last month
$lastMonthYear = $lastMonth->format('Y');
$lastMonthMonth = $lastMonth->format('m');

$currentDate = $currentDate->format('m-d-y');


// Calculate the previous month
if ($month == 1) {
    // If the current month is January (1), set the previous month to December (12) of the previous year
    $previousMonthNumber = 12;
    $previousYear = date('Y') - 1;
} else {
    // For all other months, subtract 1 from the current month to get the previous month
    $previousMonthNumber = $month - 1;
    $previousYear = date('Y');
}
$previousMonthName = date('F', mktime(0, 0, 0, $previousMonthNumber, 1));
$previousMonthNumber = str_pad($previousMonthNumber, 2, '0', STR_PAD_LEFT);

$firstdate = date('d', strtotime("first day of $year-$monthName"));
$lastDateOfMonth = date('d', strtotime("last day of $year-$monthName"));


// header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
// header("Content-Disposition: attachment; filename=Summary Report for the Month of ".$monthName.".xls");  //File name extension was wrong
// header("Expires: 0");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// header("Cache-Control: private",false);

include("includes/connect.php");

$con->next_result();
if ($reqtype == "ALL") {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled,  req.requestor,  req.department,  req.request_type,  req.ticket_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.action, req.recommendation,  cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.ticket_category WHERE req.admin_approved_date BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$month-$lastDateOfMonth'");
} else {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled,  req.requestor,  req.department,  req.request_type,  req.ticket_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.action, req.recommendation,  cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.ticket_category WHERE req.admin_approved_date BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$month-$lastDateOfMonth' AND cat.req_type = '$reqtype'");
}

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <center>
        <b>
            <font color="blue">GLORY (PHILIPPINES), INC.</font>
        </b>
        <br>
        <b>ICT HELPDESK</b>
        <br>
        <h3> <b> Summary Report for the Month of <?php echo $monthName ?></b></h3>
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
                    <th rowspan="2">Request Category (Details)</th>
                    <th rowspan="2">In-charge</th>
                    <th colspan="3">Requirements</th>
                    <th rowspan="2">ICT Date Approval</th>
                    <th rowspan="2">Date Responded</th>
                    <th rowspan="2">Response Rate</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Date Finished</th>
                    <th rowspan="2">Accomplishment Rate</th>
                    <th rowspan="2">Remarks</th>
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


                    $dateFilled = new DateTime($row['date_filled']);
                    $year = $dateFilled->format('y');
                    $month = $dateFilled->format('m');

                    if ($row['req_type'] == "TS") {
                        $request_no = "TS-" . $year . $month . "-" . $row['id'];
                    } elseif ($row['req_type'] == "JO") {
                        $request_no = "JO-" . $year . $month . "-" . $row['id'];
                    } elseif ($row['req_type'] == "SR") {
                        $request_no = "SR-" . $year . $month . "-" . $row['id'];
                    }

                    $requestor = $row['requestor'];
                    $department = $row['department'];
                    if ($row['request_type'] != NULL) {
                        $request_category = $row['request_type'] . " (" . $row['request_category'] . ")";
                    } else {
                    }

                    $in_charge = $row['assignedPersonnelName'];
                    $piority_level = $row['level'];
                    $required_response_time = $row['hours'];
                    $required_completion_days = $row['days'];
                    $date_finished = $row['completed_date'];
                    $date_finished1 = new DateTime($row['completed_date']);
                    $action_taken = $row['action'];
                    $recommendation = $row['recommendation'];

                    $ict_approval_date = $row['ict_approval_date'];
                    $time_responded = $row['first_responded_date'];

                    $ictApprovalDate1 = new DateTime($row['ict_approval_date']);
                    $dateResponded2 = new DateTime($row['first_responded_date']);
                    $ictApprovalDate1->setTime($ictApprovalDate1->format('H'), 0, 0);
                    $dateResponded2->setTime($dateResponded2->format('H'), 0, 0);

                    $ictApprovalDate3 = new DateTime($row['ict_approval_date']);
                    $dateResponded4 = new DateTime($row['first_responded_date']);

                    // Define holidays array
                    $sqlHoli = "SELECT holidaysDate FROM holidays";
                    $resultHoli = mysqli_query($con, $sqlHoli);
                    $holidays = array();
                    while ($row = mysqli_fetch_assoc($resultHoli)) {
                        $holidays[] = $row['holidaysDate'];
                    }
                    $interval = $ictApprovalDate1->diff($dateResponded2);
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

                    // if($hours1 <=11 ){
                    // $finalHours = $hours - 15;
                    // echo $hours;


                    // }
                    // else if($hours1 ==12 ){
                    // $finalHours = $hours - 16;


                    // echo $hours;
                    // }
                    // else if($hours1 >12 ){
                    $finalHours = $hours;
                    $minutes1 = $ictApprovalDate3->format('i');
                    $minutes1_decimal = $minutes1 / 60;

                    $minutes2 = $dateResponded4->format('i');
                    $minutes2_decimal = $minutes2 / 60;


                    // echo $finalHours;

                    // echo $minutes1_decimal;

                    // echo $minutes2_decimal;


                    $finalHours = ($finalHours - $minutes1_decimal) + $minutes2_decimal;
                    // }



                    if ($time_responded == "" || $time_responded == null) {
                        $response_rate = "";
                    } else {
                        $response_rate = number_format($finalHours, 2, '.', ',');
                    }

                    if (($response_rate <= $required_response_time) && ($time_responded != "" || $time_responded != null)) {
                        $response_remarks = "On Time";
                    } elseif ($response_rate > $required_response_time) {
                        $response_remarks = "Late";
                    } else {
                        $response_remarks = "Pending";
                    }



                    // Calculate the difference between the two dates in days
                    $interval = $ictApprovalDate1->diff($date_finished1);
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

                    if ($date_finished == "" || $date_finished == null) {
                        $accomplishment_rate = "";
                    } else {
                        $accomplishment_rate = $days;
                    }


                    if (($accomplishment_rate <= $required_completion_days) && ($date_finished != "" || $date_finished != null)) {
                        $accomplishment_remarks = "On Time";
                    } elseif ($accomplishment_rate > $required_completion_days) {
                        $accomplishment_remarks = "Late";
                    } else {
                        $accomplishment_remarks = "Pending";
                    }

                    echo "<tr>
                            
                                    <td>$request_no</td>
                                    <td>$requestor</td>
                                    <td>$department</td>
                                    <td>$request_category</td>
                                    <td>$in_charge</td>
                                    <td>$piority_level</td>
                                    <td>$required_response_time</td>
                                    <td>$required_completion_days</td>
                                    <td>$ict_approval_date</td>
                                    <td>$time_responded </td>
                                    <td>$response_rate</td>
                                    <td>$response_remarks </td>
                                    <td>$date_finished</td>
                                    <td>$accomplishment_rate</td>
                                    <td>$accomplishment_remarks</td>
                                    <td>$action_taken</td>
                                    <td>$recommendation</td>
                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>