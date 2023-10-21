<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class VehicleAllotmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*if(auth()->check() && auth()->user()->isOwner()) {
            return route('unauthorized');
        }*/

        //dd(Auth::guard('admin')->user()->login_type);
        $session = session('session_nm');
        if(empty($session))
        {
            return redirect('wpanel/user/login');
        }
        if (empty(Auth::guard('admin')->user()) || Auth::guard('admin')->user()->login_type != 4)
        {
            return redirect('wpanel/user/login');
            //return new Response(view('unauthorized')->with('role', 'ADMIN'));
        }
        return $next($request);
    }
}
