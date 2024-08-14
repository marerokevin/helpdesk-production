
  
$(document).ready(function () {
  
    $('#employeeTable').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0},
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
              
            
  });

  
