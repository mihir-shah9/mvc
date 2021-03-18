<?php

namespace Block\Admin\Shipping\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTab()
    {
        parent::prepareTab();
        $this->addTab('shipping', ['label' => 'Shipping', 'block' => 'Block\Admin\Shipping\Edit\Tabs\Form']);
        $this->addTab('info', ['label' => 'Information', 'block' => 'Block\Admin\Shipping\Edit\Tabs\Info']);

        $this->setDefaultTab('shipping');
        return $this;
    }
}
