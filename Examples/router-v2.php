<?php

use Morphable\Routing\RouterFactory as Router;
use Morphable\Routing\Middleware as Middleware;

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

?>

<pre>
  <?= 
var_dump(Router::getGroups());
  
  ?>
</pre>

<?php


