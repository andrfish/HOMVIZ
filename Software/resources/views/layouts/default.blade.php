<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
	
    <div class="row">
      @include('flash::message')
    </div>

	@yield('content')

	@yield('scripts')
</body>
</html>