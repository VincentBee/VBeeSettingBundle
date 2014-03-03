VBeeSettingBundle
=================

This bundle simply allow to manage settings in your application trough the database.
That make it easier to manage during the application running than parameters files.

Installation
============

Composer.json:

    "vbee/settingbundle": "dev-master"

Update your vendors:

    php composer.phar update vbee/settingbundle

app/AppKernel.php:

   new VBee\SettingBundle\VBeeSettingBundle(),

Usage in code
=============

Create a new Setting

    <?php
    $this->container->get('vbee.manager.setting')->create('foo', 'bar');

Get a existing Setting

    <?php
    $this->container->get('vbee.manager.setting')->get('foo');

Get all Settings

    <?php
    $this->container->get('vbee.manager.setting')->all();

Remove a Setting

    <?php
    $this->container->get('vbee.manager.setting')->remove('foo');

Usage in command line
=====================

Create a new Setting

    php app/console vbee:setting:create foo bar

Remove a Setting

    php app/console vbee:setting:remove foo bar

Purge all Settings

    php app/console vbee:setting:remove --all