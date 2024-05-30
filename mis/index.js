
  
$(document).ready(function () {
  
    $('#employeeTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
    }   );
    $('#overAllTable').DataTable(  {
      "columnDefs": [
        { "width": "1%", "targets": 0},
        {"className": "dt-center", "targets": "_all"}
      ],
        responsive: true,
        
      }   );
      $('#overAllFinished').DataTable(  {
        "columnDefs": [
          { "width": "1%", "targets": 0},
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          
        }   );
      $('#forRatingTable').DataTable(  {
        "columnDefs": [
          { "width": "1%", "targets": 0},
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          
        }   );
        $('#cancelledTable').DataTable(  {
          "columnDefs": [
            { "width": "1%", "targets": 0},
            {"className": "dt-center", "targets": "_all"}
          ],
            responsive: true,
            
          }   );
          $('#adminApprovalTable').DataTable(  {
            "columnDefs": [
              { "width": "1%", "targets": 0},
              {"className": "dt-center", "targets": "_all"}
            ],
              responsive: true,
              
            }   );
            $('#inProgressTable').DataTable(  {
              "columnDefs": [
                { "width": "1%", "targets": 0},
                {"className": "dt-center", "targets": "_all"}
              ],
                responsive: true,
                
              }   );
              
              $('#toRateTable').DataTable(  {
                "columnDefs": [
                  { "width": "1%", "targets": 0},
                  {"className": "dt-center", "targets": "_all"}
                ],
                  responsive: true,
                  
                }   );
                $('#overAllEmployees').DataTable(  {
                  "columnDefs": [
                    { "width": "1%", "targets": 0},
                    {"className": "dt-center", "targets": "_all"}
                  ],
                    responsive: true,
                    
                  }   );
                  $('#pmsTable').DataTable(  {
                    "columnDefs": [
                      { "width": "1%", "targets": 0},
                      {"className": "dt-center", "targets": "_all"}
                    ],
                      responsive: true,
                      
                    }   );
                  
                    $(document).ready(function () {
  
                      $('#removableDeviceTable').DataTable(  {
                      "columnDefs": [
                        { "width": "1%", "targets": 0},
                        {"className": "dt-center", "targets": "_all"}
                      ],
                        responsive: true,
                        
                      }   );
                    
                    });
                    $(document).ready(function () {
  
                      $('#deviceHistoryTable').DataTable(  {
                      "columnDefs": [
                        { "width": "1%", "targets": 0},
                        {"className": "dt-center", "targets": "_all"}
                      ],
                        responsive: true,
                        
                      }   );
                    
                    });
                    $(document).ready(function () {
                      var table = $('#workingStationTable').DataTable({
                        select: {
                          style: 'multi'
                        },
                        "columnDefs": [
                          { "width": "1%", "targets": 0 },
                          { "className": "dt-center", "targets": "_all" }
                        ],
                        responsive: true,
                      });
                     
                      var selectedPcIds = []; // Array to store the selected PC IDs
                      var previousSelection = []; // Array to store the previously selected rows
                    
                      $('#workingStationTable').on('select.dt deselect.dt', function () {
                        var currentSelection = table.rows({ selected: true }).nodes().toArray();
                    
                        if (currentSelection.length > previousSelection.length) {
                          // New rows have been selected
                          var newSelectedRows = currentSelection.filter(function (row) {
                            return !previousSelection.includes(row);
                          });
                    
                          // Extract the PC IDs from the new selected rows
                          var newSelectedPcIds = newSelectedRows.map(function (row) {
                            return $(row).find('td:first').data('pcid');
                          });
                    
                          // Add the new selected PC IDs to the array
                          selectedPcIds = selectedPcIds.concat(newSelectedPcIds);
                        } else if (currentSelection.length < previousSelection.length) {
                          // Rows have been deselected
                          var deselectedRows = previousSelection.filter(function (row) {
                            return !currentSelection.includes(row);
                          });
                    
                          // Extract the PC IDs from the deselected rows
                          var deselectedPcIds = deselectedRows.map(function (row) {
                            return $(row).find('td:first').data('pcid');
                          });
                    
                          // Remove the deselected PC IDs from the array
                          selectedPcIds = selectedPcIds.filter(function (pcId) {
                            return !deselectedPcIds.includes(pcId);
                          });
                        }
                    
                        previousSelection = currentSelection.slice(); // Update the previous selection
                    
                        console.log(selectedPcIds);

                        // const divIdArrayUser = [1];
                        // divIdArrayUser.push(parseInt(inputCount));
                        document.getElementById("arrayOfSelected").value = selectedPcIds;
                        document.getElementById("arrayOfSelectedDel").value = selectedPcIds;

                      });

                    
                    
                      $('#showSelectedButton').click(function () {
                        console.log("Asd");
                        $.ajax({
                          url: './devices.php',
                          method: 'POST',
                          data: { deviceIds: selectedPcIdscctv },
                          success: function (response) {
                            // Handle the response from the server
                            // console.log(response);
                          },
                          error: function () {
                            // Handle the error case
                            console.log('Error updating devices');
                          }
                        });
                      });
                    });

                    $(document).ready(function () {
                      var tablecctv = $('#cctvTable').DataTable({
                        select: {
                          style: 'multi'
                        },
                        "columnDefs": [
                          { "width": "1%", "targets": 0 },
                          { "className": "dt-center", "targets": "_all" }
                        ],
                        responsive: true,
                      });
                     
                      var selectedPcIdscctv = []; // Array to store the selected PC IDs
                      var previousSelectioncctv = []; // Array to store the previously selected rows
                    
                      $('#cctvTable').on('select.dt deselect.dt', function () {
                        var currentSelection = tablecctv.rows({ selected: true }).nodes().toArray();
                    
                        if (currentSelection.length > previousSelectioncctv.length) {
                          // New rows have been selected
                          var newSelectedRows = currentSelection.filter(function (row) {
                            return !previousSelectioncctv.includes(row);
                          });
                    
                          // Extract the PC IDs from the new selected rows
                          var newSelectedPcIdscctv = newSelectedRows.map(function (row) {
                            return $(row).find('td:first').data('pcid');
                          });
                    
                          // Add the new selected PC IDs to the array
                          selectedPcIdscctv = selectedPcIdscctv.concat(newSelectedPcIdscctv);
                        } else if (currentSelection.length < previousSelectioncctv.length) {
                          // Rows have been deselected
                          var deselectedRows = previousSelectioncctv.filter(function (row) {
                            return !currentSelection.includes(row);
                          });
                    
                          // Extract the PC IDs from the deselected rows
                          var deselectedPcIdscctv = deselectedRows.map(function (row) {
                            return $(row).find('td:first').data('pcid');
                          });
                    
                          // Remove the deselected PC IDs from the array
                          selectedPcIdscctv = selectedPcIdscctv.filter(function (pcId) {
                            return !deselectedPcIdscctv.includes(pcId);
                          });
                        }
                    
                        previousSelectioncctv = currentSelection.slice(); // Update the previous selection
                    
                        console.log(selectedPcIdscctv);
  
                        // const divIdArrayUser = [1];
                        // divIdArrayUser.push(parseInt(inputCount));
                        document.getElementById("arrayOfSelectedcctv").value = selectedPcIdscctv;
                        document.getElementById("arrayOfSelectedDelcctv").value = selectedPcIdscctv;

                      })

                    
                    
                      $('#showSelectedButton').click(function () {
                        console.log("Asd");
                        $.ajax({
                          url: './devices.php',
                          method: 'POST',
                          data: { deviceIds: selectedPcIdscctv },
                          success: function (response) {
                            // Handle the response from the server
                            // console.log(response);
                          },
                          error: function () {
                            // Handle the error case
                            console.log('Error updating devices');
                          }
                        });
                      });
                    });
                    
                    $(document).ready(function () {
                      var tableprinter = $('#printerTable').DataTable({
                        select: {
                          style: 'multi'
                        },
                        "columnDefs": [
                          { "width": "1%", "targets": 0 },
                          { "className": "dt-center", "targets": "_all" }
                        ],
                        responsive: true,
                      });
                     
                      var selectedPcIdsprinter = []; // Array to store the selected PC IDs
                      var previousSelectionprinter = []; // Array to store the previously selected rows
                    
                      $('#printerTable').on('select.dt deselect.dt', function () {
                        var currentSelection = tableprinter.rows({ selected: true }).nodes().toArray();
                    
                        if (currentSelection.length > previousSelectionprinter.length) {
                          // New rows have been selected
                          var newSelectedRows = currentSelection.filter(function (row) {
                            return !previousSelectionprinter.includes(row);
                          });
                    
                          // Extract the PC IDs from the new selected rows
                          var newSelectedPcIdsprinter = newSelectedRows.map(function (row) {
                            return $(row).find('td:first').data('pcid');
                          });
                    
                          // Add the new selected PC IDs to the array
                          selectedPcIdsprinter = selectedPcIdsprinter.concat(newSelectedPcIdsprinter);
                        } else if (currentSelection.length < previousSelectionprinter.length) {
                          // Rows have been deselected
                          var deselectedRows = previousSelectionprinter.filter(function (row) {
                            return !currentSelection.includes(row);
                          });
                    
                          // Extract the PC IDs from the deselected rows
                          var deselectedPcIdsprinter = deselectedRows.map(function (row) {
                            return $(row).find('td:first').data('pcid');
                          });
                    
                          // Remove the deselected PC IDs from the array
                          selectedPcIdsprinter = selectedPcIdsprinter.filter(function (pcId) {
                            return !deselectedPcIdsprinter.includes(pcId);
                          });
                        }
                    
                        previousSelectionprinter = currentSelection.slice(); // Update the previous selection
                    
                        console.log(selectedPcIdsprinter);
  
                        // const divIdArrayUser = [1];
                        // divIdArrayUser.push(parseInt(inputCount));
                        document.getElementById("arrayOfSelectedprinter").value = selectedPcIdsprinter;
                        document.getElementById("arrayOfSelectedDelPrinter").value = selectedPcIdsprinter;

                      })

                    
                    
                      $('#showSelectedButton').click(function () {
                        console.log("Asd");
                        $.ajax({
                          url: './devices.php',
                          method: 'POST',
                          data: { deviceIds: selectedPcIdsprinter },
                          success: function (response) {
                            // Handle the response from the server
                            // console.log(response);
                          },
                          error: function () {
                            // Handle the error case
                            console.log('Error updating devices');
                          }
                        });
                      });
                    });
              
            
  });
    // Submit the form and prevent page refresh
    const $targetDeviceModal = document.getElementById('editDeviceModal');
const optionsModalDevice = {
  placement: 'center-center',
  backdrop: 'dynamic',
  backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
  closable: true,
  onHide: () => {
      console.log('modal is hidden');
  },
  onShow: () => {
      console.log('modal is shown');

  },
  onToggle: () => {
      console.log('modal has been toggled');

  }
};
const modalDevice = new Modal($targetDeviceModal, optionsModalDevice);

const $targetDeviceModalCctv = document.getElementById('editDeviceModalCctv');
const optionsModalDeviceCctv = {
  placement: 'center-center',
  backdrop: 'dynamic',
  backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
  closable: true,
  onHide: () => {
      console.log('modal is hidden');
  },
  onShow: () => {
      console.log('modal is shown');

  },
  onToggle: () => {
      console.log('modal has been toggled');

  }
};
const modalDeviceCctv = new Modal($targetDeviceModalCctv, optionsModalDeviceCctv);



const $targetDeviceModalPrinter = document.getElementById('editDeviceModalPrinter');
const optionsModalDevicePrinter = {
  placement: 'center-center',
  backdrop: 'dynamic',
  backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
  closable: true,
  onHide: () => {
      console.log('modal is hidden');
  },
  onShow: () => {
      console.log('modal is shown');

  },
  onToggle: () => {
      console.log('modal has been toggled');

  }
};
const modalDevicePrinter = new Modal($targetDeviceModalPrinter, optionsModalDevicePrinter);



var selectHTML = "";


var xhr1 = new XMLHttpRequest();
xhr1.onreadystatechange = function() {
    if (xhr1.readyState === XMLHttpRequest.DONE) {
        if (xhr1.status === 200) {
            var options = JSON.parse(xhr1.responseText);

            // Create a string variable to store the HTML

            // Iterate over the options and create <option> elements
            options.forEach(function(option) {
                selectHTML += "<option  value='" + option.ipaddress + "'>" + option.ipaddress + "</option>";
            });
            // selectHTML += "</select>";

            // You can now use the 'selectHTML' variable as needed
            // console.log(selectHTML);
        } else {
            console.log("Error: " + xhr1.status);
        }
    }
};
xhr1.open("GET", "getVacantIpAddress.php", true);
xhr1.send();

    document.getElementById("myForm").addEventListener("submit", function(event) {

      event.preventDefault();

      // Make an AJAX request to getData.php
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "./getData.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              // Parse the JSON response
              var response = JSON.parse(xhr.responseText);
              
              console.log(response); // Log the response array to the console
              // var divContainer = document.getElementById("divContainer");
              const inputContainer = document.getElementById("inputDevicesData");
              inputContainer.innerHTML="";



              // Clear any existing content in the div
              // divContainer.innerHTML = "";
              
              // Generate rows of inputs based on the response
              document.getElementById('numberOfSelectedDevices').value=response.length;
              for (var i = 0; i < response.length; i++) {
                const div =document.createElement("div");
                div.classList.add("grid");
                div.classList.add("gap-1");
                // div.classList.add("grid-cols-1");
                if (window.innerWidth >= 1200) { // Large screen (lg)
                  div.classList.add('lg:grid-cols-13');
                } else if (window.innerWidth >= 992) { // Medium screen (md)
                  div.classList.add('md:grid-cols-8');
                } else if (window.innerWidth >= 768) { // Small screen (sm)
                  div.classList.add('sm:grid-cols-2');
                } else { // Default or other screen sizes
                  div.classList.add('grid-cols-2');
                }



                div.id = "div"+i+"";

                var status;
                var edr;
                var kas;
                var itnavi;



                var isinactive = response[i].deactivated;
                if(isinactive == 0){
                status = "<option selected value='0'>Active</option><option  value='1'>In Active</option> ";

                }
                else{
                  status = "<option  value='0'>Active</option><option selected value='1'>In Active</option> ";

                }
                var edrstat = response[i].edr;
                var kasstat = response[i].kaspersky;
                var itnavistat = response[i].itnavi;


                console.log("hays" + edrstat)
                if(edrstat=="1"){
                  edr = "checked";
  
                  }
                  else{
                    edr = "";
  
                  }

                  if(kasstat=="1"){
                    kas = "checked";
    
                    }
                    else{
                      kas = "";
    
                    }
                    
                  if(itnavistat=="1"){
                    itnavi = "checked";
    
                    }
                    else{
                      itnavi = "";
    
                    }

                var set = "<div class='w-full'><input name='deviceId"+i+"' value='"+response[i].id+"' class='hidden' type='text'> <input name='pcTag"+i+"' value='"+response[i].pctag+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Insert PC Tag' ></div><div class='w-full'><input name='assetTag"+i+"' value='"+response[i].assetTag+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='FFFE-123' ></div><div class='w-full'><input name='pcname"+i+"' value='"+response[i].computerName+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='PC Name' ></div><div class='w-full'><input name='pcpassword"+i+"' value='"+response[i].password+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Password' ></div><div class='w-full'><input name='type"+i+"' value='"+response[i].type+"' type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Type' ></div><div class='w-full'><input name='user"+i+"' value='"+response[i].user+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Full Name' ></div><div class='w-full'><select  name='ipaddress"+i+"' class='js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'><option selected value='"+response[i].ipAddress+"'>"+response[i].ipAddress+"</option> <option value='Dynamic'>Dynamic</option> "+selectHTML+" </select></div><div class='w-full'><input name='department"+i+"' value='"+response[i].department+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Department' ></div><div class='w-full'><input name='macAddress"+i+"' value='"+response[i].macAddress+"' type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Mac Address' ></div><div class='w-full'><input name='email"+i+"'  type='text' value='"+response[i].email+"'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Email' ></div><div class='w-full'><select name='os"+i+"'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'><option selected value='"+response[i].os+"'>"+response[i].os+"</option> <option  value='Windows 7'>Windows 7</option>  <option  value='Windows 8'>Windows 8</option><option  value='Windows 10'>Windows 10</option><option  value='Windows 11'>Windows 11</option><option  value='Android'>Android</option>  <option  value='Windows Server'>Windows Server</option><option  value='Linux'>Linux</option></select> </div><div class='w-full'> <select name='status"+i+"'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'> "+status+" </select></div><div class='w-full'> <input  "+edr+" type='checkbox' value='1' name='edr"+i+"'  class='mr-4 w-10 h-10 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'><input "+kas+" type='checkbox' value='1' name='kas"+i+"'  class=' mr-4 w-10 h-10 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'> <input "+itnavi+" type='checkbox' value='1' name='itnavi"+i+"'  class=' mr-4 w-10 h-10 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'> </div>";

                //
                
                // <div class='w-full'><input name='status"+i+1+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Active/Inactive' required></div>
                  div.innerHTML=set;
                  inputContainer.appendChild(div);
                $('.js-example-basic-single').select2();

                  
              }
         modalDevice.toggle();
            
              
          }
      };
      xhr.send("updateSelected=true&arrayOfSelected=" + encodeURIComponent(document.getElementById("arrayOfSelected").value));
      

  });

  

  document.getElementById("myFormcctv").addEventListener("submit", function(event) {

    event.preventDefault();

    // Make an AJAX request to getData.php
    var xhrcctv = new XMLHttpRequest();
    xhrcctv.open("POST", "./getDataCctv.php", true);
    xhrcctv.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhrcctv.onreadystatechange = function() {
        if (xhrcctv.readyState === 4 && xhrcctv.status === 200) {
            // Parse the JSON response
            var response = JSON.parse(xhrcctv.responseText);
            
            console.log(response); // Log the response array to the console
            // var divContainer = document.getElementById("divContainer");
            const inputContainer = document.getElementById("inputDevicesDataCctv");
            inputContainer.innerHTML="";



            // Clear any existing content in the div
            // divContainer.innerHTML = "";
            
            // Generate rows of inputs based on the response
            document.getElementById('numberOfSelectedDevicesCctv').value=response.length;
            for (var i = 0; i < response.length; i++) {
              const div =document.createElement("div");
              div.classList.add("grid");
              div.classList.add("gap-1");
              div.classList.add("md:grid-cols-6");
              div.id = "div"+i+"";



              var set = "<div class='w-full'><input name='deviceId"+i+"' value='"+response[i].id+"' class='hidden' type='text'> <input name='dvrNo"+i+"' value='"+response[i].dvrNo+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Insert PC Tag' ></div><div class='w-full'><input name='cameraNo"+i+"' value='"+response[i].cameraNo+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='FFFE-123' ></div><div class='w-full'><input name='location"+i+"' value='"+response[i].location+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='PC Name' ></div><div class='w-full'><input name='type"+i+"' value='"+response[i].type+"' type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Type' ></div><div class='w-full'><input name='bldgAssigned"+i+"' value='"+response[i].bldgAssigned+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Full Name' ></div><div class='w-full'><select  name='ipaddress"+i+"' class='js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'><option selected value='"+response[i].ipAddress+"'>"+response[i].ipAddress+"</option> <option value='None'>None</option> <option value='Dynamic'>Dynamic</option> "+selectHTML+" </select></div>";

              //
              
              // <div class='w-full'><input name='status"+i+1+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Active/Inactive' required></div>
                div.innerHTML=set;
                inputContainer.appendChild(div);
              $('.js-example-basic-single').select2();

                
            }
            modalDeviceCctv.toggle();
          
            
        }
    };
    xhrcctv.send("updateSelectedcctv=true&arrayOfSelectedcctv=" + encodeURIComponent(document.getElementById("arrayOfSelectedcctv").value));
    

});











