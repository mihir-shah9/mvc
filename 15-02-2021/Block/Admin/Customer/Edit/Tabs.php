<?php

namespace Block\Admin\Customer\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTab()
    {
        parent::prepareTab();
        $this->addTab('customer', ['label' => 'Customer', 'block' => 'Block\Admin\Customer\Edit\Tabs\Form']);
        $this->addTab('customer_address', ['label' => 'Customer Address', 'block' => 'Block\Admin\Customer\Edit\Tabs\Address']);

        $this->setDefaultTab('customer');

        return $this;
    }
}
