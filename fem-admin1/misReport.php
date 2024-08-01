<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];

$filter = $_SESSION['filtered'];
if($filter!=""){
$fromDate = $_SESSION['fromDate'];
$toDate = $_SESSION['toDate'];

}
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
<section class="mt-10">
<table id="misReportTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Employee</th>
                <th>Number of J.O</th>
                <th>Total Ratings</th>
                <th>Stars</th>
                <th>Percentage</th>



            </tr>
        </thead>
        <tbody>
              <?php
                $a=1;
if($filter ==""){
  $sql="SELECT user.username, user.name, COUNT(request.rating_final) as numberOfJO, SUM(request.rating_final) as TotalofRates, ROUND((SUM(request.rating_final))/(COUNT(request.rating_final)), 1) as totalRating FROM user INNER JOIN request ON user.username = request.assignedPersonnel WHERE user.level = 'mis'  AND request.status2 = 'rated'  GROUP BY user.username, request.assignedPersonnelName;";
  $result = mysqli_query($con,$sql);

}
else{
  $sql="SELECT user.username, user.name, COUNT(request.rating_final) as numberOfJO, SUM(request.rating_final) as TotalofRates, ROUND((SUM(request.rating_final))/(COUNT(request.rating_final)), 1) as totalRating FROM user INNER JOIN request ON user.username = request.assignedPersonnel WHERE user.level = 'mis'  AND request.status2 = 'rated' AND request.admin_approved_date BETWEEN '$fromDate' AND '$toDate' GROUP BY user.username, request.assignedPersonnelName;";
  $result = mysqli_query($con,$sql);

}
                 
                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">

              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['username'];?> 
              
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['name'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate" style="max-width: 10px;">
              <?php echo $row['numberOfJO'];?> 
</td>

<td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
<?php echo $row['TotalofRates'];?> 
</td>
  <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
    <h2>
    <span class="flex justify-center items-center">
    <?php for($i = 1; $i<=5; $i++){
        if($i<=$row['totalRating']){
 
            $b = $i+1;

          
            ?>
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <?php
              if($row['totalRating']>$i && $row['totalRating']<$b ){
                   ?>
                    <svg  class="w-5 h-5 "  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
<linearGradient id="grad">
<stop offset="50%" stop-color=" rgb(250 204 21 )"/>
<stop offset="50%" stop-color="rgb(209 213 219)"/>
</linearGradient>
</defs>
            <path fill="url(#grad)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>

                   <?php 
                    $i++;
              }
        }
        else{
            ?>
                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <?php
        }
    } ?>   
           

    <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo  $row['totalRating'];?> </span> 
   <!-- <?php echo ' '.$row['totalRating']?>   -->
    </span></h2>
  </td>
  <td><?php echo   Round(($row['TotalofRates']/ ($row['numberOfJO'] * 5))*100, 2)  ?></td>


              




                </tr>
                  <?php

            }
               ?>
          </tbody>
    </table>

</section>







  