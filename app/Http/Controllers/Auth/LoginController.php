<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!Auth::validate($credentials)){
            \Session::flash('alerts', ['message' => trans('auth.failed'), 'type' => 'danger']);
            return redirect()->route('login')->withInput();
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->get('remember_token'));
        $request->session()->regenerate();

        return redirect()->intended();
    }
}
