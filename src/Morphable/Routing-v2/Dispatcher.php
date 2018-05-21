<?php

namespace Morphable\Routing;

/**
 * Handles executing the router and it's routes
 */
class Dispatcher {

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
        $path = Route::normalizePath(explode('?',$_SERVER['REQUEST_URI'])[0]);
        preg_match("/^" . $route->getPattern() . "$/", $path, $matches);
        return count($matches) > 0;
    }

}
