<?php 



?>
<section class="mt-10">
<table id="postedTable" class="display" style="width:100%">
        <thead>
            <tr>
               <th>No.</th>
                <th>File</th>
                <th>Month</th>
                <th>Year</th>
                <th>Type</th>
                <th>Date Posted</th>

                

                

            </tr>
        </thead>
        <tbody>
              <?php
                $a=1;

                 
                $sql="SELECT * FROM `postedreport` WHERE 1";
                $result = mysqli_query($con,$sql);


                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $a;?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <a class ="text-blue-600 hover:underline dark:text-blue-500" href="../department-admin/postedReports/<?php echo $row['type']." Summary Report for the Month of " .$row['month'] ;?>.xls"><?php echo $row['type']." Summary Report for the Month of " .$row['month'] ;?> </a>
              </td>

             <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['month'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['year'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['type'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
    <?php echo date('F d, Y g:i A', strtotime($row['date'])); ?> 
</td>
              

              
                </tr>
                  <?php
                $a++;
            }
               ?>
          </tbody>
    </table>

</section>







  