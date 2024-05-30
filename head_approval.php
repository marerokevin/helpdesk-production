<?php 
//Set the session timeout for 1 hour

$timeout = 500;


// for sending mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;






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
  $sql = "UPDATE `request` SET `status2`='admin',`approving_head`='$username',`head_approval_date`='$date',`head_remarks`='$remarks' WHERE `id` = '$requestID';";
     $results = mysqli_query($con,$sql);


     // $email = $_POST['email'];

     $sql2 = "Select * FROM `sender` WHERE `id` = '1'";
        $result2 = mysqli_query($con, $sql2);
         while($list=mysqli_fetch_assoc($result2))
         {

          
             $account=$list["email"];
             $accountpass=$list["password"];

        
            }
             
$email='j.nemedez@glory.com.ph';
$subject ='JO Request for Admin Approval'." ";
$message = 'Hi '." ". 'Admin' .' You have pending JO for your Approval.<br/>'.
'Please login to http://192.168.5.246/helpdesk.com <br/>'.
'This is a system generated email. Please do not reply to this message.';

  require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.glorylocal.com.ph';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username =   $account;     // Your Email/ Server Email
    $mail->Password =  $accountpass;                     // Your Password
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );                         
    $mail->SMTPSecure = 'ssl';                           
    $mail->Port = 465;                                   

    //Send Email
    $mail->setFrom('Job_Order@glory.com.ph'); //eto ang mag front  notificationsys01@gmail.com
    
    //Recipients
    $mail->addAddress($email);              
    $mail->addReplyTo('Job_Order@glory.com.ph');
    
    //Attachment

    // if(!empty($filename)){
    //     $mail->addAttachment($location, $filename); 
    // }
   
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    $_SESSION['message'] = 'Message has been sent';
    header("location: head_approval.php");
} catch (Exception $e) {
    $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
}


// end of sending email



  }






  if(isset($_POST['dissapproveRequest'])){
    $requestID = $_POST['requestID'];
    $remarks = $_POST['remarks'];
    $date = date("ym-dH-is");
    $username = $_SESSION['name'];
    $sql = "UPDATE `request` SET `status2`='disapproved',`approving_head`='$username',`head_approval_date`='$date',`head_remarks`='$remarks' WHERE `id` = '$requestID';";
       $results = mysqli_query($con,$sql);




       $sql2 = "Select * FROM `sender` WHERE `id` = '1'";
        $result2 = mysqli_query($con, $sql2);
         while($list=mysqli_fetch_assoc($result2))
         {

          
             $account=$list["email"];
             $accountpass=$list["password"];

        
            }


        // $email = $_POST['email'];
$jomail=$_POST['jo_email'];
$jonumber=$_POST['jo_num'];

$email= $jomail;
$subject ='Disapprove JO from Department Head '. 'JO No. '. $jonumber." ";
$message = 'Hi '. ' You have disapproved JO request. '.$jonumber.'<br/>'.
'Please login to http://192.168.5.246/helpdesk.com <br/>'.
'This is a system generated email. Please do not reply to this message.';

  require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.glorylocal.com.ph';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $account;     // Your Email/ Server Email
    $mail->Password =  $accountpass;                     // Your Password
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );                         
    $mail->SMTPSecure = 'ssl';                           
    $mail->Port = 465;                                   

    //Send Email
    $mail->setFrom('Job_Order@glory.com.ph'); //eto ang mag front  notificationsys01@gmail.com
    
    //Recipients
    $mail->addAddress($email);              
    $mail->addReplyTo('Job_Order@glory.com.ph');
    
    //Attachment

    // if(!empty($filename)){
    //     $mail->addAttachment($location, $filename); 
    // }
   
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    $_SESSION['message'] = 'Message has been sent';
    header("location: head_approval.php");
} catch (Exception $e) {
    $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
}


// end of sending email


  
    }


?>







<!-- sending email -->













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
    <link rel="stylesheet" href="./node_modules/flowbite/dist/flowbite.min.css" />

    <link rel="shortcut icon" href="resources/img/helpdesk.png">
    <link rel="stylesheet" href="css/style.css" />

    <!-- tailwind element -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" /> -->
<link rel="stylesheet" href="./node_modules/tw-elements/dist/css/index.min.css" />



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

   

    <div class="   flex mt-24   left-10 right-5    flex flex-col  px-14 sm:px-14  pt-6 pb-14 z-50  ">
