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

//Test your remote service
$router->get('/test', function () {
    return 'OK';
});

$router->get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Connected successfully to database: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Could not connect to the database. Error: " . $e->getMessage();
    }
});

$router->group(['middleware' => 'auth.access'], function () use ($router) {

    // more simple routes 
    $router->get('/users2', 'UserController@index');   // Get all users
    $router->post('/users2', 'UserController@add');  // create new user 
    $router->get('/users2/{id}', 'UserController@show'); // get user by id
    $router->put('/users2/{id}', 'UserController    @update'); // update user 
    $router->patch('/users2/{id}', 'UserController@update'); // update user 
    $router->delete('/users2/{id}', 'UserController@delete'); // delete 

    //for userjob
    $router->get('/userjob', 'UserJobController@index'); 
    $router->get('/userjob/{id}', 'UserJobController@show'); // get user by id
});
