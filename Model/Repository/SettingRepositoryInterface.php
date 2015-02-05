<?php

namespace VBee\SettingBundle\Model\Repository;

/**
 * Interface SettingRepositoryInterface
 * @package VBee\SettingBundle\Model\Repository
 */
interface SettingRepositoryInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function getSettingByName($name);

    /**
     * @return mixed
     */
    public function getSettings();
}
