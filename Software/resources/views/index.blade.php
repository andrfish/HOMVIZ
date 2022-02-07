@extends($layout)
@section('stylesheets')
<link rel="stylesheet" href="/assets/css/sweetalert2.min.css?1">
@stop
@section('scripts')
<script src="/assets/js/sweetalert2.min.js?1"></script>
<script src="/assets/js/index.js?12"></script>
@stop

@section('content')

  <style type="text/css">
    
    i.fas.fa-trash.deletesubresource {
      color: #ff3a3a;
    }
    .swal2-popup {
        position: relative !important;
        box-sizing: border-box !important;
        flex-direction: column !important;
        justify-content: center !important;
        width: 32em !important;
        max-width: 100% !important;
        padding: 1.25em !important;
        border: none !important;
        border-radius: .3125em !important;
        background: #fff !important;
        font-family: inherit !important;
        font-size: 1rem !important;
    }

    .swal2-icon {
    position: relative;
    box-sizing: content-box;
    justify-content: center;
    width: 5em;
    height: 5em;
    margin: 1.25em auto 1.875em;
    border: .25em solid transparent;
    border-radius: 50%;
    font-family: inherit;
    line-height: 5em;
    cursor: default;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    .swal2-header {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        padding: 0 1.8em !important;
    }
    .swal2-title {
        position: relative !important;
        max-width: 100% !important;
        margin: 0 0 .4em !important;
        padding: 0 !important;
        color: #595959 !important;
        font-size: 1.875em !important;
        font-weight: 600 !important;
        text-align: center !important;
        text-transform: none !important;
        word-wrap: break-word !important;
    }
    .swal2-content {
        z-index: 1 !important;
        justify-content: center !important;
        margin: 0 !important;
        padding: 0 1.6em !important;
        color: #545454 !important;
        font-size: 1.125em !important;
        font-weight: 400 !important;
        line-height: normal !important;
        text-align: center !important;
        word-wrap: break-word !important;
    }
    [class^=swal2] {
        -webkit-tap-highlight-color: transparent !important;
    }
    .swal2-actions {
        display: flex !important;
        z-index: 1 !important;
        flex-wrap: wrap !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        margin: 1.25em auto 0 !important;
    }
    .swal2-styled.swal2-confirm {
        border: 0 !important;
        border-radius: .25em !important;
        background: initial !important;
        background-color: #3085d6 !important;
        color: #fff !important;
        font-size: 1.0625em !important;
    }
    .swal2-styled:not([disabled]) {
        cursor: pointer !important;
    }
    .swal2-styled.swal2-cancel {
        border: 0 !important;
        border-radius: .25em !important;
        background: initial;
        background-color: #aaa;
        color: #fff !important;
        font-size: 1.0625em !important;
    }
    .swal2-styled {
        margin: .3125em !important;
        padding: .625em 2em !important;
        box-shadow: none !important;
        font-weight: 500 !important;
    }
    .swal2-styled.swal2-cancel {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #aaa;
        color: #fff;
        font-size: 1.0625em;
    }
    .progress{
      height: 1.1rem !important;
    }
  </style>


  @if(isset($questionnaireSubmitted))

  <script>
    
    var questionnaireSubmitted = JSON.parse(<?php echo json_encode($questionnaireSubmitted); ?>);

  </script>

  @else

  <script>
    
    var questionnaireSubmitted = "0";

  </script>

  @endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> <a href="/simulations/add"><i class="fas fa-plus text-primary"></i></a>&nbsp;&nbsp;<a href="/simulations/add">Create a New Simulation</a></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content">

    <div class="container-fluid">

        <div class="row">

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

              <div class="card-header">

                <div class="card-title">
                  Simulations
                </div>

              </div>

              <div class="card-body pb-0">
                  <div class="row d-flex align-items-stretch">

                    @if(isset($sim))

                      @foreach ($sim as $k => $val)

                        <div class="col-md-4 col-sm-6 jobs" id="{{$val->id}}" status="{{$val->status}}">
                          <div class="card card-outline card-primary">
                            <div class="card-header">
                              <div class="card-title" style="width: 100%">

                                <div class="row">
                                
                                  <div class="col-11">
                                    <h5>{{$val->simulation_name}}</h5>
                                  </div>

                                  <div class="col-1" style="float: right;">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                  </div>

                                </div>

                              </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="">
                                  <p><b>Simulation Location: </b> {{$val->simulation_location}}</p>
                                  <p><b>Number of weeks: </b> {{$val->numberofweeks}}</p>
                                  <p><b>Number of simulation: </b> {{$val->numberofsims}}</p>
                                  <p><b>Created at: </b> {{$val->created_at}}</p>
                                  <p class="status"><b>Status: </b> <span class="statushtml">{!!$val->statusMessage!!}</span></p>

                                  <div class="row">
                                    
                                    <div class="col-3"><p class="progressrow"><b>Progress:</b></p></div>


                                    <div class="col-9 progresscolumn">
                                      

                                    @if($val->status!=1)

                                      <div class="progress" style="margin-top: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;font-size: 20px" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                      </div>

                                    @else

                                    -

                                    @endif


                                    </div>                            
  

                                  </div>

                            </div>

                          <style>

                            .card-footer{
                              border-top: 1px solid rgba(0,0,0,.125);
                              padding: .75rem 1.25rem;
                              position: relative;
                              border-top-left-radius: .25rem;
                              border-top-right-radius: .25rem;
                              background-color: #fff
                            }

                          </style>


                            <div class="card-footer"">

                              <div class="text-left" style="float: left;">
                                
                                <a sim_id="{{$val->id}}" class="text-white btn btn-sm btn-danger delete-simulation">
                                    Delete
                                </a>

                              </div>

                              <div class="text-right">
                                @if($val->status!=1)
                                  <a href="#" class="btn btn-sm btn-primary disabled result-btn">
                                      Results
                                  </a>
                                @else
                                  <a href="/simulations/view/{{$val->id}}" class="btn btn-sm btn-primary result-btn">
                                      Results
                                  </a>
                                @endif
                              </div>
                            </div>


                          </div>
                          <!-- /.card -->
                        </div>

                      @endforeach

                    @endif

                  </div>

              </div>
                    
            </div><!-- /.card -->

          </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

@stop