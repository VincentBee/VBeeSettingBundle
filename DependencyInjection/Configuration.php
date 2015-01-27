<?php

namespace VBee\SettingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('v_bee_setting');

        $rootNode
            ->children()
                ->enumNode('orm')
                    ->isRequired()
                    ->values(array('doctrine', 'mongodb'))
                ->end()
                ->scalarNode('setting_doctrine_manager')
                    ->defaultValue('VBee\SettingBundle\Manager\SettingDoctrineManager')
                ->end()
                ->scalarNode('setting_mongodb_manager')
                    ->defaultValue('VBee\SettingBundle\Manager\SettingMongoDbManager')
                ->end()
                ->arrayNode('types')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('label')->isRequired()->end()
                            ->booleanNode('enable')->defaultTrue()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
