<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::all()->count();
        // if (!($user == 1)) {
            if (!Auth::user()->hasPermissionTo('administartor privileges')){
                    abort('401');
            }
        // }

        return $next($request);
    }
}
