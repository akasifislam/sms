<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Test
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
        if(Auth::check()){
            if (Auth::user()->usertype=='Admin') {
                dd('admin room 1000001');
            }elseif(Auth::user()->usertype=='user'){
                dd('user romm null');
            }
            // return $next($request);  
        }else{
           return redirect()->back();
        }

    }
}
