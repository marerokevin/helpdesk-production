<?php


$user_dept = $_SESSION['department'];
$user_level = $_SESSION['level'];
$username = $_SESSION['username'];

?>
<section class="mt-10">
  <table id="employeeTable" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Request Number</th>
        <th>Action</th>
        <th>Details</th>
        <th>Requestor</th>
        <th>Date Filed</th>
        <th>Category</th>
        <th>Assigned to</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $a = 1;

      $sql = "select * from `request` WHERE `department` = '$user_dept' and `status2` = 'head' order by id ASC  ";
      $result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr class="">
          <td class=""><?php echo $row['id']; ?> </td>
          <td>
            <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
            <button type="button" data-bs-toggle="modal" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
              Action
            </button>

          </td>
          <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
              <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                  <h5 class="text-xl font-medium leading-normal text-gray-800" id="ticketnumbertitle">
                    Approval of Request Number:
                  </h5>
                  <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="head_approval.php">
                  <div class="modal-body relative p-4">
                    <div class="mb-6">

                      <!-- <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label> -->
                      <input type="text" name="jo_email" id="ticketemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <input type="text" name="jo_num" id="jonumber" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">



                      <input type="text" name="requestID" id="idInput" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your remarks</label>
                      <textarea id="message" name="remarks" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your comments here..."></textarea>

                    </div>
                  </div>
                  <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">


                    <button type="submit" name="approveRequest" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                      Approve
                    </button>

                    <button type="submit" name="dissapproveRequest" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
                      Disapprove
                    </button>



                    <button class="inline-block px-6 py-2.5 bg-red-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-700 active:shadow-lg transition duration-150 ease-in-out ml-1 " data-modal-hide="exampleModalCenter">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
            <?php echo $row['request_details']; ?>
          </td>
          <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
            <?php echo $row['requestor']; ?>
          </td>


          <!-- to view pdf -->
          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
            <?php echo $row['date_filled']; ?>

          </td>
          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
            <?php echo $row['request_category']; ?>
          </td>
          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

            <?php if ($row['request_to'] == "fem") {
              echo "FEM";
            } else if ($row['request_to'] == "mis") {
              echo "ICT";
            }
            ?>
          </td>








        </tr>
      <?php

      }
      ?>
    </tbody>
  </table>

</section>