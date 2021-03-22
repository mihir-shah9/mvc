<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Template');
class Message extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/Customer/layout/message.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
}
