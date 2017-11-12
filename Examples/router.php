<?php

use Morphable\Routing\Router;
use Morphable\Routing\RouteBuilder;


?>

<pre>

<?= 
var_dump(RouteBuilder::buildParams($_SERVER['REQUEST_URI'], '/user/:userId/post/:postId/'));

?>

</pre>

<?php




die;

Router::middleware('name', function ($req, $res, $next) {
  if (true) {
    $next();
  } else {
    echo 'booooo';
  }
});

Router::get('/user/:userId', function ($req, $res) {
  echo 'user details';
});

$r = Router::get('/user', ['name'], function ($req, $res) {
  // echo 'user index';
});

Router::get('/posts', function ($req, $res) {
  // echo 'post index';
});

Router::any('*', function ($req, $res) {
  echo '404';
});

Router::runMiddleware('name', $r, function () {
  echo 'yeah!';
});
