<?php
session_start();

// SET THE PATH ABSOLUTE ITS RESOLVE PROBLEM WHEN THE PROJECT ARE SET INTO LIVE HOST OR DOMAIN IN UBUNTU OR MAC
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH  . 'view' .  DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', ROOT_PATH . 'controller' .  DIRECTORY_SEPARATOR);

define('MODULE_PATH', ROOT_PATH. 'modules' .  DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT','abcdefghijk123');

require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once MODULE_PATH . 'user/models/User.php';



DatabaseConnection::connect('localhost', 'oopmvc', 'root', '');
DatabaseConnection::getInstance();



$userObj = new User(DatabaseConnection::getConnection());
$userObj->findBy('username', 'admin@gmail.com');


$auth = new Auth();
$changePassword = $auth->changePassword($userObj, 'password');

echo '<pre>'.print_r($changePassword, true) .'</pre>';
