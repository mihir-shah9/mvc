<?php

namespace Block\Admin\Attribute\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTab()
    {
        parent::prepareTab();
        $this->addTab('attribute', ['label' => 'Attribute', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        $this->addTab('attributeOption', ['label' => 'Attribute Option', 'block' => 'Block\Admin\Attribute\Edit\Tabs\AttributeOption']);

        $this->setDefaultTab('attribute');
        return $this;
    }
}
