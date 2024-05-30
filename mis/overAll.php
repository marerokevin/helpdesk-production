<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];



?>
<section class="mt-10">
<table id="overAllFinished" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>JO Number</th>
                <th>Action</th>
                <th>Details</th>
                <th>Requestor</th>
                <th>Date Filed</th>
                <th>Date Received</th>
                <th>Date finished</th>
                <th>Category</th>
                <th>PC</th>
                <th>Assigned to</th>
                <th>Rate</th>

            </tr>
        </thead>
        <tbody>
              <?php
                $a=1;

                 
                $sql="select * from `request` WHERE  (`status2` = 'rated' OR `status2` = 'Done')and `request_to` = 'mis' order by `actual_finish_date` desc  ";
                $result = mysqli_query($con,$sql);


                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $a;?> 
              </td>
              
              <td class="">
              <?php 
              $date = new DateTime($row['date_filled']);
              $date = $date->format('ym');
              echo $date.'-'.$row['id'];?> 
             
              <td >
                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                    <button type="button" id="viewdetails" onclick="modalShow(this)" 
                    data-recommendation="<?php echo $row['recommendation'] ?>" 
                    data-requestorremarks="<?php echo $row['requestor_remarks'] ?>" 
                    data-quality="<?php echo $row['rating_quality'] ?>" 
                    data-delivery="<?php echo $row['rating_delivery'] ?>" 
                    data-ratedby="<?php echo $row['ratedBy'] ?>" 
                    data-daterate="<?php echo $row['rateDate'] ?>" 
                    data-action1date="<?php echo $row['action1Date'] ?>" 
                    data-action2date="<?php echo $row['action2Date'] ?>" 
                    data-action3date="<?php echo $row['action3Date'] ?>" 
                    data-headremarks="<?php echo $row['head_remarks']; ?>" 
                    data-adminremarks="<?php echo $row['admin_remarks']; ?>" 
                    data-department="<?php echo $row['department'] ?>" 
                    data-headdate="<?php echo $row['head_approval_date']; ?>" 
                    data-admindate="<?php echo $row['admin_approved_date']; ?>" 
                    data-status="<?php echo $row['status2'] ?>" 
                    data-action1="<?php echo $row['action1'] ?>" 
                    data-action2="<?php echo $row['action2'] ?>" 
                    data-action3="<?php echo $row['action3'] ?>" 
                     data-ratings = "<?php echo $row['rating_final'];?>" 
                     data-actualdatefinished="<?php $date = new DateTime($row['actual_finish_date']); $date = $date->format('F d, Y');echo $date;?>"  
                     data-assignedpersonnel="<?php echo $row['assignedPersonnelName'] ?> " 
                     data-requestor="<?php echo $row['requestor'] ?>" 
                      data-personnel="<?php echo $row['assignedPersonnel'] ?>" data-action="<?php echo $row['action'] ?>"
                       data-joidprint="<?php $date = new DateTime($row['date_filled']); $date = $date->format('ym');  echo $date.'-'.$row['id']; ?>" 
                       data-joid="<?php echo $row['id']; ?>" 
                       data-datefiled="<?php $date = new DateTime($row['date_filled']); $date = $date->format('F d, Y');echo $date;?>" 
                       data-section="<?php if($row['request_to'] === "fem"){  echo "FEM";} else if($row['request_to'] === "mis"){ echo "MIS";  }?> " 
                       data-category="<?php echo $row['request_category']; ?>" 
                       data-telephone="<?php echo $row['telephone']; ?>" 
                       data-attachment="<?php echo $row['attachment']; ?>"  
                       data-comname="<?php echo $row['computerName']; ?>" 
                       data-start="<?php echo $row['reqstart_date']; ?>" 
                       data-end="<?php echo $row['reqfinish_date']; ?>" 
                       data-details="<?php echo $row['request_details']; ?>" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> 
                    View more
                    </button>
                </td>
                
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['request_details'];?> 
              </td>
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['requestor'];?> 
              </td>

              <!-- to view pdf -->
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php 
              $date = new DateTime($row['date_filled']);
              $date = $date->format('F d, Y');
              echo $date;?> 
              
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php 
              $date = new DateTime($row['admin_approved_date']);
              $date = $date->format('F d, Y');
              echo $date;?> 
              
              </td>
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['actual_finish_date'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['request_category'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['computerName'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap truncate" style="max-width: 10px;">

<?php echo $row['assignedPersonnelName'];
?> 
</td>

   <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
    <h2>
    <span class="flex justify-center items-center">
    <?php for($i = 1; $i<=5; $i++){
        if($i<=$row['rating_final']){
 
            $b = $i+1;

          
            ?>
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <?php
              if($row['rating_final']>$i && $row['rating_final']<$b ){
                   ?>
                    <svg  class="w-5 h-5 "  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
<linearGradient id="grada">
<stop offset="50%" stop-color=" rgb(250 204 21 )"/>
<stop offset="50%" stop-color="rgb(209 213 219)"/>
</linearGradient>
</defs>
            <path fill="url(#grada)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>

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
           

    <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo  $row['rating_final'];?> </span> 
   <!-- <?php echo ' '.$row['rating_final']?>   -->
    </span></h2>
  </td>



              




                </tr>
                  <?php
                  $a++;

            }
               ?>
          </tbody>
    </table>

</section>







  