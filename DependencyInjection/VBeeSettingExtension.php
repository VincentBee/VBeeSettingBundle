<?php

namespace VBee\SettingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class VBeeSettingExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $types = array_merge(array(
            'str' => array(
                'label' => 'setting_type.string',
                'enable' => true
            ),
            'int' => array(
                'label' => 'setting_type.integer',
                'enable' => true
            ),
            'date' => array(
                'label' => 'setting_type.date',
                'enable' => true
            ),
            'url' => array(
                'label' => 'setting_type.url',
                'enable' => true
            ),
            'phone' => array(
                'label' => 'setting_type.phone',
                'enable' => true
            )
        ), $config['types']);

        $typesForm = array();
        $typesValid = array();
        foreach ($types as $name => $type) {
            if (true === $type['enable']) {
                $typesForm[$name] = $type['label'];
                $typesValid[] = $name;
            }
        }
        $container->setParameter('vbee.setting_types_select', $typesForm);
        $container->setParameter('vbee.setting_types_valid', $typesValid);

        switch ($config['orm']) {
            case 'doctrine':
                $container->setParameter('vbee.setting_entity.class', 'VBee\SettingBundle\Entity\Setting');
                $container->setParameter('vbee.setting_setting_manager', $config['setting_doctrine_manager']);
                $loader->load('manager.doctrine.xml');
                break;
            case 'mongodb':
                $container->setParameter('vbee.setting_entity.class', 'VBee\SettingBundle\Document\Setting');
                $container->setParameter('vbee.setting_setting_manager', $config['setting_mongodb_manager']);
                $loader->load('manager.mongodb.xml');
                break;
        }
    }
}
