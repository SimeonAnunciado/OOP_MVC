<?php
namespace src\validationRules;

use src\interfaces\ValidationRuleInterface;

class ValidateSpecialCharacter implements ValidationRuleInterface{
    private $rule = "/[^a-zA-Z0-9]+/";

    public function __construct() {
        // $this->rule = $rule;
    }

    function validateRules($value) {
        if(!preg_match($this->rule, $value)){
            return false;
        }
        return true;
    }

    public function getErrorMessage(){
        return "vaildate special character error" ;
    }

}