<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfNotUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'user' )
    {

        if (!Auth::guard($guard)->check()) {
	        return redirect('user/login');
		}

        if(boolval(!Auth::user()->bl_email)){
			Auth::logout();
            // toastr()->warning('Email ainda não confirmado.');
            Session::flash('email', 'Email não confirmado');
            Session::flash('alert-class', 'alert-danger');
            return redirect('user/login');

        }

        if(boolval(!Auth::user()->bl_acesso)){
			Auth::logout();
            // toastr()->warning('Aguardando liberação.');
            Session::flash('liberacao', 'Aguardando liberação do admin.');
            Session::flash('alert-class', 'alert-danger');
			return redirect('user/login');
        }

        return $next($request);
    }
}
