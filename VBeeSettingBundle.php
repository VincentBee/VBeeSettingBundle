<?php

namespace VBee\SettingBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use VBee\SettingBundle\DependencyInjection\Compiler\SettingValueValidatorCompilerPass;

class VBeeSettingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new SettingValueValidatorCompilerPass());
    }
}
