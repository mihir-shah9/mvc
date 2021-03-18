<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $attributes = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/attribute/grid.php');
    }


    public function setAttributes($attributes = NULL)
    {
        if (!$attributes) {
            $attribute = \Mage::getModel('Model\Attribute');
            $attributes = $attribute->fetchAll();
        }
        $this->attributes = $attributes;
        return $this->attributes;
    }
    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }
}
