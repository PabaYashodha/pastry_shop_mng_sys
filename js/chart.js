$(document).ready(function () {
    let columChartUrl = "../controller/ChartController.php?status=getColumChartValue"
    $.getJSON(columChartUrl, function (response) {
       chart.updateSeries([{
           data: response[1]
         }])
        chart.updateOptions({
        xaxis: {
            categories: response[0]
        }
        })
    });
var options = { //bar chart
    series: [],
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
    categories: [],
  },
  yaxis: {
    title: {
      text: 'Rs'
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
 //pie chart
 let pieChartUrl = "../controller/ChartController.php?status=getPieChartValue"
 $.getJSON(pieChartUrl, function (response) {
    chart1.updateOptions({
        series: response[1],
        labels: response[0]
    })
 })
var options = { //pie chart
    series: [],
    chart: {
    width: 380,
    type: 'pie',
  },
  labels: [],
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

  var chart1 = new ApexCharts(document.querySelector("#pieChart"), options);
  chart1.render();

});
