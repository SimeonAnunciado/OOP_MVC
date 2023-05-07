<?php
namespace src\interfaces;

interface ValidationRuleInterface{

    public function validateRules($value);
    public function getErrorMessage();

}