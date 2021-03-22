<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Brand extends \Controller\Core\Admin
{
    protected $brand = null;
    protected $message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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

    // public function formAction()
    // {
    //     $formhtml = \Mage::getBlock('Block\Admin\Brand\Edit')->toHtml();
    //     $response = [
    //         'status' => 'success',
    //         'message' => 'mihir',
    //         'element' => [
    //             'selector' => '#contentHtml',
    //             'html' => $formhtml
    //         ]
    //     ];
    //     header("Content-type: application/json charset=utf-8");
    //     echo json_encode($response);
    // }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $brand = \Mage::getModel('Model\Brand');
            if ($id = $this->getRequest()->getGet('brandId')) {
                $brand = $brand->load($id);
                if (!$brand) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $brand->createdDate = date("Y-m-d H:i:s");
            }
            $brandData = $this->getRequest()->getPost('brand');
            $brand->setData($brandData);
            $brand->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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
        }
    }

    public function editAction()
    {
        try {
            $brand = \Mage::getModel('Model\Brand');
            $id = (int) $this->getRequest()->getGet('brandId');
            if ($id) {
                $brand->load($id);
                if (!$brand) {
                    throw new \Exception("No Data Found.");
                }
            }

            $gridhtml = \Mage::getBlock('Block\Admin\Brand\Edit')->toHtml();
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
            $id = (int) $this->getRequest()->getGet('brandId');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $brand = \Mage::getModel('Model\Brand');
            $brandData = $this->getRequest()->getPost('brand');
            $brand->load($id);
            $brand->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            // $this->redirect('grid');
        }
    }
}
