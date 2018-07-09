<?php

namespace vendor\core\base;

abstract class Controller
{

    public $route = [];
    public $view;
    public $layout;

//пользовательские данные
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view);
        $viewObject->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }

}