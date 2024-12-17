<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSpinCooldown
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
//
//        if ($user->last_spin_at && now()->diffInHours($user->last_spin_at) < 24) {
//            return redirect()->back()->with('error', 'Bạn chỉ được quay lại sau 24 giờ!');
//        }
//
//        return $next($request);
//    }
}}
