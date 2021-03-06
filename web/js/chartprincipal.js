 //Coloca en funcionamiento la grafica principal
    //---------------------------------------------
    $(document).ready(function(){
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();
      
    });


var ctx = document.getElementById('Carreras').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Rojo', 'Azul', 'Amarillo', 'Verde', 'Purpura', 'Naranja'],
        datasets: [{
            label: 'Estadisticas Carreras',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('Profesores').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Rojo', 'Azul', 'Amarillo', 'Verde', 'Purpura', 'Naranja'],
        datasets: [{
            label: 'Estadisticas Profesores',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgb(0, 135, 221,.7)',
            ],
            borderColor: [
                'rgba(255, 255, 255)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var ctx = document.getElementById('Alumnos').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: ['Rojo', 'Azul', 'Amarillo', 'Verde', 'Purpura', 'Naranja'],
        datasets: [{
            label: 'Estadisticas Alumnos',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgb(0, 135, 221,.7)',
            ],
            borderColor: [
                'rgba(0,0,0,.5)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});