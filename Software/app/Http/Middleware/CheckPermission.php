<?php

namespace App\Http\Middleware;

use Closure;
use App\Job;
use Auth;
use Laracasts\Flash\Flash;
use Session;
use Redirect;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $permission - from routes.php to determine what type of check we need to make
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!app('Illuminate\Contracts\Auth\Guard')->guest()) {
            // If successful continue onto page request
            if ($request->user()->can($permission)) {

                return $next($request);
            }

            // Determine the path of where the user came from and redirect accordingly
            $redirect_path = (Session::get('_previous')['url']) ? Session::get('_previous')['url'] : '/';
            Flash::warning('You do not have authorization to view this page');

            // Check for unauthorized ajax requests and return 401, if post then redirect back to login page
            return $request->ajax ? response('Unauthorized.', 401) : Redirect::to($redirect_path);
        }
    }
}
