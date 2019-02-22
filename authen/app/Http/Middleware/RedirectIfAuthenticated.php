<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    //Phương thức này dùng để xử lý khi chúng ta đăng nhập thành công
    public function handle($request, Closure $next, $guard = null)
    {
        switch($guard){
            case 'admin' :
                if(Auth::guard($guard)->check()){
                    return redirect()->route('admin.dashboard');
                }
                break;
            default:
                if(Auth::guard($guard)->check()){
                    return redirect()->route('home');
                }
                break;
        }

        return $next($request);
    }
}
