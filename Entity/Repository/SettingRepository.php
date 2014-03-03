<?php

namespace VBee\SettingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SettingRepository
 */
class SettingRepository extends EntityRepository
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
}
