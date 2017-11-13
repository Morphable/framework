<?php

use Morphable\Routing\Router;
use Morphable\Routing\RouteBuilder;

$url = $_SERVER['REQUEST_URI'];
$route = 'user/:userId/post/:postId/?ok';

echo $url . PHP_EOL;
echo $route . PHP_EOL;

$params = RouteBuilder::buildRoute($route);
$params = RouteBuilder::fillParams($url, $params);

// var_dump($params);

if (RouteBuilder::compare($params)) {
  echo 'success!';
} else {
  echo 'failed!';
}

die;

Router::middleware('name', function ($req, $res) {
  
});

Router::middleware('name2', function ($req, $res) {
  if ($req->params['userId'] != 2) {
    $res->redirect('/posts');
  }
});

Router::get('/user/:userId', ['name', 'name2'], function ($req, $res) {
  echo 'user details';
});

$r = Router::get('/user', function ($req, $res) {
  echo 'user index';
});

Router::get('/posts', function ($req, $res) {
  echo 'post index';
});

Router::any('*', function ($req, $res) {
  echo '404';
});

// Router::runMiddleware('name', $r, function () {
//   echo 'yeah!';
// });
