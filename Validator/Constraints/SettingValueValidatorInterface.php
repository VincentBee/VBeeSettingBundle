<?php

namespace VBee\SettingBundle\Validator\Constraints;

/**
 * Interface SettingValueValidatorInterface
 * @package VBee\SettingBundle\Entity\Validator
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