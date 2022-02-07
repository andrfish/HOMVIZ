@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/users/login.css') !!}
@stop
@section('scripts')

@stop

@section('content')
<div class="container">

  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin-top:100px">
      @if(isset($unauthorized))
          	<div class="alert alert-warning alert-dismissible" role="alert">
      		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      		    <strong>Warning!</strong> You are not authorized to view this page. Please Login.
      		  </div>

           
      @elseif(isset($wrong))
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               Wrong username or password
            </div>
      @endif
      <section class="login-form">
          {!! Form::open(array('action' => 'UsersController@postLogin','id'=>'reg-form', 'class'=>'','role'=>"form")) !!}
            <div class="form-group">
              <input type="text" name="username" placeholder="Username" required class="form-control input-lg"  />
            </div>
            <div class="form-group">
             <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
            </div>
            <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
            <div>
              <a href="{!! route('registration_view') !!}">Create account</a> or <a href="/password-reset">reset password</a>
            </div>
            <input type="hidden" name="direct-login" value="true"/>
           {!! Form::close() !!}
      </section>  
      </div>
      <div class="col-md-4"></div>
  </div>
</div>
@stop