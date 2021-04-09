<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Cart extends \Controller\Core\Admin
{
    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Cart\Grid')->setCart($this->getCart())->toHtml();
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
    public function addToCartAction()
    {
        $productId = $this->getRequest()->getGet('id');
        $product = \Mage::getModel('Model\Product')->load($productId);

        if ($product) {
            $this->getCart()->addItemToCart($product);
        }

        $gridhtml = \Mage::getBlock('Block\Admin\Cart\Grid')->setCart($this->getCart())->toHtml();
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

    public function selectCustomerAction()
    {
        $data = $this->getRequest()->getPost('customerId');
        $session = \Mage::getModel('Model\Admin\Session');
        $session->customerId = $data;

        $gridhtml = \Mage::getBlock('Block\Admin\Cart\Grid')->setCart($this->getCart($data))->toHtml();
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

    public function deleteItemAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $cartItem = \Mage::getModel('Model\Cart\Item');
            // $cartItem->load($id);
            $cartItem->delete($id);

            $gridhtml = \Mage::getBlock('Block\Admin\Cart\Grid')->setCart($this->getCart())->toHtml();
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
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            // $this->redirect('grid');
        }
    }

    public function updateAction()
    {
        $quantities = $this->getRequest()->getPost('item');
        foreach ($quantities as $key => $quantity) {
            $cartItem = \Mage::getModel('Model\Cart\Item')->load($key);
            $cartItem->quantity = $quantity;
            $cartItem->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Cart\Grid')->setCart($this->getCart())->toHtml();
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

    public function checkoutMethodAction()
    {
        // $this->redirect('grid', 'checkout');
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
