<?php

namespace VBee\SettingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VBee\SettingBundle\Form\DataTransformer\SettingDoctrineDataTransformer;
use VBee\SettingBundle\Form\DataTransformer\SettingMongoDbDataTransformer;

class SettingType extends AbstractType {

    protected $types;

    protected $class;

    public function __construct(array $types, $class)
    {
        $this->types = $types;
        $this->class = $class;
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

        if('VBee\SettingBundle\Entity\Setting' == $this->class) {
            $builder->addModelTransformer(new SettingDoctrineDataTransformer());
        } else if ('VBee\SettingBundle\Document\Setting' == $this->class) {
            $builder->addModelTransformer(new SettingMongoDbDataTransformer());
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }

    public function getName() {
        return 'setting';
    }

}