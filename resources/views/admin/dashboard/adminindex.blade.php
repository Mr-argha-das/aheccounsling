 @extends('layouts.'.config('backendLayout'))
@section('content')

<style type="text/css">
  .highcharts-figure,
.highcharts-data-table table {
  min-width: 310px;
  max-width: 800px;
  margin: 1em auto;
}

#container {
  height: 400px;
}
 

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>

<style>
.card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;
}
.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
}
.card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}
.card-box p {
    font-size: 15px;
}
.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 72px;
    color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}
.bg-blue {
    background-color: #00c0ef !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-red {
    background-color: #d9534f !important;
}
</style>
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w500 mb-0 text-primary text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">Dashboard</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard</h6>
            </div>
        </div>
    </div>
</div>
  <div class="block">
    <div class="block-content">

      <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-blue">
                    <div class="inner">
                        <h3> ${{number_format($totalCurrencyAmount->aud,2)}} </h3>
                        <p> {{date('F') }}  AUD </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    </div>
                    <!-- <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-green">
                    <div class="inner">
                        <h3> ₹{{number_format($totalCurrencyAmount->inr,2)}} </h3>
                        <p>  {{date('F') }}  INR </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <!-- <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-orange">
                    <div class="inner">
                       <h3> ${{number_format($weekTotalAmount->aud,2)}} </h3>
                        <p> This Week AUD </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                    <!-- <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-red">
                    <div class="inner">
                         <h3> ₹{{number_format($weekTotalAmount->inr,2)}} </h3>
                        <p> This Week INR </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <!-- <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card-box bg-info">
                    <div class="inner">
                         <h3> {{$weekTotalAmount->word_count}} </h3>
                          
                         <p>  This Week Word Count </p>
                     </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <!-- <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

            <div class="col-lg-6 col-sm-6">
                <div class="card-box bg-warning">
                    <div class="inner">
                        
                         <h3> {{$totalCurrencyAmount->word_count}} </h3>
                         <p>  {{date('F') }}  Word Count </p>
                     </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <!-- <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a> -->
                </div>
            </div>

        </div>
      <div class="row">
           <div class="col-md-4">
            <figure class="highcharts-figure">
            <div id="currency_amout_count"></div>
              </figure>
           </div>

           <div class="col-md-8">
            <figure class="highcharts-figure">
              <div id="order_count"></div>
             </figure>
            </div>

          </div>
        
       <div class="row">
         <div class="col-md-12">
             
              <div id="compair_order_bde"></div>
           
            </div>
      </div>

       <div class="row">
         <div class="col-md-12">
           
              <div id="compair_order_aud"></div>
             
            </div>

            <div class="col-md-12">
            <figure class="highcharts-figure">
            <div id="mix_chart"></div>
           </figure>
          </div>
      </div>

      </div>
  </div>
 
@endsection
@section('javascript')
<script src="{{asset('webassets/js/chart/highcharts.js')}}"></script>
<script src="{{asset('webassets/js/chart/data.js')}}"></script>
<script src="{{asset('webassets/js/chart/variable-pie.js')}}"></script>
<script src="{{asset('webassets/js/chart/drilldown.js')}}"></script>
<script src="{{asset('webassets/js/chart/exporting.js')}}"></script>
<script src="{{asset('webassets/js/chart/export-data.js')}}"></script>
<script src="{{asset('webassets/js/chart/accessibility.js')}}"></script>
 <script type="text/javascript">
 $( document ).ready(function() {
     
  $.ajax({
      'async': false,
      'global': false,
       url: "{{route('getAdminData')}}",
       dataType: 'json',
       type: 'get',
       data: { id:1},
      success:function(data){
        getOnLoadData(data);
      }
   });
function getOnLoadData(data){
  var rmData =JSON.parse(data.rmData);
  var rmDataService =JSON.parse(data.rmDataService);
  var rmCompairOrders =JSON.parse(data.rmCompairOrders);
  var currencyAmount =JSON.parse(data.currencyAmount);
  var rmCompairAud =JSON.parse(data.rmCompairAud);
  var audOrderMonthName =JSON.parse(data.audOrderMonthName);
  var audOrderaud =JSON.parse(data.audOrderaud);
  var audOrdernumber =JSON.parse(data.audOrdernumber);

  Highcharts.chart('compair_order_bde',{
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Order'
    },
     xAxis: {
        categories: ['Jan'],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Number of orders'
        },
        labels: {
            formatter: function() {
                     
                return this.value;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ''
    },
    plotOptions: {
        line: {
            lineWidth: 1,
            marker: {
                enabled: false
            }
        }
    },
    series:rmCompairOrders  
});

Highcharts.chart('compair_order_aud',{
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Aud'
    },
     xAxis: {
        categories: ['Jan'],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'AUD'
        },
        labels: {
            formatter: function() {
                     
                return this.value;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ''
    },
    plotOptions: {
        line: {
            lineWidth: 1,
            marker: {
                enabled: false
            }
        }
    },
    series:rmCompairAud  
});

 
 Highcharts.chart('order_count', {
  chart: {
    type: 'column'
  },
  title: {
    align: 'left',
    text: 'Relationship manager Total Number of order Month <?php echo date('M-Y') ?>'
  },
  subtitle: {
    align: 'left',
    text: 'Click the columns to view by services'
  },
  accessibility: {
    announceNewData: {
      enabled: true
    }
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Total Number of order'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
        format: '{point.y:.0f}'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> total Order<br/>'
  },

  series: [
    {
      name: "Relationship Manager",
      colorByPoint: true,
      data: rmData
    }
  ],
  drilldown: {
    breadcrumbs: {
      position: {
        align: 'right'
      }
    },
    series:rmDataService
  }
 });



 Highcharts.chart('currency_amout_count', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Currency Wise Total Amount'
    },
    tooltip: {
        headerFormat: '',
         valueDecimals: 2,
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
            '{point.name} Amount: <b>{point.x}</b><br/>' +
            'INR Amount: <b>{point.y}</b><br/>' +
            'AUD Amount: <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        data: currencyAmount
    }]
});

  Highcharts.chart('mix_chart', {
      chart: {
          zoomType: 'xy'
      },
      title: {
          text: `Monthly AUD and total number of orders, {{date('Y')}}`,
          align: 'left'
      },
      xAxis: [{
          categories: audOrderMonthName,
          crosshair: true
      }],
      
      yAxis: [{ // Primary yAxis
          labels: {
              format: '{value}',
              style: {
                  color: Highcharts.getOptions().colors[1]
              }
          },
          title: {
              text: 'Total AUD',
              style: {
                  color: Highcharts.getOptions().colors[1]
              }
          }
      },{ // Secondary yAxis
          title: {
              text: 'Total Orders',
              style: {
                  color: Highcharts.getOptions().colors[0]
              }
          },
          labels: {
              format: '{value}',
              style: {
                  color: Highcharts.getOptions().colors[0]
              }
          },
          opposite: true
      }],
      tooltip: {
          shared: true
      },
      legend: {
          align: 'left',
          x: 80,
          verticalAlign: 'top',
          y: 80,
          floating: true,
          backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || // theme
              'rgba(255,255,255,0.25)'
      },
      series: [{
          name: 'Total Orders',
          type: 'column',
          colorByPoint: true,
          yAxis: 1,
          data: audOrdernumber,
      }, {
          name: 'Total AUD',
          type: 'spline',
          data: audOrderaud,
           
      }]
  });
 }  

 });
 </script>
@endsection

