<?php

use function PHPSTORM_META\map;

namespace Block\Admin\Config_group\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Information extends \Block\Core\Edit
{
    protected $configs = [];
    protected $configGroup = null;
    public function __construct()
    {
        $this->setTemplate('./View/Admin/Config_group/edit/tabs/information.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setConfigs($configs = null)
    {
        if (!$configs) {
            $configs = \Mage::getModel('Model\Config_group\Config')->fetchAll();
        }
        $this->configs = $configs;
        return $this;
    }

    public function getConfigs()
    {
        if (!$this->configs) {
            $this->setConfigs();
        }
        return $this->configs;
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
