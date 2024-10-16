<?php
$month = $_GET['month'];
$year = $_GET['year'];
$reqtype = $_GET['request_type'];


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


include("includes/connect.php");

$con->next_result();
if ($reqtype == "ALL") {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
    WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') )
    AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC");


//     echo "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
//     WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') )
//     AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC";
} else {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'mis'  AND cat.req_type = '$reqtype' ORDER BY req.admin_approved_date ASC");
// echo "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'mis'  AND cat.req_type = '$reqtype' ORDER BY req.admin_approved_date ASC";
}



$sqlICT = mysqli_query($con, "SELECT * FROM `user` WHERE `department` = 'ICT' and `admin` = false");


$month = $_GET['month'];
$filename = "$reqtype Summary Report for the Month of " . $month . ".xls";
$filepath = "department-admin/postedReports/" . $filename;

ob_start();

// Your existing code that generates the Excel content
// This could be an HTML table, CSV content, or any other Excel-compatible format
?>
 <center> 
       <b>
           <font color='blue'>GLORY (PHILIPPINES), INC.</font>
       </b>
       <br>
       <b>ICT Helpdesk </b>
       <br>
       <h3> <b> Summary Report for the Month of  <?php echo $month;?> </b></h3>

       <br>
   </center>
   <br>

   <div id='table-scroll'>
       <table width='100%' border='1' align='left'>

           <thead>
               <tr>
                   <th rowspan='2'>Request No.</th>
                   <th rowspan='2'>Requestor</th>
                   <th rowspan='2'>Department</th>
                   <th rowspan='2'>Request Type (Category)</th>
                   <th rowspan='2'>Request Details</th>
                   <th rowspan='2'>In-charge</th>
                   <th colspan='3'>Requirements</th>
                   <th rowspan='2'>ICT Date Approval</th>
                   <th rowspan='2'>Date Responded</th>
                   <th rowspan='2'>Response Rate (Hours)</th>
                   <th rowspan='2'>Remarks</th>
                   <th rowspan='2'>Date Finished</th>
                   <th rowspan='2'>Accomplishment Rate (Days)</th>
                   <th rowspan='2'>Remarks</th>
                   <th rowspan='2'>Closed by</th>
                   <th rowspan='2'>Action Taken</th>
                   <th rowspan='2'>Recommendation</th>
               </tr>
               <tr>
                   <th>Priority Level</th>
                   <th>Hours</th>
                   <th>Days</th>
               </tr>
                <?php

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
                    $year = $dateFilled->format('y');
                    $month = $dateFilled->format('m');

                    if ($row['request_type'] === "Technical Support") {
                        $request_no = "TS-" . $year . $month . "-" . $row['id'];
                    } else {
                        $request_no = "JO-" . $year . $month . "-" . $row['id'];
                    }


                    $requestor = $row['requestor'];
                    $department = $row['department'];


                    if ($row['request_type'] != NULL) {
                        $request_category = $row['request_type'] . " (" . $row['request_category'] . ")";
                    } else {
                        $request_category =  "Job Order (" . $row['request_category'] . ")";
                    }

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

                    if ($ticket_close_date != NULL && $date_finished != NULL) {
                        $closedBy = 'System';
                    } elseif (($requestor_approval_date != NULL || $rateDate != NULL) && $date_finished != NULL) {
                        $closedBy = 'Requestor';
                    } else {
                        $closedBy = '';
                    }

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


             

                    echo "<tr>    
                                    <td>$request_no</td>
                                    <td>$requestor</td>
                                    <td>$department</td>
                                    <td>$request_category</td>
                                    <td>$details</td>
                                    <td>$in_charge</td>
                                    <td>$piority_level</td>
                                    <td>$required_response_time</td>
                                    <td>$required_completion_days</td>
                                    <td>$approvalDate</td>
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

echo "</tbody></table> </div>";

?>

<table>
<thead>
                <tr>
   
                    






                </tr>

            </thead>
