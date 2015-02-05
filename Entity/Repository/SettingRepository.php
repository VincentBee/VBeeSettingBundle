<?php

namespace VBee\SettingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use VBee\SettingBundle\Entity\Setting;
use VBee\SettingBundle\Model\Repository\SettingRepositoryInterface;

/**
 * Class SettingRepository
 * @package VBee\SettingBundle\Entity\Repository
 */
class SettingRepository extends EntityRepository implements
    SettingRepositoryInterface
{
    public function getSettingByName($name)
    {
        return $this->createQueryBuilder('setting')
            ->andWhere('setting.name = :name')
            ->setParameter(':name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getSettings()
    {
        return $this->createQueryBuilder('setting')
            ->getQuery()
            ->getResult()
        ;
    }
}
