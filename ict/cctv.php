<<<<<<< HEAD
<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];



?>
<section class="mt-10">
<table id="cctvTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
             
                <th>DVR No.</th>
                <th>Camera No.</th>
                <th>Location</th>
                <th>Type</th>
                <th>Bldg. Assigned</th>
                <th>Ip Address</th>


            </tr>
        </thead>
        <tbody>
              <?php
                          
                $a=1;

                $sql="SELECT * FROM `cctv` ";
                $result = mysqli_query($con,$sql);

                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td data-pcid="<?php echo $row['id'];?>" class="">
              <?php 
              echo $a;?> 
             </td>
           
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['dvrNo'];?> 
              </td>

              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['cameraNo'];?> 
              </td>


              <!-- to view pdf -->
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['location'];?> 
              
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['type'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['bldgAssigned'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['ipAddress'];?> 
              </td>
             

              




                </tr>
                  <?php 

                    $a++;
            }
               ?>
          </tbody>
    </table>

</section>







=======
<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];



?>
<section class="mt-10">
<table id="cctvTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
             
                <th>DVR No.</th>
                <th>Camera No.</th>
                <th>Location</th>
                <th>Type</th>
                <th>Bldg. Assigned</th>
                <th>Ip Address</th>


            </tr>
        </thead>
        <tbody>
              <?php
                          
                $a=1;

                $sql="SELECT * FROM `cctv` ";
                $result = mysqli_query($con,$sql);

                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td data-pcid="<?php echo $row['id'];?>" class="">
              <?php 
              echo $a;?> 
             </td>
           
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['dvrNo'];?> 
              </td>

              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['cameraNo'];?> 
              </td>


              <!-- to view pdf -->
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['location'];?> 
              
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['type'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['bldgAssigned'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['ipAddress'];?> 
              </td>
             

              




                </tr>
                  <?php 

                    $a++;
            }
               ?>
          </tbody>
    </table>

</section>







>>>>>>> 18b611ebc99e621b2fbab0a3c84e78c7d9a01409
  