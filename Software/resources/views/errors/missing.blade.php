@extends($layout)
@section('stylesheets')
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
{!! Html::style('assets/css/errors/404.css') !!}
@stop
@section('scripts')
@stop

@section('content')
<div class="container" style="margin-top:80px;margin-bottom:100px;">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions">
                    <a href="{!! route('home_index') !!}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop