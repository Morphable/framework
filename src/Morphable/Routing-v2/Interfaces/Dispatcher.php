<?php

namespace Morphable\Routing\Interfaces;

interface Dispatcher {
  
  public function __construct ($router, $request);

  public function dispatch ();

  public function urlToParams ();

  public function getUrl ();

  public function getMethod ();

  public function getParams ();

}
