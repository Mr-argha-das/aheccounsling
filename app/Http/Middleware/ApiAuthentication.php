<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthentication
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
         if(empty($token)){
            return response([
            'message' => 'bearer token not authorized'
        ], 403);

         }
        $user = \App\Model\UserModel::where('_token_id', $token)->first();
        if($user) {
            $request->merge([ 'login_email' => $user->user_email]);
             return $next($request);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }
}