<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<< HEAD
        if(Auth::user()->role == 'superadmin'){
            return $next($request);
        }else{
            return back();
        }
=======
        return Auth::user()->role == 'superadmin' ? $next($request) : back();
>>>>>>> f615d9de5f7cccd66240f606f2037b0fc0f8bab1
    }
}
