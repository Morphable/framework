<?php

namespace Morphable\Routing;

/**
 * Route related methods and properties
 */
class Route {

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $params;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @var array
     */
    private $middlewares = [];

    /**
     * @param string
     * @param string
     */
    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }

}
