<?php 


//Set the session timeout for 1 hour

$timeout = 500;

//Set the maxlifetime of the session

ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session

ini_set( "session.cookie_lifetime", $timeout );

  // session_start();
  
$s_name = session_name();
$url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 500; URL=$url1");
//Check the session exists or not

if(isset( $_COOKIE[ $s_name ] )) {

    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );

    
}

else

    echo "Session is expired.<br/>";


// end of session timeout>";




session_start();

    if(!isset($_SESSION['connected'])){
      header("location: index.php");
    }


        
// connection php and transfer of session
include ("includes/connect.php");
$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];

if(isset($_POST['approveRequest'])){
  $requestID = $_POST['requestID'];
  $remarks = $_POST['remarks'];
  $date = date("ym-dH-is");
  $username = $_SESSION['name'];
  $sql = "UPDATE `request` SET `status2`='For Admin Approval',`approving_head`='$username',`head_approved_date`='$date',`head_remarks`='$remarks' WHERE `id` = '$requestID';";
     $results = mysqli_query($con,$sql);

  }



  if(isset($_POST['dissapproveRequest'])){
    $requestID = $_POST['requestID'];
    $remarks = $_POST['remarks'];
    $date = date("ym-dH-is");
    $username = $_SESSION['name'];
    $sql = "UPDATE `request` SET `status2`='Disapproved by head',`approving_head`='$username',`head_approved_date`='$date',`head_remarks`='$remarks' WHERE `id` = '$requestID';";
       $results = mysqli_query($con,$sql);
  
    }
?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEM MIS Helpdesk</title>


    <!-- font awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" /> -->
    <link rel="stylesheet" href="./fontawesome-free-6.2.0-web/css/all.min.css">
    

     <!-- tailwind play cdn -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="./cdn_tailwindcss.js"></script>

     <!-- from flowbite cdn -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" /> -->
    <link rel="stylesheet" href="node_modules/flowbite/dist/flowbite.min.css" />

    <!-- modal and other tailwind elements -->
    <link rel="stylesheet" href="./node_modules/tw-elements/dist/css/index.min.css" />

    <link rel="shortcut icon" href="resources/img/helpdesk.png">
    <!-- <link rel="stylesheet" href="css/style.css" /> -->

    <!-- tailwind element -->
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" /> -->

<!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <!-- darkmode -->
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    </script>






</head>
<body  onload=navFuntion() class="static  bg-white dark:bg-gray-900"  >

    <!-- nav -->
    <?php require_once 'nav.php';?>

   

    <div class=" flex mt-24   left-10 right-5 flex-col  px-14 sm:px-14  pt-6 pb-14 z-50  ">
<!-- <div class="  fixed top-20 left-10 right-5    flex flex-col pt-6 px-2 sm:px-4 py-2.5  "> -->

  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8  ">


    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">Job Order:  <span class="text-blue-600 dark:text-blue-500">All Request</span></h1>
       
        <table class="min-w-full text-center">
          <thead class="border-b bg-gray-800">
            <tr>
              <th scope="col" class="text-sm font-small text-white px-2 py-4">
               No.
              </th>

              <th scope="col" class="text-sm font-small text-white px-2 py-4">
              View JO
              </th>

              <!-- <th scope="col" class="text-sm font-small text-white px-2 py-4">
              Action
              </th> -->

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Status
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                JO No.
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Assign Section
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Date of Request
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Requestor
              </th>
              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Department
              </th>
             


            


              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                In-Charge
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Target Date Start
              </th>


              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Target Date Finish
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
               Attachment
              </th>

              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
               Category
              </th>


             

             


              <!-- <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                    Action
                </th> -->

            </tr>
          </thead class="border-b">



              

          <tbody>




          

          
<!--  start calling record on db -->

