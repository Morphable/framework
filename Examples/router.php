<?php

use Morphable\Routing\Router;
use Morphable\Routing\RouteBuilder;

Router::middleware('name', function ($req, $res) {
  if ($req->params['name'] != 'me') {
    $res->json(['Error' => 'name is not name']);
  }
});

Router::middleware('correctUser', function ($req, $res) {
  if ($req->params['userId'] != 2) {
    $res->status(403);
    $res->json(['Forbidden' => 'Wrong user id']);
  }
});

Router::get('/guess/my/:name', ['name'], function ($req, $res) {
  echo 'you guessed right!';
});

Router::get('/user', function ($req, $res) {
  echo 'user index';
});

Router::get('/user/:userId', ['correctUser'], function ($req, $res) {
  echo 'user details from ' . $req->params['userId'];
});


Router::get('/posts', function ($req, $res) {
  echo 'post index';
});

Router::any('404', function ($req, $res) {
  echo '404';
});
