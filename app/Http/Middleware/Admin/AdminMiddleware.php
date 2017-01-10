<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
//        if(empty(Session::get('admin'))) {
//            return redirect( '/login' );
//        }
        return $next($request);
    }
}
