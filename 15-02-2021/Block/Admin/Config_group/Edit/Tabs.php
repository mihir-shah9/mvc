<?php

namespace Block\Admin\Config_group\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTab()
    {
        parent::prepareTab();
        $this->addTab('configuration', ['label' => 'Configuration', 'block' => 'Block\Admin\Config_group\Edit\Tabs\Form']);
        $this->addTab('information', ['label' => 'Information', 'block' => 'Block\Admin\Config_group\Edit\Tabs\information']);

        $this->setDefaultTab('configuration');
        return $this;
    }
}
