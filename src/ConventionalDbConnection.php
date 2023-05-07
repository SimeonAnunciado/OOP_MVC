<?php
namespace src;


class ConventionalDbConnection {
    public $conn;
    public static $count = 0;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {

          echo 'connect '. self::$count++ .' ';
          $this->conn = new PDO("mysql:host=$servername;dbname=oopmvc", $username, $password);
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection(){

       return $this->conn;

    }
}

$conn1 = (new ConventionalDbConnection())->getConnection();
var_dump($conn1);

$conn2 = (new ConventionalDbConnection())->getConnection();
var_dump($conn2);

$conn3 = (new ConventionalDbConnection())->getConnection();
var_dump($conn3);

$conn3 = (new ConventionalDbConnection())->getConnection();
var_dump($conn3);