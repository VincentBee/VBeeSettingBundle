<?php

namespace VBee\SettingBundle\Entity\Enum;

class SettingTypeEnum
{
    const STRING        = 'str';
    const INTEGER       = 'int';

    public static function getSettingTypes()
    {
        return array(
            self::STRING            => 'setting_type.string',
            self::INTEGER           => 'setting_type.integer'
        );
    }
}