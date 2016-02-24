<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.form');
    }

}
