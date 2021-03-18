<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
    protected $admin = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/admin/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
    public function setAdmin($admin = null)
    {
        if ($admin) {
            $this->admin = $admin;
            return $this;
        }
        $admin = \Mage::getModel('Model\Admin');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $admin->load($id);
        }
        $this->admin = $admin;
        return $this;
    }

    public function getAdmin()
    {
        if (!$this->admin) {
            $this->setAdmin();
        }
        return $this->admin;
    }
}
