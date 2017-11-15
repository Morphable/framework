<?php

namespace Morphable\Routing\Interfaces;

interface Route {

  /**
   * Set the parameters
   * @param String method
   * @param String route
   * @param Array middleware
   * @return self
   */
  public function __construct ($method, $route, $middleware);

  /**
   * Add additional middleware
   * @param Array middleware
   * @return self
   */
  public function middleware ($middleware);

  /**
   * Return all parameters
   * @return Array
   */
  public function get ();

  /**
   * Get route method
   * @return String
   */
  public function getMethod ();

  /**
   * Get the route
   * @return String
   */
  public function getRoute ();

  /**
   * Get the middleware
   * @return Array
   */
  public function getMiddleware ();

}
