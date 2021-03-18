<?php

namespace Block\Core\Layout;

\Mage::loadFileByClassName('Block\Core\Template');
class Footer extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/Core/layout/footer.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
}
