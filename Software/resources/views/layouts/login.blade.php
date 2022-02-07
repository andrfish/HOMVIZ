<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/css/responsive.css" rel="stylesheet">
  @yield('stylesheets')

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<body>


   
  @yield('content')



  <script type="text/javascript" src="/assets/js/jquery.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>

  @yield('scripts')

</body>
</html>