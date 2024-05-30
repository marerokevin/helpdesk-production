<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];



?>
<section class="mt-10">
<table id="workingStationTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Number</th>
             
                <th>PC Tag</th>
                <th>Asset Tag</th>
                <th>Type</th>
                <th>User</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>
              <?php
                          $date = new DateTime(); 
                          $month = $_SESSION['selectedMonth'];
                          $year = $_SESSION['selectedYear'];
                $a=1;

                $sql="SELECT * FROM `devices` WHERE `department` = '$user_dept' AND `type` != 'Tablet'";
                $result = mysqli_query($con,$sql);

                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td class="">
              <?php 
              echo $a;?> 
             </td>
           
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['pctag'];?> 
              </td>

              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['assetTag'];?> 
              </td>


              <!-- to view pdf -->
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['type'];?> 
              
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['user'];?> 
              </td>
            
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?php if($row['deactivated'] == false){
                    echo "Active";
                } else{ echo "Inactive"; }?> 
              </td>

              




                </tr>
                  <?php 

                    $a++;
            }
               ?>
          </tbody>
    </table>

</section>







  