<?php
                $a=1;
                    //  include ("includes/connect.php");
                 
                 
                  $sql="select * from request  order by ticket_no ASC  ";
                  $result = mysqli_query($con,$sql);
                
                 //  if(isset($_POST['searchh']  )){
                    //   $search=mysqli_real_escape_string($mysqli,$_POST['search']);
                  //     if($search!=""){
                   //        $sql="select * from request where suppliername like '%$search%' or contact_person like '%$search%'"; 
                           
                 //  }
             //  }
           
                while($row=mysqli_fetch_assoc($result)){

                
                  ?>













              <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-small text-gray-900"><?php echo $a++?></td>



              <td class="px-6 py-4 text-right">
                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                    <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-bs-jonumber="<?php echo $row['ticket_no'];?>" data-bs-id="<?php echo $row['id'];?>" data-bs-jorequest="<?php echo $row['request_details'];?>">                    View JO
                    </button>
                </td>
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      
    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        

        <h5 class="text-xl font-medium leading-normal text-gray-800" id="ticketnumbertitle">
          JO Number////////: 
        </h5>
                

        <button type="button"
          class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
          data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
      <h5 class="text-lg font-medium leading-normal text-blue-800">Details of Request : </h5>
                </div>
      <div class="modal-header flex flex-shrink-0 items-center justify-between p-4  rounded-t-md">
      <p class="text-sm font-medium leading-normal text-gray-800" id="ticketdetails">
         details////////: 
                </p>
      </div>



      <form method="POST" action="allrequest.php">
      <div class="modal-body relative p-4">
      <div class="mb-6">
    <!-- <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label> -->
    <input type="text" name="requestID" id="idInput" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

</div>
      </div>
      <div
        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
        <button  
          class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
          data-bs-dismiss="modal">
          Close
        </button>
        
       
      </div>
      </form>
    </div>
  </div>
</div>




 

              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['status'];?> 
              </td>

              


              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['ticket_no'];?> 
              </td>

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['request_to'];?> 
              </td>

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['date_filled'];?> 
              </td>

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['requestor'];?> 
              </td>

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['department'];?> 
              </td>

             


              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['perform_by'];?> 
              </td>


              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['reqstart_date'];?> 
              </td>


              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['reqfinish_date'];?> 
              </td>



              <!-- to view pdf -->
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?php if ($row['attachment'] != null){
                ?>
                <a class="text-sm text-blue-700 font-light px-6 py-4 whitespace-nowrap" href="<?php echo $row['attachment'];?>" target="_blank">View</a>
                <?php
                } else{
                  ?>
                <a class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap">Empty...</a>
                <?php
                }
                  ?>
              
              </td>



              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['request_category'];?> 
              </td>




              




                </tr>
                  <?php

                }
              
               ?>




           
              <!-- <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                MIS-001
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                10/23/2022
              </td>

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                Mark
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                Production
              </td>
             
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                Request to check computer due to always hang up and also alway no network
              </td>

             

              <td class="text-sm text-gray-700 font-light px-6 py-4 whitespace-nowrap">
                Un-Assigned
              </td>

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                10/28/2022
              </td> -->

             

              <!-- <td class="py-4 px-6">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a>
                </td> -->

<!--          
  
 -->



              <!-- <td class="py-4 px-6">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a>
                </td>

              </tr> -->

              

         


           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  

























    

<!-- flowbite javascript -->
<!-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> -->
<script src="./node_modules/flowbite/dist/flowbite.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> -->
<script src="./node_modules/tw-elements/dist/js/index.min.js"></script>




<!-- darkmode script -->
<script>  



const exampleModal = document.getElementById('exampleModalCenter')
exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  const button = event.relatedTarget
  // Extract info from data-bs-* attributes
  const requestId = button.getAttribute('data-bs-id');
  const joNumber = button.getAttribute('data-bs-jonumber')
  const joRequest = button.getAttribute('data-bs-jorequest')

  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  const modalId = exampleModal.querySelector('#idInput')
  const ticketNo = exampleModal.querySelector('#ticketnumbertitle')
  const joDetails = exampleModal.querySelector('#ticketdetails')


  
  modalId.value = `${requestId}`
  ticketNo.textContent = `JO No. : ${joNumber}`
  joDetails.textContent = ` ${joRequest}`

})









var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
    
});


// active page highlight

var activepage = document.getElementById("allrequest");
activepage.classList.remove("text-gray-700");
activepage.classList.add("text-blue-700");
activepage.classList.remove("dark:text-gray-400");
activepage.classList.add("dark:text-white");

</script>

</body>
</html>