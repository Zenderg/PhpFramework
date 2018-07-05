<?php

namespace app\controllers;

class Page extends App
{

    public function viewAction()
    {
        print_r($this->route);
        echo 'Page::view';
    }

}