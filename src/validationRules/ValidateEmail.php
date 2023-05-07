<?php
namespace src\validationRules;
use src\interfaces\ValidationRuleInterface;

class ValidateEmail implements ValidationRuleInterface{


    public function validateRules($value){
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }


    public function getErrorMessage(){

        return "email invalid ";

    }
}