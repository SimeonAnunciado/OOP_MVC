<?php
namespace modules\page\models;

class Page extends \src\Entity{
    public function __construct($conn)
    {
        parent::__construct($conn, 'pages');
    }

    public function initFields(){
        $this->fields = [
            'id',
            'title',
            'content',
            'created_at'
        ];
    }
}