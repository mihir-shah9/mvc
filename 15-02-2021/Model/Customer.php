<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Customer extends \Model\Core\Table
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    protected $billingAddress = null;
    protected $shippingAddress = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTableName("customer");
        $this->setPrimaryKey("id");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }

    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        return $this;
    }
    public function getBillingAddress()
    {
        $query = "SELECT * FROM `address` WHERE `id` = '{$this->id}' AND `addressType` = 'billing'";
        $addressModel = \Mage::getModel('Model\Address');
        $address = $addressModel->fetchRow($query);
        if ($address) {
            $this->setBillingAddress($address);
        }
        return $this->billingAddress;
    }

    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }
    public function getShippingAddress()
    {
        $query = "SELECT * FROM `address` WHERE `id` = '{$this->id}' AND `addressType` = 'shipping'";
        $addressModel = \Mage::getModel('Model\Address');
        $address = $addressModel->fetchRow($query);
        if ($address) {
            $this->setShippingAddress($address);
        }
        return $this->shippingAddress;
    }
}
