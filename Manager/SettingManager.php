<?php

namespace VBee\SettingBundle\Manager;

use Doctrine\ORM\EntityManager;
use VBee\SettingBundle\Entity\Setting;

class SettingManager
{
    /**
     * @var \VBee\SettingBundle\Entity\Repository\SettingRepository
     */
    protected $repository;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository('VBeeSettingBundle:Setting');
    }

    /**
     * @param String $name
     * @return mixed
     */
    public function get($name)
    {
        $setting = $this->repository->getSettingByName($name);
        if($setting instanceof Setting){
            return $setting->getValue();
        }
        return null;
    }
}