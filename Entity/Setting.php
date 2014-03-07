<?php

namespace VBee\SettingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\ExecutionContextInterface;
use VBee\SettingBundle\Entity\Enum\SettingTypeEnum;

/**
 * Setting
 */
class Setting
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;


    public function isDataValid(ExecutionContextInterface $context)
    {
        $check = '/^(.+)$/';
        switch($this->type){
            case SettingTypeEnum::INTEGER:
                $check = '/^(\d+)$/';
        }
        $matches = array();
        preg_match($check, $this->value, $matches);
        if (!isset($matches[0])) {
            $context->addViolationAt('value', 'setting.value_valid', array('%type%' => $this->type), null);
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Setting
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Setting
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Setting
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
