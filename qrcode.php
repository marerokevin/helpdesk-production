<?php
    require './dompdf/vendor/autoload.php';

    use Dompdf\Dompdf;
   

    $html ='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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

    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=asdjkgfaskdjgfasdkjh&choe=UTF-8">
      
    </body>
    </html>';   
    $dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream('Job Order Report.pdf', ['Attachment' => 0]);
?>

