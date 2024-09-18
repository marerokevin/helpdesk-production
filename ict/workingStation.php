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
             
                <th data-priority="1">PC Tag</th>
                <th data-priority="4">Host Name</th>

                <th>Asset Tag</th>
                <th>Type</th>
                <th>User</th>
                <th>Ip Address</th>
                <th>Department</th>
                <th>Statoos</th>
                <th>EDR</th>
                <th>History</th>
                <th data-priority="2">Ip Config</th>
                <th data-priority="3">Applications</th>



            </tr>
        </thead>
        <tbody>
              <?php
                          $date = new DateTime(); 
                          $month = $_SESSION['selectedMonth'];
                          $year = $_SESSION['selectedYear'];
                $a=1;

                $sql="SELECT * FROM `devices` ";
                $result = mysqli_query($con,$sql);

                while($row=mysqli_fetch_assoc($result)){
                  ?>
              <tr class="">
              <td data-pcid="<?php echo $row['id'];?>" class="">
              <?php 
              echo $a;?> 
             </td>
           
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['pctag'];?> 
              </td>
              <td class="text-sm text-red-700 font-light px-6 py-4 whitespace-nowrap truncate max-w-xs">
              <?php echo $row['computerName'];?> 
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
              <?php echo $row['ipAddress'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php echo $row['department'];?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <?php if($row['deactivated'] == false){
                    echo "<h4 class='flex justify-center items-center'> <span class='flex w-3 h-3 bg-blue-600 rounded-full'></span> <span class='flex'> &nbsp Active </span></h4>";
                } else{
                    echo "<h4 class='flex justify-center items-center'> <span class='flex w-3 h-3 bg-red-500 rounded-full'></span> <span class='flex'> &nbsp Inactive </span></h4>";
                     }?> 
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              <?php 
              if($row['edr']){
                ?>
                <span class="m-auto flex w-3 h-3 bg-teal-500 rounded-full"></span>
                <?php
              }?> 
              </td>
              <td> 
                <button type="button" onclick="modalShowHistory(this)" data-pctag="<?php echo $row['pctag'] ?>" data-id="<?php echo $row['id'] ?>"  data-pchost="<?php echo $row['computerName'] ?>"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  History
</button>

<!-- <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal<?php echo $row['id'];?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button"> 
  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
  <?php echo $row['id'];?>
</button>
<div id="dropdownDotsHorizontal<?php echo $row['id'];?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
      <li>
         <button type="button" onclick="modalShowHistory(this)" data-pctag="<?php echo $row['pctag'] ?>" data-id="<?php echo $row['id'] ?>"  data-pchost="<?php echo $row['computerName'] ?>"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  History
</button> -->
        <!-- <a href="#" onclick="modalShowHistory(this)" data-pctag="<?php echo $row['pctag']; ?>" data-id="<?php echo $row['id'];?>"  data-pchost="<?php echo $row['computerName']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">History</a> -->
      <!-- </li>
      <li>
        <a href="#" onclick="modalShowProofIp(this)" data-deviceidip="<?php echo $row['id'];?>" data-proof="<?php echo $row['proofIp'];?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">IP Config</a>
      </li>
      <li>
        <a href="#" onclick="modalShowProofApps(this)" data-deviceidapps="<?php echo $row['id'];?>" data-proof="<?php echo $row['proofInstalled'];?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Applications</a>
      </li>
    </ul> -->
    <!-- <div class="py-2">
      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated link</a>
    </div> -->
<!-- </div> -->
              </td>
              <td> 
                <button type="button" onclick="modalShowProofIp(this)" data-deviceidip="<?php echo $row['id'];?>" data-proof="<?php echo $row['proofIp'];?>"   class="<?php if($row['proofIp'] == null) { echo "bg-blue-600";} else{echo "bg-green-600";}?>  block text-white  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Ip Con
</button>
            </td>
            <td> 
                <button type="button" onclick="modalShowProofApps(this)" data-deviceidapps="<?php echo $row['id'];?>" data-proof="<?php echo $row['proofInstalled'];?>"  class="block text-white <?php if($row['proofInstalled'] == null) { echo "bg-blue-600";} else{echo "bg-green-600";}?>  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
 Apps
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


<div id="deviceHistoryModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-sm shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Device Activity   
                </h3>
                <button type="button" onclick="modalCloseHistory()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="m-2 justify-center text-center flex items-start h-auto bg-gradient-to-r from-blue-900 to-teal-500 rounded-lg ">
<div class="text-center py-2 m-auto lg:text-center w-full">
     
<div class="FrD3PA">
    <div class="QnQnDA" tabindex="-1">
        <div  role="tablist" class="_6TVppg sJ9N9w">
            <div class="uGmi4w">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="tabExample" role="tablist">
                <li  role="presentation">
                <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                    <button id="jobOrderTab"  onclick="goToJo()" type="button" role="tab" aria-controls="headApproval"  class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA"  aria-selected="false">
                        <div class="_1cZINw">
                        <div class="_qiHHw Ut_ecQ kHy45A">

<img src="../resources/img/list.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

</div>
                        </div>
                        <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Job Order</p>
                    </button></div>
                </li>
                <li role="presentation">
                                    <div class="p__uwg" style="width: 106px; margin-right: 0px;">
                                        <button id="pmsTab" onclick="goToPms()" type="button" role="tab"
                                            aria-controls="overall"
                                            class="_1QoxDw o4TrkA CA2Rbg Di_DSA cwOZMg zQlusQ uRvRjQ POMxOg _lWDfA"
                                            aria-selected="false">
                                            <div class="_1cZINw">
                                                <div class="_qiHHw Ut_ecQ kHy45A">

                                                <span class="gkK1Zg jxuDbQ"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24s10.7 24 24 24 24-10.7 24-24S37.3 0 24 0zM11.9 15.2c.1-.1.2-.1.2-.1 1.6-.5 2.5-1.4 3-3 0 0 0-.1.1-.2l.1-.1c.1 0 .2-.1.3-.1.4 0 .5.3.5.3.5 1.6 1.4 2.5 3 3 0 0 .1 0 .2.1s.1.2.1.3c0 .4-.3.5-.3.5-1.6.5-2.5 1.4-3 3 0 0-.1.3-.4.3-.6.1-.7-.2-.7-.2-.5-1.6-1.4-2.5-3-3 0 0-.4-.1-.4-.5l.3-.3zm24.2 18.6c-.5.2-.9.6-1.3 1s-.7.8-1 1.3c0 0 0 .1-.1.2-.1 0-.1.1-.3.1-.3-.1-.4-.4-.4-.4-.2-.5-.6-.9-1-1.3s-.8-.7-1.3-1c0 0-.1 0-.1-.1-.1-.1-.1-.2-.1-.3 0-.3.2-.4.2-.4.5-.2.9-.6 1.3-1s.7-.8 1-1.3c0 0 .1-.2.4-.2.3 0 .4.2.4.2.2.5.6.9 1 1.3s.8.7 1.3 1c0 0 .2.1.2.4 0 .4-.2.5-.2.5zm-.7-8.7s-4.6 1.5-5.7 2.4c-1 .6-1.9 1.5-2.4 2.5-.9 1.5-2.2 5.4-2.2 5.4-.1.5-.5.9-1 .9v-.1.1c-.5 0-.9-.4-1.1-.9 0 0-1.5-4.6-2.4-5.7-.6-1-1.5-1.9-2.5-2.4-1.5-.9-5.4-2.2-5.4-2.2-.5-.1-.9-.5-.9-1h.1-.1c0-.5.4-.9.9-1.1 0 0 4.6-1.5 5.7-2.4 1-.6 1.9-1.5 2.4-2.5.9-1.5 2.2-5.4 2.2-5.4.1-.5.5-.9 1-.9s.9.4 1 .9c0 0 1.5 4.6 2.4 5.7.6 1 1.5 1.9 2.5 2.4 1.5.9 5.4 2.2 5.4 2.2.5.1.9.5.9 1h-.1.1c.1.5-.2.9-.8 1.1z"></path></svg></span>

                                                </div>
                                            </div>
                                            <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">PMS</p>
                                        </button></div>
                                </li>
                <li  role="presentation">
                    
                <div class="p__uwg" style="width: 113px; margin-left: 16px; margin-right: 0px;">
                <button id="editTab" onclick="goToEdit()"
                        class="_1QoxDw o4TrkA CA2Rbg cwOZMg zQlusQ uRvRjQ POMxOg" type="button" tabindex="-1" role="tab" aria-controls="adminApproval" aria-selected="false">
                        <div class="_1cZINw">
                            <div class="_qiHHw Ut_ecQ kHy45A">

                            <img src="../resources/img/note.png" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            </div>
                        </div>
                        <p class="_5NHXTA _2xcaIA ZSdr0w CCfw7w GHIRjw">Edit</p>
                    </button></div>
                </li>   
            
              
                    </ul>
            </div>
            <div class="rzHaWQ theme light" id="diamondHistory" style="transform: translateX(55px) translateY(2px) rotate(135deg);"></div>
        </div>
    </div>
</div>
<div class="hidden"> 
<ul class="uGmi4w  mb-1 m-4 flex text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow  dark:divide-gray-700 dark:text-gray-400">
    <li class="w-full relative">
        <a href="#" class="inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">For Approval</a>
        <div class="rzHaWQ theme light" style="transform: translateX(198px) translateY(2px) rotate(135deg);"></div>
  
    </li>
    <li class="w-full">
        <a href="#" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Dashboard</a>
    </li>
    <li class="w-full">
        <a href="#" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Settings</a>
    </li>
    <li class="w-full">
        <a href="#" class="inline-block w-full p-4 bg-white rounded-r-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Invoice</a>
    </li>

</ul>

</div>

</div>
                                      </div>

    <div id="myTabContentHistory" >
    <div class="hidden p-4 rounded-lg " id="johistory" role="tabpanel" aria-labelledby="jo-tab">
    <div id="divContainerForHistory" class="overflow-auto h-96 relative w-full  " >
        <!-- <div class=" mt-2.5 rounded-lg bg-gray-50 dark:bg-gray-800 w-full p-6 ">
            <div class="grid grid-cols-2 gap-4 place-content-between ">
                <div>
                    <h4>Request</h4>
                </div>
                <div class="text-right">
                <h4>Request ID: 2304-002</h4>
                </div>
            </div>
            <p class="mt-0 text-gray-500 dark:text-gray-400">
                The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is
                meant to ensure a common set of data rights in the European Union.
            </p>
            <div class="grid grid-cols-2 gap-4 place-content-between ">
                <div>
                    <h4>Requestor: Kimberly Bautista</h4>
                </div>
                <div class="text-right">
                <h4>Date: May 01, 2023</h4>

                </div>
            </div>
            <div class="mt-2">
            <div class="grid grid-cols-2 gap-4 place-content-between ">
                <div>
                    <h4>Action</h4>
                </div>
                <div class="text-right">
                    <h4>Date: May 05, 2023</h4>
                </div>
            </div>
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                The European Union’s General Data Protection Regulation (G.D.P.R.).
            </p>
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                The European Union’s General Data Protection Regulation (G.D.P.R.).
            </p>
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                The European Union’s General Data Protection Regulation (G.D.P.R.).
            </p>
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
            With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply
            </p>
            </div>
            
        </div> -->
       
        </div>
    </div>
        <div class="hidden p-4 rounded-lg " id="pmshistory" role="tabpanel" aria-labelledby="pms-tab">
    <div id="divContainerForHistoryPms"  class="overflow-auto h-96 relative w-full" >
                <!-- <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                 -->
            </div>
        </div>
        <div class="hidden p-4 rounded-lg " id="edithistory" role="tabpanel" aria-labelledby="edit-tab">
    <div  id="divContainerForHistoryEdit" class="overflow-auto h-96 relative w-full p-6 " >
                
            </div>
        </div>
        </div>
           
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <!-- <button  type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button> -->
                <button  type="button" onclick="modalCloseHistory()"class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
// function exportDevices(){
  
//   var table = document.getElementById("workingStationTable");
//   var rows =[];

//            column1 = 'No.';
//            column2 = 'PC Tag';
//            column3 = 'Host Name';
//            column4 = 'Asset Tag';
//            column5 = 'Type';
//            column6 = 'User';
//            column7 = 'IP Address';
//            column8 = 'Department';


           
//            rows.push(
//                [
//                    column1,
//                    column2,
//                    column3,
//                    column4,
//                    column5,
//                    column6,
//                    column7,
//                    column8,


                  
            
//                ]
//            );
           
//   for(var i=0,row; row = table.rows[i];i++){
//         column1 = row.cells[0].innerText;
//            column2 = row.cells[1].innerText;
//            column3 = row.cells[2].innerText;
//            column4 = row.cells[3].innerText;
//            column5 = row.cells[4].innerText;
//            column6 = row.cells[5].innerText;
//            column7 = row.cells[6].innerText;
//            column8 = row.cells[7].innerText;


           
//            rows.push(
//                [
//                    column1,
//                    column2,
//                    column3,
//                    column4,
//                    column5,
//                    column6,
//                    column7,
//                    column8,


                  
            
//                ]
//            );

//   }
//   csvContent = "data:text/csv;charset=utf-8,";
//         /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
//        rows.forEach(function(rowArray){
//            row = rowArray.join(",");
//            csvContent += row + "\r\n";
//        });
 
//        /* create a hidden <a> DOM node and set its download attribute */
//        var encodedUri = encodeURI(csvContent);
//        var link = document.createElement("a");
//        link.setAttribute("href", encodedUri);
//        link.setAttribute("download", "Devices.csv");
//        document.body.appendChild(link);
//         /* download the data file named "Stock_Price_Report.csv" */
//        link.click();
// }

    
</script>




  