// document.getElementById("myFormExportDevices").addEventListener("submit", function(event) {
function exportDevices (){
  var xhrdevices = new XMLHttpRequest();
xhrdevices.onreadystatechange = function() {
    if (xhrdevices.readyState === XMLHttpRequest.DONE) {
        if (xhrdevices.status === 200) {
            var response = JSON.parse(xhrdevices.responseText);
          console.log (response)
           
          
  // var table = document.getElementById("workingStationTable");
  var rows =[];

           column1 = 'No.';
           column2 = 'PC Tag';
           column3 = 'Host Name';
           column4 = 'Asset Tag';
           column5 = 'Type';
           column6 = 'User';
           column7 = 'IP Address';
           column8 = 'MAC Address';
           column9 = 'Department';
           column10 = 'OS';
           column11 = 'EDR';
           column12 = 'Kaspersky';
           column13 = 'IT Navi';




           
           rows.push(
               [
                   column1,
                   column2,
                   column3,
                   column4,
                   column5,
                   column6,
                   column7,
                   column8,
                   column9,
                   column10,
                   column11,
                   column12,
                   column13,






                  
            
               ]
           );
           
  for(var i=0,row; i < response.length;i++){
           column1 = parseInt(i) +1;
           column2 = response[i].pctag;
           column3 = response[i].computerName;

           column4 = response[i].assetTag;
           column5 = response[i].type;
           column6 = response[i].user;
           column7 = response[i].ipAddress;
           column8 = response[i].macAddress;
           column9 = response[i].department;
           column10 = response[i].os;
           column11 = response[i].edr;
           column12 = response[i].kaspersky;
           column13 = response[i].itnavi;




           
           rows.push(
               [
                   column1,
                   column2,
                   column3,
                   column4,
                   column5,
                   column6,
                   column7,
                   column8,
                   column9,
                   column10,
                   column11,
                   column12,
                   column13,


           
               ]
           );

  }
  csvContent = "data:text/csv;charset=utf-8,";
        /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
          row = rowArray.join('","');
          row = '"' + row + '"';
          csvContent += row + "\r\n";
      });
 
       /* create a hidden <a> DOM node and set its download attribute */
       var encodedUri = encodeURI(csvContent);
       var link = document.createElement("a");
       link.setAttribute("href", encodedUri);
       link.setAttribute("download", "Devices.csv");
       document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
       link.click();


        } else {
            console.log("Error: " + xhrdevices.status);
        }
    }
};
xhrdevices.open("GET", "getDevices.php", true);
xhrdevices.send();




  // console.log("nyek"); 

  // event.preventDefault();

  // // Make an AJAX request to getData.php
  // var xhrdevices = new XMLHttpRequest();
  
  // xhrdevices.open("POST", "./getDevices.php", true);
  // xhrdevices.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  // xhrdevices.onreadystatechange = function() {
  //   console.log("nyek");
  //   console.log(xhrdevices.readyState)
  //     if (xhrdevices.readyState === 4 && xhrdevices.status === 200) {
  //         // Parse the JSON response.
  //   console.log("nyeks");

  //         var response = JSON.parse(xhrdevices.responseText);
          
  //         console.log(response); 





         
        
          
  //     }
  // };
  // xhrdevices.send();
  

