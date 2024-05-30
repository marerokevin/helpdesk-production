
$(document).ready(function () {
  
    $('#employeeTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      order: [[ 1, 'asc' ]]
    });
  
  });

  $(document).ready(function () {
  
    $('#adminApprovalTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
      {"className": "dt-center", "targets": "_all"}
  

    ],
  
      responsive: true,
      
    }   );
  
  });
  $(document).ready(function () {
  
    $('#inProgressTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
    }   );
  
  });
  $(document).ready(function () {
  
    $('#toRateTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
    }   );
  
  });

  $(document).ready(function () {
  
    $('#pmsTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
    }   );
  
  });
  
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
  
    $('#workingStationTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
    }   );
  
  });
  
//   window.addEventListener('load', function() {
//     console.log('JavaScript code is being executed.');
//     document.getElementById('loading-message').style.display = 'block';
// });