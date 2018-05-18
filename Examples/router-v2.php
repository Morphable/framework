<?php

use Morphable\Routing\Router;

$router = new Router();

$router->get("/user", function ($req, $res) {
    echo 'user index</br>';
});

$router->get("/user/s:username", function ($req, $res) {
    echo "user detail</br>";
})
->setMiddleware(function($req, $res) {
    if ($req->params['username'] != 'kobus')
    {
        die('Youre not allowed');
    }
});

$router->get('/user/s:username/posts', function ($req, $res) {
    echo 'user posts</br>';
});

$router->get('/user/s:username/posts/s:postSlug', function ($req, $res) {
    echo 'user post detail</br>';
});

$router->post('/user', function ($req, $res) {
    echo 'new user</br>';
});

$router->put('/user/s:username', function ($req, $res) {
    echo 'edit user</br>';
});

$router->on('before', function ($req, $res) {
    echo 'Before route</br>';
});

$router->on('after', function ($req, $res) {
    echo 'after route</br>';
});

$router->on('notFound', function () {
    echo '404 Not found</br>';
});

$router->dispatch();
