<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogOut
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
		if(!empty(session()->get('admin_id')))
		{
			return redirect('admin-dashboard');
		}
        return $next($request);
    }
}
