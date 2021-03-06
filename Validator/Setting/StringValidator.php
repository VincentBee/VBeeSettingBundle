<?php

namespace VBee\SettingBundle\Validator\Setting;

use VBee\SettingBundle\Validator\Constraints\SettingValueValidatorInterface;

class StringValidator implements SettingValueValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        $matches = array();
        preg_match('/^(.+)$/', $value, $matches);
        if (isset($matches[0])) {
            return true;
        }
        return false;
    }

    public function getName()
    {
        return 'str';
    }
}