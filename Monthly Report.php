<?php
include("includes/connect.php");
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

session_start();

$month = $_SESSION['month'];
$year = $_SESSION['year'];
$wholename = $_SESSION['name'];
$section = $_SESSION['level'];

$monthNumber1 = date('m', strtotime($month));

// Create DateTime object
$currentDate = DateTime::createFromFormat('m-d-Y', $monthNumber1 . '-01-' . $year);


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


if ($section == "admin") {
    $section = $_SESSION['adminsection'];
}
$firstdate = date('d', strtotime("first day of $year-$month"));
$lastDateOfMonth = date('d', strtotime("last day of $year-$month"));

$monthNumber = date('m', strtotime("$month"));
$sql = "SELECT ROUND (((SELECT COUNT('id') FROM request WHERE request_to = '$section' AND (status2 = 'Done' OR status2 = 'rated' )AND late != true AND admin_approved_date BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth')) / ((SELECT ((SELECT COUNT('id') FROM request WHERE request_to = '$section' AND (status2 = 'Done' OR status2 = 'rated') AND admin_approved_date BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth')) + (SELECT COUNT('id') FROM request WHERE request_to = '$section' AND status2 = 'inprogress' AND admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth'  ))) * 100, 2) AS percentage;";
// $sql="SELECT ROUND (((SELECT COUNT('id') FROM request WHERE request_to = '$section' AND (status2 = 'Done' OR status2 = 'rated') AND admin_approved_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth')) / ((SELECT ((SELECT COUNT('id') FROM request WHERE request_to = '$section' AND (status2 = 'Done' OR status2 = 'rated') AND admin_approved_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth')) + (SELECT COUNT('id') FROM request WHERE request_to = '$section' AND status2 = 'inprogress' AND admin_approved_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth' AND reqfinish_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth'))) * 100, 2) AS percentage;";
$result = mysqli_query($con, $sql);
// $sql = "SELECT ROUND (((SELECT COUNT('id') FROM request WHERE request_to = '$section' AND (status2 = 'Done' OR status2 = 'rated') AND admin_approved_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth')) / ((SELECT ((SELECT COUNT('id') FROM request WHERE request_to = '$section' AND (status2 = 'Done' OR status2 = 'rated') AND admin_approved_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth')) + (SELECT COUNT('id') FROM request WHERE request_to = '$section' AND status2 = 'inprogress' AND admin_approved_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth' AND reqfinish_date BETWEEN '$year-$monthNumber-$firstdate' AND '$year-$monthNumber-$lastDateOfMonth'))) * 100, 2) AS percentage;";
$resultPercentage = "";
while ($row = mysqli_fetch_assoc($result)) {
    $resultPercentage = $row['percentage'];
}

$dateNow = new DateTime();
$dateNow = $dateNow->format('F d, Y');


$html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Monthly Report</title>
        <style>
        @page { margin: 15px; }
        body{
            font-family: "Calibri", sans-serif;
        }
        .header{
            display: flex; 
            justify-content: center; 
        }
        .logo{
            height: 100px; width: 100px; background-color: blue
        }
        .label{
            font-weight: bold;
            font-size:11px;
        }
        .child{
            font-size:11px;

        }
        p{
            margin: 5px
        }
        .category{
            font-weight: bold;
            text-decoration: underline;
            font-size:11px;

        }
        table {
            border-collapse: collapse;
            border-color: inherit;
            text-indent: 0;
            margin-top: 10px;
			border: 2px;
            font-size: 9px;
            width: 100%;
		}
		#finishedTable td {
            border-width: .5px; border-style: solid; 
           padding-left: 5px;  border-color: gray
		}
        #latefinishedTable td {
            border-width: .5px; border-style: solid; 
           padding-left: 5px;  border-color: gray
		}
        #pendingTable td {
            border-width: .5px; border-style: solid; 
           padding-left: 5px;  border-color: gray
		}
        .first{
            width: 25%;
        }
        .second{
            width: 40%;

        }
        .third{
            width: 15%;
        }
        .fourth{
            width: 25%;

        }

        </style>

        <script src="../cdn_tailwindcss.js"></script>
    
       
    </head>
    <body style="margin: 0px; padding: 0px; ">
        <div style="text-align: center">
            <p style="font-size: 11px; margin: 0; font-weight: bold">Job Order Monthly Report</p>
        </div>


        <table>
        <tr>
                <td class="first"><span class="label">Date</span><span style="align-text: right">:</span></td>
                <td class="second"> <span class="child">' . $dateNow . '</span></td>
               
           

            </tr>
            <tr>
                <td class="first"><span class="label">Section</span><span style="align-text: right">:</span></td>
                <td class="second"> <span style="text-transform: uppercase;" class="child">' . $section . '</span></td>
                <td><span class="label">Month of: </span></td>
                <td class="fourth"><span class="child">' . $month . ' ' . $year . ' </span></td>


            </tr>
                
            </tr>';
if ($section == "fem") {
    $html .= '<tr>
                <td class="first"><span class="label">Target:  </span></td>
                <td class="second"> <span class="child">97% Completion of Job Orders from Approved Schedule</span></td>
                <td><span class="label">Result: </span></td>
                <td class="fourth"><span class="child">' . $resultPercentage . '%</span></td>
                    
                </tr>';
} else {
    $html .= '<tr> </tr>';
}

