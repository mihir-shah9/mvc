<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Checkout extends \Model\Core\Table
{

    public function __construct()
    {
        $this->setTableName("ch");
        $this->setPrimaryKey("addressId");
    }
}
