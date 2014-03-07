<?php

namespace VBee\SettingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SettingValueValidatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('vbee.validator.setting_value')) {
            return;
        }

        $definition = $container->getDefinition(
            'vbee.validator.setting_value'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'vbee.setting_value_validator'
        );
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addValidator',
                array(new Reference($id))
            );
        }
    }
}