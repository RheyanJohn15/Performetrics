function loadStudentResult(question, score){
  const barConfig = {
    type: 'bar',
    data: {
      labels: question,
      datasets: [
        {
          label: '',
          backgroundColor: '#0694a2',
          // borderColor: window.chartColors.red,
          borderWidth: 1,
          data: score,
          
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: false,
      },
      scales: {
        y: {
          suggestedMin: 0, // Set the minimum value for the Y-axis
          suggestedMax: 4, // Set the maximum value for the Y-axis
        },
      },
    },
  };
  
  const barsCtx = document.getElementById('barsStudent');
  window.myBar = new Chart(barsCtx, barConfig);
  
      
}


function loadTeacherResult(question, score){
  const barConfig = {
    type: 'bar',
    data: {
      labels: question,
      datasets: [
        {
          label: '',
          backgroundColor: '#7e3af2',
          // borderColor: window.chartColors.red,
          borderWidth: 1,
          data: score,
          
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        display: false,
      },
      scales: {
        y: {
          suggestedMin: 0, // Set the minimum value for the Y-axis
          suggestedMax: 4, // Set the maximum value for the Y-axis
        },
      },
    },
  };
  
  const barsCtx = document.getElementById('barsTeacher');
  window.myBar = new Chart(barsCtx, barConfig);
  
      
}