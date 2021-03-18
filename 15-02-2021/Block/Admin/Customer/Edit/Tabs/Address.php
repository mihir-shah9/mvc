<?php

use function PHPSTORM_META\map;

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Address extends \Block\Core\Edit
{
    protected $billing = null;
    protected $shipping = null;

    public function __construct()
    {
        $this->setTemplate('./View/Admin/customer/edit/tabs/address.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setBilling($billing = null)
    {
        if ($billing) {
            $this->billing = $billing;
            return $this;
        }
        $customer = \Mage::getModel('Model\Customer');
        $billing = \Mage::getModel('Model\Address');
        if ($id = $this->getRequest()->getGet('id')) {
            $customer = $customer->load($id);
            $query = "SELECT * FROM `address` WHERE `id`= `{$customer->id}` AND `addressType` = `billing`";
            $billing = $billing->fetchRow($query);
        }
        $this->billing = $billing;
        return $this;
    }

    public function getBilling()
    {
        if (!$this->billing) {
            $this->setBilling();
        }
        return $this->billing;
    }

    public function setShipping($shipping = null)
    {
        if ($shipping) {
            $this->shipping = $shipping;
            return $this;
        }
        $customer = \Mage::getModel('Model\Customer');
        $shipping = \Mage::getModel('Model\Address');
        if ($id = $this->getRequest()->getGet('id')) {
            $customer = $customer->load($id);
            $query = "SELECT * FROM `address` WHERE `id` = `{$customer->id}`
            AND `addressType` = `shipping`";
            $shipping = $shipping->fetchRow($query);
        }
        $this->shipping = $shipping;
        return $this;
    }

    public function getShipping()
    {
        if (!$this->shipping) {
            $this->setShipping();
        }
        return $this->shipping;
    }
}
