<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//set timeout
$timeout = 3600;
ini_set( "session.gc_maxlifetime", $timeout );
ini_set( "session.cookie_lifetime", $timeout );
$s_name = session_name();
$url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 500; URL=$url1");
if(isset( $_COOKIE[ $s_name ] )) {
    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );    
}
else
    echo "Session is expired.<br/>";
// end of set timeout



    session_start();

    function convertToSentenceCase($string) {
        $sentences = preg_split('/(?<=[.?!])\s+/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
        $output = '';
        foreach ($sentences as $sentence) {
            $sentence = trim($sentence);
            if (!empty($sentence)) {
                $sentence = strtolower($sentence);
                $sentence = ucfirst($sentence);
                $output .= $sentence . ' ';
            }
        }
        $output = rtrim($output); // Remove trailing space
        return $output;
    }
    
    $requestor=$_SESSION['name'];


    if(!isset($_SESSION['connected'])){
      header("location: index.php");
    }

    include ("../includes/connect.php");

    $sqllink = "SELECT `link` FROM `setting`";
    $resultlink = mysqli_query($con, $sqllink);
    $link = "";
    while($listlink=mysqli_fetch_assoc($resultlink))
    {
    $link=$listlink["link"];
    
    
      }

      
    $user_dept = $_SESSION['department'];
    $user_level=$_SESSION['level'];
    $user_name=$_SESSION['name'];
    $username = $_SESSION['username'];


    $sql1 = "Select * FROM `user` WHERE `level` = 'admin'";
    $result = mysqli_query($con, $sql1);
    while($list=mysqli_fetch_assoc($result))
    {
    $adminemail=$list["email"];
    $adminname=$list["name"];

    }    
    
         //code for submiting the JO

        $dest_path = "";
        $jono=date("ym-dH-is");
        if(isset($_POST['submit'])){
            $userid = $_POST['head'];
            $sql1 = "Select * FROM `user` WHERE `id` = '$userid'";
            $result = mysqli_query($con, $sql1);
            while($list=mysqli_fetch_assoc($result))
            {
            $email=$list["email"];
            $headname=$list["name"];
            }    
            $messageUpload ="";
    
                    $nullFile =  implode($_FILES['uploadedFile']);

                    if($nullFile != "40"){
                        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
                        {
                        // get details of the uploaded file
                        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
                        $fileName = $_FILES['uploadedFile']['name'];
                    
                        $fileSize = $_FILES['uploadedFile']['size'];
                        $fileType = $_FILES['uploadedFile']['type'];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));
                    
                        // sanitize file-name
                        //   $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                        $newFileName = $jono .'.'. $fileName . '.' . $fileExtension;
                    
                        // check if file has one of the following extensions
                        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc' , 'pdf','csv','xlsx');
                    
                        if (in_array($fileExtension, $allowedfileExtensions))
                        {
                            // directory in which the uploaded file will be moved
                            $uploadFileDir = '../upload_files/';
                            $dest_path = $uploadFileDir . $newFileName;
                    
                            if(move_uploaded_file($fileTmpPath,$dest_path)) 
                            {
                            $messageUpload ='File is successfully uploaded.';
                            }
                            else 
                            {
                            $messageUpload = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                            }
                        }
                        else
                        {
                            $messageUpload = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                        }
                        }
                        else
                        {
                        $messageUpload = 'There is some error in the file upload. Please check the following error.<br>';
                        $messageUpload .= 'Error:' . $_FILES['uploadedFile']['error'];
                        }
                            
                    }
                    else {
                        $dest_path == "";
                    }



            $jo_no=date("ym-dH-is");
            $year= date("Y");
            $month= date("M");
            // $jo_no="sdfsd";

           $datenow = date("Y-m-d");

            $requestto = $_POST['femmis'];
            $category = $_POST['category'];

            $computerName = $_POST['computerName'];
          
            $start= $_POST['start'];
            $end = $_POST['finish'];
            $request= convertToSentenceCase($_POST['request']);
            $telephone = $_POST['telephone'];
            // $bldg=$_POST['building'];
            

          
            $terms=$_POST['terms'];
  
            if ($requestto != "" || $category !="")

            {
            $email1=$_SESSION['email'];
            $sql = "insert into request (date_filled,status2,requestorUsername,requestor,email,department,request_to, request_category,request_details,computerName,reqstart_date ,reqfinish_date, telephone,head_approval_date, approving_head,accept_termsandconddition,month,year,attachment) 
                    values('$datenow','admin','$username','$user_name','$email1','$user_dept','$requestto','$category','$request','$computerName','$start','$end','$telephone','$datenow','$headname','$terms','$month','$year','$dest_path')";
                $results = mysqli_query($con,$sql);
                
            if($results){
                
                $sql2 = "Select * FROM `sender`";
                $result2 = mysqli_query($con, $sql2);
                while($list=mysqli_fetch_assoc($result2))
                {
                $account=$list["email"];
                $accountpass=$list["password"];
        
                  }    

                  $subject ='Job order request';
                  $message = 'Hi '.$adminname.',<br> <br>   Mr/Ms. '.$requestor.' filed a job order. Please check the details by signing in into our Helpdesk <br> Click this '.$link.' to signin. <br><br><br> This is a generated email. Please do not reply. <br><br> Helpdesk';
                  
                 require '../vendor/autoload.php';
    
                 $mail = new PHPMailer(true);                      
                 try {
                  //Server settings
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.glorylocal.com.ph';                       // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $account;     // Your Email/ Server Email
                    $mail->Password = $accountpass;                     // Your Password
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                                                );                         
                    $mail->SMTPSecure = 'none';                           
                    $mail->Port = 465;                                   
            
                    //Send Email
                    // $mail->setFrom('Helpdesk'); //eto ang mag front  notificationsys01@gmail.com
                    
                    //Recipients
                    $mail->setFrom('mis.dev@glory.com.ph', 'Helpdesk');
                    $mail->addAddress($adminemail);              
                    $mail->isHTML(true);                                  
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
            
                    $mail->send();
                    $_SESSION['message'] = 'Message has been sent';
                    echo "<script>alert('Thank you for approving. This request is now sent to your administrator. $messageUpload ') </script>";
                    echo "<script> location.href='index.php'; </script>";

                        // header("location: form.php");
                    } catch (Exception $e) {
                        $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                    echo "<script>alert('Message could not be sent. Mailer Error.') </script>";

                    }

               
               
            }
            else{
                echo "<script>alert('There is a problem with filing. Please contact your administrator.') </script>";

            }
                ?>

                <?php

                }

        else{
    
            echo "<script>alert('Please complete fields.') </script>";

            ?>
            <?php    

                }          
                }
                
                ?>

    



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEM MIS Helpdesk</title>
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
<body   class="static  bg-white dark:bg-gray-900"  >

    <!-- nav -->
    <?php require_once 'nav.php';?>


