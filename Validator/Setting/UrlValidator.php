<?php

namespace VBee\SettingBundle\Validator\Setting;

use VBee\SettingBundle\Validator\Constraints\SettingValueValidatorInterface;

class UrlValidator implements SettingValueValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
            return false;
        }
        return true;
    }

    public function getName()
    {
        return 'url';
    }
}