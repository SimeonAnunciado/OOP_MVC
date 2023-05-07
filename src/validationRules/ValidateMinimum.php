<?php
namespace src\validationRules;

use src\interfaces\ValidationRuleInterface;

class ValidateMinimum implements ValidationRuleInterface {

    private $minimum;

    public function __construct($minimum){
        $this->minimum = $minimum;
    }

    public function validateRules($value){
        if(strlen($value) < $this->minimum){
            return false;
        }

        return true;
    }

    public function getErrorMessage(){
        return "validate minimum error should be " . $this->minimum;
    }
}