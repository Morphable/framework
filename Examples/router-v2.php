<?php

use Morphable\Routing\RouterFactory as Router;
use Morphable\Routing\Middleware as Middleware;
use Morphable\Routing\Dispatchers\Dispatcher;
use Morphable\Http\Request;

$m3 = new Middleware('userAllowed', function ($req, $res) {

});

$router = new Router;

$router->get('post', function ($router) {
  echo 'post index';
  exit;
});

$router->prefix ('api/', function ($router) {

  $router->get('', function ($router) {
    echo 'index api';
    exit;
  });

  $router->middleware('checkApiKey', function ($router) {

    $router->prefix('/user/', function ($router) {

      $router->get('', function ($router) {
        echo 'index user';
        exit;
      });

      $router->get(':userId', function ($router) {
        echo 'user details';
        exit;
      });

    });

  });

});

$router->get('post/:postId', function ($router) {
  echo 'post detail';
  exit;
});

$request = new Request();
$router = Router::getGroups();

$dispatcher = new Dispatcher($router, $request);

var_dump($dispatcher->getParams());


if (isset($_GET['json'])) {
  if ($_GET['json'] == 'true') {
    header('Content-type: application/json');
    echo json_encode(Router::getGroups());
  }
}
