<?php

namespace Block\Admin\Cart;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    protected $cart = null;
    protected $customer = null;
    public function __construct()
    {
        $this->setTemplate('./View/Admin/cart/grid.php');
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cart) {
            throw new \Exception("Cart is not set.");
        }
        return $this->cart;
    }

    public function getCustomers()
    {
        return \Mage::getModel('Model\Customer')->fetchAll();
    }
}
