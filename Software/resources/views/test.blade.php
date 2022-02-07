@extends($layout)
@section('stylesheets')
@stop
@section('scripts')

@stop

@section('content')
  <script>
    
    qx = JSON.parse(<?php echo json_encode($qx); ?>);

    console.log(qx)
	var i;
	for (i = 0; i < qx[0].length; i++) {

		let data_point = qx[0][i].split(" ");

		let timestamp = data_point[1];

		console.log(data_point[1])
	  	

	}

  </script>
@stop