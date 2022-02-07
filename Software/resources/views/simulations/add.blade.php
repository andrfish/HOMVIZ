@extends($layout)
@section('stylesheets')
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css?1">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css?1">
	<link rel="stylesheet" href="/assets/css/sweetalert2.min.css?1">
	<link rel="stylesheet" href="/assets/css/simulations/index.css?32">
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
@stop
@section('scripts')
	<script type="text/javascript" src="/SmartWizard-master/src/js/jquery.smartWizard.js?22"></script>
	<script type="text/javascript" src="/assets/js/sweetalert2.min.js?1"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
	<script type="text/javascript" src="/assets/js/simulations/index.js?12"></script>
@stop

@section('content')

  <!-- Control Sidebar -->
  <aside class="my-sidebar control-sidebar-dark sidebar-close">
    <!-- Control sidebar content goes here -->
	<div class="p-3 control-sidebar-content">

		<div class="header" style="display: inline-block;width: 100%;">
			
			<div style="float: left;" class="title"><h5>Video Tutorial</h5></div>
			<div style="float: right; cursor: pointer;" class="control"><i id="close-slider" class="fas fa-times-circle"></i></div>

		</div>

		<div id="step-1-video" class="video-container hide">

			<h6>Step 1</h6>
			
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/p7nSuzCPUkk" frameborder="0" allowfullscreen></iframe>
			</div>

		</div>

		<div id="step-2-video" class="video-container hide">

			<h6>Step 2</h6>
			
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ns3F-ztSV8I" frameborder="0" allowfullscreen></iframe>
			</div>

		</div>

		<div id="step-3-video" class="video-container hide">

			<h6>Step 3</h6>
			
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3ororsdLHdo" allowfullscreen></iframe>
			</div>

		</div>

		<div id="step-4-video" class="video-container hide">

			<h6>Step 4</h6>
			
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/XnGM3V09eEY" allowfullscreen></iframe>
			</div>

		</div>

		<div id="step-5-video" class="video-container hide">

			<h6>Step 5</h6>
			
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/bK1M9xTCQDw" allowfullscreen></iframe>
			</div>

		</div>

		<div id="step-6-video" class="video-container hide">

			<h6>Step 6</h6>
			
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/qOCtxqZ7H7U" allowfullscreen></iframe>
			</div>

		</div>

	</div>

  </aside>
  <!-- /.control-sidebar -->

	<style>
		
		td.titles{
			background-color: gray;
    		color: white;
    		font-weight: bold;
		}
		.swal2-icon.swal2-error.swal2-animate-error-icon{
			margin-right: 10px
		}

		#_table{
			max-height: 700px;
    		overflow-y: auto;
		}

		.myrow {
		  display: flex; /* equal height of the children */
		}

		.mycol {
		  flex: 1; /* additionally, equal width */
		  padding-bottom: 1em;
		}

		.btn-success {
		    border-color: #5cb85c !important;
		    color: #fff !important;
		    background: #5cb85c !important;
		}

		.dismisspopover{
			cursor: pointer;
		}

		.swal2-popup {
		    position: relative !important;
		    box-sizing: border-box !important;
		    flex-direction: column !important;
		    justify-content: center !important;
		    width: 32em !important;
		    max-width: 100% !important;
		    padding: 1.25em !important;
		    border: none !important;
		    border-radius: .3125em !important;
		    background: #fff !important;
		    font-family: inherit !important;
		    font-size: 1rem !important;
		}

		.swal2-header {
		    display: flex !important;
		    flex-direction: column !important;
		    align-items: center !important;
		    padding: 0 1.8em !important;
		}
		.swal2-title {
		    position: relative !important;
		    max-width: 100% !important;
		    margin: 0 0 .4em !important;
		    padding: 0 !important;
		    color: #595959 !important;
		    font-size: 1.875em !important;
		    font-weight: 600 !important;
		    text-align: center !important;
		    text-transform: none !important;
		    word-wrap: break-word !important;
		}
		.swal2-content {
		    z-index: 1 !important;
		    justify-content: center !important;
		    margin: 0 !important;
		    padding: 0 1.6em !important;
		    color: #545454 !important;
		    font-size: 1.125em !important;
		    font-weight: 400 !important;
		    line-height: normal !important;
		    text-align: center !important;
		    word-wrap: break-word !important;
		}
		[class^=swal2] {
		    -webkit-tap-highlight-color: transparent !important;
		}
		.swal2-actions {
		    display: flex !important;
		    z-index: 1 !important;
		    flex-wrap: wrap !important;
		    align-items: center !important;
		    justify-content: center !important;
		    width: 100% !important;
		    margin: 1.25em auto 0 !important;
		}
		.swal2-styled.swal2-confirm {
		    border: 0 !important;
		    border-radius: .25em !important;
		    background: initial !important;
		    background-color: #3085d6 !important;
		    color: #fff !important;
		    font-size: 1.0625em !important;
		}
		.swal2-styled:not([disabled]) {
		    cursor: pointer !important;
		}
		.swal2-styled.swal2-cancel {
		    border: 0;
		    border-radius: .25em;
		    background: initial;
		    background-color: #aaa;
		    color: #fff;
		    font-size: 1.0625em;
		}
		.swal2-styled {
		    margin: .3125em !important;
		    padding: .625em 2em !important;
		    box-shadow: none !important;
		    font-weight: 500 !important;
		}
		.swal2-icon {
		    position: relative;
		    box-sizing: content-box;
		    justify-content: center;
		    width: 5em;
		    height: 5em;
		    margin: 1.25em auto 1.875em;
		    border: .25em solid transparent;
		    border-radius: 50%;
		    font-family: inherit;
		    line-height: 5em;
		    cursor: default;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		}
		option:disabled {
		    color: #d0d0d0 !important;
			text-decoration: line-through;
		}
		.disabled {
		    color:gray !important;
		    cursor: no-drop;
		}

		.text-left{
			text-align: left !important;
		}

		.sum-ul{
			padding-left: 27px !important
			width:100%;
		}

		.sum-ul .child-ul {
			margin-bottom: 15px
		}

		.sidebar-open {
		  right: 0
		}

		.sidebar-close {
		  right: -500px
		}

		.my-sidebar{
		  width: 500px;
		  position: fixed;
		  top:0;
		  height: 100%;
		  transition: all .2s;
		  z-index: 999;
		}

		.video-container{
			margin-top: 40px;
		}

		.video-link-container{
		    float: right;
		    margin: 0px 10px 10px 10px;
		    font-size: 23px;
		    cursor: pointer;
		}

		.video-link-container i{
		    cursor: pointer;
		}

		.policy-input{
			width: 100px !important;
		}

		.parentrow td {
			border-bottom: none !important;
		}


		.last-child-row td{
			border-top: none !important;
		}

		.child-row td {
			border-top: none !important;
			border-bottom: none !important;
		}

		.bb0{
			border-bottom: 0 !important;
		}

		.bt0{
			border-top: 0 !important;
		}

		.overview-title-table{
			width: 100%
		}

		.overview-title-table tr td:first-child{
			text-align: left;
		}

		.overview-title-table tr td:last-child{
			text-align: right;
		}


	</style>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="margin-left: 0">

		<div id="myoverlay" style="position: absolute;width: 100%;height: 100%;background: white;z-index: 9;"></div>
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
				  <div class="col-sm-6">
				    <h1 class="m-0 text-dark">New Simulation</h1>
				  </div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<div id="mcontent" class="content" style="display: none">

		    <div class="container-fluid">

		        <div class="row myrow">

			        <div class="col-lg-9 mycol" id="main-window">

						{!! Form::open(array('action' => 'SimulationsController@postAdd','role'=>"form", 'id'=>"myform", 'autocomplete'=>"off")) !!}

					        @if(isset($project_id))
						        <input type="hidden" name="project_id" value="{{$project_id}}">
						    @endif

						    <input type="hidden" name="stopwatch" id="stopwatch" value="0">
						    <input type="hidden" name="videosliderwatches" id="videosliderwatches" value="0">


							<!-- Policies are going to be here -->
						    <div style="display: none" id="policieshtmls"></div>

								
							<!-- Popoovers are going to be here -->
						    <div style="display: none" id="popoverhtmls"></div>

							<!-- Popoovers for overview window are going to be here -->
						    <div style="display: none" id="popoverhtmls-overview"></div>

						    <div class="card card-primary card-outline" style="height: 100%;margin-bottom: 0">

					            <div class="card-body" id="smartwizard"	>

						            <ul>
						                <li><a href="#step-1">Step 1<br /><big>Name and Location&nbsp;&nbsp;<i class="fas fa-map-marked-alt"></i></big></a></li>
						                <li><a href="#step-2">Step 2<br /><big>Population Group&nbsp;&nbsp;<i class="fas fa-users"></i></big></a></li>
						                <li><a href="#step-3">Step 3<br /><big>Resources&nbsp;&nbsp;<i class="fas fa-shapes"></i></big></a></li>
						                <li><a href="#step-4">Step 4<br /><big>Living Situations&nbsp;&nbsp;<i class="fas fa-id-badge"></i></big></a></li>
						                <li><a href="#step-5">Step 5<br /><big>New Scenarios&nbsp;&nbsp;<i class="fas fa-building"></i></big></a></li>
						                <li><a href="#step-6">Step 6<br /><big>Parameters&nbsp;&nbsp;<i class="fas fa-sliders-h"></i></big></a></li>
						            </ul>

						            <div style="padding-top: 15px">

						                <div id="step-1" class="">

						                	<div class="row">

								                <div class="col-md-12">
								                	<div class="row">
									                	<div class="col-md-6">
															<div class="form-group">
											                	<label for="inputName">Simulation Name&nbsp;

																<a class='show-info pointer'>
																<span msg="Name your simulation. This is for your recollection and does not affect the outcome of your simulation."></span>
																<i class='text-info fas fa-info-circle'></i>
																</a>

																
																<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutorial video" class="pointer general-tooltip"><i step='1' class="text-info fas fa-video tutorial-link"></i></a>

											                	&nbsp;</label>
											                	<div id="locationField"></div>
											                	<input name="simulation_name" id="simulation-name" type="text" class="form-control" placeholder="Enter simulation name" value='' onpaste="return false" maxlength="20">
											                	<span class="text-danger" id="simname-error">Simulation name is required. No special characters are permitted.</span>
											              	</div>
										              	</div>
									              	</div>
									            </div>

									            <div class="col-md-12">
								                	<div class="row">
									                	<div class="col-md-6">
															<div class="form-group">
											                	<label for="inputName">Enter a name and select a city from the dropdown list&nbsp;

																	<a class='show-info pointer'>
																	<span msg="Select the city that your data is representing. This is for your recollection and does not affect the outcome of your simulation."></span>
																	<i class='text-info fas fa-info-circle'></i>
																	</a>

											                	&nbsp;</label>
											                	<div id="locationField"></div>
											                	<input autocomplete="off" id="autocomplete" placeholder="Enter city name" name="simulation_location" type="text" class="form-control sim-location">
											                	<span class="text-danger" id="cityname-error">City name is required.</span>
												            </div>
										              	</div>
									              	</div>
									            </div>

									            <div class="col-md-6">

												    <div id="map"></div>

												    <script>

												      var map, map2, places, infoWindow;
												      var markers = [];
												      var autocomplete;
												      var countryRestrict = {'country': 'ca'};
												      var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
												      var hostnameRegexp = new RegExp('^https?://.+?/');

												      var countries = {
												        'ca': {
												          center: {lat: 62, lng: -110.0},
												          zoom: 3
												        }
												      };

												      function initMap() {
												        map = new google.maps.Map(document.getElementById('map'), {
												          zoom: countries['ca'].zoom,
												          center: countries['ca'].center,
												          mapTypeControl: false,
												          panControl: false,
												          zoomControl: false,
												          streetViewControl: false
												        });

												        map2 = new google.maps.Map(document.getElementById('map2'), {
												          zoom: countries['ca'].zoom,
												          center: countries['ca'].center,
												          mapTypeControl: false,
												          panControl: false,
												          zoomControl: false,
												          streetViewControl: false
												        });

												        infoWindow = new google.maps.InfoWindow({
												          content: document.getElementById('info-content')
												        });

												        // Create the autocomplete object and associate it with the UI input control.
												        // Restrict the search to the default country, and to place type "cities".
												        autocomplete = new google.maps.places.Autocomplete(
												            /** @type {!HTMLInputElement} */ (
												            document.getElementById('autocomplete')), {
												              types: ['(cities)'],
												              componentRestrictions: countryRestrict
												            });
												        places = new google.maps.places.PlacesService(map);
												        places2 = new google.maps.places.PlacesService(map2);

												        autocomplete.addListener('place_changed', onPlaceChanged);

												      }

												      // When the user selects a city, get the place details for the city and
												      // zoom the map in on the city.
												      function onPlaceChanged() {
												        var place = autocomplete.getPlace();
												        if (place.geometry) {
												          map.panTo(place.geometry.location);
												          map.setZoom(15);
												          map2.panTo(place.geometry.location);
												          map2.setZoom(10);

												        } else {
												          document.getElementById('autocomplete').placeholder = 'City name';
												        }

												        window.loc=1;
												      
												        step1HandleErrors();

												      }

												      function clearMarkers() {
												        for (var i = 0; i < markers.length; i++) {
												          if (markers[i]) {
												            markers[i].setMap(null);
												          }
												        }
												        markers = [];
												      }

												      // Set the country restriction based on user input.
												      // Also center and zoom the map on the given country.
												      function setAutocompleteCountry() {
												        var country = 'ca';
												        if (country == 'all') {
												          autocomplete.setComponentRestrictions({'country': []});
												          map.setCenter({lat: 15, lng: 0});
												          map.setZoom(2);
												          map2.setCenter({lat: 15, lng: 0});
												          map2.setZoom(2);
												        } else {
												          autocomplete.setComponentRestrictions({'country': country});
												          map.setCenter(countries[country].center);
												          map.setZoom(countries[country].zoom);
												          map2.setCenter(countries[country].center);
												          map2.setZoom(countries[country].zoom);
												        }
												        clearResults();
												        clearMarkers();
												      }

												    </script>
												    
												    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjSc4Dogy851gGnXKKWcypMufL4ASk3RM&libraries=places&callback=initMap" async defer></script>

									            </div>

								        	</div>

						                </div>

						                <div id="step-2" class="">

						                	<div class="row">

								                <div class="col-md-12">

													<div class="form-group">

									                	<label for="inputName">Select population type</label>

									                	<a class='show-info pointer'>
														<span msg="Select among the provided population types. In the later stages, you can use the defined population types to customize your simulation."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>

									                	<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutorial video" class="pointer general-tooltip"><i step='2' class="text-info fas fa-video tutorial-link"></i></a>

									                	<br>
									                	
													  	<div class="form-inline">
														  	<select class="form-control col-md-6" id="populationselect">
														  		<option selected disabled id="title" value="0">Select One</option>
																<option id="u30hl1m" >under 30, homeless less than 1 year, male</option>
																<option id="u30hm1m" >under 30, homeless more than 1 year, male</option>
																<option id="u30hl1f" >under 30, homeless less than 1 year, female</option>
																<option id="u30hm1f" >under 30, homeless more than 1 year, female</option>
																<option id="b30t50hl1m" >30-50 years, homeless less than 1 year, male</option>
																<option id="b30t50hm1m" >30-50 years, homeless more than 1 year, male</option>
																<option id="b30t50hl1f" >30-50 years, homeless less than 1 year, female</option>
																<option id="b30t50hm1f" >30-50 years, homeless more than 1 year, female</option>
																<option id="g50hl1m" >greater than 50 years, homeless less than 1 year, male</option>
																<option id="g50hm1m" >greater than 50 years, homeless more than 1 year, male</option>
																<option id="g50hl1f" >greater than 50 years, homeless less than 1 year, female</option>
																<option id="g50hm1f" >greater than 50 years, homeless more than 1 year, female</option>
											                </select>
													    	<button id="populationbtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
													    </div>

									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12" style="margin-bottom: 50px;">

													<div id="populationtable">

														<div class="table-responsive row-scroll" style="border: 1px solid gray;">
															<table class="table table-bordered" style="margin-bottom: 0">
																<thead>
																	<tr>

																		<th>Name</th>
																		<th>Population count<span id="pop-count-info">&nbsp;
																		<a class='show-info pointer'>
																		<span msg="Enter the total population of each population type."></span>
																		<i class='text-info fas fa-info-circle'></i>
																		</a>
																		&nbsp;</span></th>
																		<th>Action</th>

																	</tr>
																</thead>
																<tbody>
																	<tr><td></td><td></td><td></td></tr>
																</tbody>
															</table>
														</div>

													</div>

												</div>

											</div>

						                </div>

						                <div id="step-3" class="">

						                	<div class="row">

								                <div class="col-md-12">

													<div class="form-group">

									                	<label for="inputName">Select between the provided resources</label>


														<a class='show-info pointer'>
														<span msg="A resource is a place or a type of facility where people experiencing homelessness can spend the night."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>

														<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutorial video" class="pointer general-tooltip"><i step='3' class="text-info fas fa-video tutorial-link"></i></a>


													  	<div class="form-inline">
														  	<select class="form-control col-md-4" id="resselect">
														  		<option selected disabled id="title" value="0">Select</option>
																<option id="Hospital" type="res">Hospital</option>
																<option id="Shelter" type="res">Shelter</option>
																<option id="TransitionalHousing" type="res">Transitional Housing</option>
																<option id="Rehabilitation" type="res">Addiction / Rehabilitation Center</option>
																<option id="HousingFirst" type="res">Housing First (HF) program</option>
											                </select>
													    	<button id="resourcebtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
													    </div>

									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12" style="margin-bottom: 50px;">

													<div id="resource_table">

														<div class="table-responsive row-scroll" style="border: 1px solid gray;">
															<table class="table table-bordered" id="restable" style="margin-bottom: 0">
																<thead>
																	<tr>

																		<th>Type</th><th>Name</th><th>Action</th><th>Properties</th><th>Delete</th>

																	</tr>
																</thead>
																<tbody id="res-tbody">
																	<tr><td></td><td></td><td></td><td></td><td></td></tr>
																</tbody>
															</table>
														</div>

													</div>

												</div>

											</div>

						                </div>

						                <div id="step-4" class="">

						                	<div class="row">

								                <div class="col-md-12">

													<div class="form-group">

									                	<label for="inputName">Select between the provided living situations</label>

									                	<a class='show-info pointer'>
															<span msg="A particular living condition such as hidden homelessness"></span>
															<i class='text-info fas fa-info-circle'></i>
														</a>

														<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutorial video" class="pointer general-tooltip"><i step='4' class="text-info fas fa-video tutorial-link"></i></a>
									                	<br>
									                	
													  	<div class="form-inline">
														  	<select class="form-control col-md-4" id="stateselect">
														  		<option selected disabled id="title">Select</option>
																<option id="HiddenHomeless" type="state">Hidden Homeless</option>
																<option id="NotHomeless" type="state">Not Homeless</option>
																<option id="Street" type="state">Street</option>
																<!-- <option id="InstitutionalOrganization" type="state">Institutional Organization</option> -->
											                </select>
													    	<button id="statebtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
													    </div>

									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12" style="margin-bottom: 50px;">

													<div id="state_table">

														<div class="table-responsive row-scroll" style="border: 1px solid gray;">
															<table class="table table-bordered" id="statetable" style="margin-bottom: 0">
																<thead>
																	<tr>

																		<th>Type</th><th>Name</th><th>Properties</th><th>Action</th>

																	</tr>
																</thead>
																<tbody id="state-tbody">
																	<tr><td></td><td></td><td></td><td></td></tr>
																</tbody>
															</table>
														</div>

													</div>

												</div>

											</div>

						                </div>

						                <div id="step-5" class="">

						                	<div class="row">

								                <div class="col-md-12">

													<div class="form-group">

									                	<label for="inputName">Add a new scenario to your simulation</label>

														<a class='show-info pointer'>
														<span msg="New scenarios affect the parameters of previously added resources in your simulation. Using new scenarios, you can observe the outcome of your simulation if some resources have different parameters, for example, the maximum length of stay and the capacity."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>

														<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutorial video" class="pointer general-tooltip"><i step='5' class="text-info fas fa-video tutorial-link"></i></a>

									                	<br>
									                	
													  	<div class="form-inline">
													  		<input id="policy-name-input" type="text" class="form-control col-md-4 no-special-chars" value="" placeholder="Enter the program name and press add">
													    	<button id="policybtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
													    </div>
													    <span class="text-danger hide" id="housingp-error">*required.</span>

									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12" style="margin-bottom: 50px;">

													<div id="policy_table">

														<div class="table-responsive row-scroll" style="border: 1px solid gray;">
															<table class="table table-bordered" id="policytable" style="margin-bottom: 0">
																<thead>
																	<tr>

																		<th>Type</th><th>Name</th><th>Properties</th><th>Action</th>

																	</tr>
																</thead>
																<tbody id="policy-tbody">
																	<tr><td></td><td></td><td></td><td></td></tr>
																</tbody>
															</table>
														</div>

													</div>

												</div>

											</div>

						                </div>


						                <div id="step-6" class="">

						                	<div class="row" style="margin-left: 0;margin-right: 0;">

								                <div class="col-md-4">

													<div class="form-group">
									                	<label for="inputName">Number of weeks</label>

									                	<a class='show-info pointer'>
															<span msg="The total number of weeks to run the simulation."></span>
															<i class='text-info fas fa-info-circle'></i>
														</a>

														<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutorial video" class="pointer general-tooltip"><i step='6' class="text-info fas fa-video tutorial-link"></i></a>


									                	<input type="number" min="1" max="520" step="1" autocomplete="off" name="numberofweeks" id="simweeks" class="form-control is-invalid">
									                	<span class="text-danger" id="weeks-error">This input is required. The value must be a numeric value between 1 to 520.</span>
									              	</div>

				   
									            </div>

								        	</div>

						                </div>

						            </div>


					            </div>

					            <div class="card-footer" style="text-align: right;">
							
									<button type="button" class="btn btn-default" id="prev" disabledx="">Back</button>
									<button type="button" class="btn bg-gradient-primary" id="next">Next Step</button>

				              	</div>

						    </div><!-- /.card -->

						{!! Form::close() !!}

					</div>

					<div class="col-lg-3 mycol" id="side-window">
						
						<div class="card card-primary card-outline" style="height: 100%">

							<div class="card-header" style="height: 73px;background: #17a2b8;color: #fff;border: 1px solid #078da2;">
								<h3 class="card-title" style="line-height: 48px;">
									<strong>Overview</strong>
								</h3>
							</div>

							<div class="card-body" style="height: 100px;overflow-x: auto;">

								<div class="row">

									<table class="overview-title-table">
									  <tr>
									    <td>Step 1, Name and Location:</td>
									    <td><span id="loc-overview" class="text-danger">Incomplete</span></td>
									  </tr>
									</table>

								</div>

								<div class="row summary-data hide" id="s1-sum">
									<ul class="sum-ul">
										<li>Simulation Name: <span id="simname-side"></span></li>
										<li>City Name: <span id="cityname-side"></span></li>
									</ul>
								</div>
								<div class="row">
									<div class="col-lg-12 hide" id="loc-div">
										<div id="map2"></div>
									</div>
								</div>

								<hr>

								<div class="row">

									<table class="overview-title-table">
									  <tr>
									    <td>Step 2, Population Group:</td>
									    <td><span id="population-overview" class="text-danger">Incomplete</span></td>
									  </tr>
									</table>

								</div>

								<div id="population-info" class="row summary-data">


								</div>

								<hr>

								<div class="row">

									<table class="overview-title-table">
									  <tr>
									    <td>Step 3, Resources:</td>
									    <td><span id="resources-overview" class="text-danger">Incomplete</span></td>
									  </tr>
									</table>

								</div>
								<div class="row summary-data" id="res-summary"></div>

								<hr>

								<div class="row">

									<table class="overview-title-table">
									  <tr>
									    <td>Step 4, Living Situations:</td>
									    <td><span id="states-overview" class="text-danger">Incomplete</span></td>
									  </tr>
									</table>

								</div>
 								<div class="row summary-data" id="state-summary"></div>

								<hr>

								<div class="row">

									<table class="overview-title-table">
									  <tr>
									    <td>Step 5, New Scenarios:</td>
									    <td><span id="policies-overview" class="text-info">0 scenario</span></td>
									  </tr>
									</table>

								</div>
								<div class="row summary-data" id="policy-summary"></div>
								<hr>

								<div class="row">
									
									<table class="overview-title-table">
									  <tr>
									    <td>Step 6, Parameters:</td>
									    <td><span id="parameters-overview"" class="text-danger">Incomplete</span></td>
									  </tr>
									</table>

								</div>


						    </div>

						</div><!-- /.card -->

					</div>

		        </div>
		        <!-- /.row -->

		    </div><!-- /.container-fluid -->

		</div>
	</div>

	<div class="modal" id="modal-xl-policy" style="background: #0000005c;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit program</h4>
              <button type="button" class="close close-policy-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body" id="policy-modal-body">
              
            	<div id="policy-edit-twrapper"></div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default close-policy-modal">Close</button>
              <button type="button" class="btn btn-primary" id="save-close-policy-modal">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
     </div>

@stop



