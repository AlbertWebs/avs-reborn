<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if(auth()->user()->type == $userType){
            return $next($request);
        }

       // Redirect users based on their type
       switch (auth()->user()->type) {
            case 'admin':
                return redirect('/admin');
            case 'user':
                return redirect('/dashboard');
            default:
                return redirect('/login')->with('error', 'Unauthorized access.');
        }
    }
}
