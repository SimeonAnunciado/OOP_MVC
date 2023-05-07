<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once 'src/interfaces/ValidationRuleInterface.php';
require_once 'src/Validation.php';
require_once 'src/ValidationRules/ValidateEmail.php';

final class ValidationTest extends TestCase
{
    public function testValidationEmail(): void
    {
        $valiidation = new Validation();
        $valiidation->addRule(new ValidateEmail());

        // $this->assertFalse($valiidation->validate('12312312'));
        $this->assertTrue($valiidation->validate('test@gmail.com'));
    }

}



