<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        return view('auth.form', ['nextUrl' => $request->input('nextUrl', null)]);
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
        if ( $request->has('nextUrl') ) {
            $url = $request->input('nextUrl');
        } else {
            // TODO: debugging now
            $url = route('debug_state');
        }
        return ['token' => $user->token, 'nextUrl' => $url];
    }

}
