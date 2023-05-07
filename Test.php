<?php

class db{
    private static $connection;

    private static $instance = null;

    public function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new Database;
        }

        return self::$instance;
    }
}