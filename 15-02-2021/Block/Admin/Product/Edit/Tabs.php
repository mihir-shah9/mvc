<?php

namespace Block\Admin\Product\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTab()
    {
        parent::prepareTab();
        $this->addTab('product', ['label' => 'Product', 'block' => 'Block\Admin\Product\Edit\Tabs\Form']);
        $this->addTab('media', ['label' => 'Media', 'block' => 'Block\Admin\Product\Edit\Tabs\Media']);
        $this->addTab('groupPrice', ['label' => 'GroupPrice', 'block' => 'Block\Admin\Product\Edit\Tabs\GroupPrice']);
        $this->setDefaultTab('product');

        return $this;
    }
}
