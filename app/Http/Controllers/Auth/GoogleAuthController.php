<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request) {
        // Cek apakah 'code' ada di URL callback
        if (!$request->has('code')) {
            // Redirect ke halaman login jika batal
            return redirect()->route('login')->with('error', 'Login dengan Google dibatalkan.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();
            $registeredUser = User::where('google_id', $googleUser->id)->first();

            if (!$registeredUser) {
                $user = User::updateOrCreate([
                    'google_id' => $googleUser->id,
                ], [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('123'),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ]);

                Auth::login($user);

                return redirect('/dashboard');
            }

            Auth::login($registeredUser);
            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
