<?php

namespace VBee\SettingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SettingCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        try{
            $settings = $container->get('doctrine')->getRepository('VBeeSettingBundle:Setting')->findAll();
        } catch(\Exception $e){
            $settings = array();
        }

        foreach($settings as $setting){
            if($container->hasParameter($setting->getName())){
                continue;
            }
            $container->setParameter(
                $setting->getName(),
                $setting->getValue()
            );
        }
    }
}