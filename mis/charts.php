
 <?php 

$timeout = 3600;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set( "session.gc_maxlifetime", $timeout );

ini_set( "session.cookie_lifetime", $timeout );
 
$s_name = session_name();
$url1=$_SERVER['REQUEST_URI'];


if(isset( $_COOKIE[ $s_name ] )) {

    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );

    
}

else

    echo "Session is expired.<br/>";





session_start();

    if(!isset($_SESSION['connected'])){
      header("location: ../index.php");
    }


  
include ("../includes/connect.php");

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts</title>
    <link rel="shortcut icon" href="../resources/img/helpdesk.png">

    <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">


    
  
    <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

    <link rel="stylesheet" href="index.css">

    <script src="../cdn_tailwindcss.js"></script>


    <link rel="stylesheet" href="../node_modules/flowbite/dist/flowbite.min.css" />





</head>
<body   class="static h-screen  bg-white dark:bg-gray-700"  >


    <?php require_once 'nav.php';?>







<div class=" ml-72 flex mt-16 h-[95%]  left-10 right-5  flex-col  px-14 sm:px-8  pt-6 pb-14 z-50 ">
<div class="justify-center  text-center flex items-start h-full bg-gradient-to-r from-blue-900 to-teal-500 rounded-xl ">
<div class="text-center py-2 m-auto lg:text-center w-full">
       
<canvas id="myChart" ></canvas>

</div>
</div>








 </div> 



 
 <script src="../node_modules/chart.js/dist/Chart.js"></script>


<script src="../node_modules/flowbite/dist/flowbite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>

    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="chart.js"></script>

<script>

   



$("#sidehome").removeClass("bg-gray-200");
$("#sideuser").removeClass("bg-gray-200");
$("#sideMyRequest").removeClass("bg-gray-200");
$("#sidepms").removeClass("bg-gray-200");
$("#sidedocs").removeClass("bg-gray-200");
$("#sidecharts").addClass("text-white bg-gradient-to-r from-blue-900 to-teal-500");




$("#sidehome1").removeClass("bg-gray-200");
$("#sideuser1").removeClass("bg-gray-200");
$("#sideMyRequest1").removeClass("bg-gray-200");
$("#sidepms1").removeClass("bg-gray-200");
$("#sidedocs1").removeClass("bg-gray-200");
$("#sidecharts").addClass("text-white bg-gradient-to-r from-blue-900 to-teal-500");



</script>

</body>
</html>