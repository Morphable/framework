<?php

namespace Morphable\Routing\Interfaces;

interface RouteDispatcher {
  
  public function __construct ($requestParams, $route);

  public function requestUrlTooLong ();

  public function setValueParam ($key);

  public function buildMatchParams ();

  public function routeToParams ();

  public function dispatch ($handler);

  public function match ();

}
