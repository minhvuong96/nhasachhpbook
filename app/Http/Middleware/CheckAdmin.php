<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdmin
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
            if(Auth::user()->admin!=1){
            Auth::logout();
            return redirect('/admin');
            }else{
                 return $next($request);
            }
        }else{
            return redirect('/admin');
        }
       
    }
}
