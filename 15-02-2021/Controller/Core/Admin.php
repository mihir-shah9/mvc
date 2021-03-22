<?php

namespace Controller\Core;

use Collator;

\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Admin extends Abstracts
{

    public function setLayout(\Block\core\Layout $layout = null)
    {
        if (!$layout) {
            $layout = \Mage::getBlock('Block\core\Layout');
        }
        $this->layout = $layout;
        return $this;
    }

    public function setMessage($message = null)
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }
}
