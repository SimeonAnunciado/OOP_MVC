<?php

namespace modules\page\controllers;

use modules\page\models\Page;

class PageController extends \src\Controller{

    public function defaultAction(){
        $page = new Page($this->dbc);
        $page->findBy('id', $this->entityId);
        $data['data'] = $page;
        #echo '<pre>'.print_r($data,true).'</pre>';
        #die();
        $this->layout->view('page/views/home-page', $data);
    }


}

