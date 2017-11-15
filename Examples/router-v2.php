<?php

use Morphable\Routing\RouterFactory as Router;
use Morphable\Routing\Middleware as Middleware;

$m3 = new Middleware('userAllowed', function ($req, $res) {

});

$router = new Router;

$router->prefix ('api/', function ($router) {

  $router->middleware('checkApiKey', function ($router) {

    $router->prefix('/user/', function ($router) {



    });

  });

});

var_dump(Router::getGroups());
