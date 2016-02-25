<?php

use App\Models\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

/** Login and authenticate */
$app->get('/login',
    ['as' => 'login', 'uses' => 'AuthController@loginForm']
);
$app->post('/login',
    ['as' => 'login_do', 'uses' => 'AuthController@doLogin']
);



/** Debugging routing */
$app->get('/debug',
    function () use ($app)
    {
        $results = User::all();
        print_r($results);
    }
);
$app->get('/state',
    [
        'as' => 'debug_state',
        'middleware' => 'auth',
        function ()
        {
            return 'OK';
        }
    ]
);
