<?php

use Morphable\Routing\RouterFactory as Router;
use Morphable\Routing\Middleware as Middleware;
use Morphable\Routing\Dispatchers\Dispatcher;
use Morphable\Routing\Exceptions;
use Morphable\Http\Request;

$m3 = new Middleware('hasApiKey', function ($req, $res) {
  if (!isset($_GET['apikey'])) {
    $ex = new Exceptions\BadRequestException('Missing api key');
    $ex->response($res);
  }
});

$m3 = new Middleware('validUser', function ($req, $res) {
  if ($req->params['userId'] != 1) {
    $ex = new Exceptions\NotAllowedException('Wrong user id');
    $ex->response($res);
  }
});

$router = new Router;

$router->get('', function ($req, $res) {
  echo 'Welcome home!';
});

$router->prefix('api', function ($router) {

  $router->get('', function ($router) {
    echo 'Api index';
  });

  $router->middleware([], function ($router) {

    $router->get('user', ['hasApiKey'],  function ($req, $res) {
      echo 'index user';
    });

    $router->get('user/:userId', function ($req, $res) {
      echo 'detail user ' . $req->params['userId'];
    });

  });

});

$router->get('403', function ($req, $res) {
  $res->json([
    'error' => 403,
    'message' => 'Not allowed'
  ]);
  exit;
});

$router->get('400', function ($req, $res) {
  $ex = new Exceptions\BadRequestException('Bad request');
  $ex->response($res);
});

$router->get('404', function ($req, $res) {
  $ex = new Exceptions\BadRequestException('Route not found');
  $ex->response($res);
});

$dispatcher = new Dispatcher(Router::getGroups(), new Request());

$dispatcher->dispatch();
$exception = $dispatcher->getException();

if ($exception instanceof Exceptions\NotFoundException) {
  header('Location: /404');
  die;
}

if (isset($_GET['json'])) {
  if ($_GET['json'] == 'true') {
    header('Content-type: application/json');
    echo json_encode($router::getGroups());
  }
}
