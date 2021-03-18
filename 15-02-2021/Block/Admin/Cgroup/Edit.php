<?php

namespace Block\Admin\Cgroup;

\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
    protected $cgroup = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/cgroup/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
    public function setCgroup($cgroup = null)
    {
        if ($cgroup) {
            $this->cgroup = $cgroup;
            return $this;
        }
        $cgroup = \Mage::getModel('Model\Cgroup');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $cgroup->load($id);
        }
        $this->cgroup = $cgroup;
        return $this;
    }

    public function getCgroup()
    {
        if (!$this->cgroup) {
            $this->setCgroup();
        }
        return $this->cgroup;
    }
}
