 <!-- session for who is login user    -->
 <?php 




//Set the session timeout for 1 hour

$timeout = 3600;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Set the maxlifetime of the session

ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session

ini_set( "session.cookie_lifetime", $timeout );

  // session_start();
  
$s_name = session_name();
$url1=$_SERVER['REQUEST_URI'];

//Check the session exists or not

if(isset( $_COOKIE[ $s_name ] )) {

    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );

    
}

else

    echo "Session is expired.<br/>";


// end of session timeout>";






session_start();

    if(!isset($_SESSION['connected'])){
      header("location: ../index.php");
    }


    
// connection php and transfer of session
include ("../includes/connect.php");
$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username = $_SESSION['username'];

$misusername =  $_SESSION['username'];




if(isset($_POST['changeMonth'])){
$month = $_POST['selectedMonth'];
$selectedYear = $_POST['selectedYear'];

$_SESSION['selectedMonth'] = $month;
$_SESSION['selectedYear'] = $selectedYear;


}



$sqllink = "SELECT `link` FROM `setting`";
$resultlink = mysqli_query($con, $sqllink);
$link = "";
while($listlink=mysqli_fetch_assoc($resultlink))
{
$link=$listlink["link"];


  }

  $nname=$_SESSION['name'];
if(isset($_POST['addPMSAction'])){
  
    $deviceId = $_POST['deviceId'];
    $actionPms = $_POST['actionDetails'];

    $sql = "UPDATE `pmsaction` SET `approved`='1',`comments`='$actionPms',`approvedBy`='$nname' WHERE `id` =  $deviceId";
    $results = mysqli_query($con,$sql);

    
    
    }
    


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk</title>
    <link rel="shortcut icon" href="../resources/img/helpdesk.png">
    
    <!-- font awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" /> -->
    <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">


    
  
    <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

    <link rel="stylesheet" href="index.css">
     <!-- tailwind play cdn -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="../cdn_tailwindcss.js"></script>

  


    <!-- <link href="/dist/output.css" rel="stylesheet"> -->


     <!-- from flowbite cdn -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" /> -->
    <link rel="stylesheet" href="../node_modules/flowbite/dist/flowbite.min.css" />

    <!-- <link rel="stylesheet" href="css/style.css" /> -->




</head>
<body   class="static  bg-white dark:bg-gray-700"  >

    <!-- nav -->
    <?php require_once 'nav.php';?>


<!-- main -->






<div class=" ml-72 flex mt-16  left-10 right-5  flex-col  px-14 sm:px-8  pt-6 pb-14 z-50 ">
<div class="justify-center text-center flex items-start h-auto bg-gradient-to-r from-blue-900 to-teal-500 rounded-xl ">
<div class="text-center py-2 m-auto lg:text-center w-full">
        <!-- <h6 class="text-sm  tracking-tight text-gray-200 sm:text-lg">Good Day</h6> -->
        <!-- <div class="m-auto flex flex-col w-2/4  h-12">
<h2 class="text-xl font-bold tracking-tight text-gray-100 sm:text-xl">Total numbers of pending Job Order</h2>

</div> -->

<!--        
<div class="m-auto flex flex-col w-2/4">

<div class="mt-0 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 ">

  <div class="flex items-start rounded-xl bg-teal-700 dark:bg-white p-4 shadow-lg">
    <div class="flex h-12 w-12 overflow-hidden items-center justify-center rounded-full border border-red-100 bg-red-50">
    <img src="../resources/img/Engineer.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

    </div>

    <div class="ml-3">
      <h2 class="font-semibold text-gray-100 dark:text-gray-900">FEM Pending</h2>
      <p class="mt-2 text-xl text-left text-gray-100"><?php 
                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE request_to = 'fem' AND status2 = 'inprogress'";
                                        $result = mysqli_query($con, $sql1);
                                        while($count=mysqli_fetch_assoc($result))
                                        {
                                        echo $count["pending"];
                                      
                                        }
                            ?></p>
    </div>
  </div>
  <div class="flex items-start rounded-xl bg-sky-900 dark:bg-white p-4 shadow-lg">
    <div class="flex h-12 w-12 items-center overflow-hidden  justify-center rounded-full border border-indigo-100 bg-indigo-50">
    <img src="../resources/img/itboy.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

    </div>

    <div class="ml-3">
      <h2 class="font-semibold text-gray-100 dark:text-gray-900">MIS Pending</h2>
      <p class="mt-2 text-xl text-left text-gray-100"><?php 
                                        $sql1 = "SELECT COUNT(id) as 'pending' FROM request WHERE request_to = 'mis' AND status2 = 'inprogress'";
                                        $result = mysqli_query($con, $sql1);
                                        while($count=mysqli_fetch_assoc($result))
                                        {
                                        echo $count["pending"];
                                      
                                        }
                            ?></p>
    </div>
  </div>
 
