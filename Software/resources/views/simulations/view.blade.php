@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="//d3js.org/d3.v4.min.js"></script>
  <script src="/AdminLTE-3.0.0/plugins/chart.js/Chart.min.js?v1"></script>
  <script src="https://unpkg.com/chartjs-plugin-colorschemes"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="/assets/js/simulations/view.js?30"></script>
@stop

@section('content')

  <style type="text/css">
    
    label {
        display: inline-block;
        margin: 10px 0 0 10px;
    }

    .btn-app{
      margin: 0 !important;
      cursor: pointer;
    }

    .btn-app .fas {
      line-height: inherit;
    }

  </style>

  <script>
    
    var dataSeriesLabel = JSON.parse(<?php echo json_encode($dataSeriesLabel); ?>);
    var dataSeriesLabelPie = JSON.parse(<?php echo json_encode($dataSeriesLabelPie); ?>);
    var resourceLabel = JSON.parse(<?php echo json_encode($resourceLabel); ?>);
    var populationLabel = JSON.parse(<?php echo json_encode($populationLabel); ?>);
    var weekLabel = JSON.parse(<?php echo json_encode($weekLabel); ?>);
    var scenario_ids = JSON.parse(<?php echo json_encode($scenario_ids); ?>);

  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
  </div>


  <div class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-primary callout callout-info">
            <div class="card-header">
              <div class="card-title">
                <h5>Simulation Details</h5>
              </div>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

                <strong>Name</strong>
                <p>{{$sim_info['name']}}</p>
                
                <strong>Simulation city</strong>
                <p>{{$sim_info['city']}}</p>
                
                <strong>Number of weeks</strong>
                <p>{{$sim_info['numberofweeks']}}</p>
                
                <strong>Population type and count</strong>
                <ul>
                  @foreach($sim_info['populattioncontent'] as $popckey => $popcval)

                    <li>{{App\Simulation::populationIDtoName($popckey)}}: {{$popcval}}</li>

                  @endforeach
                </ul>

                <strong>Resources</strong>
                <ul>
                  @foreach($sim_info['listofresources'] as $reslistval)

                    <li>{{$reslistval}}</li>

                  @endforeach
                </ul>

                <strong>Living situations</strong>
                <ul>
                  @foreach($sim_info['listofstates'] as $statelistval)

                    <li>{{$statelistval}}</li>

                  @endforeach
                </ul>


            </div>
          </div>
        </div>
      </div>

      <div class="card card-primary card-outline card-tabs">

        <div class="card-header p-0 pt-1 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">


            @foreach($scenario_info as $s_key => $s_val)

              <li class="nav-item">
                <a class="nav-link mytabs" fortab="{{$s_val['id']}}" kind="main" id="{{$s_val['id']}}-tab" data-toggle="pill" href="#{{$s_val['id']}}" role="tab" aria-controls="{{$s_val['name']}}" aria-selected="true">{{$s_val['name']}} Simulation</a>
              </li>

            @endforeach


          </ul>
        </div>


        <div class="card-body">
	@php
    	$active = '';
	@endphp
         @foreach($scenario_info as $s2_key => $s2_val)

            {{--*/ $active = '' /*--}}
          @if($s2_key==0)
            {{--*/ $active = 'active  show' /*--}}
          @endif
            

            <div class="tab-content" id="custom-tabs-two-tabContent">
              <div class="tab-pane {{$active}}" kind="main" id="{{$s2_val['id']}}" role="tabpanel" aria-labelledby="{{$s2_val['id']}}-tab">

                <!-- This card is only for scenarios not the main simulation -->
                @if($s2_key!=0)
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-primary">
                      <div class="card-header">
                        <div class="card-title">
                          <h5>Scenario Details</h5>
                        </div>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">

                          {!!$scenario_details_html[$s2_val['id']]!!}

                      </div>
                    </div>
                  </div>
                </div>
                @endif


                <div class="row">

                  <div class="col-md-12">
                    <div class="card card-outline card-primary">
                      <div class="card-header">
                        <div class="card-title">
                          <h5>Population, by number of weeks ({{$numberofweeks}} weeks) &nbsp;&nbsp;<i class="fas fa-chart-line" style="color:gray"></i></h5>
                        </div>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        @foreach($populationLabelview as $kpop => $pop)

                          @if($kpop!=0)
                            <hr>
                          @endif

                          <div class="chart" style="margin-bottom: 25px">
                            <canvas id="lineChart-{{$s2_val['id']}}-{{$kpop}}" style="height:250px; min-height:450px"></canvas>
                          </div>

                        @endforeach
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="card card-primary card-outline card-tabs">
                      <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active mytabs" fortab="custom-tabs-radar" kind="radarbar" id="custom-tabs-radar-tab" data-toggle="pill" href="#custom-tabs-radar" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Radar Chart &nbsp;&nbsp;<i class="fas fa-chart-pie" style="color:gray"></i></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link mytabs" fortab="custom-tabs-bar" kind="radarbar" id="custom-tabs-bar-tab" data-toggle="pill" href="#custom-tabs-bar" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Bar Chart &nbsp;&nbsp;<i class="fas fa-chart-bar" style="color:gray"></i></a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                          <div class="tab-pane active" kind="radarbar" id="custom-tabs-radar" role="tabpanel" aria-labelledby="custom-tabs-radar-tab">
                            <!-- radar -->
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                  <div class="card-header">
                                    <div class="card-title">
                                      <h5>Initial Population VS. Final Population</h5>
                                    </div>
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="card-body">

                                    <div class="row radarcharts radarpie">
                                      <div class="col-md-12">
                                        @foreach($populationLabelview as $kpop2 => $pop)


                                          @if($kpop2!=0)
                                            <hr>
                                          @endif

                                          <div class="row">
                                            <div class="col-md-6" style="float: left">
                                              <div class="chart" style="margin-bottom: 25px">
                                                <canvas id="chart-area-0-{{$s2_val['id']}}-{{$kpop2}}" class="chartjs" style="display: block; width: 100%; height: 485px;"></canvas>
                                              </div>
                                            </div>
                                            <div class="col-md-6" style="float: left">
                                              <div class="chart" style="margin-bottom: 25px">
                                                <canvas id="chart-area-1-{{$s2_val['id']}}-{{$kpop2}}" class="chartjs" style="display: block; width: 100%; height: 485px;"></canvas>
                                              </div>
                                            </div>
                                          </div>

                                        @endforeach
                                      </div>
                                    </div>

                                  </div>
                                </div>
                            </div>
                          </div>
                          <div class="tab-pane" kind="radarbar" id="custom-tabs-bar" role="tabpanel" aria-labelledby="custom-tabs-bar-tab">
                            <!-- //bar -->
                            <div class="col-md-12">
                              <div class="card card-outline card-primary">
                                <div class="card-header">
                                  <div class="card-title">
                                    <h5>Initial Population VS. Final Population</h5>
                                  </div>
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="row barcharts radarpie">
                                    <div class="col-md-12">
                                      @foreach($populationLabelview as $kpop3 => $pop3)

                                        @if($kpop3!=0)
                                          <hr>
                                        @endif

                                        <div class="chart" style="margin-bottom: 75px;height: 355px">
                                          <canvas id="chart-bar-{{$s2_val['id']}}-{{$kpop3}}" class="chartjs" style="display: block; width: 100%;"></canvas>
                                        </div>

                                      @endforeach

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>

              </div>
            </div>

          @endforeach

        </div>
        <!-- /.card -->
      </div>

    </div><!-- /.container-fluid -->

  </div>


@stop
