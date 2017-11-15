<?php

namespace Morphable\Routing\Interfaces;

interface RouterFactory {

  /**
   * When group extends set parent
   * else keep empty
   */
  public function __construct ();

  /**
   * Make a group with prefix
   * @param String prefix
   * @param Callable callback
   * @return Group
   */
  public function prefix ($prefix, $callback);

  /**
   * Make a group with middleware
   * @param Array middleware
   * @param Callable callback
   * @return Group
   */
  public function middleware ($middleware, $callback);

  /**
   * Add a route with method get
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function get ($route, $middleware, $callback);

  /**
   * Add a route with method get
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function post ($route, $middleware, $callback);

  /**
   * Add a route with method post
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function put ($route, $middleware, $callback);

  /**
   * Add a route with method put
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function patch ($route, $middleware, $callback);

  /**
   * Add a route with method patch
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function delete ($route, $middleware, $callback);

  /**
   * Add a route with method delete
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function option ($route, $middleware, $callback);

  /**
   * Add a route with any method
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function any ($route, $middleware, $callback);

  /**
   * Get all routes from group
   * @return Array
   */
  public function getRoutes ();

  /**
   * Get middleware from group
   * @return Array
   */
  public function getMiddleware ();

  /**
   * Get all groups
   * @return Array
   */
  static function getGroups ();

  /**
   * Get prefix from group
   * @return String
   */
  public function getPrefix ();

  /**
   * Normalize a route
   * @param String
   * @return String
   */
  public function normalizeRoute ($route);

}
