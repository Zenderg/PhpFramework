<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController {

    public $layout='main';

    public function indexAction()
    {
        $model=new Main();
        $posts=$model->findAll();
//        $data=$model->findBySql("SELECT * FROM {$model->table} WHERE price LIKE ?", []);
//        print_r($data);
        $this->set(compact('posts'));
    }

}