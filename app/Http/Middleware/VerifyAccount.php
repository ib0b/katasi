<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class VerifyAccount
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
        
        if(auth()->check()){
            $user = auth()->user();
            if(!$user->isVerified()){
                return redirect()->route('verifyAccount');
            }  
        }
        return $next($request);
    }
}
