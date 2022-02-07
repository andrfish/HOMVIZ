@extends($layout)
@section('stylesheets')
@stop
@section('scripts')


<script type="text/javascript" src="/assets/js/users/registration.js?1"></script>

@stop

@section('content')


  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE-3.0.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/AdminLTE-3.0.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE-3.0.0/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition register-page">
  <div class="register-box">


    @if(session()->has('message'))
      <div class="alert alert-danger">
          {{ session()->get('message') }}
      </div>
    @endif


    <div class="register-logo">
      <a href="/"><b>{{env("appname")}}</b></a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Registration Form</p>

        <form action="/register" method="post" id="myForm">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="input-group mb-3">
            <input name="username" type="username" class="form-control" placeholder="Username" required minlength="5" maxlength="15" id="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="row mb-3" id="username-error" style="display: none">
            <div class="col-12">
              <span class="text-danger">The username already exists. Please use a different username</span>  
            </div> 
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" required="" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12 form-group">

              <select class="form-control" id="sel2" name="gender" required>
                <option value="" selected="true" disabled="disabled">Gender</option>  
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">I don't identify as either Male or Female</option>
                <option value="ns">Prefer not to answer</option>
              </select>

            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              
              <select class="form-control" id="sel3" name="age" required>
                <option value="" selected="true" disabled="disabled">Age Group</option>  
                <option value="18 to 20">18 - 20 years old</option>
                <option value="21 to 25">21 - 25 years old</option>
                <option value="26 to 30">26 - 30 years old</option>
                <option value="31 to 45">31 - 45 years old</option>
                <option value="46+">46+</option>
                <option value="ns">Prefer not to answer</option>
              </select>

            </div>
          </div>

          <div class="input-group mb-3">
            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required minlength="6" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input id="password_confirm" oninput="check(this)" name="password_confirmation" type="password" class="form-control" placeholder="Retype password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="showpass" onclick="myFunction()">
                <label for="showpass">
                  <a>Show password</a>
                </label>
              </div>
            </div>
          </div>


          <script language='javascript' type='text/javascript'>
              function check(input) {
                  if (input.value != document.getElementById('password').value) {
                      input.setCustomValidity('Password Must be Matching.');
                  } else {
                      // input is valid -- reset the error message
                      input.setCustomValidity('');
                  }
              }
              function myFunction() {
                var x = document.getElementById("password");
                var x_confirm = document.getElementById("password_confirm");
                if (x.type === "password") {
                  x.type = "text";
                  x_confirm.type = "text";
                } else {
                  x.type = "password";
                  x_confirm.type = "password";
                }
              }
          </script>

          <hr>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required checked="">
                <label for="agreeTerms">
                 I agree to the <a href="/terms">terms</a>
                </label>
              </div>
            </div>

            <!-- /.col -->
            <div class="col-4">
              <button type="text" id="submit-btn" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->

    <div>
      <a href="/login" class="text-center"><span class="fas fa-chevron-left"></span> Back to login</a>
    </div>

  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="/AdminLTE-3.0.0/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/AdminLTE-3.0.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/AdminLTE-3.0.0/dist/js/adminlte.min.js"></script>
  </body>

@stop


