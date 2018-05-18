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
                $router->getConfig()->action('before', $route);
                $route->exec();
                $router->getConfig()->action('after', $route);
                $_SESSION['framework']['previous_url'] = $route->getRequest()->fullUrl;
                die;
            }
        }

        $router->getConfig()->action('notFound');
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
