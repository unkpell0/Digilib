<?php
namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Logika redirect berdasarkan peran
        if ($user->role == 1) {
            return redirect('/admin'); // Admin ke halaman /admin
        } elseif ($user->role == 3) {
            return redirect('/home'); // User ke halaman /dashboard
        }

        // Default redirect
        return redirect('/home');
    }
}
