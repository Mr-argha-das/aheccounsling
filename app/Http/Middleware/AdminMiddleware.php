<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$roles)
    {
        /*if(auth()->check() && auth()->user()->isOwner()) {
            return route('unauthorized');
        }*/
        if(!empty($roles)){
            $roles = explode('+',$roles);
        }else{
            $roles=[];
        }

        //dd(Auth::guard('admin')->user()->login_type);
        $session = session('session_nm');
        if(empty($session))
        {
            return redirect('wpanel/user/login?sessionFailed');
        }

        if (empty(Auth::guard('admin')->user()))
        {
            return redirect('wpanel/user/login?LoginRequired');
            //return new Response(view('unauthorized')->with('role', 'ADMIN'));
        }

        $arrangeRoal=[];
        foreach($roles as $val){
            if($val == 'admin') { $arrangeRoal[1]=$val; }
            if($val == 'staff') { $arrangeRoal[2]=$val; }
            if($val == 'container') { $arrangeRoal[3]=$val; }
            if($val == 'vehicle') { $arrangeRoal[4]=$val; }
        }

         $loginType = Auth::guard('admin')->user()->login_type;

        if (empty($arrangeRoal[$loginType]))
        {
            return redirect('wpanel/user/dashboard?WrongAccess');
            //return new Response(view('unauthorized')->with('role', 'ADMIN'));
        }

        return $next($request);
    }
}
