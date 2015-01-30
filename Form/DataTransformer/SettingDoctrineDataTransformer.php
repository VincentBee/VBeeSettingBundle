<?php

namespace VBee\SettingBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use VBee\SettingBundle\Entity\Setting as DoctrineSetting;
use VBee\SettingBundle\Model\Setting;

class SettingDoctrineDataTransformer implements DataTransformerInterface {

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
        if($value instanceof DoctrineSetting){
            return $value;
        }
        if($value instanceof Setting){
            $transformedValue = new DoctrineSetting();
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