<?php

namespace Morphable\Routing;

class Group extends RouterFactory {

  public function __construct ($parent = null, $middleware = null, $prefix = null, $callback = null) {
    $this->type = 'Group';

    $this->extend($parent, $middleware, $prefix);
    
    if ($callback != null) {
      $callback($this);
    }

    return $this;
  }

  public function extend ($parent, $middleware, $prefix) {
    if ($parent != null) {
      $this->setPrefix($parent->prefix);
      $this->setMiddleware($parent->getMiddleware());
    }

    if ($prefix != null) {
      $this->addPrefix($prefix);
    }

    if ($middleware != null) {
      $this->addMiddleware($middleware);
    }
  }

}
