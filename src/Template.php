<?php
namespace src;

class Template {

    private $layout = 'default';

    public function __construct($layout = 'default'){
        $this->layout = $layout;
    }

    public function setLayout($layout = ''){
        $this->layout = $layout;
    }

    public function view($page, $data){
        extract($data);

        if(!$this->checkIfExist($page)){
            include VIEW_PATH. '/status-pages/404.html';
            return;
        }
        # include VIEW_PATH.'layout/'.$this->layout.'.php';
        #echo VIEW_PATH.$this->layout.'.php';
        #die();
        include VIEW_PATH.$this->layout.'.php';
    }

    private function checkIfExist($page){
        // echo MODULE_PATH.$page.'.php';
        // die();
        return  file_exists(MODULE_PATH.$page.'.php') ?? false;

    }
}