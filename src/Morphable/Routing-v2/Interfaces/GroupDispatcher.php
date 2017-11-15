<?php

namespace Morphable\Routing\Interfaces;

interface GroupDispatcher {

  public function __construct ($dispatcher, $group);

  public function dispatch ();

}
