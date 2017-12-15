<?php

namespace Morphable\Routing\Interfaces;

/**
 * This class executes, handles and validates
 * a single route, also it executes the
 * middleware.
 */
interface RouteDispatcher {
  
  /**
   * Constructor
   * @param Array objectParams
   * @param Array route
   * @return self
   */
  public function __construct ($requestParams, $route);
  
  /**
   * Explode route
   * @return Array
   */
  public function routeToParams ();

  /**
   * Check exists index of request url
   * @param int key
   * @return String
   */
  public function setValueParam ($key);

  /**
   * Check if request url is longer than route
   * @return Boolean
   */
  public function requestUrlTooLong ();

  /**
   * Build array to easily check if route matches
   * And to easily get parameters
   * @return Array
   */
  public function buildMatchParams ();

  /**
   * Get array of set parameters
   * @return Array
   */
  public function getParams ();

  /**
   * Execute route if match
   * @param Method handler
   * @return void
   */
  public function dispatch ($handler);

  /**
   * Check if route matches with request url
   * @return Boolean
   */
  public function match ();

  /**
   * Execute middleware of the route
   * @param Request req
   * @param Response res
   * @return void
   */
  public function executeMiddleware ($req, $res);

}
