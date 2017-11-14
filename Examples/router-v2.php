<?php

use Morphable\Routing\RouterFactory as Router;
use Morphable\Routing\Middleware as Middleware;

$m1 = new Middleware('userExists', function ($req, $res) {

});

$m2 = new Middleware('userDoesNotExist', function ($req, $res) {

});

$m3 = new Middleware('userAllowed', function ($req, $res) {

});
