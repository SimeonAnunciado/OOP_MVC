<?php

use src\Template;
use src\DatabaseConnection;
use modules\page\controllers\PageController;
use modules\dashboard\admin\controllers\DashboardController;

use modules\page\admin\controllers\PageController as AdminPageController;


session_start();

// SET THE PATH ABSOLUTE ITS RESOLVE PROBLEM WHEN THE PROJECT ARE SET INTO LIVE HOST OR DOMAIN IN UBUNTU OR MAC
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH  . 'view' .  DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', ROOT_PATH . 'controller' .  DIRECTORY_SEPARATOR);

define('MODULE_PATH', ROOT_PATH. 'modules' .  DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT','abcdefghijk123');

spl_autoload_register(function($file){

    $file = ROOT_PATH . str_replace('\\', '/', $file) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }


    // if(file_exists(ROOT_PATH .'src/'. $file. '.php')){
    //     require_once ROOT_PATH . 'src/'. $file. '.php';
    // }
    // if(file_exists( MODULE_PATH . 'page/models/'.$file.'.php')){
    //     require_once MODULE_PATH . 'page/models/'.$file.'.php';
    // }
    // if(file_exists( MODULE_PATH . 'user/models/'.$file.'.php')){
    //     require_once MODULE_PATH . 'user/models/'.$file.'.php';
    // }
});
/*
require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once ROOT_PATH . 'src/Validation.php';
//  validation
require_once ROOT_PATH . 'src/interfaces/ValidationRuleInterface.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMaximum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMinimum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateEmail.php';
require_once ROOT_PATH . 'src/validationRules/ValidateSpecialCharacter.php';
//  validation
require_once MODULE_PATH . 'page/models/Page.php';
require_once MODULE_PATH . 'user/models/User.php';
// helpers
*/
require_once ROOT_PATH . 'src/Helpers.php';



DatabaseConnection::connect('localhost', 'oopmvc', 'root', '');
DatabaseConnection::getInstance();

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ( $module == 'dashboard') {
    // include MODULE_PATH . '/dashboard/admin/controllers/DashboardController.php';
    $controller = new DashboardController(DatabaseConnection::getConnection());
    $controller->layout = new Template('admin/layout/default');
    $controller->runAction($action);

} elseif( $module == 'page'){
    // include MODULE_PATH . '/page/admin/controllers/PageController.php';
    $controller = new AdminPageController(DatabaseConnection::getConnection());
    $controller->layout = new Template('admin/layout/default');
    $controller->runAction($action);

}
