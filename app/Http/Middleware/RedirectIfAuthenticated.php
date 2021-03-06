<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        // we got different guards, and differe guards have their own stuff
//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//        }
//
//        return $next($request);

        switch ($guard) {
            case 'clients':
                if (Auth::guard($guard)->check()) {
                    return redirect(route('clients.dashboard'));
                }
                break;
            case 'staff':
                if (Auth::guard($guard)->check()) {
                    return redirect(route('staff.dashboard'));
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->intended();
                }
                break;
        }
        return $next($request);
    }

}
