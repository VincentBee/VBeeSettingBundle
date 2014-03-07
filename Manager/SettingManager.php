<?php

namespace VBee\SettingBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator;
use VBee\SettingBundle\Entity\Enum\SettingTypeEnum;
use VBee\SettingBundle\Entity\Setting;

class SettingManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \VBee\SettingBundle\Entity\Repository\SettingRepository
     */
    protected $repository;

    /**
     * @var \Symfony\Component\Validator\Validator
     */
    protected $validator;

    /**
     * @param EntityManager $em
     * @param Validator $validator
     */
    public function __construct(EntityManager $em, Validator $validator)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('VBeeSettingBundle:Setting');
        $this->validator = $validator;
    }

    /**
     * @return array|\VBee\SettingBundle\Entity\Setting[]
     */
    public function all()
    {
        return $this->repository->getSettings();
    }

    /**
     * @param $name
     * @param null $default
     * @return null|string
     */
    public function get($name, $default = null)
    {
        $setting = $this->repository->getSettingByName($name);
        if($setting instanceof Setting){
            $value = $setting->getValue();
            if($value == null){
                return $value;
            }
        }
        return $default;
    }

    /**
     * @param $name
     * @param $value
     * @param null $type
     * @throws \Exception
     */
    public function set($name, $value, $type = null)
    {
        $setting = $this->repository->getSettingByName($name);
        if($setting instanceof Setting){
            if($type != null){
                $setting->setType($type);
            }
            $setting->setValue($value);

            $errors = $this->validator->validate($setting);
            if($errors->count() > 0){
                throw new \Exception('Invalid Setting, check at constraints validation');
            }

            $this->em->flush();
        }
    }

    /**
     * @param $name
     * @param $type
     * @param string $value
     * @return Setting
     * @throws \Exception
     */
    public function create($name, $value = '', $type = SettingTypeEnum::STRING)
    {
        $setting = new Setting();
        $setting->setName($name);
        $setting->setType($type);
        $setting->setValue($value);

        $errors = $this->validator->validate($setting);
        if($errors->count() > 0){
            throw new \Exception('Invalid Setting, check at constraints validation');
        }

        $this->em->persist($setting);
        $this->em->flush();

        return $setting;
    }

    /**
     * Remove a selected setting from database
     *
     * @param $name
     * @throws \Exception
     */
    public function remove($name)
    {
        $setting = $this->repository->getSettingByName($name);

        if($setting === null){
            throw new \Exception('Unable to find this Setting');
        }

        $this->em->remove($setting);
        $this->em->flush();
    }

    /**
     * Remove all setting from database
     */
    public function purge()
    {
        $settings = $this->repository->findAll();
        foreach($settings as $setting){
            $this->em->remove($setting);
        }
        $this->em->flush();
    }
}