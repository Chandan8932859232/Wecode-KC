<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $adminUser = $request->session()->get('adminUser');
        $adminPassword = $request->session()->get('adminPassword');
        if($adminUser=="" AND  $adminPassword=="")
        {
            return redirect('/admin');
        }
        return $next($request);
    }
}
