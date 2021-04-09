<?php

namespace Model\Cart;

\Mage::loadFileByClassName('Model\Core\Table');
class Address extends \Model\Core\Table
{
    const ADDRESS_TYPE_BILLING = "billing";
    const ADDRESS_TYPE_SHIPPING = "shipping";
    protected $cart = null;
    protected $customerBillingAddress = null;
    protected $customerShippingAddress = null;

    public function __construct()
    {
        $this->setTableName("cartaddress");
        $this->setPrimaryKey("cartAddressId");
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cartId) {
            return false;
        }
        $cart = \Mage::getModel('Model\Cart')->load($this->cartId);
        $this->setCart($cart);
        return $this->cart;
    }

    public function setCustomerBillingAddress($address)
    {
        $this->customerBillingAddress = $address;
        return $this;
    }

    public function getCustomerBillingAddress()
    {
        if (!$this->addressId) {
            return false;
        }
        $customerBillingAddress = \Mage::getModel('Model\Address')->load($this->addressId);
        $this->setCustomerBillingAddress($customerBillingAddress);
        return $this->customerBillingAddress;
    }

    public function setCustomerShippingAddress($address)
    {
        $this->customerShippingAddress = $address;
        return $this;
    }

    public function getCustomerShippingAddress()
    {
        if (!$this->addressId) {
            return false;
        }
        $customerShippingAddress = \Mage::getModel('Model\Address')->load($this->addressId);
        $this->setCustomerShippingAddress($customerShippingAddress);
        return $this->customerShippingAddress;
    }
}
