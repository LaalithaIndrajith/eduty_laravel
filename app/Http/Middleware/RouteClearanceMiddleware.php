<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteClearanceMiddleware
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
        if(($request->segment(3) != "") && ($request->segment(3)=="edit"))
        {
            $request_path = $request->segment(1).'_'.$request->segment(3);
        }
        else
        {
            $request_path = $request->getPathInfo();
            $request_path = substr($request_path,1);
            $request_path = str_replace('/','_',$request_path);
        }
        
        if (!Auth::user()->hasPermissionTo($request_path))
        {
            abort('401');
        } 
        else {
            return $next($request);
        } 

        return $next($request);
    }
}
