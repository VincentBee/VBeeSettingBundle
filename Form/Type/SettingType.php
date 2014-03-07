<?php

namespace VBee\SettingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VBee\SettingBundle\Entity\Enum\SettingTypeEnum;

class SettingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', null, array(
                'translation_domain' => 'VBeeSettingBundle',
                'attr' => array(
                    'placeholder' => 'setting_form.name',
                ))
            )
            ->add('type', 'choice', array(
                'translation_domain' => 'VBeeSettingBundle',
                'choices' => SettingTypeEnum::getSettingTypes()
            ))
            ->add('value', null, array(
                'translation_domain' => 'VBeeSettingBundle',
                'attr' => array(
                    'placeholder' => 'setting_form.value',
                ))
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VBee\SettingBundle\Entity\Setting',
        ));
    }

    public function getName() {
        return 'setting';
    }

}