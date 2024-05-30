<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        @page { margin-top: 0px; }
        body{
            font-family: "Calibri", sans-serif;
        }
        table {
			border: 2px;
            font-size: 10px;
            margin: auto;
		}
		td {
			padding: 10px;
            border-width: 2px;
    border-style: solid;
		}
        </style>
        <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
        <link rel="stylesheet" href="index.css">
    
        <script src="../cdn_tailwindcss.js"></script>
    
        <link rel="stylesheet" href="../node_modules/flowbite/dist/flowbite.min.css" />
       
    </head>
    <body style="margin: 0px; padding: 0px; ">
        <div style="text-align: center">
            <p style="font-size: 15px; margin: 0">Glory (Philippines) Inc.</p>
            <p style="font-size: 15px; margin: 0">Administration Department</p>
            <p style="font-size: 13px; margin: 0">http://glory-helpdesk.com</p>
            <p style="font-size: 15px; margin: 0">Job Order Report</p>
            <div style="display: flex; justify-content: center; align-items: center">
            <div style=" height: 60px; width: 60px; background-color: blue;position: relative; top: 50%;  background-image:url('../resources/img/logo.jpg'); background-repeat: no-repeat; background-size: cover; "></div>
            <div style="height: 100px; width: 170px; background-color: red;">
            <p style="font-size: 15px; margin: 0">Glory (Philippines) Inc.</p>
            <p style="font-size: 15px; margin: 0">Administration Department</p>
            <p style="font-size: 13px; margin: 0">http://glory-helpdesk.com</p>
            <p style="font-size: 15px; margin: 0">Job Order Report</p>
            </div>
            </div>

        </div>


        <table>
        <tr>
         <td colspan = "2"><span class="label">Job Order No: </span></td>
         <td colspan = "4"> <span class="child">2304-423</span></td>
         <td colspan="4"><span class="label">Status: </span></td>
         <td colspan = "2"><span class="child">Done</span></td>


     </tr>
     <tr>
         <td colspan = "2"><span class="label">Job Order No: </span></td>
         <td colspan = "3"> <span class="child">2304-423</span></td>
         <td><span class="label">Status: </span></td>
         <td colspan = "4"><span class="child">Done</span></td>


     </tr>
     </table>

        <script src="../node_modules/flowbite/dist/flowbite.js"></script>
        <script src="../node_modules/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
        <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="index.js"></script>
    </body>
    </html>