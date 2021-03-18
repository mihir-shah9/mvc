<?php

namespace Block\Core\Layout;

\Mage::loadFileByClassName('Block\Core\Template');
class Header extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/Core/layout/header.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
}
