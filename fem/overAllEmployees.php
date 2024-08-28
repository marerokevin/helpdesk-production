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
                <th>Action</th>

                

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
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <button type="button" id="viewdetails"   onclick="modalShow(this)" 
                    data-empuserusername="<?php echo $row['username'];?>" 
                    data-empuseruserid="<?php echo $row['id'];?>" 
                    data-empusername="<?php echo $row['name'];?>" 
                    data-empuserdepartment="<?php echo $row['department'];?>" 
                    data-empuseremail="<?php echo $row['email'];?>" 
                    data-empusertype="<?php echo $row['level'];?>" 
                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"> 
                  Edit
                    </button>
              </td>
              
                </tr>
                  <?php
                $a++;
            }
               ?>
          </tbody>
    </table>

</section>







  