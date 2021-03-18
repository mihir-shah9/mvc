<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Product extends \Controller\Core\Admin
{
    protected $product = NULL;
    protected $message = null;
    protected $productMedia = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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
        if ($this->getRequest()->getGet('tab') == 'media') {
            $productMedia = \Mage::getController('Controller\Admin\Product\Media');
            $productMedia->mediaSaveAction();
        }
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $product = \Mage::getModel('Model\Product');
            if ($id = $this->getRequest()->getGet("id")) {
                $product = $product->load($id);
                if (!$product) {
                    throw new \Exception("Recoed Not Found.");
                }
                $product->updatedDate =  date("Y-m-d H:i:s");
            } else {
                $product->createdDate =  date("Y-m-d H:i:s");
            }
            $productData = $this->getRequest()->getPost('product');
            $product->setData($productData);
            $product->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $product = \Mage::getModel('Model\Product');
            $productData = $this->getRequest()->getPost('product');
            $product->load($id);
            $product->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }

    public function editAction()
    {
        try {
            $product = \Mage::getModel('Model\Product');
            $id = (int) $this->getRequest()->getGet('id');
            if ($id) {
                $product->load($id);
                if (!$product) {
                    throw new \Exception("No Data Found.");
                }
            }

            $gridhtml = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();
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
        }
    }
}
