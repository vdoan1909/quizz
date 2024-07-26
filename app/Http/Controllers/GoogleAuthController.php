<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('google_id', $google_user->getId())
                ->orWhere('email', $google_user->getEmail())
                ->first();

            if ($user) {
                $user->update([
                    'name' => $google_user->getName(),
                    'google_token' => $google_user->token,
                    'google_refresh_token' => $google_user->refreshToken,
                ]);
            } else {
                $user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'password' => bcrypt('password'),
                    'google_id' => $google_user->getId(),
                    'google_token' => $google_user->token,
                    'google_refresh_token' => $google_user->refreshToken,
                ]);
            }

            Auth::login($user);

            return redirect()->route('client.index');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('login')->withErrors('Something went wrong.');
        }
    }
}
