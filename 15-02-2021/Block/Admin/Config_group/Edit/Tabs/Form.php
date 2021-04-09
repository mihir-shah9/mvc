<?php

namespace Block\Admin\Config_group\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    protected $configGroup = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/config_group/edit/tabs/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setConfigGroup($configGroup = NULL)
    {
        if ($configGroup) {
            $this->configGroup = $configGroup;
            return $this;
        }
        $configGroup = \Mage::getModel('Model\Config_group');
        if ($id = $this->getController()->getRequest()->getGet('groupId')) {
            $myrecord = $configGroup->load($id);
        }
        $this->configGroup = $configGroup;
        return $this;
    }
    public function getConfigGroup()
    {
        if (!$this->configGroup) {
            $this->setConfigGroup();
        }
        return $this->configGroup;
    }
}
