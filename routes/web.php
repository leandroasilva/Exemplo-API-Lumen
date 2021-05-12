<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Login JWT
$router->post('/auth/login', 'AuthController@autenticate');

$router->get('/pessoas', 'PessoasController@listapessoas');
$router->get('/pessoas/{id}', 'PessoasController@listapessoa');
$router->post('/pessoas', 'PessoasController@addpessoa');
$router->put('/pessoas/{id}', 'PessoasController@uptpessoa');
$router->delete('/pessoas/{id}', 'PessoasController@delpessoa'); //->middleware('jwt.auth');