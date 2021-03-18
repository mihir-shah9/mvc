<?php

namespace Block\Admin\Customer;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $customers = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/customer/grid.php');
    }

    public function setCustomers($customers = NULL)
    {
        if (!$customers) {
            $customer = \Mage::getModel('Model\Customer');
            $customers = $customer->fetchAll();
        }
        $this->customers = $customers;
        return $this->customers;
    }
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }
}
