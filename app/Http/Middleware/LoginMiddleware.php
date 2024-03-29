<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next) {

        if ($request->route()) {
            $routeName = $request->route()->getName();
        } else {
            $routeName = 'user.index';
        }

        $excludedRoutes = [
            'user.index',
            'user.register',
            'user.create',
            'user.signin'
        ];
        if (!session()->has('user') && !in_array($routeName, $excludedRoutes)) {
            return redirect()->route('user.index');
        }
        return $next($request);

    }
}
