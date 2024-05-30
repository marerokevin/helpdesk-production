<?php
  if(isset($_POST['submitNewPassword'])){

    $usernameChangePassword= $_POST['usernameChangePassword'] ;  
    $currentPass= $_POST['currentPass'] ;  
    $newPassword= $_POST['newPassword'] ;  
    $retypePassword= $_POST['retypePassword'] ;  



    $sqlSelect="SELECT * from `user` WHERE `username` = '$usernameChangePassword' AND `password` = '$currentPass'";
        $result = mysqli_query($con,$sqlSelect);
        $count = mysqli_num_rows($result); 
    if($count==1){

        if($newPassword == $retypePassword){
            $sql = "UPDATE `user` SET `password`='$newPassword' WHERE `username` = '$usernameChangePassword';";
            $results = mysqli_query($con,$sql);
            if ($results){
          echo '<script>alert("Successful")</script>';
    
            }
        }
        else{
          echo '<script>alert("Passwords does not match. Please try again")</script>';
    
        }
    }
    else{
        echo '<script>alert("Incorrect current password")</script>';

    }


}



    if (isset($_GET['username']) && isset($_GET['currentPass']) && isset($_GET['newPassword']) && isset($_GET['retypePassword'])) {

        include ("includes/connect.php");

        $usernameChangePassword = $_GET['username'];
        $currentPass = $_GET['currentPass'];
        $newPassword = $_GET['newPassword'];
        $retypePassword = $_GET['retypePassword'];
// echo $usernameChangePassword,$currentPass,$newPassword;
        $sqlSelect="SELECT * from `user` WHERE `username` = '$usernameChangePassword' AND `password` = '$currentPass'";
        $result = mysqli_query($con,$sqlSelect);
        $count = mysqli_num_rows($result); 
    if($count==1){

        if($newPassword == $retypePassword){
            $sql = "UPDATE `user` SET `password`='$newPassword' WHERE `username` = '$usernameChangePassword';";
            $results = mysqli_query($con,$sql);
            if ($results){
          echo '<script>alert("Successful")</script>';
  header("location:http://192.168.5.243/srs/login.php?user=$usernameChangePassword&pass=$newPassword");
    
            }
        }
        else{
          echo '<script>alert("Passwords does not match. Please try again")</script>';
    
        }
    }
    else{
        echo '<script>alert("Incorrect current password")</script>';

    }

      } else {
      $username = "not found";
      $newPass = "not found";
      
      }
    
    
 




?>