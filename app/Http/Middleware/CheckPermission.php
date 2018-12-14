<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($request->user()->pi->show == 0 ){
          switch ($guard) {
              case 'admin':
                  if (Auth::guard($guard)->check()) {
                      Auth::guard('admin')->logout();
                      return redirect()->route('admin.login');
                  }
                  break;
              case 'employee':
                  if (Auth::guard($guard)->check()) {
                      Auth::guard('employee')->logout();
                      return redirect()->route('employee.login');
                  }
                  break;
              default:
                  if (Auth::guard($guard)->check()) {
                      return redirect()->route('employee.login');
                  }
                  break;
          }
        }
        return $next($request);
    }
}
