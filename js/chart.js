$(document).ready(function () {

var options = { //bar chart
    series: [{
    name: 'Monthly Profit',
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
  }
//   , {
//     name: 'Revenue',
//     data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
//   }, {
//     name: 'Free Cash Flow',
//     data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
//   }
],
    chart: {
    type: 'bar',
    height: 350
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '25%',
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
      text: 'Rs (thousands)'
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "Rs " + val + " thousands"
      }
    }
  }
  };

  var chart = new ApexCharts(document.querySelector("#barChart"), options);
  chart.render();

var options = { //pie chart
    series: [44, 55, 41, 17, 15,50,65],
    chart: {
    width: 380,
    type: 'pie',
  },
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday','Sunday'],
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
    text: 'Weekly Income'
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
