<?php

namespace Morphable\Routing;

class RouterFactory implements RouterInterface {

  public static $groups = [];  

  public function __construct () {
    RouterFactory::$groups[] = $this;
  }

  public function getRouter () {
    return new Router();
  }

  public function prefix ($prefix, $callback) {

  }

  public function middleware ($middleware, $callback) {

  }

  public function addRoute ($method, $route, $middleware, $callback) {

  }

  public function get ($route, $middleware, $callback = null) {

  }

  public function post ($route, $middleware, $callback = null) {

  }

  public function put ($route, $middleware, $callback = null) {

  }

  public function patch ($route, $middleware, $callback = null) {

  }

  public function delete ($route, $middleware, $callback = null) {

  }

  public function option ($route, $middleware, $callback = null) {

  }

  public function any ($route, $middleware, $callback = null) {

  }

  public function getRoutes () {

  }

  public function getMiddleware () {

  }

  public function getGroups () {
    return RouterFactory::$groups;
  }

  public function getPrefix () {

  }

}
