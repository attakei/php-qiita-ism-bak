<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.form');
    }

    /**
     * Authenticate user by email
     *
     * @return \Illuminate\View\View
     */
    public function doLogin(Request $request)
    {
        if (! $request->has('email') ) {
            return abort(Response::HTTP_UNAUTHORIZED);
        }
        $user = User::where('email', $request->input('email'))->first();
        if ( is_null($user) ) {
            return abort(Response::HTTP_UNAUTHORIZED);
        }
        $user->regenerateToken();
        return ['token' => $user->token];
    }

}
