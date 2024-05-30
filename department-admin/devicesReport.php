<?php
require '../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

$date = new DateTime();
$date = $date->format('F d, Y');
session_start();


$user_dept = $_SESSION['department'];


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
        <title>Helpdesk Report</title>


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
		#deviceReportTable td {
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
      
        <table>
        <tr>
                <td class="first"><span class="label">Computer and Removable Devices Monthly Report</span><span style="align-text: right"></span></td>
          
               
           

            </tr>
            <tr>
                <td class="first"><span class="label">For the month of ' . $_SESSION['selectedMonth'] . ' ' . $_SESSION['selectedYear'] . ' </span><span style="align-text: right"></span></td>
                

            </tr>
            <tr>
            <td class="first"><span class="label">Department: </span><span class="label" style="align-text: right">' . $_SESSION['department'] . '</span></td>
            

        </tr>

        </table>
        <br>
        <h4><span class="label">I: List of Removable Devices</span><span style="align-text: right"></span></h4>
        <table id="deviceReportTable" >
        
        <tr>
            <td>No.</td>
            <td>Control No.</td>
            <td>Brand</td>
            <td>Size</td>
            <td>Color</td>
            <td>Type</td>
            <td>Remarks</td>
            <td>Scan By</td>



 
            </tr>
            ';

$date = new DateTime();
$month = $_SESSION['selectedMonth'];
$year = $_SESSION['selectedYear'];
$a = 1;

$sql = "SELECT removabledevices.department,removabledevices.brand, removabledevices.size, removabledevices.color, removabledevices.type, removabledevices.controlNumber ,scan.action, scan.performedBy, scan.Date, scan.month, scan.year, scan.proof FROM removabledevices LEFT JOIN scan  ON removabledevices.controlNumber = scan.controlNumber AND scan.year = '$year' WHERE removabledevices.department = '$user_dept'  AND (scan.year = '$year' OR scan.year IS NULL) AND (scan.month = '$month' OR scan.month IS NULL);";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $controlNumber = $row['controlNumber'];
    $brand = $row['brand'];

    $size = $row['size'];
    $color = $row['color'];

    $type = $row['type'];
    $action = $row['action'];
    $performedBy = $row['performedBy'];

    $html .= '  <tr>
           <td>' . $a . '</td>
           <td>' . $controlNumber . '</td>

           <td>' . $brand . '</td>
           <td>' . $size . '</td>
           <td>' . $color . '</td>
           <td>' . $type . '</td>
           <td>' . $action . '</td>
           <td>' . $performedBy . '</td>



            </tr>';
    $a++;
}





$html .= ' </table>';
$html .= '<h4><span class="label">II: List of Computer</span><span style="align-text: right"></span></h4>
<table id="deviceReportTable" >

<tr>
    <td>No.</td>
    <td>PC Tag</td>
    <td>Asset Tag</td>
    <td>User</td>
    <td>Type</td>
    <td>Status</td>




    </tr>
    ';

$date = new DateTime();
$month = $_SESSION['selectedMonth'];
$year = $_SESSION['selectedYear'];
$a = 1;

$sql = "SELECT * FROM `devices` WHERE `department` = '$user_dept' AND `type` != 'Tablet'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $pctag = $row['pctag'];
    $assetTag = $row['assetTag'];
    $user = $row['user'];
    $type = $row['type'];
    $deactivated = $row['deactivated'];
    if ($deactivated == true) {
        $deactivated = "Inactive";
    } else {
        $deactivated = "Active";
    }
    $html .= '  <tr>
   <td>' . $a . '</td>
   <td>' . $pctag . '</td>
   <td>' . $assetTag . '</td>
   <td>' . $user . '</td>
   <td>' . $type . '</td>
   <td>' . $deactivated . '</td>
   </tr>';
    $a++;
}





$html .= ' </table>';

$html .= '<table style="bottom: 75px; position: absolute;">
<tr>
<th class="first"><span class="label">Prepared by: </span></th>
<th class="first"><span class="label">Noted by Dept Head: </span></th>
<th class="first"><span class="label">Checked by ICT: </span></th>

</tr>
<br>
<br>
<br>

<tr>
<th class="first"><span class="label">' . $_SESSION['name'] . '</span></th>
<th class="first"><span class="label"></span></th>
<th class="first"><span class="label"></span></th>

</tr>
</table>

        
    </body>
    </html>';
$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('PMS Report.pdf', ['Attachment' => 0]);
