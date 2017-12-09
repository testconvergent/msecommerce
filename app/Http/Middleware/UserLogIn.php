<?php
namespace App\Http\Middleware;
use Closure;
class UserLogIn
{
    public function handle($request, Closure $next)
    {
		//echo 'hii';exit;
		if(!empty(session()->get('user_id')))
		{
			return redirect('dashboard');
		}
        return $next($request);
    }
}
