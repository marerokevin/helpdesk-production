<?php
require '../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

session_start();
$date = new DateTime();
$date = $date->format('F d, Y');

$wholename = $_SESSION['name'];
$jobOrderNo = $_SESSION['jobOrderNo'];


$requestor = $_SESSION['requestor'];
$department = $_SESSION['pdepartment'];
$dateFiled = $_SESSION['dateFiled'];
$requestedSchedule = $_SESSION['requestedSchedule'];
$type = $_SESSION['type'];
$pcNumber = $_SESSION['pcNumber'];
$details = $_SESSION['details'];
$headsRemarks = $_SESSION['headsRemarks'];
$adminsRemarks = $_SESSION['adminsRemarks'];
$assignedPersonnel = $_SESSION['assignedPersonnel'];
$section = $_SESSION['section'];
$firstAction = $_SESSION['firstAction'];
$firstDate = $_SESSION['firstDate'];
$secondAction = $_SESSION['secondAction'];
$secondDate = $_SESSION['secondDate'];
$thirdAction = $_SESSION['thirdAction'];
$thirdDate = $_SESSION['thirdDate'];
$finalAction = $_SESSION['finalAction'];
$recommendation = $_SESSION['recommendation'];
$dateFinished = $_SESSION['dateFinished'];
$ratedBy = $_SESSION['ratedBy'];
$delivery = $_SESSION['delivery'];
$quality = $_SESSION['quality'];
$totalRating = $_SESSION['totalRating'];
$ratingRemarks = $_SESSION['ratingRemarks'];
$ratedDate = $_SESSION['ratedDate'];
$approved_reco = $_SESSION['approved_reco'];
$icthead_reco_remarks = $_SESSION['icthead_reco_remarks'];


$headsDate =  $_SESSION['headsDate'];
$adminsDate =  $_SESSION['adminsDate'];

if ($_SESSION['status'] == "inprogress") {
    $status = "In Progress";
} else if ($_SESSION['status'] == "rated") {
    $status = "Done";
} else if ($_SESSION['status'] == "Done") {
    $status = "Done";
}