</div>
</div>  -->
<div class="FrD3PA">
    <div class="QnQnDA" tabindex="-1">
        <div  role="tablist" class="_6TVppg sJ9N9w">
            <div class="uGmi4w">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="tabExample" role="tablist">

                <li role="presentation">
                                    <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                        <button id="overallTab" type="button" role="tab"
                                            aria-controls="overall"
                                            class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA"
                                            aria-selected="false">
                                            <div class="_1cZINw">
                                                <div class="_qiHHw Ut_ecQ kHy45A">

                                                <span class="gkK1Zg jxuDbQ"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24s10.7 24 24 24 24-10.7 24-24S37.3 0 24 0zM11.9 15.2c.1-.1.2-.1.2-.1 1.6-.5 2.5-1.4 3-3 0 0 0-.1.1-.2l.1-.1c.1 0 .2-.1.3-.1.4 0 .5.3.5.3.5 1.6 1.4 2.5 3 3 0 0 .1 0 .2.1s.1.2.1.3c0 .4-.3.5-.3.5-1.6.5-2.5 1.4-3 3 0 0-.1.3-.4.3-.6.1-.7-.2-.7-.2-.5-1.6-1.4-2.5-3-3 0 0-.4-.1-.4-.5l.3-.3zm24.2 18.6c-.5.2-.9.6-1.3 1s-.7.8-1 1.3c0 0 0 .1-.1.2-.1 0-.1.1-.3.1-.3-.1-.4-.4-.4-.4-.2-.5-.6-.9-1-1.3s-.8-.7-1.3-1c0 0-.1 0-.1-.1-.1-.1-.1-.2-.1-.3 0-.3.2-.4.2-.4.5-.2.9-.6 1.3-1s.7-.8 1-1.3c0 0 .1-.2.4-.2.3 0 .4.2.4.2.2.5.6.9 1 1.3s.8.7 1.3 1c0 0 .2.1.2.4 0 .4-.2.5-.2.5zm-.7-8.7s-4.6 1.5-5.7 2.4c-1 .6-1.9 1.5-2.4 2.5-.9 1.5-2.2 5.4-2.2 5.4-.1.5-.5.9-1 .9v-.1.1c-.5 0-.9-.4-1.1-.9 0 0-1.5-4.6-2.4-5.7-.6-1-1.5-1.9-2.5-2.4-1.5-.9-5.4-2.2-5.4-2.2-.5-.1-.9-.5-.9-1h.1-.1c0-.5.4-.9.9-1.1 0 0 4.6-1.5 5.7-2.4 1-.6 1.9-1.5 2.4-2.5.9-1.5 2.2-5.4 2.2-5.4.1-.5.5-.9 1-.9s.9.4 1 .9c0 0 1.5 4.6 2.4 5.7.6 1 1.5 1.9 2.5 2.4 1.5.9 5.4 2.2 5.4 2.2.5.1.9.5.9 1h-.1.1c.1.5-.2.9-.8 1.1z"></path></svg></span>

                                                </div>
                                            </div>
                                            <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">PMS</p>
                                        </button></div>
                                </li>
                 
            
              
                    </ul>
            </div>
            <div class="rzHaWQ theme light dark:bg-gray-700" id="diamond" style="transform: translateX(50px) translateY(2px) rotate(135deg);"></div>
        </div>
    </div>
