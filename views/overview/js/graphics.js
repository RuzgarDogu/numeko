function getPieData (d, cont, metin) {
  console.log(d);

  // Build the chart

  Highcharts.chart(cont, {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: metin
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        }
      }
    },
    series: [{
      name: 'Brands',
      colorByPoint: true,
      data: d
    }]
  });
}


function getLineData (d,cont) {

        Highcharts.chart(cont, {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Tarihe Göre Öğrenci Sayıları'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Zoom yapmak için tıklayın ve sürükleyin' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'date'
            },
            yAxis: {
                title: {
                    text: 'Öğrenci Sayıları'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'USD to EUR',
                data: d
            }]
        });

}


function getBarData (d,c,cont) {



Highcharts.chart(cont, {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Firmalara Göre Katılım'
    },
    subtitle: {
        text: 'Toplam kişi sayısı esas alınmıştır'
    },
    xAxis: {
        categories: c,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Firmalar',
        data: d

    }]
});





}
