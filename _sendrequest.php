 <!-- session for who is login user    -->
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
?>






























<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if(isset($_POST['send'])){

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $filename = $_FILES['attachment']['name'];
    $location = 'attachment/' . $filename;
    move_uploaded_file($_FILES['attachment']['tmp_name'], $location);

    //Load composer's autoloader
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.glorylocal.com.ph';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'j.nemedez@glory.com.ph';     // Your Email/ Server Email
        $mail->Password = 'C0nn3ctm387';                     // Your Password
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
        if(!empty($filename)){
            $mail->addAttachment($location, $filename); 
        }
       
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $_SESSION['message'] = 'Message has been sent';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

    header('location:index.php');
}
else{
    $_SESSION['message'] = 'Please fill up the form first';
    header('location:index.php');
}