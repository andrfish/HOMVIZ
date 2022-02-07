@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/login_modal.css') !!}
{!! Html::style('assets/css/users/profile.css') !!}
{!! Html::style('assets/css/login_modal.css') !!}
@stop
@section('scripts')
<script src="/assets/js/login_modal.js"></script>
<script src="/assets/js/users/profile.js"></script>
@stop
@section('content')
<div class="site-wrapper">
  <div class="container-fluid">
    <!-- LEFT BOX START -->
    <div class="col-md-12" id="left-box" target="false">
      <div class="container" id="left-box-inner">
          <form class="form-horizontal" action="{!! route('users_profile_post') !!}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">



            <div class="form-group ind-box">
              <label for="inputEmail3" class="col-md-2 col-sm-2 col-xs-2 control-label">Photo</label>
              <div class="col-md-8 col-sm-8 col-xs-8 pull-right">

                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <a href="#">
                      <img class="media-object profile-picture" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/{{$profile_image}}" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    </a>  
                  </div>

                  <div class="file-container col-md-6 col-sm-6 col-xs-6 pull-right"> 
                      <span class="file-wrapper">
                        <input type="file" id="form-submit-btn" />
                        <span class="button" id="sub-btn">Choose File</span>
                      </span>
                      <span id="saved" class="hide" style="color:#5cb85c;">&nbsp&nbsp&nbsp&nbsp<i class="glyphicon glyphicon-ok-sign" style="padding-right: 4px;"></i>Saved</span>
                      <span id="somthing-wrong" class="hide" style="color:#d9534f">&nbsp&nbsp&nbsp&nbsp<i class="glyphicon glyphicon-remove-sign" style="padding-right: 4px;"></i>Somthing went wrong</span>
                  </div>

              </div>
            </div>



            <hr>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
              <div class="col-sm-8 pull-right">
                <input type="text" name="fname" class="form-control" id="inputEmail3" placeholder="First name" value="{{$fname}}">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
              <div class="col-sm-8 pull-right">
                <input type="text" name="lname" class="form-control" id="inputEmail3" placeholder="Last Name" value="{{$lname}}">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8 pull-right">
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$email}}" disabled="disabled">
              </div>
            </div>
            <button type="submits" class="btn btn-primary pull-right">Save</button>
          </form>
      </div>
  </div>
  <!-- LEFT BOX END -->
</div>
</div>

{!! View::make('partials.login_modal') !!}
@stop