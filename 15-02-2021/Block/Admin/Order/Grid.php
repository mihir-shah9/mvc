<?php

namespace Block\Admin\Order;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function __construct()
    {
        $this->setTemplate('./View/Admin/order/grid.php');
    }

    // public function getCart()
    // {
    //     return \Mage::getModel('Model\Cart')->fetchAll();
    // }

    public function getCart($customerId = null)
    {
        $session = \Mage::getModel('Model\Admin\Session');
        if ($customerId) {
            $session->customerId = $customerId;
        }

        $cart = \Mage::getModel('Model\Cart');
        $query = "SELECT * FROM cart WHERE customerId = '{$session->customerId}'";
        $cart = $cart->fetchRow($query);

        if ($cart) {
            return $cart;
        }
        $cart = \Mage::getModel('Model\Cart');
        $cart->customerId = $session->customerId;
        $cart->createdDate = date("Y-m-d H:i:s");
        $cart->save();
        return $cart;
    }

    public function getCartAddress()
    {
        return \Mage::getModel('Model\Cart\Address')->fetchAll();
    }

    public function getCartItem()
    {
        $cartItem = \Mage::getModel('Model\Cart\Item')->fetchAll();
        return $cartItem;
    }

    public function getProduct()
    {
        $cartItem = $this->getCartItem();
        // $product = \Mage::getModel('Model\Product');
        // // if ($cartItem->productId == $product->id) {
        // //     return $product->name;
        // // }
        // print_r($cartItem->getData());
        // die();
        foreach ($cartItem->getData() as $key => $value) {
            $product = \Mage::getModel('Model\Product')->load($value->productId);
        }
        return;
    }
}
