<?php

namespace VBee\SettingBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use VBee\SettingBundle\Model\Repository\SettingRepositoryInterface;

/**
 * Class SettingRepository
 * @package VBee\SettingBundle\Document\Repository
 */
class SettingRepository extends DocumentRepository implements
    SettingRepositoryInterface
{
    public function getSettingByName($name)
    {
        return $this->findOneBy(
            array('name' => $name)
        );
    }

    public function getSettings()
    {
        return $this->findAll();
    }
}
