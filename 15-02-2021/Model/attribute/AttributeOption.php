<?php

namespace Model\Attribute;

\Mage::loadFileByClassName('Model\Core\Table');
class AttributeOption extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName("attributeoption");
        $this->setPrimaryKey("optionId");
    }
}
