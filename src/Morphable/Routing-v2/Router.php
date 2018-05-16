<?php

namespace Morphable\Routing;

class Router {

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var object
     */
    private $config;

    /**
     * @param object
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

}
