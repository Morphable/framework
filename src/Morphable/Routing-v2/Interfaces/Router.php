<?php

namespace Morphable\Routing\Interfaces;

interface Router {

  /**
   * Add a route to current group
   * @param String method
   * @param String route
   * @param Array middleware
   * @param Callable callback
   * @return Route
   */
  public function addRoute ($method, $route, $middleware, $callback);

  /**
   * Overwrite the middleware from group
   * @param Array middleware
   * @return Self
   */
  public function setMiddleware ($middleware);

  /**
   * Add middleware to group
   * @param Array middleware
   * @return Self
   */
  public function addMiddleware ($middleware);

  /**
   * Overwrite the prefix from the group
   * @param String prefix
   * @return Self
   */
  public function setPrefix ($prefix);

  /**
   * Add prefix to the all existing prefix
   * @param String prefix
   * @return Self
   */
  public function addPrefix ($prefix);

}
