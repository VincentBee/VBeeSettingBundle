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

Update the database:

    php app/console doctrine:schema:update --force

Update route for access to the html interface:

    #app/routing.yml:
    v_bee_setting:
        resource: "@VBeeSettingBundle/Resources/config/routing.xml"
        prefix:   /setting

Import css:

    <link rel="stylesheet" href="{{ asset('bundles/vbeesetting/css/bootstrap.min.css') }}" type="text/css" media="all" />

Usage in code
=============

Create a new Setting

    $this->container->get('vbee.manager.setting')->create('foo', 'bar'); // default type = 'str'
    $this->container->get('vbee.manager.setting')->create('foo', 'bar', 'str');
    $this->container->get('vbee.manager.setting')->create('foo', '123', 'int');
    // ... check all available types

Get a existing Setting

    $this->container->get('vbee.manager.setting')->get('foo');

Get all Settings

    $this->container->get('vbee.manager.setting')->all();

Set a new value for a Setting:

    $this->container->get('vbee.manager.setting')->set('foo', 'bar');
    $this->container->get('vbee.manager.setting')->set('foo', 'bar', 'str');
    $this->container->get('vbee.manager.setting')->set('foo', '123', 'int');
    // ... check all available types

Remove a Setting

    $this->container->get('vbee.manager.setting')->remove('foo');

Usage in Twig
=============

Get a existing Setting

    {{ getSetting('foo') }}

Usage in command line
=====================

Create a new Setting

    php app/console vbee:setting:create foo bar

Remove a Setting

    php app/console vbee:setting:remove foo bar

Purge all Settings

    php app/console vbee:setting:remove --all

Value Types
===========

VBeeSetting bundle allow you to make validation on your setting value dynamically.

By Default, these types are available:

Type | In DB | In Code
--- | --- | ---
String | 'str' | `\VBee\SettingBundle\Entity\Enum\SettingTypeEnum::STRING`
Integer | 'int' | `\VBee\SettingBundle\Entity\Enum\SettingTypeEnum::INTEGER`

