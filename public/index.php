<?php

use src\DatabaseConnection;
use src\Template;
use src\Router;
use modules\page\controllers\PageController;
use modules\page\admin\controllers\PageController as AdminPageController;



session_start();

// SET THE PATH ABSOLUTE ITS RESOLVE PROBLEM WHEN THE PROJECT ARE SET INTO LIVE HOST OR DOMAIN IN UBUNTU OR MAC
// MAIN START
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

define('VIEW_PATH', ROOT_PATH  . 'view' .  DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', ROOT_PATH . 'controller' .  DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT','abcdefghijk123');
define('MODULE_PATH', ROOT_PATH. 'modules' .  DIRECTORY_SEPARATOR);

spl_autoload_register(function($file){
    $file = ROOT_PATH . str_replace('\\', '/', $file) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }

    // if(file_exists(ROOT_PATH .'src/'.$className . '.php')){
    //     require_once ROOT_PATH . 'src/'.$className.'.php';
    // }
    // if(file_exists(MODULE_PATH .'page/models/'.$className . '.php')){
    //     require_once MODULE_PATH . 'page/models/'.$className.'.php';
    // }
});


// require_once ROOT_PATH . 'src/Controller.php';
// require_once ROOT_PATH . 'src/Template.php';
// require_once ROOT_PATH . 'src/DatabaseConnection.php';
// require_once ROOT_PATH . 'src/Entity.php';
// require_once ROOT_PATH . 'src/Router.php';
// require_once MODULE_PATH . 'page/models/Page.php';

// helpers
// require_once MODULE_PATH . 'src/Helpers.php';

DatabaseConnection::connect('localhost', 'oopmvc', 'root', '');
DatabaseConnection::getInstance();


$section = $_GET['seo_name'] ?? 'home';

$router = new Router(DatabaseConnection::getConnection());
$router->findBy('pretty_url', $section);


$action = $router->action != '' ? $router->action : 'default';
$moduleName = ucfirst(str_replace("-", "", $router->module)) . 'Controller';



$controllerFIle =  MODULE_PATH. $router->module . '/controllers/'. $moduleName.'.php';
#echo '<pre>' .print_r($router, true);
// die();

// require_once MODULE_PATH . 'page/models/Page.php';
#require_once MODULE_PATH . 'page/controllers/PageController.php';
// require_once MODULE_PATH . 'user/models/User.php';


if(file_exists($controllerFIle)){
    include $controllerFIle;
    $controller =  new PageController(DatabaseConnection::getConnection());
    # simeon added 5/2/2023
    $controller->layout = new Template('layout/default');
    # simeon added
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}else{
    include MODULE_PATH. $router->module . '/views/status-pages/404.html';
}
