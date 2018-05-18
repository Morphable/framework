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

$router = new Router();

$router->get('/user', function (Request $req, Response $res) {
    # user index
});

$router->get('/user/s:username', function (Request $req, Response $res) {
    # user detail by username
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
