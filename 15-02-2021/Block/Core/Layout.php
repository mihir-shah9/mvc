<?php

namespace Block\core;

\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Block\Core\Layout\Message');
class Layout extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setController(\Mage::getController('Controller\Core\Admin'));
        $this->setTemplate('./View/Core/layout/threeColumn.php');
        $this->prepareChildren();
    }

    public function prepareChildren()
    {
        $this->addChild(\Mage::getController('Block\Core\Layout\Header'), 'header');
        $this->addChild(\Mage::getController('Block\Core\Layout\Left'), 'left');
        $this->addChild(\Mage::getController('Block\Core\Layout\Content'), 'content');
        $this->addChild(\Mage::getController('Block\Core\Layout\Footer'), 'footer');
    }

    public function getContent()
    {
        return $this->getChild('content');
    }

    public function getLeft()
    {
        return $this->getChild('left');
    }

    public function getRight()
    {
        return $this->getChild('right');
    }
}
