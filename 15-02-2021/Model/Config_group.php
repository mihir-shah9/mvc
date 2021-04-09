<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Config_group extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName("config_group");
        $this->setPrimaryKey("groupId");
    }
}
