<?php

namespace Morphable\Routing\Interfaces;

interface RouteDispatcher {
  
  public function __construct ($route);

  public function buildRoute ();

  public function dispatch ($handler);

  public function match ();

}
