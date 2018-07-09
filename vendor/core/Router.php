<?php

namespace vendor\core;

class Router
{

//    public function __construct() {
//        echo 'привет мир';
//    }

    //таблица маршрутов
    protected static $routes = [];

    //текущий маршрут
    protected static $route = [];

    //добавляет маршрут в таблицу
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    //возвращает таблицу маршрутов
    public static function getRoutes()
    {
        return self::$routes;
    }


    //возвращает текущий маршрут
    public static function getRoute()
    {
        return self::$route;
    }

    //находит url в таблице маршрутов
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = "index";
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //Перенаправляет url по конкретному маршруту
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $controllerObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action'] . 'Action');

                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else {
                    echo "Метод $action не найден";
                }

            } else {
                echo "Контроллер $controller не найден";
            }

        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    //Возвращает строку в upperCamelCase
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    //Возвращает строку в lowerCamelCase
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}