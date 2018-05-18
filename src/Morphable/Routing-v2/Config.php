<?php

namespace Morphable\Routing;

/**
 * Routing config
 */
class Config {

    /**
     * @var string
     */
    private $cache = null;

    /**
     * @var string
     */
    private $session = null;

    /**
     * @var array
     */
    private $actions = [
        'before' => [],
        'after' => [],
        'notFound' => []
    ];

    /**
     * @var string
     */
    private $log = null;

    /**
     * @param string
     * @return self
     */
    public function setCache($path)
    {
        $this->cache = $path;
        return $this;
    }

    /**
     * @param string
     * @return self
     */
    public function setSession($var)
    {
        $this->session = $var;
        return $this;
    }

    /**
     * @param string
     * @return self
     */
    public function setLog($path)
    {
        $this->log = $path;
        return $this;
    }

    /**
     * @param string
     * @param callable
     * @return self
     */
    public function setAction($action, $callback)
    {
        $this->actions[$action][] = $callback;
        return $this;
    }

    /**
     * Execute action
     * @param string action name
     * @return void
     */
    public function action($name)
    {
        foreach ($this->actions[$name] as $action)
        {
            $action();
        }
    }

}
