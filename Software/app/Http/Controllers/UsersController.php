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
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;
use App\RoleUser;
use App\QuestionsNAnswer;
use App\Review;

class UsersController extends Controller
{
    public function __construct() {

        $this->layout = "layouts.default";

        $this->terms = session('terms');

    }

    public function getRegistration()
    {

        if ($this->terms == '1') {
            return view('auth.register')
            ->with('layout',$this->layout);
        } else {
            return Redirect::route('terms');
        }

    }

    public function postRegistration()
    {

        $username = Input::get('username');
        $u = User::where('username',$username)->first();

        if ($u===null) {

            $user = new User;
            $user->username = $username;
            $user->email = Input::get('email');
            $user->age = Input::get('age');
            $user->gender = Input::get('gender');
            $user->password = Hash::make(Input::get('password')); 
            $user->save();
            Auth::attempt(array('username'=> $user->username, 'password'=>Input::get('password')));

        } else {

            Flash::error('User exists');

        }

        return Redirect::route('index');

    }

    public function getLogin()
    {
        return view('auth.login')
        ->with('layout',$this->layout);
    }

    public function postLogin()
    {

        $username = Input::get('username');
        $password = Input::get('password');

        $u = User::where('username',$username)->first();

        if (Auth::attempt(array('username'=>$username, 'password'=>$password))) {

            return Redirect::route('index');

        } else {
            return redirect()->back()->with('message', "Invalid Username or Password");
        }
        
    }   

    public function getLogout()
    {
        Auth::logout();
        return Redirect::action('HomeController@getHomepage');
    }

    public function postLogout()
    {
        Auth::logout();
        return Redirect::action('HomeController@getHomepage');
    }

    public function postCheckUsername()
    {   
       
        $username = Input::get('username');

        $db_username = User::where('username',$username)->first();
        $status = 400;

        if (isset($db_username)) {

            $status = 0;

        } else {

            $status = 200;

        }

        return Response::json(array(
            'status' => $status
        ));

    }

}
