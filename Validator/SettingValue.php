<?php

namespace VBee\SettingBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class SettingValue
 * @package VBee\SettingBundle\Validator\Constraints
 */
class SettingValue extends Constraint
{
    public function validatedBy()
    {
        return 'setting_value';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}