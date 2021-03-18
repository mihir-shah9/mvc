<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Admin\Dashboard');
\Mage::loadFileByClassName('Controller\Core\Admin');
class Shipping extends \Controller\Core\Admin
{
    protected $shipping = null;
    protected $shippings = [];
    protected $message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
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
            $shipping = \Mage::getModel('Model\Shipping');
            if ($id = $this->getRequest()->getGet("id")) {
                $shipping = $shipping->load($id);
                if (!$shipping) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $shipping->createdDate = date("Y-m-d H:i:s");
            }
            $shippingData = $this->getRequest()->getPost('shipping');
            $shipping->setData($shippingData);
            $shipping->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
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

    public function editAction()
    {
        try {
            $shipping = \Mage::getModel('Model\Shipping');
            $id = (int) $this->getRequest()->getGet('id');
            if ($id) {
                $shipping->load($id);
                if (!$shipping) {
                    throw new \Exception("No Data Found.");
                }
            }

            $gridhtml = \Mage::getBlock('Block\Admin\Shipping\Edit')->setTableRow($shipping)->toHtml();
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
            $shipping = \Mage::getModel('Model\Shipping');
            $shippingData = $this->getRequest()->getPost('shipping');
            $shipping->load($id);
            $shipping->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
