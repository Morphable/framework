<?php

namespace Morphable\Http\Interfaces;

/**
 * The purpose of the request class
 * is to easily share a request
 * between the routes, middleware and
 * controllers if neccesairy.
 */
interface Request {

  /**
   * Constructor
   * @return self
   */
  public function __construct ();

  /**
   * Get the host
   * @return String
   */
  public function getHost ();

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
   * Get all headers
   * @return Array
   */
  public function getHeaders ();

  /**
   * Get a header by name
   * @return String
   */
  public function getHeader ($name);

  /**
   * Get all cookies
   * @return Array
   */
  public function getCookies ();

  /**
   * Get a cookie by name
   * @return String
   */
  public function getCookie ($name);

  /**
   * Set request parameters
   * @param Array params
   * @return Array
   */
  public function setParams ($params);

  /**
   * Get request parameters
   * @return Array
   */
  public function getParams ();

}