<!-- main -->





<div class=" ml-72 flex mt-16  left-10 right-5  flex-col  px-14 sm:px-8  pt-6 pb-14 z-50 ">
  
<form class="px-40" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
    <div class=" grid gap-6 mb-6 md:grid-cols-2">



        <div>
            <label for="femmis" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300" >Request to </label>
            <select name="femmis" id="femmis" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
            <option selected disabled value=" " data-val="">Choose Section:</option>
            <option value="fem">FEM: Facility and Equipment Maintenance</option>
            <option value="mis">MIS: Management Information System</option>
            
         </select>
         </div>

         <div>
            <label for="category" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300">Category <a href="#" class="text-blue-600 hover:underline dark:text-blue-500" ></a></label>
            <!-- <label for="remember" class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-400" data-modal-toggle="defaultModal">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label> -->

            <select name="category" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
            <option selected disabled value=" " data-val="">Choose Category:</option>
            <!-- <option value="na" data-val="na"></option> -->
            <option value="Facilities" data-val="fem">Facilities</option>
            <option value="Electrical" data-val="fem">Electrical</option>
            <option value="Mechanical" data-val="fem">Mechanical</option>
            <option value="Compliance" data-val="fem">Compliance</option>
            <option value="Relayout" data-val="fem">Relayout</option>
            <option value="Quotation" data-val="fem">Quotation</option>
            <option value="Computer" data-val="mis">Computer</option>
            <option value="Network" data-val="mis">Network</option>
            <option value="Printer" data-val="mis">Printer</option>

            <option value="Telephone" data-val="mis">Telephone</option>
            <option value="Email" data-val="mis">Email</option>
            <option value="Relayout" data-val="mis">Relayout</option>
            <option value="Quotation" data-val="mis">Quotation</option>
            <option value="CCTV" data-val="mis">CCTV-Attach approve letter from Admin head</option>
            <option value="Others" data-val="mis">Others</option>
            <option value="Others" data-val="fem">Others</option>

            
            </select>      
        </div>

        <div id="gridtochange" class="grid grid-col-1 col-span-2 gap-8">
        <div class="hidden">
            <label for="head" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300">Approving Head </label>
            <select  name="head" id="head" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
               
            <?php
             //    $sql1 = "Select * FROM `user` WHERE `username`='$username'";
               $sql1 = "Select * FROM `user` WHERE `department` = '$user_dept' AND `level`='head' ";
               $result = mysqli_query($con, $sql1);
                while($list=mysqli_fetch_assoc($result))
                {
                    $userId=$list["id"];
                    $headName=$list["name"];
                     ?>

                   <!-- <option selected  disabled class="text-gray-900">Choose Head:</option>  -->
                  <option value="<?php echo  $userId; ?>"> <?php echo  $headName; ?>  </option> <?php 
                    
                }    

                ?>
        
          </select>

    
          </div>




         <div >
         <label for="schedule" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300">Expected Schedule</label>
         
         
            <!-- <div date-rangepicker="" class="flex items-center"> -->
                <div class="flex items-center">
            <div class="relative w-2/4">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input onchange="testDate()" id="datestart" name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date start"  required>
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative w-2/4">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input id="datefinish" onchange = "endDate()" name="finish" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date finish"  required>
            </div>

            </div>  
        </div>
        <div id="computerdiv" class="hidden">
        <label for="schedule" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300">Computer Name</label>
         
        <input type="text" name="computerName" id="computerName" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
           
             </div>
        </div>
        <div class="mb-2">
