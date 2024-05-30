<?php

//Set the session timeout for 1 hour
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$timeout = 500;

//Set the maxlifetime of the session

ini_set("session.gc_maxlifetime", $timeout);

//Set the cookie lifetime of the session

ini_set("session.cookie_lifetime", $timeout);

// session_start();

$s_name = session_name();
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 500; URL=$url1");
//Check the session exists or not

if (isset($_COOKIE[$s_name])) {

  setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
} else

  echo "Session is expired.<br/>";


// end of session timeout>";



session_start();

if (!isset($_SESSION['connected'])) {
  header("location: index.php");
}


// connection php and transfer of session
include("includes/connect.php");
$user_dept = $_SESSION['department'];
$user_level = $_SESSION['level'];
$user_name = $_SESSION['name'];

?>


<!-- insert data -->




<!-- sending email -->


<?php
$dest_path = "";

$jono = date("ym-dH-is");


if (isset($_POST['submit'])) {
  // include ("includes/connect.php");
  $userid = $_POST['head'];

  $sql1 = "Select * FROM `user` WHERE `id` = '$userid'";
  $result = mysqli_query($con, $sql1);
  while ($list = mysqli_fetch_assoc($result)) {
    $email = $list["email"];
    $headname = $list["name"];
    // $user=$list["name"];

  }
  // echo $email;


  $sql2 = "Select * FROM `sender` WHERE `id` = '1'";
  $result2 = mysqli_query($con, $sql2);
  while ($list = mysqli_fetch_assoc($result2)) {


    $account = $list["email"];
    $accountpass = $list["password"];
    // $user=$list["name"];

  }
  // echo $email;



  // $email = $_POST['email'];
  $subject = 'JO Request for Approval' . " " . $jono;
  $message = 'Hi ' . " " . $headname . ' You have pending JO for your Approval.<br/>' .
    'Please login to http://192.168.5.246/helpdesk.com <br/>' .
    'This is a system generated email. Please do not reply to this message.';

  // $filename = $_FILES['attachment']['name'];
  // $location = 'attachment/' . $filename;
  // move_uploaded_file($_FILES['attachment']['tmp_name'], $location);

  //Load composer's autoloader
  require 'vendor/autoload.php';

  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
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
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //Send Email


    //Recipients
    $mail->addAddress($email);


    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    $_SESSION['message'] = 'Message has been sent';
    // header("location: form.php");
  } catch (Exception $e) {
    $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
  }


  // end of sending email






  $nullFile =  implode($_FILES['uploadedFile']);
  if ($nullFile != "40") {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
      // get details of the uploaded file
      $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
      $fileName = $_FILES['uploadedFile']['name'];

      $fileSize = $_FILES['uploadedFile']['size'];
      $fileType = $_FILES['uploadedFile']['type'];
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));

      // sanitize file-name
      //   $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
      $newFileName = $jono . '.' . $fileName . '.' . $fileExtension;

      // check if file has one of the following extensions
      $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'pdf');

      if (in_array($fileExtension, $allowedfileExtensions)) {
        // directory in which the uploaded file will be moved
        $uploadFileDir = './upload_files/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $message = 'File is successfully uploaded.';
        } else {
          $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }
      } else {
        $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
      }
    } else {
      $message = 'There is some error in the file upload. Please check the following error.<br>';
      $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }
  } else {
    $dest_path == "";
  }
  // upload files 






  //  end upload files


  $jo_no = date("ym-dH-is");
  $year = date("Y");
  $month = date("M");
  // $jo_no="sdfsd";

  $datenow = date("Y-m-d-H-i");

  $requestto = $_POST['femmis'];
  $category = $_POST['category'];

  $start = $_POST['start'];
  $end = $_POST['finish'];
  $request = $_POST['request'];
  // $bldg=$_POST['building'];



  $terms = $_POST['terms'];

  // if ($con->connect_error) {
  //     die("Connection failed: " . $con->connect_error);
  //   }        
  if (!empty($requestto && $category))
  //if($itemname!="" OR $descrp!="" OR $usein!="")
  {
    $email1 = $_SESSION['email'];
    $sql = "insert into request (date_filled,status,status2,ticket_no,requestor,email,department,request_to, 	request_category ,request_details,perform_by,reqstart_date ,reqfinish_date,approving_head,accept_termsandconddition,month,year,attachment) 
        values('$datenow','For approval of $headname','head','$jo_no','$user_name','$email1','$user_dept','$requestto',' $category','$request','To be assign by Admin','$start','$end','$headname','$terms','$month','$year','$dest_path')";
    $results = mysqli_query($con, $sql);
    if ($results) {
      echo "<script>alert('Thank you! Your request has been sent.') </script>";
      echo "<script> location.href='allrequest.php'; </script>";
    } else {
      echo "<script>alert('error') </script>";
    }
?>

  <?php

  } else {

    echo "<script>alert('Please complete fields.') </script>";

    // allert message!

  ?>
<?php

  }
}

