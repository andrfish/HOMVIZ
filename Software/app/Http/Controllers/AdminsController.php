<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Input;
use Validator;
use Redirect;
use Hash;
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
use App\Admin;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;
use App\SiteSetting;

class AdminsController extends Controller
{
    public function __construct() {
    //     // Define layout

       if (Auth::user()) {
            switch (Auth::user()->roles) {
                case 1:
                    $this->layout = 'layouts.admins';
                    break;
                case 2:
                    $this->layout = 'layouts.admins';
                    break;
                case 3:
                    $this->layout = 'layouts.admins_simple';
                    break;
                
                default:
                    # code...
                    break;
            }
        } 

        Role::AutoFillRoles();

    }
    
    public function getIndex() {

        return view('admins.index')
        ->with('layout','layouts.admins');
    }

    public function getSimpleIndex() {
        $_layout = 'layouts.admins_simple';
        return view('admins.index')
        ->with('layout',$_layout);
    }

    public function getLogin() {

        $this->layout = 'layouts.login';
        return view('admins.login')
            ->with('layout',$this->layout);
    }

    public function postLogin() {
        $username = Input::get('email');
        $password = Input::get('password');
        // Session::reflash();

        if (Auth::attempt(array('username'=>$username, 'password'=>$password))) {
            Flash::success('Welcome back '.$username.'!');
            // return redirect()->action('AdminsController@getIndex');
            // Check for intended redirect, if not exists then go to default /admins page

            return (Session::has('intended_url')) ? Redirect::to(Session::get('intended_url')) : redirect()->intended('/admins');
        } else { //LOGING FAILED
            Flash::error('Wrong Username or Password!');
            $this->layout = 'layouts.login';
            return view('admins.login')
            ->with('layout',$this->layout);
        }
    }

    public function getLogout() {
        Auth::logout();
        Flash::success('You have successfully been logged out');
        return Redirect::action('AdminsController@getLogin');
    
    }
    public function getViewAcl() {   
        return view('admins.acl_view')
        ->with('layout',$this->layout);
               
    }

    //USERS SETTING
    public function getUsersIndex() {
        $search_by = User::search_by();
        return view('admins.users_setting.index')
         ->with('layout',$this->layout)
         ->with('search_by',$search_by);
    }
    
    public function getUsersAdd() {
        return view('admins.users_setting.add')
         ->with('layout',$this->layout);
    }
    
    public function postUsersAdd() {

    }
    
    public function getUsersEdit($id = null) {
        $users = User::find($id);
        $roles = Role::PerpareRolesForSelect();
        $user_role_id = RoleUser::GetUserRoleId($users->id);
        return view('admins.users_setting.edit')
         ->with('layout',$this->layout)
         ->with('roles',$roles)
         ->with('users',$users)
         ->with('user_role_id',$user_role_id); 
    }

    public function getWebMode() {
        $sst = SiteSetting::find(1);
        if (isset($sst)) {
             return view('admins.mode')
                 ->with('layout',$this->layout)
                 ->with('sst',$sst->mode);      
        } 
    }
    
    public function postWebModeChange() {
        $rad = Input::get('optionsRadios');
        $sett = SiteSetting::find(1);
        if (isset($sett)) {
            $sett->mode = $rad;
            if ($sett->save()) {
                Flash::success('Successfully Saved!');
            }
        }
        return Redirect::back();

    }

    
    public function postUsersEdit() {

        $username = Input::get('username');
        $fname = Input::get('fname');
        $lname = Input::get('lname');
        $email = Input::get('email');
        $role_id = Input::get('role_id');
        $id = Input::get('id');

        $users = User::find($id);
        $users->username = $username;
        $users->firstname = $fname;
        $users->lastname = $lname;
        $users->roles = $role_id;
        $users->email = $email;

        $role_users = RoleUser::where('user_id',$id)->first();
        $role_users->role_id = $role_id;

        if ($users->save() && $role_users->save()) {
            Flash::success('Successfully Updated');
        } else {
            Flash::Error('Error');
        }
        return Redirect::back();
    }
}
