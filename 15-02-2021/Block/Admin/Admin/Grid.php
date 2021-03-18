<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $admins = [];

    public function __construct()
    {
        parent::__construct();
        $this->setController(\Mage::getController('Controller\Core\Admin'));
        $this->setTemplate('./View/Admin/admin/grid.php');
    }

    public function setAdmins($admins = null)
    {
        if (!$admins) {
            $admin = \Mage::getModel('Model\Admin');
            $admins = $admin->fetchAll();
        }
        $this->admins = $admins;
        return $this;
    }

    public function getAdmins()
    {
        if (!$this->admins) {
            $this->setAdmins();
        }
        return $this->admins;
    }
}
