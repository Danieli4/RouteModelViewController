<?php

namespace App\RMVC\Route;

class Route
{
    private static array $rotesGet = [];

    public static function get(string $route, array $controller):RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$rotesGet[] = $routeConfiguration;

        return $routeConfiguration;

    }
}