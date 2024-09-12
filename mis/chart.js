 
      const ctx = document.getElementById('myChart');
      const labels = ['January', 'February','March','April','May','June','July','August','September','October','November','December'];
new Chart(ctx, {
  type: 'line',
  data: {
    labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    borderColor: 'white',
    tension: 0.1,
    pointStyle: 'circle',
      pointRadius: 10,
      pointHoverRadius: 15,

  }],
  
  },
  options: {
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