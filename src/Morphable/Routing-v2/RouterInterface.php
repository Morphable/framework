<?php

namespace Morphable\Routing;

interface RouterInterface {

  public function __construct ();

  public function prefix ($prefix, $callback);

  public function middleware ($middleware, $callback);

  public function addRoute ($method, $route, $middleware, $callback);

  public function get ($route, $middleware, $callback = null);

  public function post ($route, $middleware, $callback = null);

  public function put ($route, $middleware, $callback = null);

  public function patch ($route, $middleware, $callback = null);

  public function delete ($route, $middleware, $callback = null);

  public function option ($route, $middleware, $callback = null);

  public function any ($route, $middleware, $callback = null);

  public function getRoutes ();

  public function addMiddleware ($middleware);

  public function getMiddleware ();

  static function getGroups ();

  public function addPrefix ($prefix);

  public function getPrefix ();

  public function normalizeRoute ($route);

}
