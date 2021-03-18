<?php

namespace Block\Admin\Shipping\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Info extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/shipping/edit/tabs/info.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
}
