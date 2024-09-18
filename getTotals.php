<?php




$month1 = $_SESSION['month'];
$year1 = $_SESSION['year'];
$reqtype = $_SESSION['request_type'];
// $date = new DateTime();
// $date->setDate(2022, $month1, 1); // Set the date to the first day of the specified month
// $monthName = $date->format('F');
$monthNumber = date('m', strtotime($month1));
// Create DateTime object
$currentDate = DateTime::createFromFormat('m-d-Y', $monthNumber . '-01-' . $year1);
$lastMonth = $currentDate->modify('-1 month');

// Get the year and month of the last month
$lastMonthYear = $lastMonth->format('Y');
$lastMonthMonth = $lastMonth->format('m');

$currentDate = $currentDate->format('m-d-y');

$monthNumber = date('m', strtotime($month1));
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
$lastDateOfMonth = date('d', strtotime("last day of $year1-$month1"));


include("includes/connect.php");


$con->next_result();
if ($reqtype == "ALL") {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
    WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year1-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth') )
    AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC");


//     echo "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
//     WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year1-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth') )
//     AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC";
} else {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year1-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'mis'  AND cat.req_type = '$reqtype' ORDER BY req.admin_approved_date ASC");
// echo "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year1-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year1-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'mis'  AND cat.req_type = '$reqtype' ORDER BY req.admin_approved_date ASC";
}



$sqlICT = mysqli_query($con, "SELECT * FROM `user` WHERE `department` = 'ICT' and `admin` = false");




$totalofOngoing = 0;
$totalofFinished = 0;
$totalofLate = 0;
$totalofOnTheSpot = 0;



$totalofOngoingMembers = 0;
$totalofFinishedMembers = 0;
$totalofLateMembers = 0;
$totalofOnTheSpotMembers = 0;




$arrayOfMembersStatusLate=[];
$arrayOfMembersNoOfTask=[];
$arrayOfMembersStatusOnGoing=[];
$arrayOfMembersStatusOnTime=[];
$arrayOfMembersOnTheSpot=[];



    $totalNumberOfTask = mysqli_num_rows($sql);
    while ($row = mysqli_fetch_array($sql)) {
        $action_taken = $row['action1'];
        $final_action = $row['action'];
        $dateFilled = new DateTime($row['date_filled']);
        $year1 = $dateFilled->format('y');
        $month1 = $dateFilled->format('m');


        $requestor = $row['requestor'];
        $department = $row['department'];



        $in_charge = $row['assignedPersonnelName'];
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


        $ict_approval_date = $row['ict_approval_date'];
        $approvalDate = new DateTime($row['ict_approval_date']);
        $approvalDate = $approvalDate->format('F d, Y H:i:s');
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
        while ($row1 = mysqli_fetch_assoc($resultHoli)) {
            $holidays[] = $row1['holidaysDate'];
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


        $finalHours = $hours;
        $minutes1 = $ictApprovalDate3->format('i');
        $minutes1_decimal = $minutes1 / 60;

        if ($time_responded != "" || $time_responded != null) {
            $minutes2 = $dateResponded4->format('i');
            $minutes2_decimal = $minutes2 / 60;
            // echo $row['first_responded_date'];
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




        // Calculate the difference between the two dates in days

        if ($date_finished != "" || $date_finished != null) {
            $interval = $ictApprovalDate1->diff($date_finished1);

            $dateFinished = new DateTime($row['completed_date']);
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
            $totalofOnTheSpot++;

            if (!isset($arrayOfMembersOnTheSpot[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersOnTheSpot[$in_charge] = 0;
            }
            $arrayOfMembersOnTheSpot[$in_charge]  += 1;

            if (!isset($arrayOfMembersNoOfTask[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersNoOfTask[$in_charge] = 0;
            }
            $arrayOfMembersNoOfTask[$in_charge]  += 1;


        } elseif (($accomplishment_rate <= $required_completion_days) && ($date_finished != "" || $date_finished != null)) {
            $accomplishment_remarks = "On Time";
            $totalofFinished++;
            $class1 = "style='color:green;'";

            if (!isset($arrayOfMembersStatusOnTime[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersStatusOnTime[$in_charge] = 0;
            }
            $arrayOfMembersStatusOnTime[$in_charge]  += 1;

            if (!isset($arrayOfMembersNoOfTask[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersNoOfTask[$in_charge] = 0;
            }
            $arrayOfMembersNoOfTask[$in_charge]  += 1;



        } elseif (($accomplishment_rate > $required_completion_days) && ($date_finished != "" || $date_finished != null)) {
            $accomplishment_remarks = "Late";
            $totalofLate++;
            $class1 = "style='color:red;'";

            if (!isset($arrayOfMembersStatusLate[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersStatusLate[$in_charge] = 0;
            }
            $arrayOfMembersStatusLate[$in_charge]  += 1;


            if (!isset($arrayOfMembersNoOfTask[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersNoOfTask[$in_charge] = 0;
            }
            $arrayOfMembersNoOfTask[$in_charge]  += 1;


            // echo $in_charge;
        } elseif (($accomplishment_rate <= $required_completion_days) && ($date_finished == "" || $date_finished == null)) {
            $accomplishment_rate = "";
            $accomplishment_remarks = "On Going";
            $class1 = "style='color:black;'";
            $totalofOngoing++;

            if (!isset($arrayOfMembersStatusOnGoing[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersStatusOnGoing[$in_charge] = 0;
            }
            $arrayOfMembersStatusOnGoing[$in_charge]  += 1;


if (!isset($arrayOfMembersNoOfTask[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersNoOfTask[$in_charge] = 0;
            }
            $arrayOfMembersNoOfTask[$in_charge]  += 1;


        } elseif (($accomplishment_rate > $required_completion_days) && ($date_finished == "" || $date_finished == null)) {
            $accomplishment_rate = "";
            $accomplishment_remarks = "Late";
            $totalofLate++;
            $class1 = "style='color:red;'";
            if (!isset($arrayOfMembersStatusLate[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersStatusLate[$in_charge] = 0;
            }
            
            $arrayOfMembersStatusLate[$in_charge]  += 1;

            if (!isset($arrayOfMembersNoOfTask[$in_charge])) {
                // If the key does not exist, initialize it with 0
                $arrayOfMembersNoOfTask[$in_charge] = 0;
            }
            $arrayOfMembersNoOfTask[$in_charge]  += 1;


            // echo $in_charge;
        }

        if (($time_responded != "" || $time_responded != null) && ($date_finished == "" || $date_finished == null)) {
            $action = $action_taken;
        } else {
            $action = $final_action;
        }


    }



    // echo $totalofOngoing;
    // echo $totalofFinished;
    // echo $totalofOnTheSpot;
    // echo $totalofLate;
    // echo $totalNumberOfTask;
?>