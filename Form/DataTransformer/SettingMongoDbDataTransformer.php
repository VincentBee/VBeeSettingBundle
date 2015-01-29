<?php

namespace VBee\SettingBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use VBee\SettingBundle\Document\Setting as MongoDbSetting;
use VBee\SettingBundle\Model\Setting;

class SettingMongoDbDataTransformer implements DataTransformerInterface {

    public function transform($value)
    {
        if($value instanceof Setting){
            $transformedValue = new MongoDbSetting();
            $transformedValue->setName($value->getName());
            $transformedValue->setDescription($value->getDescription());
            $transformedValue->setType($value->getType());
            $transformedValue->setValue($value->getValue());

            return $transformedValue;
        }

        return null;
    }

    public function reverseTransform($value)
    {
        return $value;
    }
}