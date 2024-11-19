<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function facebookpage() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $request) {
        // Cek apakah 'code' ada di URL callback
        if (!$request->has('code')) {
            // Redirect ke halaman login jika batal
            return redirect()->route('login')->with('error', 'Login dengan Facebook dibatalkan.');
        }

        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $registeredUser = User::where('facebook_id', $facebookUser->id)->first();

            if (!$registeredUser) {
                $user = User::updateOrCreate([
                    'facebook_id' => $facebookUser->id,
                ], [
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'password' => Hash::make('123'),
                ]);

                Auth::login($user);

                return redirect('/dashboard');
            }

            Auth::login($registeredUser);
            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Facebook.');
        }
    }
}