// });

}




















document.getElementById("myFormprinter").addEventListener("submit", function(event) {

  event.preventDefault();

  // Make an AJAX request to getData.php
  var xhrprinter = new XMLHttpRequest();
  xhrprinter.open("POST", "./getDataPrinter.php", true);
  xhrprinter.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhrprinter.onreadystatechange = function() {
      if (xhrprinter.readyState === 4 && xhrprinter.status === 200) {
          // Parse the JSON response
          var response = JSON.parse(xhrprinter.responseText);
          
          console.log(response); // Log the response array to the console
          // var divContainer = document.getElementById("divContainer");
          const inputContainer = document.getElementById("inputDevicesDataPrinter");
          inputContainer.innerHTML="";



          // Clear any existing content in the div
          // divContainer.innerHTML = "";
          
          // Generate rows of inputs based on the response
          document.getElementById('numberOfSelectedDevicesPrinter').value=response.length;
          for (var i = 0; i < response.length; i++) {
            const div =document.createElement("div");
            div.classList.add("grid");
            div.classList.add("gap-1");
            div.classList.add("md:grid-cols-5");
            div.id = "div"+i+"";



            var set = "<div class='w-full'><input name='deviceId"+i+"' value='"+response[i].id+"' class='hidden' type='text'> <input name='type"+i+"' value='"+response[i].type+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Insert PC Tag' ></div><div class='w-full'><input name='model"+i+"' value='"+response[i].model+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='FFFE-123' ></div><div class='w-full'><input name='location"+i+"' value='"+response[i].location+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='PC Name' ></div><div class='w-full'><input name='serialNo"+i+"' value='"+response[i].serialNo+"' type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Type' ></div><div class='w-full'><select  name='ipaddress"+i+"' class='js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'><option selected value='"+response[i].ipAddress+"'>"+response[i].ipAddress+"</option> <option value='None'>None</option> <option value='Dynamic'>Dynamic</option> "+selectHTML+" </select></div>";

            //
            
            // <div class='w-full'><input name='status"+i+1+"' type='text'  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Active/Inactive' required></div>
              div.innerHTML=set;
              inputContainer.appendChild(div);
            $('.js-example-basic-single').select2();

              
          }
          modalDevicePrinter.toggle();
        
          
      }
  };
  xhrprinter.send("updateSelectedprinter=true&arrayOfSelectedprinter=" + encodeURIComponent(document.getElementById("arrayOfSelectedprinter").value));
  

});









  function removeSet(id){

    // Retrieve the element by its id
var element = document.getElementById('div'+id);

// Check if the element exists
if (element) {
  // Retrieve the parent element
  var parentElement = element.parentNode;
  
  // Remove the element from its parent
  parentElement.removeChild(element);
}

}
  function devicemodalHide(){
    modalDevice.toggle();

  }

  function devicemodalHideCctv(){
    modalDeviceCctv.toggle();

  }

  function devicemodalHidePrinter(){
    modalDevicePrinter.toggle();

  }
  
  // $(document).ready(function() {
  //   $('#myForm').submit(function(e) {
  //     e.preventDefault(); // Prevent the form from submitting normally
  
  //   $.ajax({
  //       type: 'POST',
  //       url: 'getData.php',
  //       dataType: 'json',
  //       success: function(data) {
  //         console.log(data); // Log the entire array
      
  //         // Log each array in $rowsList individually
  //         data.forEach(function(array) {
  //           console.log(array);
  //         });
  //       },
  //       error: function(xhr, status, error) {
  //         console.error(error); // Display an error message if the request fails
  //       }
  //     });
  //   });
  // });


  
  // $.ajax({
  //   type: 'POST',
  //   url: 'getData.php',
  //   dataType: 'json',
  //   success: function(data) {
  //     console.log(data); // Log the entire array
  
  //     // Log each array in $rowsList individually
  //     data.forEach(function(array) {
  //       console.log(array);
  //     });
  //   },
  //   error: function(xhr, status, error) {
  //     console.error(error); // Display an error message if the request fails
  //   }
  // });


  function slideMainContent(){
    if(sidebar==0){
    document.getElementById("mainContent").style.width="100%";  
    document.getElementById("mainContent").style.marginLeft= "0px"; 
    // document.getElementById("sidebar").style.opacity= ""; 
    // document.getElementById("sidebar").style.transition = "all .1s";
    
    document.getElementById("mainContent").style.transition = "all .3s";
    
    
    
    
    
    
    sidebar=1;
    }
    else{
      document.getElementById("mainContent").style.width="calc(100% - 280px)";  
    document.getElementById("mainContent").style.marginLeft= "280px";  
    
    sidebar=0;
    }
    
    }
