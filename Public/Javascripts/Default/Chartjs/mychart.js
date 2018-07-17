/**
 * Created by Mehdi on 27/03/2018.
 */
var ctx = document.getElementById("myChart");
//console.log(ctx);
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["March", "April", "May", "June", "July", "August"],
        datasets: [{
            label: 'k of visitor',
            data: [12, 19, 8, 6, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
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


$.getJSON("./json/test.json", function (data) {
    console.log('getjson');
    $.each(data, function (index, value) {
        console.log(value);
    });
});


var containerStatTosle = document.getElementById('chart-view-tosle');
var chartViewTosle = new Chart(containerStatTosle, {
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            data: [30, 50, 29, 12, 26]
        }]
    },
    options: {
        showLines: true
    }
});