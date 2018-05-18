# Morphable Routing

## Code
```PHP
<?php
// Factory
use \Morphable\Routing\Router;

// Request
use \Morphable\Http\Request;

// Response
use \Morphable\Http\Response;

// Factory
$router = new Router();

// Before every route
$router->on('before', function ($req, $res) {
    echo 'Before route</br>';
});

// After every route
$router->on('after', function ($req, $res) {
    echo 'after route</br>';
});

// 404
$router->on('notFound', function () {
    echo '404 Not found</br>';
});

$router->get('/user', function (Request $req, Response $res) {
    # user index
});

$router->get('/user/s:username', function (Request $req, Response $res) {
    # user detail by username
})
->setMiddleware(function (Request $req, Response $res) {
    if ($req->params['username'] != 'kobus')
    {
        die('Wrong username');
    }
});

$router->get('/user/n:userId', function (Request $req, Response $res) {
    # user detail by userId
});

$router->post('/user', function (Request $req, Response $res) {
    # create user
});

$router->put('/user/n:userId', function (Request $req, Response $res) {
    # update user
});

```
