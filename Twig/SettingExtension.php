<?php

namespace VBee\SettingBundle\Twig;

use VBee\SettingBundle\Entity\Setting;
use VBee\SettingBundle\Manager\SettingManager;

class SettingExtension extends \Twig_Extension
{
    /**
     * @var SettingManager
     */
    protected $manager;

    /**
     * @param SettingManager $manager
     */
    public function __construct(SettingManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'getSetting' => new \Twig_Function_Method($this, 'getSetting', array()),
        );
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array();
    }

    /**
     * @param $name
     * @param null $default
     * @return null|string
     */
    public function getSetting($name, $default = null)
    {
        return $this->manager->get($name, $default);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_extension';
    }
}