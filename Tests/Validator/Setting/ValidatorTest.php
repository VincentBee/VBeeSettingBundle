<?php

namespace VBee\SettingBundle\Tests\Validator\Setting;

use VBee\SettingBundle\Validator\Setting\DateValidator;
use VBee\SettingBundle\Validator\Setting\IntegerValidator;
use VBee\SettingBundle\Validator\Setting\PhoneValidator;
use VBee\SettingBundle\Validator\Setting\StringValidator;
use VBee\SettingBundle\Validator\Setting\UrlValidator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testString()
    {
        $validator = new StringValidator();
        $this->assertTrue($validator->validate('ok'));
        $this->assertTrue($validator->validate('&[]é"ok'));
        $this->assertTrue($validator->validate('some very long string with spaces'));
    }

    public function testInteger()
    {
        $validator = new IntegerValidator();
        $this->assertTrue($validator->validate('123'));
        $this->assertFalse($validator->validate('123.123'));
        $this->assertFalse($validator->validate('abc'));
        $this->assertFalse($validator->validate('some string with space'));
    }

    public function testDate()
    {
        $validator = new DateValidator();
        $this->assertTrue($validator->validate('2000-01-01T01:30:00'));
        $this->assertFalse($validator->validate('2000-01-01T01:30:00aaa'));
        $this->assertFalse($validator->validate('abcdefg'));
    }

    public function testUrl()
    {
        $validator = new UrlValidator();
        $this->assertTrue($validator->validate('http://www.google.com'));
        $this->assertTrue($validator->validate('https://www.google.com'));
        $this->assertTrue($validator->validate('http://toto'));
        $this->assertFalse($validator->validate('123'));
        $this->assertFalse($validator->validate('abc'));
        $this->assertFalse($validator->validate(' €"#@'));
    }

    public function testPhone()
    {
        $validator = new PhoneValidator();
        $this->assertTrue($validator->validate('0987654321'));
        $this->assertTrue($validator->validate('0123456789'));
        $this->assertFalse($validator->validate('a0123456789'));
        $this->assertFalse($validator->validate('0123456789a'));
        $this->assertFalse($validator->validate('abc'));
    }
}