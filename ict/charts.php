<<<<<<< HEAD

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



    
if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = "ALL";
}


if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $currentYear = date('Y');
    $year = $currentYear;
}



    if (isset($_POST['changeMonthAndYear'])) {

        $requestType = $_POST['requestType'];
        $selectedYear = $_POST['year'];
        echo "<script> location.href='charts.php?type=$requestType&year=$selectedYear'; </script>";


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
    
<div class="w-full flex justify-end">
<form class="max-w-sm flex gap-2 mb-2" method="POST">
<select name="requestType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <option <?php if($type=="ALL"){ echo "selected";} ?> value="ALL">ALL</option>
      <option <?php if($type=="TS"){ echo "selected";} ?> value="TS">Ticket</option>
      <option <?php if($type=="JO"){ echo "selected";} ?>  value="JO">Job Order</option>

      </select>

  
  <div class="h-full">

            <input value="<?php echo $year; ?>" type="text" name="year" class="h-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Year" required />
        </div>
        <button type="submit" name="changeMonthAndYear" class="h-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Proceed</button>
</form>
</div>
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
    <!-- <script type="text/javascript" src="chart.js"></script> -->

<script>


 

<?php  

if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = "ALL";
}


if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $currentYear = date('Y');
    $year = $currentYear;
}

    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');
            ?>
                console.log("<?php echo $monthName; ?>");
            <?php
    }

?>
     
const ctx = document.getElementById('myChart');
      const labels = ['January', 'February','March','April','May','June','July','August','September','October','November','December'];
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
  datasets: [{
    label: 'Number of Task', // First set of bars
    data: [
        <?php 

    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['numberOfTask'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>
    ], // Data for Dataset 1
    backgroundColor: '#c9cbcf', // One color for all bars
    borderColor: '#c9cbcf', // Border color for Dataset 1
    borderWidth: 1
  },
  {
    label: 'Finished Tasks', // Second set of bars
    data: [<?php 
    
    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['finished'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#4bc0c0', // Another color for all bars
    borderColor: '#4bc0c0', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'On The Spot', // Second set of bars
    data: [<?php 
   
    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['onTheSpot'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#9966ff', // Another color for all bars
    borderColor: '#9966ff', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'Late', // Second set of bars
    data: [<?php 
   

    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['late'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#ff6384', // Another color for all bars
    borderColor: '#ff6384', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'On Going', // Second set of bars
    data: [<?php 
      
    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['ongoing'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#ffcd56', // Another color for all bars
    borderColor: '#ffcd56', // Border color for Dataset 2
    borderWidth: 1
  },
],
  
  },

  options: {
    legend: {
      labels: {
        fontColor: 'white' // Change legend label color
      }
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontColor: 'white'
          },
          gridLines: {
            color: '#ffffff8c' // Change this to your desired grid line color
          }
        }],
        xAxes: [{
            ticks: {
              beginAtZero: true,
              fontColor: 'white'
            },
            gridLines: {
              color: '#ffffff8c' // Change this to your desired grid line color
            }
          }],
        
      }
    
  },
  fill: false,
  borderColor: 'white',

});


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
=======

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



    
if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = "ALL";
}


if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $currentYear = date('Y');
    $year = $currentYear;
}



    if (isset($_POST['changeMonthAndYear'])) {

        $requestType = $_POST['requestType'];
        $selectedYear = $_POST['year'];
        echo "<script> location.href='charts.php?type=$requestType&year=$selectedYear'; </script>";


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
    
<div class="w-full flex justify-end">
<form class="max-w-sm flex gap-2 mb-2" method="POST">
<select name="requestType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <option <?php if($type=="ALL"){ echo "selected";} ?> value="ALL">ALL</option>
      <option <?php if($type=="TS"){ echo "selected";} ?> value="TS">Ticket</option>
      <option <?php if($type=="JO"){ echo "selected";} ?>  value="JO">Job Order</option>

      </select>

  
  <div class="h-full">

            <input value="<?php echo $year; ?>" type="text" name="year" class="h-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Year" required />
        </div>
        <button type="submit" name="changeMonthAndYear" class="h-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Proceed</button>
</form>
</div>
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
    <!-- <script type="text/javascript" src="chart.js"></script> -->

<script>


 

<?php  

if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = "ALL";
}


if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $currentYear = date('Y');
    $year = $currentYear;
}

    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');
            ?>
                console.log("<?php echo $monthName; ?>");
            <?php
    }

?>
     
const ctx = document.getElementById('myChart');
      const labels = ['January', 'February','March','April','May','June','July','August','September','October','November','December'];
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
  datasets: [{
    label: 'Number of Task', // First set of bars
    data: [
        <?php 

    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['numberOfTask'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>
    ], // Data for Dataset 1
    backgroundColor: '#c9cbcf', // One color for all bars
    borderColor: '#c9cbcf', // Border color for Dataset 1
    borderWidth: 1
  },
  {
    label: 'Finished Tasks', // Second set of bars
    data: [<?php 
    
    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['finished'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#4bc0c0', // Another color for all bars
    borderColor: '#4bc0c0', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'On The Spot', // Second set of bars
    data: [<?php 
   
    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['onTheSpot'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#9966ff', // Another color for all bars
    borderColor: '#9966ff', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'Late', // Second set of bars
    data: [<?php 
   

    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['late'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#ff6384', // Another color for all bars
    borderColor: '#ff6384', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'On Going', // Second set of bars
    data: [<?php 
      
    for($i = 1 ; $i<=12 ; $i++){
        $date = DateTime::createFromFormat('!m', $i);
        $monthName = $date->format('F');

           $sql="SELECT * FROM `postedreport` WHERE `type` = '$type' AND `year` = '$year' AND `month` = '$monthName';";

           $result = mysqli_query($con,$sql);
           $numrows = mysqli_num_rows($result);
           if($numrows >=1){
            while($row=mysqli_fetch_assoc($result)){
                    echo $row['ongoing'],', ';
            }
           }
           else{
            echo 0, ', ';
           }
               
    }
            
            ?>], // Data for Dataset 2
    backgroundColor: '#ffcd56', // Another color for all bars
    borderColor: '#ffcd56', // Border color for Dataset 2
    borderWidth: 1
  },
],
  
  },

  options: {
    legend: {
      labels: {
        fontColor: 'white' // Change legend label color
      }
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontColor: 'white'
          },
          gridLines: {
            color: '#ffffff8c' // Change this to your desired grid line color
          }
        }],
        xAxes: [{
            ticks: {
              beginAtZero: true,
              fontColor: 'white'
            },
            gridLines: {
              color: '#ffffff8c' // Change this to your desired grid line color
            }
          }],
        
      }
    
  },
  fill: false,
  borderColor: 'white',

});


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
>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
</html>