$html .= '<tr>
            
        </tr>
        </table>

        <h5 style="margin-bottom: 0">Finished Job Order</h5>
        <table id="finishedTable" >
        
        <tr>
        <td>No.</td>
        <td>Request Number</td>
        <td>Requestor</td>
        <td>Details</td>
        <td>Personnel</td>
        <td>Approved Date</td>
        <td>Due Date</td>
        <td>Date Finish</td>
     </tr>

            
            ';
$a = 1;

$sql = "select * from `request` WHERE `request_to` = '$section' and (`status2` = 'Done' or `status2` = 'rated') AND late != true AND `admin_approved_date` BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' order by assignedPersonnelName asc  ";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $date = new DateTime($row['date_filled']);
    $date = $date->format('ym');

    $dateApproved = new DateTime($row['admin_approved_date']);
    $dateApproved = $dateApproved->format('F d, Y');

    $dateFinished = new DateTime($row['actual_finish_date']);
    $dateFinished = $dateFinished->format('F d, Y');

    $expected = new DateTime($row['expectedFinishDate']);
    $expected = $expected->format('F d, Y');
    $html .= '  <tr>
           <td>' . $a . '</td>
           <td>' . $date . '-' . $row['id'] . '</td>
           <td>' . $row['requestor'] . '</td>
           <td>' . $row['request_details'] . '</td>
           <td>' . $row['assignedPersonnelName'] . '</td>
           <td>' . $dateApproved . '</td>
           <td>' . $expected . '</td>
           <td>' . $dateFinished . '</td>
            </tr>';

    $a++;
}



$html .= ' </table>
<br>
<br>
<br>
<br>
<br>

       <h5 style="margin-bottom: 0">Late Finished Job Order</h5>
       <table id="latefinishedTable" >
        
        <tr>
               <td>No.</td>
               <td>Request Number</td>
               <td>Requestor</td>
               <td>Details</td>
               <td>Personnel</td>
               <td>Date Started</td>
               <td>Expected Finished Date </td>
               <td>Date Finished</td>
            </tr>

            
            ';
$a = 1;

$sql = "select * from `request` WHERE `request_to` = '$section' and (`status2` = 'Done' or `status2` = 'rated') AND late != false AND `admin_approved_date` BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth' order by id asc  ";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $date = new DateTime($row['date_filled']);
    $date = $date->format('ym');

    $dateApproved = new DateTime($row['admin_approved_date']);
    $dateApproved = $dateApproved->format('F d, Y');

    $dateFinished = new DateTime($row['actual_finish_date']);
    $dateFinished = $dateFinished->format('F d, Y');


    $expected = new DateTime($row['expectedFinishDate']);
    $expected = $expected->format('F d, Y');
    $html .= '  <tr>
           <td>' . $a . '</td>
           <td>' . $date . '-' . $row['id'] . '</td>
           <td>' . $row['requestor'] . '</td>
           <td>' . $row['request_details'] . '</td>
           <td>' . $row['assignedPersonnelName'] . '</td>
           <td>' . $dateApproved . '</td>
           <td>' . $expected . '</td>
           <td>' . $dateFinished . '</td>
            </tr>';

    $a++;
}



$html .= ' </table>
        <h5 style="margin-bottom: 0">Pending Job Order</h5>
        <table id="pendingTable" >
        
        <tr>
               <td>No.</td>
               <td>Request Number</td>
               <td>Requestor</td>
               <td>Details</td>
               <td>Personnel</td>
               <td>Date Started</td>
               <td>Expected Finished Date</td>


            </tr>

            
            ';
$a = 1;

$sql = "select * from `request` WHERE `request_to` = '$section' and `status2` = 'inprogress'AND admin_approved_date  BETWEEN '$lastMonthYear-$previousMonthNumber-28' AND '$year-$monthNumber-$lastDateOfMonth'  order by id asc  ";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $date = new DateTime($row['date_filled']);
    $date = $date->format('ym');

    $dateApproved = new DateTime($row['admin_approved_date']);
    $dateApproved = $dateApproved->format('F d, Y');

    $expectedDate = new DateTime($row['expectedFinishDate']);
    $expectedDate = $expectedDate->format('F d, Y');

    $html .= '  <tr>
           <td>' . $a . '</td>
           <td>' . $date . '-' . $row['id'] . '</td>
           <td>' . $row['requestor'] . '</td>
           <td>' . $row['request_details'] . '</td>
           <td>' . $row['assignedPersonnelName'] . '</td>
           <td>' . $dateApproved . '</td>
           <td>' . $expectedDate . '</td>

            </tr>';

    $a++;
}



$html .= ' </table>';
$html .= '
       
       <table style="bottom: 75px; position: absolute;">
       <tr>
       <td class="first" style="text-align: center"><span class="label">Prepared by: </span></td>
       <td class="second"> <span class="child"></span></td>
       <td class="third" style="text-align: center"><span class="label">Checked by: </span></td>
       
       </tr>
       <tr style="margin-bottom: 50px">
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       <td> </td>
       
       </tr>
       <br>
       <br>
       
       
       <tr>
       <td class="first" style="text-align: center"><span class="label">' . $_SESSION['name'] . '</span></td>
       <td class="second"> <span class="child"></span></td>
       <td class="third" style="text-align: center"><span class="label">Jonathan Nemedez</span></td>
       
       
       </tr>
       </table>
       

        
    </body>
    </html>';
$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Monthly Report.pdf', ['Attachment' => 0]);
