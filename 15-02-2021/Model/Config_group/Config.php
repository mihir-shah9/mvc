<?php

namespace Model\Config_group;

\Mage::loadFileByClassName('Model\Core\Table');
class Config extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName("config");
        $this->setPrimaryKey("configId");
    }
}
