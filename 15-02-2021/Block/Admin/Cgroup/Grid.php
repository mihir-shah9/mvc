<?php

namespace Block\Admin\Cgroup;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $cgroups = [];

    public function __construct()
    {
        parent::__construct();
        $this->setController(\Mage::getController('Controller\Core\Admin'));
        $this->setTemplate('./View/Admin/cgroup/grid.php');
    }

    public function setCgroups($cgroups = null)
    {
        if (!$cgroups) {
            $cgroup = \Mage::getModel('Model\Cgroup');
            $cgroups = $cgroup->fetchAll();
        }
        $this->cgroups = $cgroups;
        return $this;
    }

    public function getCgroups()
    {
        if (!$this->cgroups) {
            $this->setCgroups();
        }
        return $this->cgroups;
    }
}
