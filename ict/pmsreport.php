<?php
require '../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

$date = new DateTime();
$date = $date->format('F d, Y');
session_start();

if (!isset($_SESSION['connected'])) {
    header("location: ../index.php");
}
include("../includes/connect.php");

$html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Order Report</title>
        <link rel="shortcut icon" href="../resources/img/helpdesk.png">

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
            margin-top: 10px;
			border: 2px;
            font-size:9px;
            width: 100%;
		}
		td {
padding-top: 0px;
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
      
        <table>
        <tr>
                <td class="first"><span class="label">ICT Preventive Maintenance Service</span><span style="align-text: right"></span></td>
                <td class="first" style="text-align: right"><span class="label">Date: ' . $date . '</span><span style="align-text: right"></span></td>
          
               
           

            </tr>
            <tr>
                <td class="first"><span class="label">For the month of ' . $_SESSION['selectedMonth'] . ' ' . $_SESSION['selectedYear'] . ' </span><span style="align-text: right"> </span></td>
                

            </tr>
            

        </table>
        <table id="finishedTable" >
        
        <tr style="font-weight: bold;">
               <td>No.</td>
               <td>PC Name</td>
               <td>Status</td>
               <td>Department</td>
               <td>User</td>
               <td>Type</td>
               <td>PMS Date</td>
               <td>Activity</td>
               <td >&nbsp; &nbsp; &nbsp;Performed by</td>
               <td>Remarks</td>
               <td>Approved By</td>

 
            </tr>
            ';
$date = new DateTime();
$month = $_SESSION['selectedMonth'];
$year = $_SESSION['selectedYear'];

$sql = "select `$month` from `pmsschedule` ";
$monthResult = mysqli_query($con, $sql);


while ($row = mysqli_fetch_assoc($monthResult)) {
    $scheduledDepartment =  $row[$month];
}

$departments = explode(" and ", $scheduledDepartment);

if (count($departments) == 1) {
    $DepartmentOnly = $departments[0];
    $sql = "SELECT devices.*, pmsaction.deviceName, pmsaction.action, pmsaction.performedBy, pmsaction.Date, pmsaction.month, pmsaction.year, pmsaction.comments, pmsaction.approvedBy
              FROM devices
              LEFT JOIN pmsaction
                  ON devices.computerName = pmsaction.deviceName AND pmsaction.year = '$year'
              WHERE devices.department = '$DepartmentOnly'
                  AND devices.type != 'Tablet' AND devices.deactivated = 0
                  AND (pmsaction.year = '$year' OR pmsaction.year IS NULL)
                  AND (pmsaction.month = '$month' OR pmsaction.month IS NULL);";
    $result = mysqli_query($con, $sql);
} else if (count($departments) > 1) {
    $department1 = $departments[0];
    $department2 = $departments[1];

    $sql = "SELECT  devices.*, pmsaction.deviceName, pmsaction.action, pmsaction.performedBy, pmsaction.Date, pmsaction.month, pmsaction.year, pmsaction.comments, pmsaction.approvedBy FROM devices LEFT JOIN pmsaction ON devices.computerName = pmsaction.deviceName AND pmsaction.year = '$year' WHERE (devices.department = '$department1' OR devices.department = '$department2') AND devices.type != 'Tablet' AND devices.deactivated = 0 AND (pmsaction.year = '$year' OR pmsaction.year IS NULL)
              AND (pmsaction.month = '$month' OR pmsaction.month IS NULL);";
    $result = mysqli_query($con, $sql);
}



$increment = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $department = $row['department'];
    $computerName = $row['computerName'];

    $user = $row['user'];
    $type = $row['type'];

    $Date = $row['Date'];
    $action = $row['action'];
    $perfomedBy = $row['performedBy'];
    $comments = $row['comments'];
    $approval = $row['approvedBy'];

    if ($Date == "") {
        $status = "Pending";
    } else {
        $status = "Done";
    }
    $html .= '  <tr>
           <td>' . $increment . '</td>
           <td>' . $computerName . '</td>

           <td>' . $status . '</td>
           <td>' . $department . '</td>
           <td>' . $user . '</td>
           <td>' . $type . '</td>
           <td>' . $Date . '</td>
           <td style="max-width: 100px; margin-right: 20px;">' . $action . '</td>
           <td>&nbsp; &nbsp; &nbsp;' . $perfomedBy . '</td>
           <td>' . $comments . '</td>
           <td>' . $approval . '</td>


            </tr>';
    $increment++;
}





$html .= ' </table>';
$html .= '<table style="bottom: 75px; position: absolute;">
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
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('PMS Report.pdf', ['Attachment' => 0]);