<label class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300" for="uploadedFile">Telephone</label>
<input required name="telephone" class="block w-full text-lg text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="telephone" type="text" >

</div>
<div class="mb-2">
<label class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300" for="uploadedFile">Upload file <span class="text-xs">(jpg, png, zip, txt, xls, doc , pdf, csv, xlsx)</span></label>
<input  name="uploadedFile" value="upload" class="block w-full text-lg text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="uploadedFile" type="file" >

</div>
    </div>



    <div class="mb-2">
        <label for="request" class="block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300">Request</label>
        <textarea  name="request" autocomplete="off"  type="text" id="request" class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Details" required></textarea>
    </div> 





<div class="flex items-center mb-4">
    <input required id="link-checkbox" type="checkbox" value="True" name="terms" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
    <label for="link-checkbox" class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-300">I agree and understand the <a href="#"  data-modal-target="terms" data-modal-toggle="terms" class="text-blue-600 dark:text-blue-500 hover:underline">terms and conditions.</a></label>
</div>


    <button name="submit" type="submit" class="mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
   
    <a href="index.php"  type="button"class="text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-400 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</a>

</form>




</div>


<div id="terms" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Terms of Service
                </h3>
                <button type="button" data-modal-target="terms" data-modal-toggle="terms" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                Welcome to Helpdesk System. We’re so glad you’re here. Please read the following terms before using our Services; you will be agreeing to, 
        and will be bound by them through the continued use of our Services.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                1. First come first serve base on the approved Job Order request.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                1. 2. For the relayout must be attached the approve layout plan and request must be file in advance minimum of 3 days including approval time.
                </p>
                
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
              
                <button data-modal-target="terms"data-modal-toggle="terms" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
            </div>
        </div>
    </div>
</div>
  

 


<!-- end of main -->
    

<!-- flowbite javascript -->

<!-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> -->

<script src="../node_modules/flowbite/dist/flowbite.js"></script>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>

    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="index.js"></script>

<script>
  

    $('#femmis').change(function () {
        var $options = $('#type')
            .val('')
            .find('option')
            .show();
        if (this.value != '0')
            $options
            .not('[data-val="' + this.value + '"], [data-val=""]')
            .hide();
        $('#type option:eq(0)').prop('selected', true)


    })

    $('#type').change(function () {
        if (this.value == 'Computer'){
        $("#gridtochange").removeClass("grid-col-1").addClass("grid-cols-2");
        $("#computerdiv").removeClass("hidden");
        $("#computerName").prop("required", true);
        }
      
        else{
        $("#gridtochange").addClass("grid-col-1").removeClass("grid-cols-2");

        $("#computerdiv").addClass("hidden");
        $("#computerName").prop("required", false);


        }
        console.log(this.value)
    })
    var $options = $('#type')
        .val('')
        .find('option')
        .show();
    if (this.value != '0')
        $options
        .not('[data-val="' + this.value + '"], [data-val=""]')
        .hide();
    $('#type option:eq(0)').prop('selected', true)

   

    var setdate2;

    function testDate() {
        var chosendate = document.getElementById("datestart").value;


        //  console.log(chosendate)
        const x = new Date();
        const y = new Date(chosendate);

        if (x < y) {
            console.log("Valid");
            var monthNumber = (new Date().getMonth() + 1).toString().padStart(2, '0');

            const asf = new Date(chosendate);
            var type = document.getElementById("type").value;
            if (type === "Relayout") {
            asf.setDate(asf.getDate() + 4);
            } else {
            asf.setDate(asf.getDate() + 2);
            }
            const year = asf.getFullYear();
            const month = (asf.getMonth() + 1).toString().padStart(2, "0");
            const day = asf.getDate().toString().padStart(2, "0");

            console.log(`${year}-${month}-${day}`);

            if (asf.getDay() === 0) {
                asf.setDate(asf.getDate() + 1);
            }

            var setdate = `${year}-${month}-${day}`;
            document.getElementById("datefinish").value = setdate;

            setdate2 = `${year}-${month}-${day}`;
            console.log(setdate)

        } else {
            alert("Sorry your requested date is not accepted!")

            const z = new Date();
            var monthNumber = (new Date().getMonth() + 1).toString().padStart(2, '0');
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
    $("#sidehome").removeClass("bg-gray-200");
$("#sidehistory").removeClass("bg-gray-200");
$("#sideMyRequest").removeClass("bg-gray-200");

$("#sidepms").removeClass("bg-gray-200");

</script>
</body>
</html>