VBeeSettingBundle
=================

This bundle simply allow to manage settings in your application trough the database.
That make it easier to manage during the application running than parameters files.

[![Build Status](https://travis-ci.org/VincentBee/VBeeSettingBundle.svg?branch=master)](https://travis-ci.org/VincentBee/VBeeSettingBundle)

Installation
============

Composer.json:

    "vbee/settingbundle": "dev-master"

Update your vendors:

    php composer.phar update vbee/settingbundle

Update your configuration file: app/config/config.yml

    v_bee_setting:
        orm: doctrine # possible values = doctrine and mongodb

app/AppKernel.php:

    new VBee\SettingBundle\VBeeSettingBundle(),

Update the database:

    php app/console doctrine:schema:update --force

Update route for access to the html interface:

    #app/routing.yml:
    v_bee_setting:
        resource: "@VBeeSettingBundle/Resources/config/route/routing.xml"
        prefix:   /setting

    v_bee_setting_api:
        resource: "@VBeeSettingBundle/Resources/config/route/api.xml"
        prefix:   /api

Import css:

    <link rel="stylesheet" href="{{ asset('bundles/vbeesetting/css/bootstrap.min.css') }}" type="text/css" media="all" />

Install assets:

    php app/console asset:install

Usage in code
=============

Create a new Setting

    $this->container->get('vbee.manager.setting')->create('foo', 'bar'); // default type = 'str'
    $this->container->get('vbee.manager.setting')->create('foo', 'bar', 'str');
    $this->container->get('vbee.manager.setting')->create('foo', '123', 'int');
    // ... check all available types

Get a existing Setting

    $this->container->get('vbee.manager.setting')->get('foo');
    // or
    $this->container->getParameter('foo');

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
String | str | `VBee\SettingBundle\Enum\SettingTypeEnum::STRING`
Integer | int | `VBee\SettingBundle\Enum\SettingTypeEnum::INTEGER`
Date | date | `VBee\SettingBundle\Enum\SettingTypeEnum::DATE`
Phone | phone | `VBee\SettingBundle\Enum\SettingTypeEnum::PHONE`
Url | url | `VBee\SettingBundle\Enum\SettingTypeEnum::URL`

Add a Type
==========

Declare your type
-----------------

your first have to declare your new type as:

    # app/config/config.yml
    v_bee_setting:
        types:
            your: { label: setting_type.your }

you can use translation file for translate the label

    # src/Acme/DemoBundle/Resources/translations/VBeeSettingBundle.[locale].yml
    setting_type:
        your: "Your"

Create your validator
---------------------

then you need to make your custom type validator

    <?php
    namespace Acme\DemoBundle\Validator\Constraints;

    use VBee\SettingBundle\Validator\Constraints\SettingValueValidatorInterface;

    class YourValidator implements SettingValueValidatorInterface
    {
        /**
         * @param $value
         * @return bool
         */
        public function validate($value)
        {
            $matches = array(); preg_match('/^your(.+)$/', $value, $matches);
            if (isset($matches[0])) { return true; }
            return false;
        }

        public function getName()
        {
            return 'your';
        }
    }

finally, register it as service tagged by `vbee.setting_value_validator`

    <service id="acme.validator.your" class="Acme\DemoBundle\Validator\Constraints\YourValidator">
        <tag name="vbee.setting_value_validator"/>
    </service>

APIs
====

list setting
------------

    GET: /api/setting
    {
        "status": {
            "code": 200,
            "message": "OK"
        },
        "response": {
            "settings": {
                "foo": "bar",
            }
        }
    }