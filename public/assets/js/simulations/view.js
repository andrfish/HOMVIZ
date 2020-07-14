window.colorscheme = 'brewer.Paired12';

$(document).ready(function(){

   $(document).on("click","#showdetails",function() {

    $('#showdetailswrap').css('display','block')

  });


   $(document).on("click",".togglepirbar",function() {


    $('.radarpie').css('display','none')
    $('.barcharts').not(this).css('display','block')

  });

  months = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
  ];

  let mntcounter = 0;
  let innercounter = 0

  for (var j = 0; j <= weekLabel.length - 1; j++) {

    weekLabel[j] = months[mntcounter] +'-'+ weekLabel[j]

    innercounter=innercounter+1
  
    if (innercounter>=4) {
      innercounter=0
      mntcounter=mntcounter+1
      if (mntcounter==12) {
        mntcounter=0
      }
    }

  }

  var randomScalingFactor = function() {
    return Math.round(Math.random() * 100);
  };


  var color = Chart.helpers.color;


  for (var i = 0; i < simnumber; i++) {

    $.each(populationLabel, function( index, popoluation ) {

      var count = 0;
      
      var areaChartData = {
        labels:weekLabel,
        datasets:[]
      }

      $.each( dataSeriesLabel['simulation_'+i], function( key, value ) {

        var newlabel = ''
        if (key === 'Rehabilitation') {
          newlabel = 'Addiction / Rehabilitation Center'
        } else {
          newlabel = key
        }

        count = count + 1

        let line = {
                      label               : newlabel,
                      pointRadius          : false,
                      backgroundColor     : 'transparent',
                      data                : dataSeriesLabel['simulation_'+i][key][popoluation]
                    }

        areaChartData['datasets'].push(line)

      });

      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: true
        },
        tooltips: {
          mode: 'index',
          intersect: false
        },
        hover: {
          mode: 'index',
          intersect: false
        },
        title: {
          display: true,
          text: popoluation+' Population',
          fontSize:18
        },
        plugins: {
          colorschemes: {
            scheme: window.colorscheme,
            fillAlpha: 0.2
          }
        }
      }

      var lineChartCanvas = $('#lineChart-'+(i+1)+'-'+index).get(0).getContext('2d')
      var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
      var lineChartData = jQuery.extend(true, {}, areaChartData)
      lineChartData.datasets[0].fill = false;
      lineChartData.datasets[1].fill = false;
      lineChartOptions.datasetFill = false

      var lineChart = new Chart(lineChartCanvas, { 
        type: 'line',
        data: lineChartData, 
        options: lineChartOptions
      })

    });

  }


  //RADAR
  for (var i2= 0; i2 < simnumber; i2++) {

    $.each(populationLabel, function( index2, popoluation2 ) {


      for (var z = 0; z <= 1; z++) {

        var config = {
          data: {
            datasets: [{
              data: [],
              backgroundColor: [
                color('#a6cee3').alpha(0.5).rgbString(),
                color('#1f78b4').alpha(0.5).rgbString(),
                color('#b2df8a').alpha(0.5).rgbString(),
                color('#33a02c').alpha(0.5).rgbString(),
                color('#33a02c').alpha(0.5).rgbString(),
                color('#fb9a99').alpha(0.5).rgbString(),
                color('#e31a1c').alpha(0.5).rgbString(),
                color('#fdbf6f').alpha(0.5).rgbString(),
                color('#ff7f00').alpha(0.5).rgbString(),
                color('#cab2d6').alpha(0.5).rgbString(),
                color('#6a3d9a').alpha(0.5).rgbString(),
                color('#ffff99').alpha(0.5).rgbString(),
                color('#b15928').alpha(0.5).rgbString(),
              ],
              label: 'My dataset'
            }],
            labels: ''
          },
          options: {
            responsive: true,
            title: {
              display: true,
              text: '',
              position: 'top',
              fontSize:18
            },
            plugins: {
              colorschemes: {
                scheme: window.colorscheme,
                fillAlpha: 0.2
              }
            }
          }
        };

        var newLabelArray = []
        
        $.each( resourceLabel, function( key2, value2 ) {

          if (z==0) {
            config.options.title.text = 'Initial '+popoluation2+' Population'
            config.data.datasets[0].data.push(dataSeriesLabelPie['simulation_'+i2][value2][popoluation2]['init'])
          } else {
            config.options.title.text = 'Final '+popoluation2+' Population'
            config.data.datasets[0].data.push(dataSeriesLabelPie['simulation_'+i2][value2][popoluation2]['final'])
          }

          let newVal = ''
          if (value2 === 'Rehabilitation') {
            newVal = 'Addiction / Rehabilitation Center'
          } else {
            newVal = value2
          }

          newLabelArray.push(newVal);

        });

        config.data.labels = newLabelArray;

        var ctx = document.getElementById('chart-area-'+z+'-'+(i2+1)+'-'+index2);
        window.myPolarArea = Chart.PolarArea(ctx, config);


      }

    });

  }



  // BAR
  var cflag = true;
  var carray = {}
  for (var i2= 0; i2 < simnumber; i2++) {

    $.each(populationLabel, function( index2, popoluation2 ) {

      var config = {
        data: {
          datasets: [],
          labels: ["Initial "+popoluation2+" Population", "Final "+popoluation2+" Population"],
        }
      };

      $.each( resourceLabel, function( key2, value2 ) {

          let newVal = ''
          if (value2 === 'Rehabilitation') {
            newVal = 'Addiction / Rehabilitation Center'
          } else {
            newVal = value2
          }

        config.data.datasets.push({data:[ 
                                            dataSeriesLabelPie['simulation_'+i2][value2][popoluation2]['init'],
                                            dataSeriesLabelPie['simulation_'+i2][value2][popoluation2]['final'],
                                        ],
                                  maxBarThickness:50,
                                  label: [newVal]})

      });

      var ctx = document.getElementById('chart-bar-'+(i2+1)+'-'+index2);
          
      var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: config.data,
          options: {
            responsive: true,
            plugins: {
              responsive: true,
              legend: {
                position: 'right',
              },
              title: {
                display: true,
                text: '',
                fontSize:18
              },
              scale: {
                ticks: {
                  beginAtZero: true
                },
                reverse: false,
              },
              animation: {
                animateRotate: false,
                animateScale: true
              },
              plugins: {
                colorschemes: {
                  scheme: window.colorscheme,
                  fillAlpha: 0.2
                }
              }
            }
          }
      });

    });

  }

});

