<?php

namespace Model\Product;

\Mage::loadFileByClassName('Model\Core\Table');
class GroupPrice extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName("productgroupprice");
        $this->setPrimaryKey("entityId");
    }

    public function getImagePath($subPath = null)
    {
        \Mage::getBaseDir($subPath);
        return getcwd();
    }
}
