<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        if ( ! Auth::check() || ! Auth::user()->hasRole($role)) {
////            dd($role);
//            // Nếu không có quyền, chuyển hướng đến trang không có quyền
//            return redirect('/')->with('error',
//                'You do not have access to this resource.');
//        }

        return $next($request);
    }

}
