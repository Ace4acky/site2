<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Public route for testing
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Group of routes that require JWT Authentication
$router->group(['middleware' => 'jwt.auth'], function () use ($router) {
    // Route to fetch data from Site 1
    $router->get('/site1', 'GatewayController@getSite1Data');
    
    // Route to fetch data from Site 2
    $router->get('/site2', 'GatewayController@getSite2Data');
});

// Public route for non-authenticated users (if you need)
$router->get('/public', 'GatewayController@getPublicData');

