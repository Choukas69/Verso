<?php

namespace VFram\Routing;

use VFram\Utils\Exceptions\NoRouteFoundException;

class Router
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    public function addRoute(Route $route): void
    {
        if (!in_array($route, $this->routes))
            $this->routes[] = $route;
    }

    public function getRoute(String $url): Route
    {
        foreach ($this->routes as $route) {
            if (($varsValues = $route->match($url))) {
                if ($route->hasVars()) {
                    $varsNames = $route->getVarsNames();
                    $vars = [];

                    for ($i = 1; $i <= count($varsNames); $i++) {
                        $vars[$varsNames[$i - 1]] = $varsValues[$i];
                    }

                    $route->setVars($vars);
                }

                return $route;
            }
        }

        throw new NoRouteFoundException($url);
    }
}