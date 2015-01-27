<?php

namespace VBee\SettingBundle\Manager;

use VBee\SettingBundle\Enum\SettingTypeEnum;
use VBee\SettingBundle\Model\Setting;

interface SettingManagerInterface
{
    /**
     * @return array|\VBee\SettingBundle\Entity\Setting[]
     */
    public function all();

    /**
     * @param $name
     * @param null $default
     * @return null|string
     */
    public function get($name, $default = null);

    /**
     * @param $name
     * @param $value
     * @param null $type
     * @throws \Exception
     */
    public function set($name, $value, $type = null);

    /**
     * @param $name
     * @param $type
     * @param string $value
     * @return Setting
     * @throws \Exception
     */
    public function create($name, $value = '', $type = SettingTypeEnum::STRING);

    /**
     * Remove a selected setting from database
     *
     * @param $name
     * @throws \Exception
     */
    public function remove($name);

    /**
     * Remove all setting from database
     */
    public function purge();

    public function getSettingById($id);
    public function createSetting(Setting $setting);
    public function updateSetting(Setting $setting);
    public function removeSetting(Setting $setting);
}