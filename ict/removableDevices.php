<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];



?>
<section class="mt-10">
<table id="removableDeviceTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Number</th>
                <th>Action</th>
                <th>Control No.</th>
                <th>Brand</th>
                <th>Size</th>
                <th>Color</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
              <?php
                          $date = new DateTime(); 
                          $month = $_SESSION['selectedMonth'];
                          $year = $_SESSION['selectedYear'];
                $a=1;

                $sql="SELECT 
                removabledevices.department,
                removabledevices.brand,
                removabledevices.size,
                removabledevices.color,
                removabledevices.type,
                removabledevices.controlNumber,
                scan.action,
                scan.performedBy,
                scan.Date,
                scan.month,
                scan.year,
                scan.proof
            FROM removabledevices
            LEFT JOIN scan
                ON removabledevices.controlNumber = scan.controlNumber AND scan.year = '$year' AND scan.month = '$month'
            WHERE removabledevices.department = '$user_dept';
            ";
                $result = mysqli_query($con,$sql);

                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td class="">
              <?php 
              echo $a;?> 
             </td>
              <td >
                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
                    <button  type="button" id="edit" onclick="modalShowProof(this)" 
                    data-deviceid="<?php echo $row['controlNumber'];?>" data-proof="<?php echo $row['proof'];?>" data-remarks="<?php echo $row['action'];?>"  class="inline-block px-6 py-2.5 <?php if($row['action'] == null) { echo "bg-blue-600";} else{echo "bg-green-600";}?>  text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> 
                    <?php if($row['action'] == null) { echo "Add Proof";} else{echo "View";}?> 
                    </button>
                </td>

              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['controlNumber'];?> 
              </td>


              <!-- to view pdf -->
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['brand'];?> 
              
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['size'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['color'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?php echo $row['type'];?> 
              </td>

              




                </tr>
                  <?php 

                    $a++;
            }
               ?>
          </tbody>
    </table>

</section>







  