</table>
<table style="margin-top: 40px; width: 50%"  border="1" align="left">
    <thead>
                <tr>
   
                <th>Members</th>
                    <th>Number of Task</th>
                    <th>No of Ongoing</th>
                    <th>No of Finished</th>
                    <th>No of On The Spot</th>
                    <th>No. of Late</th>




                </tr>

            </thead>
            <tbody>
                <?php
                   
      
                while ($row = mysqli_fetch_array($sqlICT)) {
                   $member= $row['name'];
        ?>
        <tr>
           <td><?php echo $member;?> </td>
           <td><?php 
            $value1 = 0;
               foreach ($arrayOfMembersNoOfTask as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>

<td><?php
$value1 = 0;
               foreach ($arrayOfMembersStatusOnGoing as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>

<td><?php
$value1 = 0;
               foreach ($arrayOfMembersStatusOnTime as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>


     
<td><?php
$value1 = 0;
               foreach ($arrayOfMembersOnTheSpot as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>




<td><?php
$value1 = 0;
               foreach ($arrayOfMembersStatusLate as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>



        </tr>
         <?php
                       
                }
                ?>
                </tbody>
    </table>

    <?php
    // foreach ($arrayOfMembersStatusLate as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }
    // echo "<br>";
    // foreach ($arrayOfMembersNoOfTask as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }
    // echo "<br>";
    // foreach ($arrayOfMembersStatusOnGoing as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }
    // echo "<br>";
    // foreach ($arrayOfMembersStatusOnTime as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }



    ?>
<table style="margin-top: 40px; width: 30%"  border="1" align="left">
<tbody>
    <tr>
        <th>Total Ongoing Task</th>
        <th><?php echo $totalofOngoing; ?></th>

    </tr>
    <tr>
        <th>Total Finished Task</th>
        <th><?php echo $totalofFinished; ?></th>

    </tr>

    <tr>
        <th>Total of On the spot task</th>
        <th><?php echo $totalofOnTheSpot; ?></th>

    </tr>


    <tr>
        <th>Total of Late Task</th>
        <th><?php echo $totalofLate; ?></th>

    </tr>
    <tr style="font-weight: bold;">
        <th>Total Number of Task</th>
        <th><?php echo $totalNumberOfTask; ?></th>

    </tr>
</tbody>
</table>
<!-- <h3>Total of On Going: <?php echo $totalofOngoing; ?></h3>
        <h3>Total of On On Time: <?php echo $totalofFinished; ?></h3>
        <h3>Total of On Late: <?php echo $totalofLate; ?></h3>
        <h3>Total: <?php echo $totalNumberOfTask; ?></h3>

</div> -->

        
    </div>

<?php

$content = ob_get_contents();


ob_end_clean();


file_put_contents($filepath, $content);
// echo $filepath;
// if($stat){
//     echo $filepath;
//     }
//     else{
//     echo "error";
    
//     }
// $copyDestination = "./department-admin/postedReports/" . $filename; // Path to copy the file



$month = $_GET['month'];


header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Summary Report for the Month of " . $month . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);



// readfile($filepath);

// if (copy($filepath, $copyDestination)) {
//     echo "File copied successfully.";
// } else {
//     echo "Failed to copy file.";
// }



// $date = new DateTime();
// $date->setDate(2022, $month, 1); // Set the date to the first day of the specified month
// $monthName = $date->format('F');
$month = $_GET['month'];
$year = $_GET['year'];
$reqtype = $_GET['request_type'];

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


if ($reqtype == "ALL") {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
    WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') )
    AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC");

$print = "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
    WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') )
    AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC";
//     echo "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category,  req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date, req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details, req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category 
//     WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') )
//     AND req.request_to = 'mis' ORDER BY req.admin_approved_date ASC";
} else {
    $sql = mysqli_query($con, "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
    OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
    OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'mis'  AND cat.req_type = '$reqtype' ORDER BY req.admin_approved_date ASC");
// echo "SELECT req.id,  req.date_filled, req.status2, req.requestor,  req.department,  req.request_type,  req.ticket_category, req.request_category, req.assignedPersonnelName, req.ict_approval_date, req.first_responded_date, req.completed_date,req.requestor_approval_date, req.ticket_close_date, req.action, req.action1,  req.recommendation, req.onthespot_ticket, req.request_details,  req.rateDate, cat.level, cat.hours, cat.days, cat.req_type FROM `request` req LEFT JOIN `categories` cat ON cat.c_name = req.request_category WHERE ((req.admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' AND req.status2 != 'cancelled') 
//     OR (req.status2 = 'inprogress'  AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth' ) 
//     OR ((req.status2 = 'done' OR req.status2 = 'rated') AND req.completed_date >='$lastMonthYear-$previousMonthNumber-28' AND req.admin_approved_date <='$year-$monthNumber-$lastDateOfMonth') ) AND req.request_to = 'mis'  AND cat.req_type = '$reqtype' ORDER BY req.admin_approved_date ASC";
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
        <b>ICT Helpdesk </b>
        <br>
        <h3> <b> Summary Report for the Month of <?php echo $month ?></b></h3>
<!-- <h4><?php echo $print; ?></h4> -->
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
                    <th colspan="3">Requirements</th>
                    <th rowspan="2">ICT Date Approval</th>
                    <th rowspan="2">Date Responded</th>
                    <th rowspan="2">Response Rate (Hours)</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Date Finished</th>
                    <th rowspan="2">Accomplishment Rate (Days)</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Closed by</th>
                    <th rowspan="2">Action Taken</th>
                    <th rowspan="2">Recommendation</th>
                </tr>
                <tr>
                    <th>Priority Level</th>
                    <th>Hours</th>
                    <th>Days</th>
                </tr>

            </thead>
            <tbody>
                <?php
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
                    $year = $dateFilled->format('y');
                    $month = $dateFilled->format('m');

                    if ($row['request_type'] === "Technical Support") {
                        $request_no = "TS-" . $year . $month . "-" . $row['id'];
                    } else {
                        $request_no = "JO-" . $year . $month . "-" . $row['id'];
                    }


                    $requestor = $row['requestor'];
                    $department = $row['department'];


                    if ($row['request_type'] != NULL) {
                        $request_category = $row['request_type'] . " (" . $row['request_category'] . ")";
                    } else {
                        $request_category =  "Job Order (" . $row['request_category'] . ")";
                    }

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

                    if ($ticket_close_date != NULL && $date_finished != NULL) {
                        $closedBy = 'System';
                    } elseif (($requestor_approval_date != NULL || $rateDate != NULL) && $date_finished != NULL) {
                        $closedBy = 'Requestor';
                    } else {
                        $closedBy = '';
                    }

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


             

                    echo "<tr>    
                                    <td>$request_no</td>
                                    <td>$requestor</td>
                                    <td>$department</td>
                                    <td>$request_category</td>
                                    <td>$details</td>
                                    <td>$in_charge</td>
                                    <td>$piority_level</td>
                                    <td>$required_response_time</td>
                                    <td>$required_completion_days</td>
                                    <td>$approvalDate</td>
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
<div>

<table>
<thead>
                <tr>
   
                    






                </tr>

            </thead>
</table>
<table style="margin-top: 40px; width: 50%"  border="1" align="left">
    <thead>
                <tr>
   
                    <th>Members</th>
                    <th>Number of Task</th>
                    <th>No of Ongoing</th>
                    <th>No of Finished</th>
                    <th>No of On The Spot</th>
                    <th>No. of Late</th>
                    






                </tr>

            </thead>
            <tbody>
                <?php
                   
$sqlICT = mysqli_query($con, "SELECT * FROM `user` WHERE `department` = 'ICT' and `admin` = false");

      
                while ($row = mysqli_fetch_array($sqlICT)) {
                   $member= $row['name'];
        ?>
        <tr>
           <td><?php echo $member;?> </td>
           <td><?php 
            $value1 = 0;
               foreach ($arrayOfMembersNoOfTask as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>

<td><?php
$value1 = 0;
               foreach ($arrayOfMembersStatusOnGoing as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>




<td><?php
$value1 = 0;
               foreach ($arrayOfMembersStatusOnTime as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>

       
<td><?php
$value1 = 0;
               foreach ($arrayOfMembersOnTheSpot as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>



<td><?php
$value1 = 0;
               foreach ($arrayOfMembersStatusLate as $key => $value) {
                // echo $key . ' => ' . $value . PHP_EOL;
                $numberOfTask = $value;
                $name = $key;
                if($member == $name){
                    $value1 = $value;
                }
            }
            echo $value1;
       ;?> </td>



        </tr>
         <?php
                       
                }
                ?>
                </tbody>
    </table>

    <?php
    // foreach ($arrayOfMembersStatusLate as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }
    // echo "<br>";
    // foreach ($arrayOfMembersNoOfTask as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }
    // echo "<br>";
    // foreach ($arrayOfMembersStatusOnGoing as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }
    // echo "<br>";
    // foreach ($arrayOfMembersStatusOnTime as $key => $value) {
    //     echo $key . ' => ' . $value . PHP_EOL;
    // }



    ?>
<table style="margin-top: 40px; width: 30%"  border="1" align="left">
<tbody>
    <tr>
        <th>Total Ongoing Task</th>
        <th><?php echo $totalofOngoing; ?></th>

    </tr>
    <tr>
        <th>Total Finished Task</th>
        <th><?php echo $totalofFinished; ?></th>

    </tr>
    <tr>
        <th>Total of On the spot task</th>
        <th><?php echo $totalofOnTheSpot; ?></th>

    </tr>
    <tr>
        <th>Total of Late Task</th>
        <th><?php echo $totalofLate; ?></th>

    </tr>
    <tr style="font-weight: bold;">
        <th>Total Number of Task</th>
        <th><?php echo $totalNumberOfTask; ?></th>

    </tr>
</tbody>
</table>
<!-- <h3>Total of On Going: <?php echo $totalofOngoing; ?></h3>
        <h3>Total of On On Time: <?php echo $totalofFinished; ?></h3>
        <h3>Total of On Late: <?php echo $totalofLate; ?></h3>
        <h3>Total: <?php echo $totalNumberOfTask; ?></h3>

</div> -->

        
    </div>
</body>


</html>