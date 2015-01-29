<?php

namespace VBee\SettingBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use VBee\SettingBundle\Entity\Setting as DoctrineSetting;
use VBee\SettingBundle\Model\Setting;

class SettingDoctrineDataTransformer implements DataTransformerInterface {

    public function transform($value)
    {
        if($value instanceof Setting){
            $transformedValue = new DoctrineSetting();
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