</div>
<div class="hidden"> 
<ul class="uGmi4w  mb-1 m-4 flex text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow  dark:divide-gray-700 dark:text-gray-400">
    <li class="w-full relative">
        <a href="#" class="inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">For Approval</a>
        <div class="rzHaWQ theme light" style="transform: translateX(198px) translateY(2px) rotate(135deg);"></div>
  
    </li>
    <li class="w-full">
        <a href="#" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Dashboard</a>
    </li>
    <li class="w-full">
        <a href="#" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Settings</a>
    </li>
    <li class="w-full">
        <a href="#" class="inline-block w-full p-4 bg-white rounded-r-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Invoice</a>
    </li>

</ul>

</div>

</div>
</div>



<!-- <div class="grid grid-cols-2 m-auto flex flex-col w-full h-20 mt-4">
<div class="flex items-center justify-center h-full bg-teal-500 p-2">
<div class=" flex h-full w-20 overflow-hidden items-center justify-center rounded-full border border-red-100 bg-red-50">
    <img src="../resources/img/list.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    </div>
    <div class="ml-3">
      <h2 class="font-semibold text-4xl text-gray-100 dark:text-gray-900">My Job Order</h2>
    </div>
</div>
<div class="h-full bg-gray-500"></div>


</div> -->
<div class="mt-10">
  
<form method = "POST">
    <div class="flex">
        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Month</label>
        <select id="states" name="selectedMonth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100  border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                 <?php 

            $date = new DateTime('01-01-2023');

            $month = $_SESSION['selectedMonth'];
          for($i=1; $i<=12; $i++){
            $Month = $date->format('F');
            if($month == $Month){
                echo "<option selected value='$Month'>$Month</option>";
            }
            else{
            echo "<option value='$Month'>$Month</option>";

            }
            $date->modify('+1 month');

          }
         
           ?>

    </select>
        <div class="relative w-full">
            <input type="number"  value="<?php echo $_SESSION['selectedYear']; ?>" name="selectedYear"id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Year" required>
            <button type="submit" name="changeMonth" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
        </div>
    </div>
    

</form>

</div>
<div id="myTabContent" class="mt-1">

    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-200" id="overAll" role="tabpanel" aria-labelledby="dashboard-tab">
    <section class="mt-10">
