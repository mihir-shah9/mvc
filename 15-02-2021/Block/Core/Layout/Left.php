<?php

namespace Block\Core\Layout;

\Mage::loadFileByClassName('Block\Core\Template');
class Left extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/Core/layout/left.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
}
