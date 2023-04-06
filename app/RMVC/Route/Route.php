<?php

namespace App\RMVC\Route;

class Route
{
    private static array $rotesGet = [];
    private static array $rotesPost = [];

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$rotesGet;
    }

    public static function getRoutesPost(): array
    {
        return self::$rotesPost;
    }

    public static function get(string $route, array $controller):RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$rotesGet[] = $routeConfiguration;

        return $routeConfiguration;

    }

    public static function post(string $route, array $controller):RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$rotesPost[] = $routeConfiguration;

        return $routeConfiguration;

    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}