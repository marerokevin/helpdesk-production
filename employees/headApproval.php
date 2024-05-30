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
        <th>Date Filed</th>
        <th>Category</th>
        <th>Assigned to</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $a = 1;

      $sql = "select * from `request` WHERE `requestorUsername` = '$username' and `status2` = 'head' order by id asc  ";
      $result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['request_type'] == "Technical Support") {
          $reqtype = "Ticket Request";
        } else {
          $reqtype = "Job Order";
        }

        $date = new DateTime($row['date_filled']);
        $date = $date->format('ym');
        if ($row['ticket_category'] != NULL) {
          $joid = 'TS-' . $date . '-' . $row['id'];
        } else {
          $joid =  'JO-' . $date . '-' . $row['id'];
        }
      ?>
        <tr class="">
          <td class="">
            <?php echo $joid; ?>
          </td>
          <td>
            <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Select</a> -->
            <button type="button" id="viewdetails" onclick="modalShow(this)" data-reqtype="<?php echo $reqtype; ?>" data-recommendation="<?php echo $row['recommendation'] ?>" data-action1="<?php echo $row['action1'] ?>" data-action2="<?php echo $row['action2'] ?>" data-action3="<?php echo $row['action3'] ?>" data-joidprint="<?php echo $joid; ?>" data-joid="<?php echo $row['id']; ?>" data-datefiled="<?php $date = new DateTime($row['date_filled']);
                                                                                                                                                                                                                                                                                                                                                                                                                  $date = $date->format('F d, Y');
                                                                                                                                                                                                                                                                                                                                                                                                                  echo $date; ?>" data-section="<?php if ($row['request_to'] === "fem") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo "FEM";
                                                                                                                                                                                                                                                                                                                                                                                                                                                } else if ($row['request_to'] === "mis") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo "ICT";
                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?> " data-category="<?php echo $row['request_category']; ?>" data-telephone="<?php echo $row['telephone']; ?>" data-attachment="<?php echo $row['attachment']; ?>" data-comname="<?php echo $row['computerName']; ?>" data-start="<?php echo $row['reqstart_date']; ?>" data-end="<?php echo $row['reqfinish_date']; ?>" data-details="<?php echo $row['request_details']; ?>" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
              View more
            </button>
          </td>

          <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
            <?php echo $row['request_details']; ?>
          </td>


          <!-- to view pdf -->
          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
            <?php
            $date = new DateTime($row['date_filled']);
            $date = $date->format('F d, Y');
            echo $date; ?>

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