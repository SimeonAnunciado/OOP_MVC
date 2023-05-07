<?php
namespace src;
class Controller {

    public $layout;
    public $entityId;

    public $dbc;

    // protected $template

    public function __construct($dbc)
    {
        $this->dbc = $dbc;
    }

    public function runAction($actionName){

        if(method_exists($this, 'runBeforeAction')){
            if($this->runBeforeAction() == false ){
                return; // stop the script from execution
            }
        }

        $actionName .="Action";

        if(method_exists($this,$actionName)){
            $this->$actionName();
        }else{
            include VIEW_PATH.'status-pages/404.html';
        }

    }

    public function setEntityId($entityId){
        $this->entityId = $entityId;
    }

}