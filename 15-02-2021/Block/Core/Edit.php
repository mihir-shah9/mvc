<?php

namespace Block\core;

class Edit extends Template
{
    private $tab = null;
    protected $tableRow = null;
    protected $tabClass = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./View/Core/edit.php");
    }
    public function getTabContent()
    {
        $tabsBlock = $this->getTab();
        $tabs = $tabsBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab', $tabsBlock->getDefaultTab());
        if (!array_key_exists($tab, $tabs)) {
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getController($blockClassName);
        $block->setTableRow($this->getTableRow());
        echo $block->toHtml();
    }

    public function getTabHtml()
    {
        return $this->getTab()->toHtml();
    }

    public function setTab($tab = null)
    {
        // echo 2;
        if (!$tab) {
            $tab = $this->getTabClass();
        }
        $this->tab = $tab;
        return $this;
    }

    public function getTab()
    {
        // echo 1;
        if (!$this->tab) {
            $this->setTab();
        }
        return $this->tab;
    }

    public function setTableRow(\Model\Core\Table $tableRow)
    {
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function setTabClass($tabClass)
    {
        // echo 4;
        $this->tabClass = $tabClass;
        return $this;
    }

    public function getTabClass()
    {
        // echo 3;
        return $this->tabClass;
    }
}
