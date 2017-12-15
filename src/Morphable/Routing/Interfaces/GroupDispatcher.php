<?php

namespace Morphable\Routing\Interfaces;

/**
 * The purpose of the group dispatcher
 * is to execute and prepare route
 * groups.
 */
interface GroupDispatcher {

  /**
   * Constructor
   * @param Object dispatcher
   * @param Array group
   * @return self
   */
  public function __construct ($dispatcher, $group);

  /**
   * Execute routes
   * @return void
   */
  public function dispatch ();

  /**
   * Check route is request method
   * @param Object route
   * @return Boolean
   */
  public function validateMethod ($route);

}
