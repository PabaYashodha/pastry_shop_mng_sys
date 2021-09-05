$(document).ready(function () {
//   FusionCharts.ready(function () {
//     var myChart = new FusionCharts({
//       type: "msline",
//       renderAt: "chart-container",
//       width: "100%",
//       height: "75%",
//       dataFormat: "json",
//       dataSource: {
//         chart: {
//           caption: "Reach of Social Media Platforms amoung youth",
//           yaxisname: "% of youth on this platform",
//           subcaption: "2012-2016",
//           showhovereffect: "1",
//           numbersuffix: "%",
//           drawcrossline: "1",
//           plottooltext: "<b>$dataValue</b> of youth were on $seriesName",
//           theme: "fusion",
//         },
//         categories: [
//           {
//             category: [
//               {
//                 label: "2012",
//               },
//               {
//                 label: "2013",
//               },
//               {
//                 label: "2014",
//               },
//               {
//                 label: "2015",
//               },
//               {
//                 label: "2016",
//               },
//             ],
//           },
//         ],
//         dataset: [
//           {
//             seriesname: "Facebook",
//             data: [
//               {
//                 value: "62",
//               },
//               {
//                 value: "64",
//               },
//               {
//                 value: "64",
//               },
//               {
//                 value: "66",
//               },
//               {
//                 value: "78",
//               },
//             ],
//           },
//           {
//             seriesname: "Instagram",
//             data: [
//               {
//                 value: "16",
//               },
//               {
//                 value: "28",
//               },
//               {
//                 value: "34",
//               },
//               {
//                 value: "42",
//               },
//               {
//                 value: "54",
//               },
//             ],
//           },
//           {
//             seriesname: "LinkedIn",
//             data: [
//               {
//                 value: "20",
//               },
//               {
//                 value: "22",
//               },
//               {
//                 value: "27",
//               },
//               {
//                 value: "22",
//               },
//               {
//                 value: "29",
//               },
//             ],
//           },
//           {
//             seriesname: "Twitter",
//             data: [
//               {
//                 value: "18",
//               },
//               {
//                 value: "19",
//               },
//               {
//                 value: "21",
//               },
//               {
//                 value: "21",
//               },
//               {
//                 value: "24",
//               },
//             ],
//           },
//         ],
//       },
//     }).render();
//   });

var options = { //bar chart
    series: [{
    name: 'Net Profit',
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
  }, {
    name: 'Revenue',
    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
  }, {
    name: 'Free Cash Flow',
    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
  }],
    chart: {
    type: 'bar',
    height: 350
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded'
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  },
  yaxis: {
    title: {
      text: '$ (thousands)'
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands"
      }
    }
  }
  };

  var chart = new ApexCharts(document.querySelector("#barChart"), options);
  chart.render();

var options = { //pie chart
    series: [44, 55, 41, 17, 15],
    chart: {
    width: 380,
    type: 'pie',
  },
  plotOptions: {
    pie: {
      startAngle: -90,
      endAngle: 270
    }
  },
  dataLabels: {
    enabled: false
  },
  fill: {
    type: 'gradient',
  },
  legend: {
    formatter: function(val, opts) {
      return val + " - " + opts.w.globals.series[opts.seriesIndex]
    }
  },
  title: {
    text: 'Gradient Donut with custom Start-angle'
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
  };

  var chart = new ApexCharts(document.querySelector("#pieChart"), options);
  chart.render();
});
