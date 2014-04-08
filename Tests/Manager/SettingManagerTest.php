<?php

namespace VBee\SettingBundle\Tests\Validator\Setting;

use VBee\SettingBundle\Entity\Enum\SettingTypeEnum;
use VBee\SettingBundle\Manager\SettingManager;

class SettingManagerTest extends \PHPUnit_Framework_TestCase
{
    const SETTING_NAME  = 'foo';
    const SETTING_VALUE = 'bar';

    public function testGet()
    {
        // First, mock the object to be used in the test
        $setting = $this->getMock('\VBee\SettingBundle\Entity\Setting');
        $setting->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue(self::SETTING_VALUE));

        // Now, mock the repository so it returns the mock of the employee
        $settingRepository = $this->getMockBuilder('\VBee\SettingBundle\Entity\Repository\SettingRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $settingRepository->expects($this->once())
            ->method('getSettingByName')
            ->will($this->returnValue($setting));

        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($settingRepository));

        $validator = $this->getMockBuilder('\Symfony\Component\Validator\Validator')
            ->disableOriginalConstructor()
            ->getMock();

        $manager = new SettingManager($entityManager, $validator);
        $this->assertEquals(self::SETTING_VALUE, $manager->get(self::SETTING_NAME));
    }

    public function testCreate()
    {
        $entityManager = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $errors = $this->getMockBuilder('\Symfony\Component\Validator\ConstraintViolationList')
            ->disableOriginalConstructor()
            ->getMock();

        $validator = $this->getMockBuilder('\Symfony\Component\Validator\Validator')
            ->disableOriginalConstructor()
            ->getMock();
        $validator->expects($this->once())
            ->method('validate')
            ->will($this->returnValue($errors));

        $manager = new SettingManager($entityManager, $validator);
        $setting = $manager->create(self::SETTING_NAME, self::SETTING_VALUE, SettingTypeEnum::STRING);

        $this->assertEquals(self::SETTING_NAME, $setting->getName());
        $this->assertEquals(self::SETTING_VALUE, $setting->getValue());
    }
}