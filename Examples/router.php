<?php

use Morphable\Routing\Router;

Router::get('/user', function ($req, $res) {
  var_dump($req->cookies);
});
