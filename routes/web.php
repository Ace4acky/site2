<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/users', 'UserController@getUsers');
$router->post('/users', 'UserController@add');
$router->get('/users/{id}', 'UserController@show');
$router->put('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');
