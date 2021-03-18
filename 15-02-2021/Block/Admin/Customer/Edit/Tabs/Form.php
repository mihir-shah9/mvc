<?php

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    protected $customer = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/customer/edit/tabs/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setCustomer($customer = NULL)
    {
        if ($customer) {
            $this->customer = $customer;
            return $this;
        }
        $customer = \Mage::getModel('Model\Customer');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $customer->load($id);
        }
        $this->customer = $customer;
        return $this;
    }
    public function getCustomer()
    {
        if (!$this->customer) {
            $this->setCustomer();
        }
        return $this->customer;
    }
}
