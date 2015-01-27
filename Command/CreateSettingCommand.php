<?php

namespace VBee\SettingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use VBee\SettingBundle\Enum\SettingTypeEnum;
use VBee\SettingBundle\Entity\Setting;

class CreateSettingCommand extends ContainerAwareCommand
{
    const CREATE_SETTING_NAME_ARG = 'name';
    const CREATE_SETTING_TYPE_ARG = 'type';
    const CREATE_SETTING_VALUE_ARG = 'value';

    protected function configure()
    {
        $this
            ->setName('vbee:setting:create')
            ->setDescription('Create a new setting')
            ->addArgument(self::CREATE_SETTING_NAME_ARG, InputArgument::REQUIRED, 'The key of the setting, must be unique')
            ->addArgument(self::CREATE_SETTING_VALUE_ARG, InputArgument::OPTIONAL, 'The first value of the setting')
            ->addArgument(self::CREATE_SETTING_TYPE_ARG, InputArgument::OPTIONAL, 'The type of the setting (str, int, ...)', SettingTypeEnum::STRING)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('vbee.manager.setting')->create(
            $input->getArgument(self::CREATE_SETTING_NAME_ARG),
            $input->getArgument(self::CREATE_SETTING_VALUE_ARG),
            $input->getArgument(self::CREATE_SETTING_TYPE_ARG)
        );
    }
}