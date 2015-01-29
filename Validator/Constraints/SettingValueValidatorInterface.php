<?php

namespace VBee\SettingBundle\Validator\Constraints;

/**
 * Interface SettingValueValidatorInterface
 * @package VBee\SettingBundle\Validator\Constraints
 */
interface SettingValueValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value);

    /**
     * @return string
     */
    public function getName();
}