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

// unsecure routes 
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users2',['uses' => 'UserController@getUsers']);
});

// more simple routes 
$router->get('/users2', 'UserController@index');   // Get all users
$router->post('/users2', 'UserController@add');  // create new user 
$router->get('/users2/{id}', 'UserController@show'); // get user by id
$router->put('/users2/{id}', 'UserController@update'); // update user 
$router->patch('/users2/{id}', 'UserController@update'); // update user 
$router->delete('/users2/{id}', 'UserController@delete'); // delete 