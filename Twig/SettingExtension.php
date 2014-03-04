<?php

namespace VBee\SettingBundle\Twig;

use VBee\SettingBundle\Manager\SettingManager;

class SettingExtension extends \Twig_Extension
{
    /**
     * @var \VBee\SettingBundle\Manager\SettingManager
     */
    protected $manager;

    public function __construct(SettingManager $manager)
    {
        $this->manager = $manager;
    }

    public function getFunctions()
    {
        return array(
            'getSetting' => new \Twig_Function_Method($this, 'getSetting', array()),
        );
    }

    public function getFilters()
    {
        return array();
    }

    public function getSetting($name)
    {
        return $this->manager->get($name);
    }

    public function getName()
    {
        return 'setting_extension';
    }
}