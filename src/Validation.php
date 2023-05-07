<?php

namespace src;

use src\interfaces\ValidationRuleInterface;
/*
implement chaining
implement OPEN CLOSE PRINCIPLE
implement interface
*/

class Validation
{
    private $rules;
    private $getAllErrorMessage = [];
    public function addRule( ValidationRuleInterface $rule){
        $this->rules[] = $rule;
        return $this;
    }

    public function validate($value){
        foreach($this->rules as $rule){
            if(!$rule->validateRules($value)){
                $this->getAllErrorMessage[] = $rule->getErrorMessage();
                return false;
            }
        }
        return true;
    }

    public function getAllErrorMessage(){
        return $this->getAllErrorMessage;
    }
}
