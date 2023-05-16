<?php
namespace modules\dashboard\admin\controllers;
use src\Auth;
use src\Validation;
use src\validationRules\ValidateEmail;
use src\validationRules\ValidateMaximum;
use src\validationRules\ValidateMinimum;

class DashboardController extends \src\controller{

    public function runBeforeAction(){

        if($_SESSION['is_admin'] ?? false == true){
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

        if($action != 'login'){
            header('Location: /admin/index.php?module=dashboard&action=login');
        }

        return true;
    }

    public function defaultAction(){
        #echo 'welcome to admin';
        # die();
        #$variables = [];

        $data = [
            'title' => 'Welcome to admin',
            'content' => ''
        ];

        $this->layout->view('page/views/static-page', $data);
        // include_once VIEW_PATH . 'admin/login.php';
    }

    public function loginAction(){
        if($_POST['postAction'] ?? 0 == 1 ){
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $validate = new Validation();

            if(!$validate
                ->addRule(new ValidateMinimum(6))
                ->addRule(new ValidateMaximum(20))
                // ->addRule(new ValidateSpecialCharacter())
                ->validate($password)){

                $_SESSION['validationRules']['errors'] = $validate->getAllErrorMessage();
            }

            if(!$validate
                ->addRule(new ValidateEmail())
                ->validate($username)){
                $_SESSION['validationRules']['errors'] =  $validate->getAllErrorMessage();
            }

            if(($_SESSION['validationRules']['errors'] ?? '') == ''){
                // check if theres no session errors
                #$res = (new Auth)->checkLogin($username, $password);
                #print_r($res,true);
                if((new Auth)->checkLogin($username, $password) ){
                    $_SESSION['is_admin'] = 1;
                    header('location: /admin/index.php?module=page');
                }else{
                    $_SESSION['validationRules']['errors'] = $validate->getAllErrorMessage();
                    // echo '<pre>'. print_r($validate->getAllErrorMessage(),true);
                }
            }
        }

        include_once VIEW_PATH . 'admin/login.php';
        // remove session after reload
        unset($_SESSION['validationRules']['errors']);

    }

    public function logoutAction(){
        session_destroy();
        unset ($_SESSION["is_admin"]);
        header('Location: /admin/index.php?module=dashboard&action=login');
    }

    public function changepasswordAction(){
        return 'change password';
    }




}