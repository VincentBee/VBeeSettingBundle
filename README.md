VBeeSettingBundle
=================

Introduction
============

This bundle simply allow to manage settings in your application trough the database.
That make it more easier to manage during the application running than parameters files.

Usage
=====

Get the setting manager service, and call the 'get' method with the key of the setting.

    <?php
    $settingManager = $this->container->get('vbee.manager.setting');
    $settingManager->get('toto');