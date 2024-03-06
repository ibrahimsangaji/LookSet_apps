// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
// var ctx = document.getElementById("myPieChart");
// var myPieChart = new Chart(ctx, {
//   type: 'doughnut',
//   data: {
//     labels: ["Direct", "Referral", "Social"],
//     datasets: [{
//       data: [55, 30, 15],
//       backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
//       hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
//       hoverBorderColor: "rgba(234, 236, 244, 1)",
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       caretPadding: 10,
//     },
//     legend: {
//       display: false
//     },
//     cutoutPercentage: 80,
//   },
// });

var ctx = document.getElementById("myPieChartAmount");
var myPieChartAmount = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Amount"],
    datasets: [{
      data: [totalAssets],
      backgroundColor: ['#4e73df'],
      hoverBackgroundColor: ['#2e59d9'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("myPieChartInbound");
var dataTotalInbound = totalInbound ?? 0;
var penguranganInbound = totalAssets - dataTotalInbound;
var myPieChartInbound = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Inbound", "Remaining"],
    datasets: [{
      data: [dataTotalInbound, penguranganInbound],
      backgroundColor: ['#1cc88a', '#D7DBDD'],
      hoverBackgroundColor: ['#17a673', '#BDC3C7'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("myPieChartOutbound");
var dataTotalOutbound = totalOutbound ?? 0;
var penguranganOutbound = totalAssets - dataTotalOutbound;
var myPieChartOutbound = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Outbound", "Remaining"],
    datasets: [{
      data: [dataTotalOutbound, penguranganOutbound],
      backgroundColor: ['#36b9cc', '#D7DBDD'],
      hoverBackgroundColor: ['#2c9faf', '#BDC3C7'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("myPieChartRepair");
var dataTotalRepair = totalRepair ?? 0;
var penguranganRepair = totalAssets - dataTotalRepair;
var myPieChartRepair = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Repair", "Remaining"],
    datasets: [{
      data: [dataTotalRepair, penguranganRepair],
      backgroundColor: ['#ffc107', '#D7DBDD'],
      hoverBackgroundColor: ['#daa609', '#BDC3C7'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("myPieChartLost");
var dataTotalLost = totalLost ?? 0;
var penguranganLost = totalAssets - dataTotalLost;
var myPieChartLost = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Lost", "Remaining"],
    datasets: [{
      data: [dataTotalLost, penguranganLost],
      backgroundColor: ['#dc3545', '#D7DBDD'],
      hoverBackgroundColor: ['#dd0b20', '#BDC3C7'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
