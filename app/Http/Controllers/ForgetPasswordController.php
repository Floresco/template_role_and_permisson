<?php

namespace App\Http\Controllers;

class ForgetPasswordController extends Controller
{
    public function __invoke()
    {
        return view('auth.forgot_password');

    }
}
