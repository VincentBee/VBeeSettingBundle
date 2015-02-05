<?php

namespace VBee\SettingBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use VBee\SettingBundle\Document\Setting as MongoDbSetting;
use VBee\SettingBundle\Model\Setting;

class SettingMongoDbDataTransformer implements DataTransformerInterface {

    public function transform($value)
    {
        return $this->getTransform($value);
    }

    public function reverseTransform($value)
    {
        return $this->getTransform($value);
    }

    private function getTransform($value)
    {
        if ($value instanceof MongoDbSetting) {
            return $value;
        }
        if ($value instanceof Setting) {
            $transformedValue = new MongoDbSetting();
            $transformedValue->setId($value->getId());
            $transformedValue->setName($value->getName());
            $transformedValue->setDescription($value->getDescription());
            $transformedValue->setType($value->getType());
            $transformedValue->setValue($value->getValue());

            return $transformedValue;
        }

        return null;
    }
}