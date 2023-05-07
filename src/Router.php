<?php
namespace src;
class Router extends \src\Entity {

    public function __construct($conn)
    {
        parent::__construct($conn, 'routes');
    }

    public function initFields(){
        $this->fields = [
            'id',
            'module',
            'action',
            'entity_id',
            'pretty_url',
            'created_at'
        ];
    }



}