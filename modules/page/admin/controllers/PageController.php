<?php
namespace modules\page\admin\controllers;
use modules\page\models\Page;

class PageController extends \src\controller{

    public function runBeforeAction(){

        if($_SESSION['is_admin'] ?? false == true){
            return true;
        }
        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

        if($action != 'login' ){

            header('Location: /admin/index.php?module=dashboard&action=login');
        }

        return true;
    }

    public function defaultAction(){
        $page = new Page($this->dbc);
        $data = $page->findAll();
        $data['pages'] = $data;

        $this->layout->view('page/admin/views/page-list', $data);
    }

    public function contactAction(){
        $data = [];
        $this->layout->view('page/admin/views/contact', $data);
    }

    public function editPageAction(){
        $id = $_GET['id'] ?? null;
        $pageObject = new Page($this->dbc);
        $data['data'] =   $pageObject->findBy('id', $id);
        $this->layout->view('page/admin/views/page-edit', $data);
    }

    public function updateAction(){
        if(isset($_POST['submit'])){
            die('submit');
           $page_id = $_POST['page_id'] ?? null;

           echo $page_id . 'submit';

        }
        /*
        $id = $_GET['id'] ?? null;
        $pageObject = new Page(DatabaseConnection::getConnection());
        $data['data'] =   $pageObject->findBy('id', $id);
        $this->layout->view('page/admin/views/page-edit', $data);
        */
    }



    public function listAction(){
        // return 'list action';
        // echo 'list ';
        // $data = [];
        // $this->layout->view('page/admin/views/page-list', $data);


        #die();
        // $data = [];
        // $this->layout->view('page/admin/views/page-list', $data);
    }


}