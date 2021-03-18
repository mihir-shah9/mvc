<?php

namespace Block\Admin\CMSpage;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $cmspages = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/cmspage/grid.php');
    }

    public function setCMSpages($cmspages = null)
    {
        if (!$cmspages) {
            $cmspage = \Mage::getModel('Model\CMSpage');
            $cmspages = $cmspage->fetchAll();
        }
        $this->cmspages = $cmspages;
        return $this;
    }

    public function getCMSpages()
    {
        if (!$this->cmspages) {
            $this->setCMSpages();
        }
        return $this->cmspages;
    }
}
