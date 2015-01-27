<?php

namespace VBee\SettingBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * SettingRepository
 */
class SettingRepository extends DocumentRepository
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
