<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function authenticated(Request $request, $user)
{
    if ($user->role == 1) {
        return redirect()->route('/admin');
    }  else {
        return redirect()->route('home'); //dashboard
    }
}
}
