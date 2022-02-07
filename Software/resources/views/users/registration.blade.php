@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/login_modal.css') !!}
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
{!! Html::style('assets/css/users/registration.css') !!}
{!! Html::style('/assets/css/general.css') !!}
{!! Html::style('/assets/css/design_tools/postcodify.css') !!}
@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.postcodify/3.3.0/search.min.js"></script>
<script src="/assets/js/design_tools/postcodify.js"></script>


<script src="/assets/js/login_modal.js"></script>
<script src="assets/js/users/registration.js"></script>
@stop

@section('content')

<div id="main-frame" class="col-md-7">
	{!! Form::open(array('action' => 'UsersController@postRegistration','id'=>'reg-form', 'class'=>'','role'=>"form")) !!}
	<div class="panel panel-primary" style="border:2px solid #337ab7">
		<div class="panel-heading">
			<h3 class="panel-title">Registration Form</h3>
		</div>
		<div class="panel-body" style="padding-left:0;padding-right:0">

			<div class="form-frame col-md-12">
				<div class="input-section  step1">
					<h3 class="form-title">Add Photo</h3>
					<div class="form-group ind-box col-md-12">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<a href="#">
								<img class="media-object profile-picture" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
							</a>
						</div>

						<div class="file-container col-md-6 col-sm-6 col-xs-6"> 
							<span class="file-wrapper">
								<input type="file" id="form-submit-btn" accept="image/*"/>
								<span class="button" id="sub-btn">Choose File</span>
							</span>
						</div>
					</div>
				</div>
				<hr>
				<div class="input-section  step2">
					<h3 class="form-title">Basic Information</h3>
					<div class="rows" style="">
						<div class="form-single">
							<input type="text" class="form-style col-md-4 first_name" name="first_name" placeholder="First name *" id="first_name" aria-describedby="sizing-addon2">
							<div class="error-wrapper-fname">
								<div class="error-first_name hide error"></div>
							</div>
						</div>
						<div class="form-single">
							<input type="text" class="form-style col-md-5 last_name" name="last_name" id="last_name" placeholder="Last name *" aria-describedby="sizing-addon2">
							<div class="error-wrapper-lname">
								<div class="error-last_name hide error"></div>
							</div>
						</div>
						<div class="form-single">
							<select class="form-style col-md-2 age" name="age" id="age">
								<option >Age</option>
								<option value="1">Below 18</option>
								<option value="2">18 or older</option>
							</select>
							<div class="error-wrapper-age">
								<div class="error-age hide error"></div>
							</div>
						</div>
					</div>
					<div class="row-2">
						<input type="text" class="form-style col-md-12 row-margin-btm" id="email" name="email" placeholder="Email *" aria-describedby="sizing-addon2">
					</div>
					<div class="error-wrapper">
						<div class="error-email hide error"></div>
					</div>
					<div class="row-2" style="margin-top: 145px;">
						<input type="text" class="form-style col-md-12 row-margin-btm" id="phone" name="phone" placeholder="Phone Number * (000-0000-0000)" aria-describedby="sizing-addon2">
					</div>
					<div class="error-wrapper">
						<div class="error-phone hide error"></div>
					</div>
				</div>
				<hr>
				<div class="input-section step3">
					<h3 class="form-title">Your New Account Credentials</h3>
					<input type="text" class="form-style col-md-12 username row-margin-btm" name="username" id="username" placeholder="Username *" aria-describedby="sizing-addon2">
					<div class="error-wrapper">
						<div class="error-username hide error"></div>
					</div>
					<input type="password" class="form-style col-md-12 top-margin password row-margin-btm" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">
					<div class="error-wrapper">
						<div class="error-password hide error"></div>
					</div>
					<input type="password" class="form-style col-md-12 top-margin password_again row-margin-btm"  name="password_again" id="password_again" placeholder="Re-Enter Password" aria-describedby="sizing-addon2">
					<div class="error-wrapper">
						<div class="error-password-again hide error"></div>
					</div>
				</div>



			</div>
		</div>
		<div class="panel-footer clearfix">
			<a class="btn btn-primary pull-right" id="submit-btn" >Join Us</a>
		</div>
	</div>


	{!! Form::close() !!}
</div>

<style>

</style>


@stop