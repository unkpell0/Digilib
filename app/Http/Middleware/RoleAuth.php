<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Mengonversi peran ke array jika dioper dalam bentuk string dengan koma
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Access denied: User not authenticated'], 403);
        }

        // Ubah $roles menjadi array jika diberikan sebagai string
        $roles = is_string($roles[0]) ? explode(',', $roles[0]) : $roles;

        // Memeriksa apakah pengguna memiliki salah satu peran yang diizinkan
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        return $next($request);
    }
}
