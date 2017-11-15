<?php

namespace Morphable\Routing\Interfaces;

/**
 * The dispatcher is the parent of 
 * all route dispatchers.
 * It's purpose is to execute and validate
 * the created routes.
 */
interface Dispatcher {
  
  /**
   * Constructor
   * @param Array router
   * @param Object request
   * @return self
   */
  public function __construct ($router, $request);

  /**
   * Execute the routes
   * @return Void
   */
  public function dispatch ();

  /**
   * Explode request url
   * @return self
   */
  public function urlToParams ();

  /**
   * Get request url
   * @return String
   */
  public function getUrl ();

  /**
   * Get request method
   * @return String
   */
  public function getMethod ();

  /**
   * Get Exploded request url
   * @return Array
   */
  public function getParams ();

  /**
   * Set exception
   * @param Object exception
   * @return self
   */
  public function setException ($exception);

  /**
   * Get exception
   * @return Object
   */
  public function getException ();

}