$html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Helpdesk Report</title>
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
            font-size:11px;
            width: 100%;
		}
		td {
padding-top: 5px;
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
        <p style="font-size: 11px; margin: 0">GLORY (PHILIPPINES) INC.</p>
        <p style="font-size: 10px; margin: 0">http://glory-helpdesk.com</p>
        <p style="font-size: 11px; margin: 0; font-weight: bold">Helpdesk Report</p>
        </div>


        <table>
            <tr>
                <td class="first"><span class="label">Request No</span><span style="align-text: right">:</span></td>
                <td class="second"> <span class="child">' . $jobOrderNo . '</span></td>
                <td><span class="label">Status: </span></td>
                <td class="fourth"><span class="child">' . $status . '</span></td>


            </tr>

            <tr>
                <td class="first"><span class="label">Requestor: </span></td>
                <td class="second"> <span class="child">' . $requestor . '</span></td>
                <td><span class="label">Department: </span></td>
                <td class="fourth"><span class="child">' . $department . '</span></td>
            </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td colspan="2" class="category"><span class="label">JOB ORDER&apos;S DETAILS</span></td>

            </tr>
            <tr>
                <td><span class="label">Date Filed: </span></td>
                <td> <span class="child">' . $dateFiled . '</span></td>
            </tr>
            <tr style="display: none">
                <td><span class="label">Requested Schedule: </span></td>
                <td> <span class="child">' . $requestedSchedule . '</span></td>

            </tr>
            <tr>
                <td class="first"><span class="label">Type: </span></td>
                <td class="second"> <span class="child">' . $type . '</span></td>';
if ($type == "Computer") {

    $html .= '<td class="third"><span class="label">PC Number: </span></td>
    <td><span class="child">' . $pcNumber . '</span></td>';
}
$html .= ' </tr>
            <tr>
                <td class="first"><span class="label">Details</span></td>
                <td  colspan="4"> <span class="child"> ' . $details . '
                    </span></td>
            </tr>';
if ($headsRemarks != "") {

    $html .= '<tr>
            <td class="second"> <span class="child">' . $headsRemarks . '</span></td>
            <td><span class="label">Date: </span></td>
            <td class="fourth"><span class="child">' . $headsDate . '</span></td>
        </tr>
        ';
} else {
    $html .= '<tr>
                <td class="first"><span class="label">Head&apos;s Remarks</span></td>
                <td class="second"> <span class="child">n/a</span></td>
                <td><span class="label">Date: </span></td>
                <td class="fourth"><span class="child">' . $headsDate . '</span></td>
            </tr>';
}

if ($adminsRemarks != "") {
    $html .= ' <tr>
                <td class="first"><span class="label">ICT Head&apos;s Remarks</span></td>
                <td class="second"> <span class="child">' . $adminsRemarks . '</span></td>
                <td><span class="label">Date: </span></td>
                <td class="fourth"><span class="child">' . $adminsDate . '</span></td>
            </tr>';
} else {
    $html .= '<tr>
                <td class="first"><span class="label">ICT Head&apos;s Remarks</span></td>
                <td class="second"> <span class="child">n/a</span></td>
                <td><span class="label">Date: </span></td>
                <td class="fourth"><span class="child">' . $adminsDate . '</span></td>
            </tr>';
}


$html .= ' </table>
        <hr>

        <table>
            <tr>
                <td class="category"><span class="label">ACTION&apos;S DETAILS </span></td>

            </tr>
            <tr>
                <td class="first"><span class="label">Assigned Personnel: </span></td>
                <td class="second"> <span class="child">' . $assignedPersonnel . '</span></td>
                <td class="third"><span class="label">Section: </span></td>
                <td><span class="child">' . $section . '</span></td>
            </tr>';
if ($firstAction != "") {
    $html .= '<tr>
    <td class="first"><span class="label">1st Action: </span></td>
    <td class="second"> <span class="child">' . $firstAction . '</span></td>
    <td style="width: 10%"><span class="label">Date: </span></td>
    <td><span class="child">' . $firstDate . '</span></td>
</tr>';
}
if ($secondAction != "") {
    $html .= '<tr>
    <td class="first"><span class="label">2nd Action: </span></td>
    <td class="second"> <span class="child">' . $secondAction . '</span></td>
    <td><span class="label">Date: </span></td>
    <td><span class="child">' . $secondDate . '</span></td>
</tr>';
}
if ($thirdAction != "") {
    $html .= '  <tr>
    <td class="first"><span class="label">3rd Action: </span></td>
    <td class="second"> <span class="child">' . $thirdAction . '</span></td>
    <td><span class="label">Date: </span></td>
    <td><span class="child">' . $thirdDate . '</span></td>
</tr>';
}
if ($finalAction != "") {
    $html .= ' <tr>
    <td class="first"><span class="label">Final Solution: </span></td>
    <td colspan="4"> <span class="child">' . $finalAction . '</span></td>

</tr>';
}

if ($dateFinished != "") {
    $html .= '  <tr>
                <td class="first"><span class="label">Date Finished:</span></td>
                <td colspan="4"> <span class="child">' . $dateFinished . '
                    </span></td>
                 </tr>';
}


$html .= '  </table>

            <hr>';
if ($recommendation != "" && ($icthead_reco_remarks != ""  || $icthead_reco_remarks != NULL) && $approved_reco == 1) {
    $html .= '<table>
                <tr>
                    <td colspan="2" class="category"><span class="label">RECOMMENDATION</span></td>
                </tr>
                <tr>
                    <td class="first"><span class="label">Assigned Personnel Recommendation:</span></td>
                    <td colspan="4"> <span class="child">' . $recommendation . '</span></td>
                </tr>';
    $html .= '<tr>
                    <td class="first"><span class="label">ICT Head&apos;s Remarks:</span></td>
                    <td colspan="4"> <span class="child">' . $icthead_reco_remarks . '</span></td>
                    </tr></table> <hr>';
} elseif ($recommendation != "" && ($icthead_reco_remarks == "" || $icthead_reco_remarks == NULL) && $approved_reco == 1) {
    $html .= '<table>
                        <tr>
                            <td colspan="2" class="category"><span class="label">RECOMMENDATION</span></td>
                        </tr>
                        <tr>
                            <td class="first"><span class="label">Assigned Personnel Recommendation:</span></td>
                            <td colspan="4"> <span class="child">' . $recommendation . '</span></td>
                        </tr></table> <hr>';
}



$html .= '<table style="bottom: 35px; position: absolute;">
        <tr>
        <td class="first"><span class="label">Printed by: </span></td>
        <td class="second"> <span class="child">' . $wholename . '</span></td>
        <td class="third"><span class="label">Date: </span></td>
        <td><span class="child">' . $date . '</span></td>
        </tr>
        </table>
            </body>
            </html>';
$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream('Job Order Report.pdf', ['Attachment' => 0]);
