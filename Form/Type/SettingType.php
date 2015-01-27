<?php

namespace VBee\SettingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingType extends AbstractType {

    protected $types;

    public function __construct(array $types)
    {
        $this->types = $types;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', null, array(
                'required' => false,
                'translation_domain' => 'VBeeSettingBundle',
                'attr' => array(
                    'placeholder' => 'setting_form.name',
                ))
            )
            ->add('description', null, array(
                'required' => false,
                'translation_domain' => 'VBeeSettingBundle',
                'attr' => array(
                    'placeholder' => 'setting_form.description',
                ))
            )
            ->add('type', 'choice', array(
                'translation_domain' => 'VBeeSettingBundle',
                'choices' => $this->types
            ))
            ->add('value', null, array(
                'required' => false,
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
            'data_class' => 'VBee\SettingBundle\Model\Setting',
        ));
    }

    public function getName() {
        return 'setting';
    }

}