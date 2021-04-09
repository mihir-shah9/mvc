<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Checkout extends \Controller\Core\Admin
{
    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Checkout\Grid')->setCart($this->getCart())->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                'selector' => '#contentHtml',
                'html' => $gridhtml
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }


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

    public function savebillingAction()
    {
        $cart = $this->getCart();
        $billingData = $this->getRequest()->getPost('billing');
        $billing = \Mage::getModel('Model\Cart\Address');

        $query = "SELECT * FROM `cartaddress` WHERE `cartId`='$cart->cartId' AND `addressType` = 'billing'";
        $billingAddress = $billing->fetchRow($query);

        if (!$billingAddress) {
            $billing->setData($billingData);
            $billing->addressType = 'billing';
            $billing->cartId = $cart->cartId;
            $billing->save();
        } else {
            $billingAddress->setData($billingData);
            $billingAddress->save();
        }

        $addressId = $this->getRequest()->getPost('saveBilling');
        if ($addressId) {
            $address = \Mage::getModel('Model\Address');

            $query = "SELECT * FROM `address` WHERE `id`= '$cart->customerId' AND `addressType` = 'billing'";
            $address = $address->fetchRow($query);

            if ($address) {
                $address->setData($billingData);
                $address->save();
            } else {
                $address = \Mage::getModel('Model\Address');
                $address->id = $cart->customerId;
                $address->setData($billingData);
                $address->addressType = 'billing';
                $address->save();
            }
        }
        $gridhtml = \Mage::getBlock('Block\Admin\Checkout\Grid')->setCart($this->getCart())->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                'selector' => '#contentHtml',
                'html' => $gridhtml
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }

    public function saveshippingAction()
    {
        $cart = $this->getCart();
        $shippingData = $this->getRequest()->getPost('shipping');
        $shipping = \Mage::getModel('Model\Cart\Address');

        $query = "SELECT * FROM `cartaddress` WHERE `cartId`='$cart->cartId' AND `addressType` = 'shipping'";
        $shippingAddress = $shipping->fetchRow($query);

        if (!$shippingAddress) {
            $shipping->setData($shippingData);
            $shipping->addressType = 'shipping';
            $shipping->cartId = $cart->cartId;
            $shipping->save();
        } else {
            $shippingAddress->setData($shippingData);
            $shippingAddress->save();
        }

        $addressId = $this->getRequest()->getPost('saveShipping');
        if ($addressId) {
            $address = \Mage::getModel('Model\Address');

            $query = "SELECT * FROM `address` WHERE `id`= '$cart->customerId' AND `addressType` = 'shipping'";
            $address = $address->fetchRow($query);

            if ($address) {
                $address->setData($shippingData);
                $address->save();
            } else {
                $address = \Mage::getModel('Model\Address');
                $address->id = $cart->customerId;
                $address->setData($shippingData);
                $address->addressType = 'shipping';
                $address->save();
            }
        }

        // $addressAsBilling = $this->getRequest()->getPost('samaAsBilling');
        // if ($addressAsBilling) {

        //     $shipping = \Mage::getModel('Model\Cart\Address');
        //     $billing = \Mage::getModel('Model\Cart\Address');


        //     $query = "SELECT * FROM `cartaddress` WHERE `cartId`='$cart->cartId' AND `addressType` = 'billing'";
        //     $billingAddress = $billing->fetchRow($query);
        //     // \print_r($billingAddress);
        //     // die();

        //     $shipping = $billingAddress;
        //     $shipping = $shipping->address;
        //     echo "<pre>";
        //     \print_r($shipping);
        //     die();
        //     // $shipping->address = $billingAddress->address;
        //     // $shipping->addressType = 'shipping';
        //     // $shipping->save();
        //     // die();
        // }

        $gridhtml = \Mage::getBlock('Block\Admin\Checkout\Grid')->setCart($this->getCart())->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                'selector' => '#contentHtml',
                'html' => $gridhtml
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }

    public function savePaymentMethodAction()
    {
        $paymentMethod = $this->getRequest()->getPost('paymentMethod');

        if (!array_key_exists('paymentMethodId', $paymentMethod)) {
            $cart = $this->getCart();
            $modelCart = \Mage::getModel('Model\Cart')->load($cart->cartId);
            $modelCart->paymentMethodId = $paymentMethod['paymentMethodId'];
            $modelCart->total = $this->getTotal();
            // $modelCart->discount = $this->getDiscount();
            $modelCart->save();
        } else {
            throw new \Exception("Select a payment method.");
        }
        $gridhtml = \Mage::getBlock('Block\Admin\Checkout\Grid')->setCart($this->getCart())->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                'selector' => '#contentHtml',
                'html' => $gridhtml
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }

    public function saveShippingMethodAction()
    {
        $shippingMethod = $this->getRequest()->getPost('shippingMethod');
        $shippingModel = \Mage::getModel('Model\Shipping')->load($shippingMethod);

        if (!array_key_exists('shippingMethodId', $shippingMethod)) {
            $cart = $this->getCart();
            $modelCart = \Mage::getModel('Model\Cart')->load($cart->cartId);
            $modelCart->shippingMethodId = $shippingMethod['shippingMethodId'];
            $modelCart->shippingAmount = $shippingModel->amount;
            $modelCart->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Checkout\Grid')->setCart($this->getCart())->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'mihir',
                'element' => [
                    'selector' => '#contentHtml',
                    'html' => $gridhtml
                ]
            ];
            header("Content-type: application/json charset=utf-8");
            echo json_encode($response);
        }
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

    // public function getDiscount()
    // {
    //     $cartItems = $this->getCart()->getItems();
    //     $discount = 0;
    //     foreach ($cartItems->getData() as $key => $cartItem) {
    //         // $query = "SELECT * FROM ";
    //         $discount = $cartItem->quantity * $cartItem->discount;
    //     }
    //     return $discount;
    // }
}
