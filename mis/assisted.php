<?php


$user_dept = $_SESSION['department'];
$user_level = $_SESSION['level'];


?>
<section class="mt-10">
<table id="assistTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="3">Request Number</th>
                                <th data-priority="4">Personnel</th>
                                <th data-priority="1">Details</th>
                                <th data-priority="2">Requestor</th>
                                <th data-priority="10">Assistant/s</th>

                                <th data-priority="5">Date Approved</th>
                        
                                <th data-priority="7">Category</th>
  


                                <!-- <th>Days Late</th> -->
                                <!-- <th>Assigned to</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //   function countWeekdays($start_date) {
                            //     $start = new DateTime($start_date);
                            //     $end = new DateTime(); 
                            //     $end = $end->format('Y-m-d');
                            //     $count = 0;

                            //     while ($start <= $end) {
                            //         // Check if the current day is not Saturday (6) or Sunday (0)
                            //         if ($start->format('N') < 6) {
                            //             $count++;
                            //         }
                            //         $start->add(new DateInterval('P1D')); // Increment by 1 day
                            //     }

                            //     return $count;
                            // }

                            // $start_date = '2023-09-25';
                            // $end_date = '2023-10-02';

                            // echo "Number of weekdays between $start_date and $end_date: $result";

                            $sqlHoli = "SELECT holidaysDate FROM holidays";
                            $resultHoli = mysqli_query($con, $sqlHoli);
                            $holidays = array();
                            $days;
                            while ($row = mysqli_fetch_assoc($resultHoli)) {
                                $holidays[] = $row['holidaysDate'];
                            }
                            // print_r($holidays);

                            $end_date = new DateTime();
                            $end_date = $end_date->format('Y-m-d');
                            $a = 1;
                            $sql = "SELECT request.*, categories.level, categories.hours
                            FROM request
                            LEFT JOIN categories ON request.request_category = categories.c_name
                            WHERE (request.status2 = 'done' OR request.status2 = 'rated')
                            AND request.assistantsId LIKE '%$misusername%'
                            ORDER BY request.id ASC;";
                            $result = mysqli_query($con, $sql);



                            while ($row = mysqli_fetch_assoc($result)) {

                                $cat_lvl = $row['category_level'];

                                if ($cat_lvl  == "" || $cat_lvl == NULL || $cat_lvl == "Normal") {

                                    $sql1 = "SELECT * FROM `categories`
                            WHERE `req_type` = 'JO'";
                                    $result1 = mysqli_query($con, $sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $days = $row1['days'];
                                } else {

                                    $sql1 = "SELECT * FROM `categories`
                            WHERE `level` LIKE '$cat_lvl%' AND `req_type`= 'TS'";
                                    $result1 = mysqli_query($con, $sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $days = $row1['days'];
                                }

                                $start = new DateTime($row['admin_approved_date']);
                                $start1 = $start->format('Y-m-d');
                                // echo $start1;
                                $end = new DateTime();
                                $end1 = $end->format('Y-m-d');
                                // echo $end1;
                                $count = 0;
                                // echo $start->format('N');
                                $start->add(new DateInterval('P1D')); // Increment by 1 day



                                while ($start <= $end) {
                                    // echo $start;
                                    // echo $end;
                                    // echo $start->format('Y-m-d') ;
                                    // echo $end->format('Y-m-d') ;
                                    // echo "<br>";

                                    // Check if the current day is not Saturday (6) or Sunday (0)
                                    // echo $start->format('Y-m-d') ;

                                    if ($start->format('N') < 6 && !in_array($start->format('Y-m-d'), $holidays)) {
                                        // echo $start->format('Y-m-d') ;
                                        // echo  '<br>';

                                        $count++;
                                    }
                                    $start->add(new DateInterval('P1D')); // Increment by 1 day

                                }
                                //    echo $count;
                                //    $resultdays = 2;
                                $dayminus = $days - 1;
                                $dayplus = $days + 1;
                                // echo $count;


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

                                <tr <?php

                                    if ($count == $days) {
                                        echo "$count style='background-color: #ef4444'";
                                    } else if ($count == $dayminus) {
                                        echo "style='background-color: #ffd78f'";
                                    } else if ($count >= $dayplus) {
                                        echo "style='background-color: #000000'";
                                    } ?>>
                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        } ?>>
                                        <?php
                                        $date = new DateTime($row['date_filled']);
                                        $date = $date->format('ym');
                                        if ($row['ticket_category'] != NULL) {
                                            echo 'TS-' . $date . '-' . $row['id'];
                                        } else {
                                            echo 'JO-' . $date . '-' . $row['id'];
                                        }

                                        ?>

                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        }  ?> class="<?php echo $count; ?> text-sm  font-semibold font-sans px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['assignedPersonnelName']; ?>
                                    </td>

                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        }  ?> class="<?php echo $count; ?> text-sm  text-[#c00000] font-semibold font-sans px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['request_details']; ?>
                                    </td>

                              

                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        } ?> class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['requestor']; ?>
                                    </td>
                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        }  ?> class="<?php echo $count; ?> text-sm  font-semibold font-sans px-6 py-4 whitespace-nowrap truncate max-w-xs">
                                        <?php echo $row['assistanNames']; ?>
                                    </td>
                                    <!-- to view pdf -->
                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        } ?> class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php
                                        if ($row['ict_approval_date'] == NULL) {
                                            $date = new DateTime($row['admin_approved_date']);
                                            $date = $date->format('F d, Y');
                                            echo $date;
                                        } else {
                                            $date = new DateTime($row['ict_approval_date']);
                                            $date = $date->format('F d, Y h:i');
                                            echo $date;
                                        }
                                        ?>

                                    </td>

                                    
                                    <td <?php if ($count >= $days) {
                                            echo "style='color: white'";
                                        } ?> class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo $row['request_category']; ?>
                                    </td>
                          
                                 
                                    <!-- <td > <?php echo $count; ?></td> -->
                                    <!-- <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

              <?php if ($row['request_to'] == "fem") {
                                    echo "FEM";
                                } else if ($row['request_to'] == "mis") {
                                    echo "ICT";
                                }


                ?> 
              </td> -->








                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>

</section>