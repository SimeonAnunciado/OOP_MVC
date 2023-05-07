<?php

class Test{
    public $fields = [
        'name',
        'age',
        'gender',
    ];


    public function set(){

    }

    public function get($name){
        return $this->fields[0];
    }
}

$test = new Test();
$res = $test->get('name');

var_dump($res);