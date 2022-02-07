@extends($layout)
@section('stylesheets')
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
{!! Html::style('assets/css/errors/404.css') !!}
@stop
@section('scripts')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>Please Create a Page</h2>
                <li><a href="{!!route('pages_add')!!}">Page Add  <i class="glyphicon glyphicon-edit"></i></a></li>
                <div class="error-details">
                    Sorry, no page has been created!
                </div>
            </div>
        </div>
    </div>
</div>
@stop