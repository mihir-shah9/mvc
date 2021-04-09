<?php

namespace Block\Admin\Checkout;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $cart;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/checkout/grid.php');
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }
    public function getCart()
    {
        return $this->cart;
    }

    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getBillingAddress()
    {
        $address = $this->getCart()->getBillingAddress();

        if ($address) {
            $this->setBillingAddress($address);
            return $this->billingAddress;
        }

        if ($address = $this->getCart()->getCustomer()->getBillingAddress()) {
            $this->setBillingAddress($address);
            return $this->billingAddress;
        }

        $address = \Mage::getModel('Model\Cart\Address');
        $this->setBillingAddress($address);
        return $this->billingAddress;
    }

    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    public function getShippingAddress()
    {
        $address = $this->getCart()->getShippingAddress();

        if ($address) {
            $this->setShippingAddress($address);
            return $this->shippingAddress;
        }

        if ($address = $this->getCart()->getCustomer()->getShippingAddress()) {
            $this->setShippingAddress($address);
            return $this->shippingAddress;
        }

        $address = \Mage::getModel('Model\Cart\Address');
        $this->setShippingAddress($address);
        return $this->shippingAddress;
    }

    public function getPayment()
    {
        $paymentData = \Mage::getModel('Model\Payment')->fetchAll();
        return $paymentData;
    }

    public function getShipping()
    {
        $shippingData = \Mage::getModel('Model\Shipping')->fetchAll();
        return $shippingData;
    }

    public function getTotal()
    {
        $cartItems = $this->getCart()->getItems();
        $total = 0;
        foreach ($cartItems->getData() as $key => $cartItem) {
            $total = $total + (($cartItem->price * $cartItem->quantity) - ($cartItem->discount * $cartItem->quantity));
        }
        return $total;
    }
}
