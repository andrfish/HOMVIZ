<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Session;
use Request;
use Auth;
use Input;
use App\Page;
use Validator;
use Redirect;
use Hash;
use Route;
use Laracasts\Flash\Flash;
use View;
use App\SiteSetting;
class BeforeFilter
{
   

    /**
     * Create a new filter instance.
     *
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        
        // Perform before page load
        
        $url = ($request->isMethod('post')) ? Session::get('_previous')['url'] : $request->url();

        if (!Request::is('users/login-modal','logout','users/login'))
        {
            Session::flash('redirect_flash',$url);
        } 
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $response = $next($request);
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


         /*
         * Custom cache headers for js and css files
         */
        if ($request->is('*.js') || $request->is('*.css')){
            $response->header("pragma", "private");
            $response->header("Cache-Control", " private, max-age=31536000");
        } else {
            $response->header("pragma", "no-cache");
            $response->header("Cache-Control", "no-store,no-cache, must-revalidate, post-check=0, pre-check=0");
        }
            

        // Perform after page load
        // If request is post remove intended url for authorized users who were logged out and want to return to previous page
        if($request->isMethod('post')){
            Session::forget('intended_url');
        }

        return $response;

    }
}
