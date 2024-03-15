<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
    if(session()->has('user') && ($request->path() !=="login" && $request->path() !=="register" && $request->path() !== "/register/create" && $request->path() !=="/login/signin" )){
        return redirect()->route('user.index'); 
    }
    dd(session()->has('user'));
    return $next($request);

    
     


    // User is already logged in
   
    
    }
}
