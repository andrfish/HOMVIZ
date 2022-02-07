@extends($layout)
@section('stylesheets')
@stop
@section('scripts')

@stop


@section('content')


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="margin-left: 0">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
			    <h1 class="m-0 text-dark">Projects</h1>
			  </div><!-- /.col -->
			  <div class="col-sm-6">
			    <ol class="breadcrumb float-sm-right">
			      <li class="breadcrumb-item"><a href="#">Home</a></li>
			      <li class="breadcrumb-item active">Starter Page</li>
			    </ol>
			  </div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<div class="content">

	    <div class="container-fluid">

	        <div class="row">

	          <div class="col-lg-12">

	            <div class="card card-primary card-outline">

          			{!! Form::open(array('action' => 'ProjectsController@postEdit','role'=>"form")) !!}

          				<input type="hidden" name="project_id" value="{{$project->id}}">

		                <div class="card card-solid" style="margin-bottom: 0">

		                    <div class="card-body pb-0">

								  <div class="form-group">
								    <label for="inputName">Project Name</label>
								    <input name="name" type="text" id="inputName" class="form-control" value="{{$project->name}}">
								  </div>
								  <div class="form-group">
								    <label for="inputDescription">Project Description</label>
								    <textarea name="description" id="inputDescription" class="form-control" rows="4">{{$project->description}}</textarea>
								  </div>
								  <div class="form-group">
								    <label for="inputProjectLeader">Project Leader</label>
								    <input name="leader" type="text" id="inputProjectLeader" class="form-control" value="{{$project->leader}}">
								  </div>

		                    </div>

							<div class="card-footer">

			                  <button type="submit" class="btn btn-primary">Save and Continue</button>
			                  
			                </div>

		                </div>

	                {!! Form::close() !!}

	            </div><!-- /.card -->

	          </div>

	        </div>
	        <!-- /.row -->

	    </div><!-- /.container-fluid -->

    </div>

@stop
