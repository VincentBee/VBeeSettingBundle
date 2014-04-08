<?php

namespace VBee\SettingBundle\Validator\Constraints;

class DateValidator implements SettingValueValidatorInterface
{
    /**
     * Check if the setting is a Date ISO 8601 "2004-02-12T15:19:21+0000"
     *
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        $timestamp = strtotime($value);
        $date = date('Y-m-d\TH:i:s', $timestamp);
        return ($date === $value);
    }

    public function getName()
    {
        return 'date';
    }
}