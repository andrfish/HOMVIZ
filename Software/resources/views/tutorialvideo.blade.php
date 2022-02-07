@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="https://www.youtube.com/iframe_api"></script>
<script src="/assets/js/tutorialvideo.js?11"></script>
@stop

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
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
                  Tutorial Video
                </div>

              </div>

              <div class="card-body">


                <p>You are about to watch a quick tutorial video to help you make a simulation. Click on the watch button to start watching.</p>

                <button class="btn btn-primary bt-lg" id="watch">Watch</button>

                <div id="video" class="embed-responsive embed-responsive-21by9" style="margin-top: 20px;display: none;"></div>

              </div>
                    
            </div><!-- /.card -->

          </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

@stop