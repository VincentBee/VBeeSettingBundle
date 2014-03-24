<?php

namespace VBee\SettingBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use VBee\SettingBundle\DependencyInjection\Compiler\SettingCompilerPass;
use VBee\SettingBundle\DependencyInjection\Compiler\SettingValueValidatorCompilerPass;

class VBeeSettingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new SettingCompilerPass(), PassConfig::TYPE_OPTIMIZE);
        $container->addCompilerPass(new SettingValueValidatorCompilerPass());
    }
}
