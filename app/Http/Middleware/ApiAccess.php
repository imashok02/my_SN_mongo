<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use MongoDB;

class ApiAccess
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
        if(empty($_REQUEST['api_key'] ))
        {
            return response()->json('Sorry, Cannot Let you In');
        }

        $user = new User;
        $findUser = $user->findOneApi($_REQUEST['api_key']);

     if ($_REQUEST['api_key'] === $findUser->api_key) 
        {
            return $next($request);
        }

        return response()->json('Sorry, Cannot Let you In');

    }

}
