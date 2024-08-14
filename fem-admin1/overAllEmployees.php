<?php 


$user_dept = $_SESSION['department'];
$user_level=$_SESSION['level'];
$username=$_SESSION['username'];


?>
<section class="mt-10">
<table id="overAllEmployees" class="display" style="width:100%">
        <thead>
            <tr>
               <th>No.</th>
                <th>Id Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Type</th>
                

            </tr>
        </thead>
        <tbody>
              <?php
                $a=1;

                 
                $sql="select * from `user` order by id asc  ";
                $result = mysqli_query($con,$sql);


                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $a;?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['username'];?> 
              </td>

             <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['name'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['email'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['department'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['level'];?> 
              </td>
              
                </tr>
                  <?php
                $a++;
            }
               ?>
          </tbody>
    </table>

</section>







  