<?php

namespace app\RMVC\Route;

class RouteDispatcher
{
    private string $requestUri = '/';
    private array $paramMap = [];
    private array $paramRequestMap = [];
    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process()
    {
        //Обработка строки запроса:
        //1. Если строка запроса есть, значит чистим ее от слешей и сохраняем.
        //1.1. Чистим строку роута.
        $this->saveRequestUri();
        //2. Разбиваем строку роута на массив и сохраняем в новый массив позицию параметра и его название.
        $this->setParamMap();
        //3. Разбиваем строку запроса на массив и проверяем есть ли в этом массиве позиция, как у позиции параметра.
        //3.1. Если есть такая позиция, значит приводим строку запроса в регулярное выражение.
        $this->makeRegexRequest();
        //4. Запускаем контроллер и экшн
        $this->run();
    }

    private function saveRequestUri()
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
        }

    }

    private function clean($str): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    public function setParamMap()
    {
        $routeArray = explode('/', $this->routeConfiguration->route);
        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(})$/', '', $param);
            }
        }

    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);
        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();

    }

    public function prepareRegex()
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run()
    {
        if (preg_match("/$this->requestUri/", $this->routeConfiguration->route)) {
            $this->render();

        }
    }

    private function render()
    {
        $className = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;
        print_r ((new $className)->$action(...$this->paramRequestMap));
//        echo '<pre>';
//        var_dump((new $className)->$action());
//        echo '<pre>';
        die();
    }
}