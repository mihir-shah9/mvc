<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    protected $attribute = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/attribute/edit/tabs/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
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
