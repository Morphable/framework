<?php

use Morphable\Routing\RouterFactory as Router;
use Morphable\Routing\Middleware as Middleware;
use Morphable\Routing\Dispatchers\Dispatcher;
use Morphable\Routing\Exceptions;
use Morphable\Http\Request;

$m3 = new Middleware('userAllowed', function ($req, $res) {

});

$router = new Router;

$router->get('post', function ($req, $res) {
  echo 'post index';
  exit;
});

$router->prefix ('api/', function ($router) {

  $router->get('', function ($req, $res) {
    echo 'index api';
    exit;
  });

  $router->middleware('checkApiKey', function ($router) {

    $router->prefix('/user/', function ($router) {

      $router->get('', function ($req, $res) {
        echo 'index user';
        exit;
      });

      $router->get(':userId', function ($req, $res) {
        var_dump($req->params['userId']);
        exit;
      });

    });

  });

});

$router->get('post/:postId', function ($req, $res) {
  echo 'post detail';
  exit;
});

$router->get('404', function ($req, $res) {
  echo '404';
  exit;
});

$request = new Request();
$router = Router::getGroups();

$dispatcher = new Dispatcher($router, $request);
$dispatcher->dispatch();

$exception = $dispatcher->getException();

if ($exception instanceof Exceptions\NotFoundException) {
  header('Location: /404');
  die;
}

if (isset($_GET['json'])) {
  if ($_GET['json'] == 'true') {
    header('Content-type: application/json');
    echo json_encode(Router::getGroups());
  }
}
