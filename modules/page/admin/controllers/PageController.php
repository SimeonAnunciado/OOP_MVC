<?php

namespace modules\page\admin\controllers;

use modules\page\models\Page;

class PageController extends \src\controller
{

    public function runBeforeAction()
    {

        if ($_SESSION['is_admin'] ?? false == true) {
            return true;
        }
        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

        if ($action != 'login') {

            header('Location: /admin/index.php?module=dashboard&action=login');
        }

        return true;
    }

    public function defaultAction()
    {
        $page = new Page($this->dbc);
        $data = $page->findAll();
        $data['pages'] = $data;

        $this->layout->view('page/admin/views/page-list', $data);
    }

    public function contactAction()
    {
        $data = [];
        $this->layout->view('page/admin/views/contact', $data);
    }

    public function editPageAction()
    {

        $id = $_GET['id'] ?? null;
        $pageObject = new Page($this->dbc);
        $data['data'] =   $pageObject->findBy('id', $id);

        if (isset($_POST['submit'])) {
            $formData = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'id' => $_POST['id'],
            ];

            if ($pageObject->save($formData)) {
                header('Location: /admin/index.php?module=page');
            }
        }
        $this->layout->view('page/admin/views/page-edit', $data);
    }

    public function deleteAction()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $pageObject = new Page($this->dbc);
        if ($pageObject->delete($id)) {
            header('Location: /admin/index.php?module=page');
        }
    }



    public function listAction()
    {
        // return 'list action';
        // echo 'list ';
        // $data = [];
        // $this->layout->view('page/admin/views/page-list', $data);


        #die();
        // $data = [];
        // $this->layout->view('page/admin/views/page-list', $data);
    }
}
