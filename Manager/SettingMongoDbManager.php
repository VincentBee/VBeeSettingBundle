<?php

namespace VBee\SettingBundle\Manager;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Symfony\Component\Validator\Validator\RecursiveValidator as Validator;
use VBee\SettingBundle\Enum\SettingTypeEnum;
use VBee\SettingBundle\Document\Setting;
use VBee\SettingBundle\Model\Setting as SettingData;

class SettingMongoDbManager implements SettingManagerInterface
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
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
     * @param \Doctrine\Bundle\MongoDBBundle\ManagerRegistry $em
     * @param Validator $validator
     */
    public function __construct(ManagerRegistry $em, Validator $validator)
    {
        $this->em = $em->getManager();
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
            if($value != null){
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
     * @param string $value
     * @param string $type
     * @param string $description
     * @throws \Exception
     * @return Setting
     */
    public function create($name, $value = '', $type = SettingTypeEnum::STRING, $description = null)
    {
        $setting = new Setting();
        $setting->setName($name);
        $setting->setType($type);
        $setting->setValue($value);
        $setting->setDescription($description);

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

    public function getSettingById($id)
    {
        return $this->repository->find($id);
    }

    public function createSetting(SettingData $settingData) {
        $setting = new Setting();
        $setting->setName($settingData->getName());
        $setting->setType($settingData->getType());
        $setting->setValue($settingData->getValue());
        $setting->setDescription($settingData->getDescription());

        $errors = $this->validator->validate($setting);
        if($errors->count() > 0){
            throw new \Exception('Invalid Setting, check at constraints validation');
        }

        $this->em->persist($setting);
        $this->em->flush();

        return $setting;
    }

    public function updateSetting(SettingData $settingData) {
        $setting = $this->repository->find($settingData->getId());
        if($setting instanceof Setting){
            $setting->setName($settingData->getName());
            $setting->setType($settingData->getType());
            $setting->setValue($settingData->getValue());
            $setting->setDescription($settingData->getDescription());

            $errors = $this->validator->validate($setting);
            if($errors->count() > 0){
                throw new \Exception('Invalid Setting, check at constraints validation');
            }

            $this->em->flush();
        }
    }

    public function removeSetting(SettingData $settingData) {
        $setting = $this->repository->find($settingData->getId());

        if($setting === null){
            throw new \Exception('Unable to find this Setting');
        }

        $this->em->remove($setting);
        $this->em->flush();
    }
}