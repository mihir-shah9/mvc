<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Cart extends \Model\Core\Table
{
    protected $customer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $payment = null;
    protected $shipping = null;

    public function __construct()
    {
        $this->setTableName("cart");
        $this->setPrimaryKey("cartId");
    }

    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }
        if (!$this->customerId) {
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }

    public function setItems(\Model\Cart\Item\Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    public function getItems()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM cartitem WHERE cartId='{$this->cartId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if ($items) {
            $this->setItems($items);
        }
        return $this->items;
    }

    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getBillingAddress()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cartaddress` WHERE `cartId`={$this->cartId} 
        AND `addressType`='billing'";
        // print_r($query);
        // die();
        $billingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        $this->setBillingAddress($billingAddress);
        return $this->billingAddress;
    }

    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    public function getShippingAddress()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM cartaddress WHERE cartId={$this->cartId} 
        AND addressType='{\\Model\\Cart\\Address::ADDRESS_TYPE_SHIPPING}'";
        $shippingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        $this->setBillingAddress($shippingAddress);
        return $this->shippingAddress;
    }

    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    public function getPayment()
    {
        if ($this->payment) {
            return $this->payment;
        }
        if (!$this->paymentMethodId) {
            return false;
        }
        $payment = \Mage::getModel('Model\Payment')->load($this->paymentMethodId);
        $this->setPayment($payment);
        return $this->payment;
    }

    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }

    public function getShipping()
    {
        if ($this->shipping) {
            return $this->shipping;
        }
        if (!$this->shippingMethodId) {
            return false;
        }
        $shipping = \Mage::getModel('Model\Shipping')->load($this->shippingMethodId);
        $this->setShipping($shipping);
        return $this->shipping;
    }

    public function addItemToCart($product, $quantity = 1)
    {
        $item = \Mage::getModel('Model\Cart\Item');
        $query = "SELECT * FROM `{$item->getTableName()}` WHERE `cartId` = {$this->cartId} AND productId = '{$product->id}'";

        $item = $item->fetchRow($query);

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
            return true;
        }

        $item = \Mage::getModel('Model\Cart\Item');
        $item->cartId = $this->cartId;
        $item->productId = $product->id;
        $item->price = $product->price;
        $item->quantity = $quantity;
        $item->discount = $product->discount;
        $item->createdDate = date("Y-m-d H:i:s");
        $item->save();
    }
}
