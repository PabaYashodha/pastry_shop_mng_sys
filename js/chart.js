$(document).ready(function () {
  FusionCharts.ready(function () {
    var myChart = new FusionCharts({
      type: "msline",
      renderAt: "chart-container",
      width: "100%",
      height: "75%",
      dataFormat: "json",
      dataSource: {
        chart: {
          caption: "Reach of Social Media Platforms amoung youth",
          yaxisname: "% of youth on this platform",
          subcaption: "2012-2016",
          showhovereffect: "1",
          numbersuffix: "%",
          drawcrossline: "1",
          plottooltext: "<b>$dataValue</b> of youth were on $seriesName",
          theme: "fusion",
        },
        categories: [
          {
            category: [
              {
                label: "2012",
              },
              {
                label: "2013",
              },
              {
                label: "2014",
              },
              {
                label: "2015",
              },
              {
                label: "2016",
              },
            ],
          },
        ],
        dataset: [
          {
            seriesname: "Facebook",
            data: [
              {
                value: "62",
              },
              {
                value: "64",
              },
              {
                value: "64",
              },
              {
                value: "66",
              },
              {
                value: "78",
              },
            ],
          },
          {
            seriesname: "Instagram",
            data: [
              {
                value: "16",
              },
              {
                value: "28",
              },
              {
                value: "34",
              },
              {
                value: "42",
              },
              {
                value: "54",
              },
            ],
          },
          {
            seriesname: "LinkedIn",
            data: [
              {
                value: "20",
              },
              {
                value: "22",
              },
              {
                value: "27",
              },
              {
                value: "22",
              },
              {
                value: "29",
              },
            ],
          },
          {
            seriesname: "Twitter",
            data: [
              {
                value: "18",
              },
              {
                value: "19",
              },
              {
                value: "21",
              },
              {
                value: "21",
              },
              {
                value: "24",
              },
            ],
          },
        ],
      },
    }).render();
  });
//   const dataSource = {
//     chart: {
//       caption: "Android Distribution for our app",
//       subcaption: "For all users in 2017",
//       showpercentvalues: "1",
//       defaultcenterlabel: "Android Distribution",
//       aligncaptionwithcanvas: "0",
//       captionpadding: "0",
//       decimals: "1",
//       plottooltext:
//         "<b>$percentValue</b> of our Android users are on <b>$label</b>",
//       centerlabel: "# Users: $value",
//       theme: "fusion"
//     },
//     data: [
//       {
//         label: "Ice Cream Sandwich",
//         value: "1000"
//       },
//       {
//         label: "Jelly Bean",
//         value: "5300"
//       },
//       {
//         label: "Kitkat",
//         value: "10500"
//       },
//       {
//         label: "Lollipop",
//         value: "18900"
//       },
//       {
//         label: "Marshmallow",
//         value: "17904"
//       }
//     ]
//   };
  
//   FusionCharts.ready(function() {
//     var myChart = new FusionCharts({
//       type: "doughnut2d",
//       renderAt: "chart-container pie",
//       width: "100%",
//       height: "100%",
//       dataFormat: "json",
//       dataSource
//     }).render();
//   });
  
var options = {
    series: [44, 55, 41, 17, 15],
    chart: {
    width: 380,
    type: 'donut',
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

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
});
