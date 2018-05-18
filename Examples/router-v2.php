<?php

use Morphable\Routing\Router;
use Morphable\Routing\Controller;

class UserController extends Controller {

  

}

$router = new Router();

$router->get("/user", function ($req, $res) {
    echo "user index";
});

$router->get("/user/s:username", function ($req, $res) {
    echo "user detail";
});

$router->get('/user/s:username/posts', function ($req, $res) {
    echo 'user posts';
});

$router->get('/user/s:username/posts/s:postSlug', function ($req, $res) {
    echo 'user post detail';
});

$router->post('/user', function ($req, $res) {
    echo 'new user';
});

$router->put('/user/s:username', function ($req, $res) {
    echo 'edit user';
});

$router->dispatch();
