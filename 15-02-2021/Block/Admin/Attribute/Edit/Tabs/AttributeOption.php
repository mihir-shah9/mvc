<?php

use function PHPSTORM_META\map;

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class AttributeOption extends \Block\Core\Edit
{
    protected $options = [];
    protected $attribute = NULL;

    public function __construct()
    {
        $this->setTemplate('./View/Admin/attribute/edit/tabs/attributeOption.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setOptions($options = null)
    {
        if (!$options) {
            $options = \Mage::getModel('Model\Attribute\AttributeOption')->fetchAll();
        }
        $this->options = $options;
        return $this;
    }

    public function getOptions()
    {
        if (!$this->options) {
            $this->setOptions();
        }
        return $this->options;
    }

    public function setAttribute($attribute = NULL)
    {
        if ($attribute) {
            $this->attribute = $attribute;
            return $this;
        }
        $attribute = \Mage::getModel('Model\Attribute');
        if ($id = $this->getController()->getRequest()->getGet('attributeId')) {
            $myrecord = $attribute->load($id);
        }
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        if (!$this->attribute) {
            $this->setAttribute();
        }
        return $this->attribute;
    }
}
