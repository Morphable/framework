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

  $router->middleware(['hasApiKey'], function ($router) {

    $router->get('user', function ($req, $res) {
      ?>
        <form action="user/postrequest?apikey=1" method="post">
          <input type="text" name="name" value="<?= $_GET['apikey'] ?>">
          <input type="submit">
        </form>
      <?php
    });

    $router->post('user/postrequest', function ($req, $res) {
      var_dump($_SESSION);
      // $res->back();
    });



    $router->get('user/:userId', ['validUser'], function ($req, $res) {
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
    echo json_encode($router::getGroups());
  }
}
