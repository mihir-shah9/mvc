<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Customer extends \Controller\Core\Admin
{
    protected $customer = NULL;
    protected $customers = [];
    protected $message = null;
    protected $billing = null;
    protected $shipping = null;


    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridhtml
                ],
                [
                    'selector' => '#leftHtml',
                    'html' => null
                ]
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $customer = \Mage::getModel('Model\Customer');
            if ($id = $this->getRequest()->getGet("id")) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception("Recoed Not Found.");
                }
                $customer->updatedDate =  date("Y-m-d H:i:s");
            } else {
                $customer->createdDate =  date("Y-m-d H:i:s");
            }
            $customerData = $this->getRequest()->getPost('customer');
            $customer->setData($customerData);
            $password = md5($customer->password);
            $customer->password = $password;
            $customerId = $customer->save();
            $this->redirect('form', null, ['tab' => 'customer_address', 'Id' => $customerId], true);
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            // $this->redirect('grid');
        }
    }

    public function editAction()
    {
        try {
            $customer = \Mage::getModel('Model\Customer');
            $id = (int) $this->getRequest()->getGet('id');
            if ($id) {
                $customer->load($id);
                if (!$customer) {
                    throw new \Exception("No Data Found.");
                }
            }

            $gridhtml = \Mage::getBlock('Block\Admin\Customer\Edit')->setTableRow($customer)->toHtml();
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
            echo $e->getMessage();
            die();
        }
    }


    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $customer = \Mage::getModel('Model\Customer');
            $customerData = $this->getRequest()->getPost('customer');
            $customer->load($id);
            $customer->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }

    public function addressAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $billing = \Mage::getModel('Model\Address');
            if ($id = $this->getRequest()->getGet("addressId")) {
                $billing = $billing->load($id);
                if (!$billing) {
                    throw new \Exception("Recoed Not Found.");
                }
            }
            $billingData = $this->getRequest()->getPost('billing');
            $billing->addressType = 'billing';
            $billing->setData($billingData);
            $billing->save();

            $shipping = \Mage::getModel('Model\Address');
            if ($id = $this->getRequest()->getGet("addressId")) {
                $shipping = $shipping->load($id);
                if (!$shipping) {
                    throw new \Exception("Recoed Not Found.");
                }
            }
            $shippingData = $this->getRequest()->getPost('shipping');
            $shipping->addressType = 'shipping';
            $shipping->setData($shippingData);
            $shipping->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'mihir',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $gridhtml
                    ],
                    [
                        'selector' => '#leftHtml',
                        'html' => null
                    ]
                ]
            ];
            header("Content-type: application/json charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
        }
    }
}
