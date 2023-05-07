<?php
namespace src;

final class DatabaseConnection {

    private static $instance = null;
    public static $count = 0; // checker

    private static $connection;


    private function __construct()
    {

    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new DatabaseConnection;
            // self::$count++;
        }
        return self::$instance;
    }

    public static function connect($servername,$dbName, $username,$password){
        self::$connection = new \PDO("mysql:host=$servername;dbname=".$dbName, $username, $password);
        // set the PDO error mode to exception
        self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    public static function getConnection(){
        return self::$connection;
    }

    public static function getCount(){
        // check the total instance
        return self::$count;
    }


    private function __clone(){}

    public function __wakeup(){ }

}

// init connection
// $connect = DatabaseConnection::connect('localhost','oopmvc','root','');


// $getInstance = DatabaseConnection::getInstance();
// $con = DatabaseConnection::getCount();

// $getInstance = DatabaseConnection::getInstance();
// $con2 = DatabaseConnection::getCount();

// $getInstance = DatabaseConnection::getInstance();
// $con3 = DatabaseConnection::getCount();
