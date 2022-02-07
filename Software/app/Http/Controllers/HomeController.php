<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Project;
use App\Simulation;
use App\Userdata;
use App\Questionnaire;

class HomeController extends Controller
{
    public function __construct() {

    }

        public function getHomePage($q=null)
    {

        $layout_title = 'layouts.master';

        $sim = Simulation::where("user_id",Auth::user()->id)->get();

        foreach ($sim as $sk => $sv) {

            $d = json_decode($sv->data);

            $sv->data = '';
            $sv->simulation_name = $d->simulation_name;
            $sv->simulation_location = $d->simulation_location;
            $sv->numberofweeks = $d->numberofweeks;
            $sv->numberofsims = $d->numberofsims;
            
            $sv->statusMessage = '<span class="badge badge-default">Submitted</span>';
            if ($sv->status==1) {
               $sv->statusMessage = '<span class="badge badge-success">Completed</span>';
            } else if($sv->status==2) {
               $sv->statusMessage = '<span class="badge badge-info">Processing</span>';
            }

            $phpdate = strtotime( $sv->created_at );
            $sv->created_at = date( 'Y-m-d H:i:s', $phpdate );

        }

        if ($q=='1') {
            return view('index')
            ->with('sim',$sim)
            ->with('questionnaireSubmitted','1')
            ->with('layout',$layout_title);
        } else {
            return view('index')
            ->with('sim',$sim)
            ->with('layout',$layout_title);
        }

    }
    

    public function getQuestionnaire()
    {

        $layout_title = 'layouts.master';

        return view('questionnaire')
        ->with('layout',$layout_title);

    }

    public function postQuestionnaire()
    {

        $questionnaire = new Questionnaire;

        $questionnaire->user_id = Auth::user()->id;
        $questionnaire->answer = json_encode(Input::get('questionnaire'));
        $questionnaire->stopwatch = Input::get('stopwatch');

        $questionnaire->save();

        return Redirect::route('index', ['q' => '1']);

    }

    public function getTerms()
    {


        $layout_title = 'layouts.master';

        return view('auth.terms')
        ->with('layout',$layout_title);

    }

    public function postTerms()
    {

        session(['terms' => '1']);

        return Redirect::route('register');

    }

    public function getTutorialVideo()
    {

        $layout_title = 'layouts.master';

        return view('tutorialvideo')
        ->with('layout',$layout_title);

    }

    public function postUserWatchingTutorialVideo()
    {
        
        $status = 400;
        $user_session_id = Auth::user()->id;
        $text_data = Input::get('text_data');

        $userdata = Userdata::where('user_id',$user_session_id)->first();

        if ($userdata === null) {
            $userdata =  new Userdata();
        }

        $userdata->user_id = $user_session_id;

        if ($text_data!="") {

            $userdata->data .= $text_data.',';
        }
        
        if ($userdata->save()) {
            $status =200;
        }

        return Response::json(array(
        'status' => $status
        ));

    }
    
}
