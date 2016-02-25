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
        sleep(2);
        $message = 'Invalid email';
        if (! $request->has('email') ) {
            return abort(Response::HTTP_UNAUTHORIZED, $message);
        }
        $user = User::where('email', $request->input('email'))->first();
        if ( is_null($user) ) {
            return abort(Response::HTTP_UNAUTHORIZED, $message);
        }
        $user->regenerateToken();
        return ['token' => $user->token];
    }

}
