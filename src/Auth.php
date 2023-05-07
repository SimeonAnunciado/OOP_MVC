<?php
namespace src;
use src\DatabaseConnection;
use modules\user\models\User;

class Auth
{

    public function checkLogin($username, $password)
    {
        $user = new User(DatabaseConnection::getConnection());
        $user->findBy('username', $username);

        if (property_exists($user, 'id') && password_verify($password, $user->password)) {
            return true;
        }
    }


    public function changePassword($userObj, $newPassword)
    {
        $userObj->password = password_hash($newPassword, PASSWORD_DEFAULT);
        return $userObj;
    }
}
