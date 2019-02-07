<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Socialite;

use App\User;
use App\SocialProfile;

class SocialAuthController extends Controller
{
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        // Verificar si el id de facebook existe en la tabla de social profiles
        $existing = User::whereHas('SocialProfiles', function ($query) use ($user) {
            $query->where('social_id', $user->id);
        })->first();

        if ($existing) {
            auth()->login($existing);
            return redirect('/');
        }

        $request->session()->flash('facebookUser', $user);

        return view('users.facebook', [
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->session()->get('facebookUser');

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'avatar' => $data->avatar,
            'username' => $request->input('username'),
            'password' => str_random(16)
        ]);

        $profile = SocialProfile::create([
            'social_id' => $data->id,
            'user_id' => $user->id
        ]);

        auth()->login($user);

        return redirect('/');
    }
}
