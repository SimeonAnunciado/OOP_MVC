<?php
namespace modules\user\models;
class User extends \src\Entity {

    public function __construct($conn)
    {
        parent::__construct($conn, 'users');
    }

    public function initFields(){
        $this->fields = [
            'id',
            'name',
            'username',
            'password',
            'password_hash',
        ];
    }



}