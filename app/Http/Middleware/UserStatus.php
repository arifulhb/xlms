<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserStatus
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
        $response = $next($request);
        //If the status is not approved redirect to login
        $blocked = [
            USER_STATUS_BLOCKED,
            USER_STATUS_SUSPENDED,
        ];

        if(Auth::check() && in_array(Auth::user()->status, $blocked)){
            Auth::logout();
            return back()->withErrors(['You are blocked or suspended. Please contact admin']);
        }
        return $response;
    }
}
