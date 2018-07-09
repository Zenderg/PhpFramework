<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{

    public $layout = 'main';

    public function indexAction()
    {
        $model = new Main();
        $posts = $model->findAll();
        $data = $model->findBySql("SHOW databases");
        print_r($data);
        $this->set(compact('posts'));
    }

}