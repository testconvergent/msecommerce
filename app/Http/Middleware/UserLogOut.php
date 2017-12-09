<?php
namespace App\Http\Middleware;
use Closure;
class UserLogOut
{
    public function handle($request, Closure $next)
    {
		if(empty(session()->get('user_id')))
		{
			return redirect('login');
		}
        return $next($request);
    }
}
