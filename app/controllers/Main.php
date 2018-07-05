<?php

namespace app\controllers;

class Main extends App {

    public $layout='main';

    public function indexAction()
    {
//        $this->layout=false;
//        $this->view='test';
        $name='Андрей';
        $this->set(compact('name'));
    }

}