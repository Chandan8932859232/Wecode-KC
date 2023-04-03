<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckuserLogin
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
        $Useremail = $request->session()->get('Useremail');
        $userPassword = $request->session()->get('userPassword');
        if($Useremail=="" AND  $userPassword=="")
        {
            return redirect('/');
        }
        return $next($request);
    }
}
