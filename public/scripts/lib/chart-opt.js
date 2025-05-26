(function($){
  var options = {
    type: 'line',
    data: {
      labels: ["2013", "2014", "2015", "2016", "2018"],
      datasets: [
        {
          label: 'Laki Laki',
          data: [12, 19, 24, 28, 45],
          borderWidth: 1,
          backgroundColor: 'rgba(75, 192, 192, .15)'
        },
        {
          label: 'Perempuan',
          data: [7, 11, 35, 20, 35],
          borderWidth: 1,
          backgroundColor: 'rgba(153, 102, 255, .10)'

        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            reverse: false
          }
        }]
      }
    }
  }


  var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(231,233,237)'
  };

  var randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
  }

  function showGraphUser()
  {
    {
        $.post("/backend/user/jumuser/userbiasa",
          function (data){
                    console.log(data);
                    var tahun = [];
                    var nobulan = [];
                    var jum = [];

                    for (var i in data) {
                        tahun.push(data[i].yr);
                        nobulan.push(data[i].mon);
                        jum.push(data[i].jum);
                    }

                    var chartdata = {
                        labels: nobulan,
                        datasets: [{
                            label: 'Tahun',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: jum
                        }]
                    };

                    var graphTarget = $("#graphCanvas");

                    var lineGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
  function showGraphUserDinas()
  {
    {
        $.post("/backend/user/jumuser/dinas",
          function (data){
                    console.log(data);
                    var tahun = [];
                    var nobulan = [];
                    var jum = [];

                    for (var i in data) {
                        tahun.push(data[i].yr);
                        nobulan.push(data[i].mon);
                        jum.push(data[i].jum);
                    }

                    var chartdata = {
                        labels: nobulan,
                        datasets: [{
                            label: 'Tahun',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: jum
                        }]
                    };

                    var graphTarget = $("#graphCanvas");

                    var lineGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }

  var MONTHS = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
  var config = {
    type: 'line',
    data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
        label: "User Biasa",
        backgroundColor: chartColors.yellow,
        borderColor: chartColors.yellow,
        data: [
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()
        ],
        fill: false,
      }, {
        label: "User Baru",
        fill: false,
        backgroundColor: chartColors.green,
        borderColor: chartColors.green,
        data: [
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()
        ],
      }]
    },
    options: {
      responsive: true,
      title: {
        display: false,
        text: ''
      },
      tooltips: {
        mode: 'label',
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: false,
          scaleLabel: {
            display: true,
            labelString: 'Month'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: false,
            labelString: 'Value'
          }
        }]
      }
    }
  };



  window.onload = function () {
    var tourist = document.getElementById("chartJSContainer").getContext("2d");
    window.userExtrnal = new Chart(tourist, options);

    var chart = document.getElementById("canvas").getContext("2d");
    window.userInternal =new Chart(chart, config);

  };

});