?>


<!-- end insert data -->



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Helpdesk</title>





  <!-- font awesome -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" /> -->
  <link rel="stylesheet" href="./fontawesome-free-6.2.0-web/css/all.min.css">



  <!-- tailwind play cdn -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- from flowbite cdn -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" /> -->
  <link rel="stylesheet" href="node_modules/flowbite/dist/flowbite.min.css" />
  <!-- Script for jquery -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>


  <link rel="shortcut icon" href="resources/img/helpdesk.png">
  <link rel="stylesheet" href="css/style.css" />


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

<body onload=navFuntion() class=" static  bg-white dark:bg-gray-900">

  <!-- nav -->
  <?php require_once 'nav.php'; ?>



  <!-- main -->





  <div class="  flex mt-16   left-10 right-5    flex flex-col  px-14 sm:px-14  pt-6 pb-14 z-50 ">



    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">Job Order : <span class="text-blue-600 dark:text-blue-500">Form</span></h1>




    <!-- 
<form   action="" method="POST"  enctype="accept-charset="utf-8" enctype="multipart/form-data""> -->
    <form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
      <div class=" grid gap-6 mb-6 md:grid-cols-2">



        <div>
          <label for="femmis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Request to </label>
          <select name="femmis" id="femmis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            <option selected disabled value=" " data-val="">Choose Section:</option>
            <option value="fem">FEM: Facility and Equipment Maintenance</option>
            <!-- <option value="mis">ICT: Information and Communication Technolgy</option> -->

          </select>
        </div>

        <div>
          <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category <a href="#" class="text-blue-600 hover:underline dark:text-blue-500"></a></label>
          <!-- <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400" data-modal-toggle="defaultModal">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label> -->

          <select name="category" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            <option selected disabled value=" " data-val="">Choose Category:</option>
            <!-- <option value="na" data-val="na"></option> -->
            <option value="Facicilites" data-val="fem">Facilities</option>
            <option value="Electrical" data-val="fem">Electrical</option>
            <option value="Mechanical" data-val="fem">Mechanical</option>
            <option value="Compliance" data-val="fem">Compliance</option>
            <option value="Relayout" data-val="fem">Relayout</option>
            <option value="Quotation" data-val="fem">Quotation</option>
            <option value="Computer" data-val="mis">Computer</option>
            <option value="Network" data-val="mis">Network</option>
            <option value="Telephone" data-val="mis">Telephone</option>
            <option value="Email" data-val="mis">Email</option>
            <option value="Relayout" data-val="mis">Relayout</option>
            <option value="Quotation" data-val="mis">Quotation</option>
            <option value="CCTV" data-val="mis">CCTV-Attach approve letter from Admin head</option>

            <option value="Non-Technical" data-val="mis">Non Technical Related</option>

          </select>
        </div>


        <div>
          <label for="head" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Approving Head </label>
          <select name="head" id="head" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <?php
            //    $sql1 = "Select * FROM `user` WHERE `username`='$username'";
            $sql1 = "Select * FROM `user` WHERE `department` = '$user_dept' AND `level`='head' ";
            $result = mysqli_query($con, $sql1);
            while ($list = mysqli_fetch_assoc($result)) {
              $userId = $list["id"];
              $headName = $list["name"];
            ?>

              <!-- <option selected  disabled class="text-gray-900">Choose Head:</option>  -->
              <option value="<?php echo  $userId; ?>"> <?php echo  $headName; ?> </option> <?php

                                                                                          }

                                                                                            ?>

          </select>


        </div>




        <div>
          <label for="schedule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Request Schedule and Location</label>


          <!-- <div date-rangepicker="" class="flex items-center"> -->
          <div class="flex items-center">
            <div class="relative">
              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <input onchange="testDate()" id="datestart" name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date start" required="">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <input id="datefinish" onchange="endDate()" name="finish" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Request date finish" required="">
            </div>




            <!-- <span class="mx-4 text-gray-500">Building</span>
            <div class="relative">
            <select name="building" id="bldg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            <option selected  disabled class="text-gray-900"value="">Select Building:</option>
            <option value="All Building">All Building</option>
            <option value="GPI-1">GPI-1</option>
            <option value="GPI-2">GPI-2</option>
            <option value="GPI-3">GPI-3</option>
            <option value="GPI-4">GPI-4</option>
            <option value="GPI-5">GPI-5</option>
            <option value="GPI-6">GPI-6</option>
            <option value="GPI-7">GPI-7</option>
            <option value="GPI-8">GPI-8</option>
            <option value="GPI-9">GPI-9</option>
            <option value="GPI-10">GPI-10</option>
            </select>
            </div> -->



          </div>
        </div>
      </div>



      <div class="mb-6">
        <label for="request" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Request</label>
        <input name="request" autocomplete="off" type="text" id="request" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Details" required="">
      </div>


      <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="uploadedFile">Upload file</label>
        <input name="uploadedFile" value="upload" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="uploadedFile" type="file">

      </div>





      <div class="flex items-center mb-4">
        <input required="" id="link-checkbox" type="checkbox" value="Yes I agree on the terms and conditions." name="terms" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required="">
        <label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree and understand the <a href="#" class="modal-open  text-blue-600 dark:text-blue-500 hover:underline">terms and conditions.</a>(PLEASE CLICK TERMS AND CONDITION FOR MORE DETAILS.)</label>
      </div>


      <button name="submit" type="submit" class="mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

      <a href="form.php" type="button" class="text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-400 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</a>

    </form>



  </div>
  <!-- end of main -->





















  <!-- modal for terms -->

  <button class="hidden modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Open Modal</button>

  <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Job Order Terms and Condition</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <p class="text-justify">Welcome to Helpdesk System. We’re so glad you’re here. Please read the following terms before using our Services; you will be agreeing to,
          and will be bound by them through the continued use of our Services.</p>

        <p>.................................................................................................................</p>

        <p>1. First come first serve base on the approved Job Order request.</p>

        <p>2. For the relayout must be attached the approve layout plan and request must
          be file in advance minimum of 3 days including approval time.
        </p>
        <p>3.</p>
        <p>...</p>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <!-- <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button> -->
          <button class="modal-close px-2 bg-indigo-500 p-3 rounded-md text-white hover:bg-indigo-400">Close</button>
        </div>

      </div>
    </div>
  </div>






















  <script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event) {
        event.preventDefault()
        toggleModal()
      })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
        isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
      }
    };

    function toggleModal() {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
  </script>

  <!-- end of modal for terms and condition -->




















  <!-- datetime picker js -->

  <script src="node_modules/flowbite/dist/datepicker.js"></script>


  <!-- <script src="../path/to/flowbite/dist/flowbite.js"></script> -->
  <script src="node_modules/flowbite/dist/flowbite.js"></script>





  <!-- script for option category -->

  <script>
    $('#femmis').change(function() {
      var $options = $('#type')
        .val('')
        .find('option')
        .show();
      if (this.value != '0')
        $options
        .not('[data-val="' + this.value + '"], [data-val=""]')
        .hide();
      $('#type option:eq(0)').prop('selected', true)
      // console.log("asd");

    })

    //blocking of error on refresh page
    var $options = $('#type')
      .val('')
      .find('option')
      .show();
    if (this.value != '0')
      $options
      .not('[data-val="' + this.value + '"], [data-val=""]')
      .hide();
    $('#type option:eq(0)').prop('selected', true)


    //   end of script for category
  </script>








  <!-- darkmode script -->
  <script>
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
  </script>




  <!-- script for valid request date schedule -->
  <!-- <input type="date" id="birthdaytime" onchange="testDate()" name="birthdaytime"> -->
  <script>
    var setdate2;

    function testDate() {
      var chosendate = document.getElementById("datestart").value;


      //  console.log(chosendate)
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


        // console.log(x)
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


        // console.log(x)
      } else {
        alert("Sorry your request date is not accepted!")
        document.getElementById("datefinish").value = setdate2;

      }
    }



    // active page highlight

    var activepage = document.getElementById("joform");
    activepage.classList.remove("text-gray-700");
    activepage.classList.add("text-blue-700");
    activepage.classList.remove("dark:text-gray-400");
    activepage.classList.add("dark:text-white");
  </script>











</body>

</html>