<!-- <div class="  fixed top-20 left-10 right-5    flex flex-col pt-6 px-2 sm:px-4 py-2.5  "> -->

  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8  ">


    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">Job Order :  <span class="text-blue-600 dark:text-blue-500">For Approval of Department Head</span></h1>
       
        <table class="min-w-full text-center">
          <thead class="border-b bg-gray-800">
            <tr>
              <th scope="col" class="text-sm font-small text-white px-2 py-4">
               No.
              </th>

              <th scope="col" class="text-sm font-small text-white px-2 py-4">
              Action
              </th>
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


              <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                Details
              </th>

             

              <!-- <th scope="col" class="text-sm font-medium text-white px-2 py-4">
                    Action
                </th> -->

            </tr>
          </thead class="border-b">



              

          <tbody>




          

          
<!--  start calling record on db -->

<?php

$nname=$_SESSION['name'];
$llevel=$_SESSION['level'];
$username=$_SESSION['username'];


 $a=1;
                 
                // $sql="select * from request where status2='for head approval' and approving_head='$nname'";
                // $result = mysqli_query($con,$sql);
                // while($row=mysqli_fetch_assoc($result)){


   $sqlLevel="select level from user where username='$username'";
    $resultLevel = mysqli_query($con,$sqlLevel);
    while($field=mysqli_fetch_assoc($resultLevel))
    {
        $level=$field["level"];
        $_SESSION['level'] = $level;  
       
    
    
       if($_SESSION['level'] == 'admin'){
          $sql="select * from request where status2='head'";
          $result = mysqli_query($con,$sql);
          $counthead = mysqli_num_rows($result); 
       }
    
    
       else if($_SESSION['level'] == 'head'){
          $sql="select * from request where status2='head' and approving_head='$nname'";
          $result = mysqli_query($con,$sql);
          $counthead = mysqli_num_rows($result);
       }
    
       else{
    
       }
    
   
      }
      while($row=mysqli_fetch_assoc($result)){
                
                  ?>













              <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-small text-gray-900"><?php echo $a++?></td>

              <td class="px-6 py-4 text-right">
                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                    <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-bs-jonumber="<?php echo $row['ticket_no'];?>" data-bs-id="<?php echo $row['id'];?>" data-bs-email="<?php echo $row['email'];?>">
                    Approval
                    </button>
                </td>
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-medium leading-normal text-gray-800" id="ticketnumbertitle">
          Approval of JO Number: 
        </h5>
        <button type="button"
          class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
          data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="head_approval.php">
      <div class="modal-body relative p-4">
      <div class="mb-6">

    <!-- <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label> -->
    <input type="text" name="jo_email" id="ticketemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <input type="text" name="jo_num" id="jonumber" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    


    <input type="text" name="requestID" id="idInput" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your remarks</label>
    <textarea id="message" name="remarks" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your comments here..."></textarea>

</div>
      </div>
      <div
        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
       

        <button type="submit" name="approveRequest"
          class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
          Approve
        </button>
       
        <button type="submit" name="dissapproveRequest"
          class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
          data-bs-dismiss="modal">
          Disapprove
        </button>
        
        

        <button
          class="inline-block px-6 py-2.5 bg-red-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-700 active:shadow-lg transition duration-150 ease-in-out ml-1 "data-modal-hide="exampleModalCenter">
          Cancel
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
                <a class="text-sm text-blue-700 font-light px-6 py-4 whitespace-nowrap" href="<?php echo $row['attachment'];?>">View</a>
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




              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['request_details'];?> 
              </td>





                </tr>
                  <?php

              }
              
               ?>



           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  

























    

<!-- flowbite javascript -->
<!-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> -->

<script src="./node_modules/flowbite/dist/flowbite.js"></script>
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
  const joEmail = button.getAttribute('data-bs-email')

  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  const modalId = exampleModal.querySelector('#idInput')
  const ticketNo = exampleModal.querySelector('#ticketnumbertitle')
  const reqNo = exampleModal.querySelector('#jonumber')
  const ticketMail = exampleModal.querySelector('#ticketemail')


  
  modalId.value = `${requestId}`
  reqNo.value=`${joNumber}`
  ticketNo.textContent = `Approval JO number: ${joNumber}`
  ticketMail.value=`${joEmail}`

 

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

var activepage = document.getElementById("side");
activepage.classList.remove("text-gray-700");
activepage.classList.add("text-blue-700");
activepage.classList.remove("dark:text-gray-400");
activepage.classList.add("dark:text-white");

</script>

</body>
</html>