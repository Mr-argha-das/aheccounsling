<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class PermissionMiddleware
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
      	$userrole = session()->get('usersession');
      	$roleId = $userrole['team_type'];

      	if(!session()->has('user_id') || !session()->has('usersession'))
      	{
      		return redirect('wpanel/user/login');
      	}

      	return $next($request);
    }
}
