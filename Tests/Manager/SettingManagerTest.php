<?php

namespace VBee\SettingBundle\Tests\Validator\Setting;

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
}