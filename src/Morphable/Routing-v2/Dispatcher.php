<?php

namespace Morphable\Routing;

class Dispatcher {

    /**
     * @var array
     */
    private $status;

    /**
     * @param object
     */
    public static function router($router)
    {
        foreach ($router->getRoutes($_SERVER['REQUEST_METHOD']) as $route)
        {
            if(self::route($route))
            {
                $route->exec();
                die;
            }
        }
    }

    /**
     * @param object
     */
    public static function route($route)
    {
        preg_match("/^" . $route->getPattern() . "$/", Route::normalizePath($_SERVER['PATH_INFO']), $matches);
        return count($matches) > 0;
    }

}
