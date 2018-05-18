<?php

namespace Morphable\Routing;

use Morphable\Helper;
use Morphable\Http\Request;
use Morphable\Http\Response;

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
     * @var object Morphable\Http\Request
     */
    private $request = null;

    /**
     * @var object Morphable\Http\Response
     */
    private $response = null;

    /**
     * @var string
     */
    private $pattern = null;

    /**
     * @var array
     */
    private $options = [
        'n:' => "[0-9]{1,}", // numbers only
        's:' => "[a-z]{1,}", // letters only
        ':' => "[a-z0-9]{1,}" // numbers and letters
    ];

    /**
     * @var array
     */
    private $vars;

    /**
     * @param string
     * @param string
     */
    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = self::normalizePath($path);
        $this->callback = $callback;
        $this->init();
    }

    /**
     * Get route pattern
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Execute this route
     * @return void
     */
    public function exec()
    {
        $this->setReqRes();

        foreach ($this->middlewares as $mw)
        {
            $mw($this->request, $this->response);
        }

        $cb = $this->callback;
        $cb($this->request, $this->response);
    }

    public function setReqRes()
    {
        $this->request = new Request();
        $this->setVars();
        $this->request->setParams($this->vars);
        $this->response = new Response();
    }

    /**
     * Set or add middleware
     * @param mixed
     * @return self
     */
    public function setMiddleware($mw)
    {
        if (is_array($mw))
        {
            $this->middlewares = array_merge($this->middlewares, $mw);
        }
        else
        {
            $this->middlewares[] = $mw;
        }

        return $this;
    }

    /**
     * Prepare this instance
     * @return self
     */
    public function init()
    {
        $this->setParams();
        $this->generatePattern();

        return $this;
    }

    /**
     * Make sure the path starts with a slash and does not end with a slash
     * @param string
     * @return string
     */
    public static function normalizePath($path)
    {
        $path = trim($path, '/');
        $path = '/' . $path;

        return $path;
    }

    public function setVars()
    {
        preg_match_all("/\/([a-z0-9]|:)*/", $this->normalizePath($this->request->url), $params);
        
        $params = $params[0];
        $index = 0;
        foreach ($this->vars as $key => $value)
        {
            $this->vars[$key] = str_replace('/', '', $params[$index]);
            $index++;
        }
    }

    /**
     * Get the parameters from path and set
     * @return self
     */
    public function setParams()
    {
        preg_match_all("/\/([a-z0-9]|:|\**)*/m", $this->path, $params);
        $this->params = $params[0];
        return $this;
    }

    /**
     * Generate pattern for this route
     * @return string
     */
    public function generatePattern()
    {
        $patterns = [];
        $vars = [];
        foreach ($this->params as $key => $path)
        {
            $path = ltrim($path, '/');
            $found = false;
            foreach ($this->options as $placeholder => $part)
            {
                // Check if path has prefix
                if (helper::str_starts_with($path, $placeholder))
                {
                    $vars[str_replace($placeholder, "", $path)] = null;
                    $patterns[] = "\/{$part}";
                    $found = true;
                    break;
                }
            }

            // use path name if no prefix
            if (!$found)
            {
                $vars[$path] = null;
                $patterns[] = "\/{$path}";
            }
        }

        $this->vars = $vars;
        $this->pattern = implode($patterns);
    }

}
