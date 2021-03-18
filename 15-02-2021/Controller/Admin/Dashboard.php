<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Dashboard extends \Controller\Core\Admin
{
    public function testAction()
    {
        $layout = $this->getLayout();
        echo $layout->toHtml();
    }
}
