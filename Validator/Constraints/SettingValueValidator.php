<?php

namespace VBee\SettingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use VBee\SettingBundle\Entity\Setting;

class SettingValueValidator extends ConstraintValidator
{
    /**
     * @var SettingValueValidatorInterface[]
     */
    protected $validators;

    /**
     * @param $validator
     */
    public function addValidator($validator){
        if($validator instanceof SettingValueValidatorInterface){
            $this->validators[$validator->getName()] = $validator;
        }
    }

    /**
     * @param mixed $setting
     * @param Constraint $constraint
     */
    public function validate($setting, Constraint $constraint)
    {
        if(!$setting instanceof Setting){
            return;
        }
        if(isset($this->validators[$setting->getType()])){
            $validator = $this->validators[$setting->getType()];
            if(!$validator->validate($setting->getValue())){
                $this->context->addViolationAt('value', 'setting.value_valid', array('%type%' => $setting->getType()), null);
            }
        }
    }
}