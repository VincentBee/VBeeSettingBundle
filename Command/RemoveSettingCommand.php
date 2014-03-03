<?php

namespace VBee\SettingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveSettingCommand extends ContainerAwareCommand
{
    const REMOVE_SETTING_NAME_ARG = 'name';
    const REMOVE_SETTING_ALL_OPTION = 'all';

    protected function configure()
    {
        $this
            ->setName('vbee:setting:remove')
            ->setDescription('Remove a setting')
            ->addArgument(self::REMOVE_SETTING_NAME_ARG, InputArgument::OPTIONAL, 'The key of the setting you want to delete')
            ->addOption(self::REMOVE_SETTING_ALL_OPTION, null, InputOption::VALUE_NONE, 'Delete all settings')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if($input->getOption(self::REMOVE_SETTING_ALL_OPTION)){
            $this->getContainer()->get('vbee.manager.setting')->purge();
        } else {
            $name = $input->getArgument(self::REMOVE_SETTING_NAME_ARG);
            if($name != null){
                $this->getContainer()->get('vbee.manager.setting')->remove(
                    $name
                );
            }
        }
    }
}