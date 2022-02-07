<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'beforeFilter'], function () {

	Route::get('terms', ['as'=>'terms','uses'=>'HomeController@getTerms']);
	Route::post('terms',['uses'=>'HomeController@postTerms']);

	Route::get('login', ['as'=>'login','uses'=>'UsersController@getLogin']);
	Route::post('login',['uses'=>'UsersController@postLogin']);
	Route::get('register', ['as'=>'register','uses'=>'UsersController@getRegistration']);
	Route::post('register', ['uses'=>'UsersController@postRegistration']);
	Route::get('logout', ['as'=>'users_logout','uses'=>'UsersController@getLogout']);

	Route::post('/check-username',  ['uses' => 'UsersController@postCheckUsername']);

	Route::group(['middleware' => ['auth']], function(){

		//HOMEPAGE
		Route::get('/', ['uses'=>'HomeController@getHomepage']);

		//HOMEPAGE AFTER QUESTIONNAIRE SUBMITED
		Route::get('/home/{q?}', ['as'=>'index','uses'=>'HomeController@getHomepage']);
		
		Route::get('/simulations/add',  ['as'=>'simulation_add', 'uses' => 'SimulationsController@getAdd']);
		Route::post('/simulations/add',  ['uses' => 'SimulationsController@postAdd']);
		Route::get('/simulations/view/{id}',  ['as'=>'simulation_view', 'uses' => 'SimulationsController@getView']);

		//USING AJAX CALL SHOW THE STATUS OF EACH SIMULATION TO THE USER
		Route::post('/simulations/progress-update',  ['uses' => 'SimulationsController@postprogressUpdate']);

		Route::post('/simulations/delete',  ['uses' => 'SimulationsController@postDelete']);

		Route::get('/tutorial-video', ['uses'=>'HomeController@getTutorialVideo']);
		Route::post('/userwatchingvideo',  ['uses' => 'HomeController@postUserWatchingTutorialVideo']);
		Route::get('/questionnaire', ['uses'=>'HomeController@getQuestionnaire']);
		Route::post('/questionnaire', ['uses'=>'HomeController@postQuestionnaire']);

	});

});