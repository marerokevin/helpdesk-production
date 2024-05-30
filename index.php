

<?php
#   include ("includes/connect.php");
$sql2 = "SELECT `link` FROM `setting`";
$result2 = mysqli_query($con, $sql2);
$link = "";
while($list=mysqli_fetch_assoc($result2))
{
$link=$list["link"];


  }    
?>

<html>
  <head>
    <meta http-equiv="refresh" content="0;url=<?php echo $link;?>/login.php" />
    <title></title>
  </head>
 <body>

<!-- 
<div class="flex justify-center items-center">
  <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>  -->

<div id="loading-screen" class=" w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50">
  <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0">
    <i class="fas fa-circle-notch fa-spin fa-5x"></i>
  </span>
</div>





 </body>
</html>
