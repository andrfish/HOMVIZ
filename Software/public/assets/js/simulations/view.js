window.colorscheme = 'brewer.Paired12';

$(document).ready(function(){

   $(document).on("click","#showdetails",function() {

    $('#showdetailswrap').css('display','block')

  });


   $(document).on("click",".togglepirbar",function() {


    $('.radarpie').css('display','none')
    $('.barcharts').not(this).css('display','block')

  });


  $(document).on("click",".mytabs",function() {

    $(this).addClass('active')

    let kind = $(this).attr('kind')
    let fortab = $(this).attr('fortab')

    $('.mytabs[kind="'+kind+'"]').removeClass('active')
    $('.tab-pane[kind="'+kind+'"]').removeClass('active')
    $('.tab-pane[id="'+fortab+'"]').addClass('active')

    //workaround to fix the bug I had with the original tabbing system
    if (fortab!='custom-tabs-bar') {
      $('.tab-pane[id="custom-tabs-radar"]').addClass('active')
    }

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


  for (var i = 0; i < scenario_ids.length; i++) {

    $.each(populationLabel, function( index, popoluation ) {

      var count = 0;
      
      var areaChartData = {
        labels:weekLabel,
        datasets:[]
      }

      $.each( dataSeriesLabel['simulation_'+scenario_ids[i]], function( key, value ) {

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
                      data                : dataSeriesLabel['simulation_'+scenario_ids[i] ][key][PopulationNameToIds(popoluation)]
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
          text: popoluation+' population',
          fontSize:18
        },
        plugins: {
          colorschemes: {
            scheme: window.colorscheme,
            fillAlpha: 0.2
          }
        }
      }

      var lineChartCanvas = $('#lineChart-'+scenario_ids[i]+'-'+index).get(0).getContext('2d')
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
  for (var i2= 0; i2 < scenario_ids.length; i2++) {

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
            config.data.datasets[0].data.push(dataSeriesLabelPie['simulation_'+scenario_ids[i2] ][value2][PopulationNameToIds(popoluation2)]['init'])
          } else {
            config.options.title.text = 'Final '+popoluation2+' Population'
            config.data.datasets[0].data.push(dataSeriesLabelPie['simulation_'+scenario_ids[i2] ][value2][PopulationNameToIds(popoluation2)]['final'])
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

        var ctx = document.getElementById('chart-area-'+z+'-'+scenario_ids[i2]+'-'+index2);
        window.myPolarArea = Chart.PolarArea(ctx, config);


      }

    });

  }


  // BAR
  var cflag = true;
  var carray = {}
  for (var i3= 0; i3 < scenario_ids.length; i3++) {

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
                                            dataSeriesLabelPie['simulation_'+scenario_ids[i3]][value2][PopulationNameToIds(popoluation2)]['init'],
                                            dataSeriesLabelPie['simulation_'+scenario_ids[i3]][value2][PopulationNameToIds(popoluation2)]['final'],
                                        ],
                                  maxBarThickness:50,
                                  label: [newVal]})

      });

      var ctx = document.getElementById('chart-bar-'+scenario_ids[i3]+'-'+index2);
      
      var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: config.data,
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
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


function PopulationNameToIds(name){
    switch (name) {
      case 'under 30, homeless less than 1 year, male':
        return 'u30hl1m';
      case 'under 30, homeless less than 1 year, male (Housing First)':
        return 'u30hl1m_hf';
      case 'under 30, homeless more than 1 year, male':
        return 'u30hm1m';
      case 'under 30, homeless more than 1 year, male (Housing First)':
        return 'u30hm1m_hf';
      case 'under 30, homeless less than 1 year, female':
        return 'u30hl1f';
      case 'under 30, homeless less than 1 year, female (Housing First)':
        return 'u30hl1f_hf';
      case 'under 30, homeless more than 1 year, female':
        return 'u30hm1f';
      case 'under 30, homeless more than 1 year, female (Housing First)':
        return 'u30hm1f_hf';
      case '30-50 years, homeless less than 1 year, male':
        return 'b30t50hl1m';
      case '30-50 years, homeless less than 1 year, male (Housing First)':
        return 'b30t50hl1m_hf';
      case '30-50 years, homeless more than 1 year, male':
        return 'b30t50hm1m';
      case '30-50 years, homeless more than 1 year, male (Housing First)':
        return 'b30t50hm1m_hf';
      case '30-50 years, homeless less than 1 year, female':
        return 'b30t50hl1f';
      case '30-50 years, homeless less than 1 year, female (Housing First)':
        return 'b30t50hl1f_hf';
      case '30-50 years, homeless more than 1 year, female':
        return 'b30t50hm1f';
      case '30-50 years, homeless more than 1 year, female (Housing First)':
        return 'b30t50hm1f_hf';
      case 'greater than 50 years, homeless less than 1 year, male':
        return 'g50hl1m';
      case 'greater than 50 years, homeless less than 1 year, male (Housing First)':
        return 'g50hl1m_hf';
      case 'greater than 50 years, homeless more than 1 year, male':
        return 'g50hm1m';
      case 'greater than 50 years, homeless more than 1 year, male (Housing First)':
        return 'g50hm1m_hf';
      case 'greater than 50 years, homeless less than 1 year, female':
        return 'g50hl1f';
      case 'greater than 50 years, homeless less than 1 year, female (Housing First)':
        return 'g50hl1f_hf';
      case 'greater than 50 years, homeless more than 1 year, female':
        return 'g50hm1f';
      case 'greater than 50 years, homeless more than 1 year, female (Housing First)':
        return 'g50hm1f_hf';
      case 'Combined':
        return 'Combined';
      case 'Combined Housing First':
        return 'Combined_hf';
      default:
        return 'error';
    }
}