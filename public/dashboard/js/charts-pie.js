/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
function pieLoad(student, teacher, coordinator){
  const pieConfig = {
    type: 'doughnut',
    data: {
      datasets: [
        {
          data: [student, teacher, coordinator],
          /**
           * These colors come from Tailwind CSS palette
           * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
           */
          backgroundColor: ['#ff5a1f', '#0e9f6e', '#3f83f8'],
          label: 'Dataset 1',
        },
      ],
      labels: ['Students', 'Teachers', 'Coordinators'],
    },
    options: {
      responsive: true,
      cutoutPercentage: 80,
      /**
       * Default legends are ugly and impossible to style.
       * See examples in charts.html to add your own legends
       *  */
      legend: {
        display: false,
      },
    },
  }
  
  // change this to the id of your chart element in HMTL
  const pieCtx = document.getElementById('pie')
  window.myPie = new Chart(pieCtx, pieConfig)
  
}
