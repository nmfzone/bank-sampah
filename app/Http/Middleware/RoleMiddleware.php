<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
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
        $roles = $this->getMiddlewareParameterOnly(func_get_args());

        if (auth()->user()->status == 4) {
            alert()->success('Account anda telah di banned. Silahkan kontak administrator.')->persistent("Close");
            auth()->logout();

            return redirect('auth/login');
        }

        foreach($roles as $role) {
            if (auth()->check() && auth()->user()->hasRole($role)) {
                return $next($request);
            }
        }

        return abort(401);
    }

    protected function getMiddlewareParameterOnly($args)
    {
        array_shift($args); // Delete $request
        array_shift($args); // Delete Closure $next

        return $args;
    }
}
