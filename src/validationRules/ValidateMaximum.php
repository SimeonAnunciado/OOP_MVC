<?php

namespace src\validationRules;

use src\interfaces\ValidationRuleInterface;

class ValidateMaximum implements ValidationRuleInterface{

    private $maximum;

    public function __construct($maximum){
        $this->maximum = $maximum;
    }

    public function validateRules($value){
        if(strlen($value) > $this->maximum){
            return false;
        }

        return true;
    }


    public function getErrorMessage(){
        return "validate maximum error should be " . $this->maximum;
    }
}