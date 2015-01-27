<?php

namespace VBee\SettingBundle\Twig;

use VBee\SettingBundle\Manager\SettingManagerInterface;

class SettingExtension extends \Twig_Extension
{
    /**
     * @var SettingManagerInterface
     */
    protected $manager;

    /**
     * @param SettingManagerInterface $manager
     */
    public function __construct(SettingManagerInterface $manager)
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