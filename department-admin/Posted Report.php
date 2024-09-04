 <!-- session for who is login user    -->
 <?php




    //Set the session timeout for 1 hour

    $timeout = 3600;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //Set the maxlifetime of the session

    ini_set("session.gc_maxlifetime", $timeout);

    //Set the cookie lifetime of the session

    ini_set("session.cookie_lifetime", $timeout);

    // session_start();

    $s_name = session_name();
    $url1 = $_SERVER['REQUEST_URI'];

    //Check the session exists or not

    if (isset($_COOKIE[$s_name])) {

        setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
    } else

        echo "Session is expired.<br/>";


    // end of session timeout>";






    session_start();

    if (!isset($_SESSION['connected'])) {
        header("location: ../index.php");
    }



    // connection php and transfer of session
    include("../includes/connect.php");
   

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
     <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

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

 <body class="static  bg-white dark:bg-gray-900">

     <!-- nav -->
     <?php require_once 'nav.php'; ?>


     <!-- main -->






     <div class=" ml-72 flex mt-16  left-10 right-5  flex-col  px-14 sm:px-8  pt-6 pb-14 z-50 ">
         <div class="justify-center text-center flex items-start h-auto bg-gradient-to-r from-blue-900 to-teal-500 rounded-xl ">
             <div class="text-center py-2 m-auto lg:text-center w-full">
               
                 <div class="FrD3PA">
                     <div class="QnQnDA" tabindex="-1">
                         <div role="tablist" class="_6TVppg sJ9N9w">
                             <div class="uGmi4w">
                                 <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-white dark:text-gray-400" id="tabExample" role="tablist">

                                     <li role="presentation">
                                         <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                             <button id="overallTab" type="button" role="tab" aria-controls="overall" class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA" aria-selected="false">
                                                 <div class="_1cZINw">
                                                     <div class="_qiHHw Ut_ecQ kHy45A">

                                                         <span class="gkK1Zg jxuDbQ"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                                                 <path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24s10.7 24 24 24 24-10.7 24-24S37.3 0 24 0zM11.9 15.2c.1-.1.2-.1.2-.1 1.6-.5 2.5-1.4 3-3 0 0 0-.1.1-.2l.1-.1c.1 0 .2-.1.3-.1.4 0 .5.3.5.3.5 1.6 1.4 2.5 3 3 0 0 .1 0 .2.1s.1.2.1.3c0 .4-.3.5-.3.5-1.6.5-2.5 1.4-3 3 0 0-.1.3-.4.3-.6.1-.7-.2-.7-.2-.5-1.6-1.4-2.5-3-3 0 0-.4-.1-.4-.5l.3-.3zm24.2 18.6c-.5.2-.9.6-1.3 1s-.7.8-1 1.3c0 0 0 .1-.1.2-.1 0-.1.1-.3.1-.3-.1-.4-.4-.4-.4-.2-.5-.6-.9-1-1.3s-.8-.7-1.3-1c0 0-.1 0-.1-.1-.1-.1-.1-.2-.1-.3 0-.3.2-.4.2-.4.5-.2.9-.6 1.3-1s.7-.8 1-1.3c0 0 .1-.2.4-.2.3 0 .4.2.4.2.2.5.6.9 1 1.3s.8.7 1.3 1c0 0 .2.1.2.4 0 .4-.2.5-.2.5zm-.7-8.7s-4.6 1.5-5.7 2.4c-1 .6-1.9 1.5-2.4 2.5-.9 1.5-2.2 5.4-2.2 5.4-.1.5-.5.9-1 .9v-.1.1c-.5 0-.9-.4-1.1-.9 0 0-1.5-4.6-2.4-5.7-.6-1-1.5-1.9-2.5-2.4-1.5-.9-5.4-2.2-5.4-2.2-.5-.1-.9-.5-.9-1h.1-.1c0-.5.4-.9.9-1.1 0 0 4.6-1.5 5.7-2.4 1-.6 1.9-1.5 2.4-2.5.9-1.5 2.2-5.4 2.2-5.4.1-.5.5-.9 1-.9s.9.4 1 .9c0 0 1.5 4.6 2.4 5.7.6 1 1.5 1.9 2.5 2.4 1.5.9 5.4 2.2 5.4 2.2.5.1.9.5.9 1h-.1.1c.1.5-.2.9-.8 1.1z"></path>
                                                             </svg></span>

                                                     </div>
                                                 </div>
                                                 <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Reports</p>
                                             </button>
                                         </div>
                                     </li>



                                 </ul>
                             </div>
                             <div class="rzHaWQ theme light" id="diamond" style="transform: translateX(50px) translateY(2px) rotate(135deg);"></div>
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
         <div id="myTabContent">

             <div class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800" >
                 <?php include 'postedReports.php'; ?>
             </div>

         </div>




     </div>






     <!-- Main modal -->
     



     <!-- flowbite javascript -->

     <!-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> -->

     <script src="../node_modules/flowbite/dist/flowbite.js"></script>
     <script src="../node_modules/jquery/dist/jquery.min.js"></script>

     <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>

     <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
     <script type="text/javascript" src="index.js"></script>

     <script>
          $("#sidehome").removeClass("bg-gray-200");
         $("#sidepms").removeClass("bg-gray-200");
         $("#sideMyRequest").removeClass("bg-gray-200");
        //  $("#sideuser").addClass("bg-gray-200");
         $("#sidereport").addClass("text-white bg-gradient-to-r from-blue-900 to-teal-500");
         $("#sideMyJo").addClass("text-white bg-gradient-to-r from-pink-500 to-orange-400");

         

         $("#sidehome1").removeClass("bg-gray-200");
         $("#sidepms1").removeClass("bg-gray-200");
         $("#sideMyRequest1").removeClass("bg-gray-200");
         $("#sideuser1").addClass("text-white bg-gradient-to-r from-blue-900 to-teal-500");
     </script>

 </body>

 </html>