<table id="pmsTable" class="display" style="width:100%">
        <thead>
            <tr>
              <th>No.</th>
               <th>Computer Name</th>
                <th>Action</th>
                <th>User</th>
                <th>Department</th>
                <th>Type</th>
                <th>Activity</th>
                <th>Date</th>
                <th>Performed By</th>

                

            </tr>
        </thead>
        <tbody>
        <?php
                 $date = new DateTime(); 
                 $month = $_SESSION['selectedMonth'];
                 $year = $_SESSION['selectedYear'];

                 $sql="select `$month` from `pmsschedule` ";
                 $monthResult = mysqli_query($con,$sql);
 
                 
                 while($row=mysqli_fetch_assoc($monthResult)){
                 $scheduledDepartment =  $row[$month];
                 }

                 $departments = explode(" and ", $scheduledDepartment);
                 
                 if (count($departments) == 1) {
                   $DepartmentOnly = $departments[0];
                   $sql="SELECT devices.department, devices.type,  devices.user, devices.os, devices.computerName,  devices.email, pmsaction.id ,pmsaction.deviceName, pmsaction.action, pmsaction.performedBy, pmsaction.Date, pmsaction.month, pmsaction.year, pmsaction.comments, pmsaction.approved
                   FROM devices
                   LEFT JOIN pmsaction
                       ON devices.computerName = pmsaction.deviceName AND pmsaction.year = '$year'
                   WHERE devices.department = '$DepartmentOnly'
                       AND devices.type != 'Tablet' AND devices.deactivated = 0
                       AND (pmsaction.year = '$year' OR pmsaction.year IS NULL)
                       AND (pmsaction.month = '$month' OR pmsaction.month IS NULL);";
                   $result = mysqli_query($con,$sql);
   
                 } else if (count($departments) > 1) {
                   $department1 = $departments[0];
                   $department2 = $departments[1];

                   $sql="SELECT  devices.department,  devices.type,  devices.user, devices.os, devices.computerName,  devices.email, pmsaction.id ,pmsaction.deviceName, pmsaction.action, pmsaction.performedBy, pmsaction.Date, pmsaction.month, pmsaction.year, pmsaction.comments, pmsaction.approved FROM devices LEFT JOIN pmsaction ON devices.computerName = pmsaction.deviceName AND pmsaction.year = '$year' WHERE (devices.department = '$department1' OR devices.department = '$department2') AND devices.type != 'Tablet' AND devices.deactivated = 0 AND  (pmsaction.year = '$year' OR pmsaction.year IS NULL)
                   AND (pmsaction.month = '$month' OR pmsaction.month IS NULL);";
                   $result = mysqli_query($con,$sql);
   
                 } 


                
                 $increment = 1;
                 while($row=mysqli_fetch_assoc($result)){
             ?>
             <tr class="">
             <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $increment;?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['computerName'];?> 
              </td>
              <td >
                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                    <button type="button" id="viewdetails"   onclick="modalShow(this)"  <?php if($row['action']=="" || $row['approved']==true  ) {echo "disabled" ;}?>
                    data-deviceid="<?php echo $row['id'];?>" 
                    data-email="<?php echo $row['email'];?>" 
                    data-user="<?php echo $row['user'];?>" 

                   class="inline-block px-6 py-2.5 <?php if($row['action']=="" || $row['approved']==true) {echo "text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed" ;} else{echo "bg-blue-600 text-white";}?> font-medium text-xs leading-tight uppercase rounded shadow-md <?php if($row['action']=="") {echo "" ;} else{echo "hover:bg-blue-700 hover:shadow-lg";}?> focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> 
                  Approve
                    </button>
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['user'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['department'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['type'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['action'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php 
              if($row['Date'] !=""){
                $date = new DateTime($row['Date']);
                $date = $date->format('F d, Y');
                echo $date;
              }
              ?> 
              </td>
              </td>
              
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['performedBy'];?> 
              </td>
                 </tr>
             <?php
             $increment++;
                 }

        ?>
          </tbody>
    </table>

</section>  
 </div>

</div>




 </div> 



 


<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <form action="" method="POST">
            <!-- Modal header -->
            <input type="text" id="deviceId" name="deviceId" class="hidden">
            <input type="text" id="deviceEmail" name="deviceEmail" class="hidden">
            <input type="text" id="deviceUser" name="deviceUser" class="hidden">

                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add PMS Action
                </h3>
                <button  onclick="modalHide()"type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class=" items-center p-6 space-y-2">
               
                <div id="actionDetailsDiv" class="">
                <label for="message" class="py-4 col-span-1 font-semibold text-gray-400 dark:text-gray-400">Leave a comment</label>
                <textarea id="actionDetails" name="actionDetails" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            
                </div>
                
               
            </div> 
            
  
            <div id="buttonAdd" class=" items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button  type="submit" name="addPMSAction" class="shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80  w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Approve</button>
            </div>
          
        </form>
            
        </div>
    </div>
</div>




 
    

<!-- flowbite javascript -->

<!-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> -->

<script src="../node_modules/flowbite/dist/flowbite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>

    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="index.js"></script>

<script>
    const $targetElModal = document.getElementById('defaultModal');

// options with default values
const optionsModal = {
  placement: 'center-center',
  backdrop: 'dynamic',
  backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
  closable: true,
  onHide: () => {
      console.log('modal is hidden');
  },
  onShow: () => {
      console.log('modal is shown');
    const buttonModal = document.querySelector("#viewdetails");

    //   console.log(section);
  },
  onToggle: () => {
      console.log('modal has been toggled');

  }
};
const modal = new Modal($targetElModal, optionsModal);

function modalShow(element){

    document.getElementById("deviceId").value =element.getAttribute("data-deviceid");
    document.getElementById("deviceUser").value =element.getAttribute("data-user");
    document.getElementById("deviceEmail").value =element.getAttribute("data-email");


    
    modal.toggle();

}
function modalHide(){
    modal.toggle();

}
    // set the drawer menu element
const $targetEl = document.getElementById('sidebar');

// options with default values
const options = {
  placement: 'left',
  backdrop: false,
  bodyScrolling: true,
  edge: false,
  edgeOffset: '',
  backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',
  onHide: () => {
      console.log('drawer is hidden');
  },
  onShow: () => {
      console.log('drawer is shown');
  },
  onToggle: () => {
      console.log('drawer has been toggled');
  }
};

/*
* targetEl: required
* options: optional
*/
const drawer = new Drawer($targetEl, options);
drawer.show();
var show = true;
function shows(){
    if(show){
        drawer.hide();
        show = false;
    }
    else{
        drawer.show();
        show = true;
    }


}





// // Code for tabs
const tabElements= [

    {
        id: 'overAll',
        triggerEl: document.querySelector('#overallTab'),
        targetEl: document.querySelector('#overAll')
    },

];

// options with default values
const taboptions = {
    defaultTabId: 'overAll',
    activeClasses: 'text-amber-400 hover:text-amber-400 dark:text-amber-400 dark:hover:text-amber-400 border-amber-600 dark:border-amber-500',
    inactiveClasses: 'text-gray-300 hover:text-amber-500 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
        console.log('tab is shown');
    }
};

/*
* tabElements: array of tab objects
* options: optional
*/
const tabs = new Tabs(tabElements, taboptions);

// open tab item based on id
tabs.show('overAll');


// // get the tab object based on ID
// tabs.getTab('adminApproval1')

// // get the current active tab object
// tabs.getActiveTab()


function goToAdmin(){
    const myElement = document.querySelector('#diamond');
    
    document.getElementById("telephone").disabled = true;
    document.getElementById("datestart").disabled = true;
    document.getElementById("datefinish").disabled = true;
    document.getElementById("message").disabled = true;
    document.getElementById("computername").disabled = true;

    $("#assignedPersonnelDiv").addClass("hidden");

    $("#buttondiv").addClass("hidden");

    $("#actionDetailsDiv").addClass("hidden");

    

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(180px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}

function goToMis(){
    document.getElementById("telephone").disabled = true;
    document.getElementById("datestart").disabled = true;
    document.getElementById("datefinish").disabled = true;
    document.getElementById("message").disabled = true;
    document.getElementById("computername").disabled = true;
    
    $("#assignedPersonnelDiv").removeClass("hidden");
    $("#buttondiv").addClass("hidden");


    $("#actionDetailsDiv").addClass("hidden");

    const myElement = document.querySelector('#diamond');

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(300px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}
function goToRate(){
    document.getElementById("telephone").disabled = true;
    document.getElementById("datestart").disabled = true;
    document.getElementById("datefinish").disabled = true;
    document.getElementById("message").disabled = true;
    document.getElementById("computername").disabled = true;
    $("#assignedPersonnelDiv").removeClass("hidden");


    $("#actionDetailsDiv").removeClass("hidden");

    $("#buttondiv").addClass("hidden");


    const myElement = document.querySelector('#diamond');

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(420px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}
function goToFinished(){
    document.getElementById("telephone").disabled = true;
    document.getElementById("datestart").disabled = true;
    document.getElementById("datefinish").disabled = true;
    document.getElementById("message").disabled = true;
    document.getElementById("computername").disabled = true;
    $("#assignedPersonnelDiv").removeClass("hidden");

    $("#ratingstar").removeClass("hidden");

    $("#actionDetailsDiv").removeClass("hidden");
    $("#actionsDiv").removeClass("hidden");

    $("#buttondiv").removeClass("hidden");
    $("#reasonCancelDiv").addClass("hidden");
    $("#cancelledByDiv").addClass("hidden");
    $("#actualDateFinishedDiv").removeClass("hidden");
    const myElement = document.querySelector('#diamond');

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(50px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}
function goToOverall(){
    document.getElementById("telephone").disabled = true;
    document.getElementById("datestart").disabled = true;
    document.getElementById("datefinish").disabled = true;
    document.getElementById("message").disabled = true;
    document.getElementById("computername").disabled = true;
    $("#assignedPersonnelDiv").removeClass("hidden");

    $("#ratingstar").removeClass("hidden");

    $("#actionDetailsDiv").removeClass("hidden");
    $("#actionsDiv").removeClass("hidden");

    $("#buttondiv").removeClass("hidden");
    $("#reasonCancelDiv").addClass("hidden");
    $("#cancelledByDiv").addClass("hidden");
    $("#actualDateFinishedDiv").removeClass("hidden");
    const myElement = document.querySelector('#diamond');

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(160px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}
function goToCancelled(){
    document.getElementById("telephone").disabled = true;
    document.getElementById("datestart").disabled = true;
    document.getElementById("datefinish").disabled = true;
    document.getElementById("message").disabled = true;
    document.getElementById("computername").disabled = true;
    $("#assignedPersonnelDiv").addClass("hidden");
    $("#reasonCancelDiv").removeClass("hidden");
    $("#cancelledByDiv").removeClass("hidden");
    $("#actualDateFinishedDiv").addClass("hidden");
    $("#ratingstar").addClass("hidden");
    $("#actionsDiv").addClass("hidden");

    


    
    $("#actionDetailsDiv").addClass("hidden");

    $("#buttondiv").addClass("hidden");


    const myElement = document.querySelector('#diamond');

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(280px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}
function goToHead(){
    $("#buttondiv").removeClass("hidden");
   
    $("#actionDetailsDiv").addClass("hidden");
    $("#assignedPersonnelDiv").addClass("hidden");

    document.getElementById("telephone").disabled =false;
    document.getElementById("computername").disabled = false;
    document.getElementById("datestart").disabled = false;
    document.getElementById("datefinish").disabled = false;
    document.getElementById("message").disabled = false;
    const myElement = document.querySelector('#diamond');

// Get the current transform value
const currentTransform = myElement.style.transform = 'translateX(50px) translateY(2px) rotate(135deg)';


// transform: translateX(55px) translateY(2px) rotate(135deg);
}
function cancellation(){
    document.getElementById("reasonCancel").required = true;
}
function exitcancellation(){
    document.getElementById("reasonCancel").required = false;
}


var setdate2;
var setdate;


function testDate() {
    var chosendate = document.getElementById("datestart").value;


     console.log(chosendate)
    const x = new Date();
    const y = new Date(chosendate);

    if (x < y) {
        console.log("Valid");
        var monthNumber = new Date().getMonth() + 1;
        const asf = new Date(chosendate);
        asf.setDate(asf.getDate() + 1);
        var setdate = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
        document.getElementById("datefinish").value = setdate;

        setdate2 = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
        console.log(setdate)

    } else {
        alert("Sorry your request date is not accepted!")

        const z = new Date();
        var monthNumber = new Date().getMonth() + 1
        z.setDate(z.getDate() + 1);
        console.log(z);
        var setdate = z.getFullYear() + "-" + monthNumber + "-" + z.getDate();
        document.getElementById("datestart").value = setdate;
        console.log(setdate)

        const asf2 = new Date(setdate);
        asf2.setDate(asf2.getDate() + 2);
        setdate2 = asf2.getFullYear() + "-" + monthNumber + "-" + asf2.getDate();
        document.getElementById("datefinish").value = setdate2;

    }
}

function endDate() {
    console.log(setdate2);


    var chosendate3 = document.getElementById("datefinish").value;
    console.log(chosendate3);

    const x = new Date(setdate2);
    const y = new Date(chosendate3);

    if (x < y) {

    } else {
        alert("Sorry your request date is not accepted!")
        document.getElementById("datefinish").value = setdate2;

    }
}
function rate(id){
    console.log(id);

    if(id=="rate1"){
        document.getElementById("rateScore").value='1';
        $("#rate1").removeClass("text-gray-300");
        $("#rate2").removeClass("text-gray-300");
        $("#rate3").removeClass("text-gray-300");
        $("#rate4").removeClass("text-gray-300");
        $("#rate5").removeClass("text-gray-300");

        $("#rate1").removeClass("text-yellow-400");
        $("#rate2").removeClass("text-yellow-400");
        $("#rate3").removeClass("text-yellow-400");
        $("#rate4").removeClass("text-yellow-400");
        $("#rate5").removeClass("text-yellow-400");

        $("#rate1").addClass("text-yellow-400");
        $("#rate2").addClass("text-gray-300");
        $("#rate3").addClass("text-gray-300");
        $("#rate4").addClass("text-gray-300");
        $("#rate5").addClass("text-gray-300");
    }
    else if(id=="rate2"){
        document.getElementById("rateScore").value='2';

        $("#rate1").removeClass("text-gray-300");
        $("#rate2").removeClass("text-gray-300");
        $("#rate3").removeClass("text-gray-300");
        $("#rate4").removeClass("text-gray-300");
        $("#rate5").removeClass("text-gray-300");

        $("#rate1").removeClass("text-yellow-400");
        $("#rate2").removeClass("text-yellow-400");
        $("#rate3").removeClass("text-yellow-400");
        $("#rate4").removeClass("text-yellow-400");
        $("#rate5").removeClass("text-yellow-400");

        $("#rate1").addClass("text-yellow-400");
        $("#rate2").addClass("text-yellow-400");

        $("#rate3").addClass("text-gray-300");
        $("#rate4").addClass("text-gray-300");
        $("#rate5").addClass("text-gray-300");
    
    }
    else if(id=="rate3"){
        document.getElementById("rateScore").value='3';

        $("#rate1").removeClass("text-gray-300");
        $("#rate2").removeClass("text-gray-300");
        $("#rate3").removeClass("text-gray-300");
        $("#rate4").removeClass("text-gray-300");
        $("#rate5").removeClass("text-gray-300");

        $("#rate1").removeClass("text-yellow-400");
        $("#rate2").removeClass("text-yellow-400");
        $("#rate3").removeClass("text-yellow-400");
        $("#rate4").removeClass("text-yellow-400");
        $("#rate5").removeClass("text-yellow-400");

        $("#rate1").addClass("text-yellow-400");
        $("#rate2").addClass("text-yellow-400");
        $("#rate3").addClass("text-yellow-400");

        $("#rate4").addClass("text-gray-300");
        $("#rate5").addClass("text-gray-300");
    
    }
    else if(id=="rate4"){
        document.getElementById("rateScore").value='4';

        $("#rate1").removeClass("text-gray-300");
        $("#rate2").removeClass("text-gray-300");
        $("#rate3").removeClass("text-gray-300");
        $("#rate4").removeClass("text-gray-300");
        $("#rate5").removeClass("text-gray-300");

        $("#rate1").removeClass("text-yellow-400");
        $("#rate2").removeClass("text-yellow-400");
        $("#rate3").removeClass("text-yellow-400");
        $("#rate4").removeClass("text-yellow-400");
        $("#rate5").removeClass("text-yellow-400");

        $("#rate1").addClass("text-yellow-400");
        $("#rate2").addClass("text-yellow-400");
        $("#rate3").addClass("text-yellow-400");
        $("#rate4").addClass("text-yellow-400");

        $("#rate5").addClass("text-gray-300");
    
    }
    else if(id=="rate5"){
        document.getElementById("rateScore").value='5';

        $("#rate1").removeClass("text-gray-300");
        $("#rate2").removeClass("text-gray-300");
        $("#rate3").removeClass("text-gray-300");
        $("#rate4").removeClass("text-gray-300");
        $("#rate5").removeClass("text-gray-300");

        $("#rate1").removeClass("text-yellow-400");
        $("#rate2").removeClass("text-yellow-400");
        $("#rate3").removeClass("text-yellow-400");
        $("#rate4").removeClass("text-yellow-400");
        $("#rate5").removeClass("text-yellow-400");

        $("#rate1").addClass("text-yellow-400");
        $("#rate2").addClass("text-yellow-400");
        $("#rate3").addClass("text-yellow-400");
        $("#rate4").addClass("text-yellow-400");
        $("#rate5").addClass("text-yellow-400");

    
    }
}

$("#sidehome").removeClass("bg-gray-200");
$("#sideuser").removeClass("bg-gray-200");
$("#sideMyRequest").removeClass("bg-gray-200");
$("#sidepms").addClass("bg-gray-200 dark:bg-gradient-to-br from-green-400 to-blue-600");

</script>

</body>
</html>