<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdminUser
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (User::where('id', Auth::user()->id)->value('is_admin')) {
             return $next($request);
        }
        return abort(404);
    }
}
