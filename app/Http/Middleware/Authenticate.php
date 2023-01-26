<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->is('admin') || $request->is('admin/*')){   //追記
                return redirect()->guest('/admin/login');           //追記
            }else{
                return url('/');
            }                                                       //追記
            return url('/');
            //return route('login');
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $this->redirectToOriginal($request, $guards)
        );
    }

    protected function redirectToOriginal($request, array $guards)
    {
        foreach ($guards as $guard) {
            if ($guard === 'admin') {
                return route('admin.login');
            }
        }
}
