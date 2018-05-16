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

$router->get("/user/s:username/n:pageCount/", function ($req, $res) {
    echo "user detail";
});

$router->logRoutes();
