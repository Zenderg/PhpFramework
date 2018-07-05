<?php

namespace app\controllers;

class PageController extends AppController
{

    public function viewAction()
    {
        print_r($this->route);
        echo 'Page::view';
    }

}