 
     
     const ctx = document.getElementById('myChart');
      const labels = ['January', 'February','March','April','May','June','July','August','September','October','November','December'];
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
  datasets: [{
    label: 'Number of Task', // First set of bars
    data: [65, 59, 80, 81, 56, 55, 40, 45, 50, 35, 60, 70], // Data for Dataset 1
    backgroundColor: '#c9cbcf', // One color for all bars
    borderColor: '#c9cbcf', // Border color for Dataset 1
    borderWidth: 1
  },
  {
    label: 'Finished Tasks', // Second set of bars
    data: [45, 69, 60, 75, 46, 65, 60, 55, 40, 50, 65, 80], // Data for Dataset 2
    backgroundColor: '#4bc0c0', // Another color for all bars
    borderColor: '#4bc0c0', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'On The Spot', // Second set of bars
    data: [45, 69, 60, 75, 46, 65, 60, 55, 40, 50, 65, 80], // Data for Dataset 2
    backgroundColor: '#9966ff', // Another color for all bars
    borderColor: '#9966ff', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'Late', // Second set of bars
    data: [45, 69, 60, 75, 46, 65, 60, 55, 40, 50, 65, 80], // Data for Dataset 2
    backgroundColor: '#ff6384', // Another color for all bars
    borderColor: '#ff6384', // Border color for Dataset 2
    borderWidth: 1
  },
  {
    label: 'On Going', // Second set of bars
    data: [45, 69, 60, 75, 46, 65, 60, 55, 40, 50, 65, 80], // Data for Dataset 2
    backgroundColor: '#ffcd56', // Another color for all bars
    borderColor: '#ffcd56', // Border color for Dataset 2
    borderWidth: 1
  },
],
  
  },

  options: {
    legend: {
      labels: {
        fontColor: 'white' // Change legend label color
      }
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontColor: 'white'
          },
          gridLines: {
            color: '#ffffff8c' // Change this to your desired grid line color
          }
        }],
        xAxes: [{
            ticks: {
              beginAtZero: true,
              fontColor: 'white'
            },
            gridLines: {
              color: '#ffffff8c' // Change this to your desired grid line color
            }
          }],
        
      }
    
  },
  fill: false,
  borderColor: 'white',

});